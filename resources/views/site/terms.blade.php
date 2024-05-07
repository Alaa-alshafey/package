@extends('layouts.app')

@section('content')


@push('style')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&libraries=places&language=en-AU"></script>

@endpush

<div class="department">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1><span> سياسة الشروط والأحكام العامة</span></h1>
                {!! getsetting('terms_provider')!!}
             </div>

            <br>
            <br>

             <div class="col-xs-12 col-sm-12 col-md-12">
                 <h1><span>عضوية التميز</span></h1>
                 {!! getsetting('terms_user') !!}
            </div>

        </div>
    </div>
</div>

@endsection
