@extends('admin.layout')
@section('title')
    صناديق العملاء
@endsection

@section('header')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">تفاصيل الصندوق</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    {!! Form::model($transport) !!}

                    <div class="form-group col-md-6 pull-left">
                        <label>اسم العضو</label>
                        {!! Form::text("calculated_price",$transport->client->name,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>وقت البداية</label>
                        {!! Form::text("start_time",null,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>


                    <div class="form-group col-md-6 pull-left">
                        <label>حجم الصندوق</label>
                        {!! Form::text("name_en",$transport->size->name,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>الوزن</label>
                        {!! Form::text("weight",null,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>


                    <div class="form-group col-md-12 pull-left">
                        <label>المسافة</label>
                        {!! Form::text("distance",null,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>السعر المتوقع</label>
                        {!! Form::text("offered_price",null,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>

                    <div class="form-group col-md-6 pull-left">
                        <label>السعر المحسوب</label>
                        {!! Form::text("calculated_price",null,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>نوع السيارة</label>
                        {!! Form::text("car_type_id",$transport->carType->name,['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>الحالة</label>
                        {!! Form::text("is_ended",$transport->is_ended==0?'غير منتهي':'منتهي',['class'=>'form-control ','readonly'=>'readonly'])!!}
                    </div>
                    {!! Form::hidden('start_lat',$transport->start_point_latitude,['id'=>'start_lat']) !!}
                    {!! Form::hidden('start_lng',$transport->start_point_longitude,['id'=>'start_lng']) !!}
                    {!! Form::hidden('end_lat',$transport->end_point_latitude,['id'=>'end_lat']) !!}
                    {!! Form::hidden('end_lng',$transport->end_point_longitude,['id'=>'end_lng']) !!}
                    @include('admin.map')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/form_layouts.js')}}"></script>
@endsection
