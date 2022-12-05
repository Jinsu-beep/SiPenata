@extends('layouts/home/index-layout')
@section('title') Dasar Hukum @endsection

@push('css')
<style>
    .pdfobject-container { height: 50rem;}
</style>
@endpush

@section('content')
<section class="section">
    <div class="container mt-4">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-sm-12 col-md-6 col-lg-12">
                <div class="title">
                    <h2>Dasar Hukum</h2>
                    <p>
                        <ul>
                            <table id="example2" class="table table-bordered table-hover">
                                <tbody>
                                    @foreach ($dataDasarHukum as $ddh)
                                    <tr>
                                        <td><li><a onclick="showFile({{ $ddh->id }})" href="#">{{ $ddh->nama }}</a> </li></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-showFile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">File Dasar Hukum</h4>
                </button>
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
        $('#menu-dasarhukum').addClass('active');
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
        // var data_DasarHukum = {!! json_encode($dataDasarHukum->toArray()) !!}
        // PDFObject.embed(data_DasarHukum.file_DasarHukum, "#file");
        // $('#modal-showFile').modal('show');
    }
</script>
@endpush