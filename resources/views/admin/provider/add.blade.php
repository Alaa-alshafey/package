@extends('admin.layout')
@section('title')
اضافة  مزود خدمة جديد
@endsection

@section('header')

@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">اضافة  مزود خدمة جديد</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    {!!Form::open( ['route' => 'admin.provider.store' ,'class'=>'form phone_validate', 'method' => 'Post','enctype'=>"multipart/form-data",'files' => true]) !!}
                    @include('admin.provider.form')
                    {!!Form::close() !!}
                </div>

            </div>
        </div>
    </div>
<!-- #END# Basic Validation -->
@endsection

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="/admin/assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="/admin/assets/js/plugins/pickers/pickadate/legacy.js"></script>

    <script type="text/javascript" src="/admin/assets/js/core/app.js"></script>
    <script type="text/javascript" src="/admin/assets/js/pages/picker_date.js"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/form_layouts.js')}}"></script>
@endsection
