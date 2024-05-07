@extends('admin.layout')
@section('title')
    تعديل
    {{--{{dd($faq)}}--}}
      {{$slider->ar_name}}
@endsection

@section('header')
@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">تعديل {{$slider->name}}</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                            {!!Form::model($slider , ['route' => ['admin.sliders.update' , $slider->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}
                                @include('admin.sliders.form')
                            {!!Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/form_layouts.js')}}"></script>

@endsection
