@extends('admin.layout')
@section('title')
    تعديل
      {{$event->title}}
@endsection

@section('header')
@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">تعديل {{$event->title}}</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                            {!!Form::model($event , ['route' => ['admin.events.update' , $event->id] ,
                            'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}
                                @include('admin.events.form')
                            {!!Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/form_layouts.js')}}"></script>
    <script>
        $(document).ready(function() {

            $('#Category').change(function () {

                var val = $(this).val();
                var base_url = "{{asset('/')}}";
                if (val == "") {
                    val = 0;
                }
                url =  base_url + "events/sub_categories/" + val;

                console.log(url);
                $.ajax({
                    type: "GET",
                    url: base_url + "events/sub_categories/" + val,

                    success: function (data) {
                        $('#subCat').html(data);
                    }
                });


            });
        });
    </script>
@endsection
