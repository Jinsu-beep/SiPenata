@extends('layouts/home/index-layout')
@section('title') Dasar Hukum @endsection

@push('css')
<style>
    .pdfobject-container { height: 50rem;}
</style>
@endpush

@section('content')
<!-- ======= F.A.Q Section ======= -->
<section id="faq" class="faq section-bg">
    <div class="container mt-4">
        <div class="section-title" data-aos="fade-up">
            <p>Dasar Hukum</p>
        </div>
        <div class="faq-list">
            <ul>
                @foreach ($dataDasarHukum as $ddh)
                    <li data-aos="fade-up">
                        <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                            <a onclick="showFile({{ $ddh->id }})" href="#">{{ $ddh->nama }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
<!-- End F.A.Q Section -->

<div class="modal fade" id="modal-showFile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">File Dasar Hukum</h4>
            </div>
            <div class="modal-body">
                <div id="file"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{-- PDFObject --}}
<script src="/PDFObject/pdfobject.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#dasarHukum').addClass('active');
    });
</script>

<script>
    function showFile(id) {
        $.ajax({
            type: 'GET',
            url: '/landingdasarhukum/'+id,
            success:function(response){
                console.log(response);
                PDFObject.embed(response.file_DasarHukum, "#file");
                $('#modal-showFile').modal('show');
            }
        });
    }
</script>
@endpush