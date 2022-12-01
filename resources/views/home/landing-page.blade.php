@extends('layouts/home/index-layout')
@section('title') Welcome @endsection

@section('content')
    {{-- About Start --}}
	@include('home/about-layout')
    {{-- About End --}}

    <div class="container">
        <hr>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#home').addClass('active');
            $('#menu-home').addClass('active');
        });
    </script>
@endpush