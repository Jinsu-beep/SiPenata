@extends('layouts/home/index-layout')
@section('title') Welcome @endsection

@section('content')
    {{-- About Start --}}
	@include('home/tentang_kami/about-layout')
    {{-- About End --}}

    <div class="container">
        <hr>
    </div>

    {{-- Dasar Hukum Start --}}
    @include('home/dasar_hukum/dasar_hukum')
    {{-- Dasar Hukum End --}}
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#menu-home').addClass('active');
        });
    </script>
@endpush