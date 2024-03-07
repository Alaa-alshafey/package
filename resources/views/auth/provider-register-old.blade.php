@extends('layouts.app')

@section('content')


    @push('style')
        <link href="{{ asset('/website/')}}/amssoftech.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet"/>
        {{--        <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/post.css" rel="stylesheet" />--}}
        <style>

            #regForm {
                background-color: #ffffff;
                padding: 10px;
                width: 100%;
                float: left;
                direction: rtl;
            }
            #regForm .import-compnay{
                position: absolute;
                left: 20px;
                top: -22px;
                color: #7ac943;
                font-size: 15px;
                font-weight: bold;
            }

            button {
                font-family: 'Janna LT' !important;
                background-color: #98c64c;
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                font-size: 17px;
                /*font-family: Raleway;*/
                cursor: pointer;
            }

            button:hover {
                opacity: 0.8;
            }

            #prevBtn {
                background-color: #bbbbbb;
            }

            #nextBtn {
                float: left;
                color: #ffffff;
                background: #176083;
            }

            #submitBtn {
                float: left;
                padding: 10px 50px;
                border-radius: 50px;
            }

            input, select {
                font-family: 'Janna LT' !important;
                padding: 6px 10px;
                width: 100%;
                font-size: 17px;
                border: 1px solid #aaaaaa;
                line-height: 25px !important;
            }

            input:hover, input:focus, select:hover, select:focus {
                outline: 0;
                border: 1px solid #176083;
            }

            .check-box input ~ .checkmark{
                background-color: #d7d7d7;

                border: 1px solid #888;
            }
            .user-bg label{
                -webkit-border-radius: 18px;
                -moz-border-radius: 18px;
                border-radius: 18px;
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
            }

            .next-step{
                color:#ffffff;
                background:#006bb3;
                padding: 10px 50px;
                border-radius: 50px !important;
            }
            .prev-step{
                background-color: #bcc732;
                padding: 10px 50px;
                border-radius: 50px !important;
                border:1px solid #bcc732;
            }

            #regForm select{
                -webkit-border-radius: 16px !important;
                -moz-border-radius: 16px !important;
                border-radius: 16px !important;
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
                padding: 5px 0 !important;
            }
            #regForm input{
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
            }
            #regForm input[type='file']{
                width: 98% !important;
            }

            /* Mark input boxes that gets an error on validation: */
            input.invalid {
                background-color: #ffdddd;
            }

            #snackbar {
                visibility: hidden;
                min-width: 250px;
                margin-left: -125px;
                background-color: #ef003b;
                color: #fff;
                text-align: center;
                border-radius: 2px;
                padding: 16px;
                position: fixed;
                z-index: 1;
                left: 50%;
                top: 30px;
                font-size: 17px;
            }

            #snackbar.show {
                visibility: visible;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }

            @-webkit-keyframes fadein {
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @keyframes fadein {
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @-webkit-keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }

            @keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }

            @charset "UTF-8";
            .stepper .nav-tabs {
                position: relative;
                padding-left: 50px;

            }
            .stepper .nav-tabs > li {
                width: 25%;
                position: relative;
            }
            .stepper .nav-tabs > li:after {
                content: '';
                position: absolute;
                background: #f1f1f1;
                display: block;
                width: 100%;
                height: 5px;
                top: 30px;
                right: 50%;
                z-index: 1;
            }
            .stepper .nav-tabs > li.completed::after {
                background: #3ea7f1;
            }
            .stepper .nav-tabs > li:last-child::after {
                background: transparent;
            }
            .stepper .nav-tabs > li.active:last-child .round-tab {
                background: #34bc9b;
            }
            .stepper .nav-tabs > li.active:last-child .round-tab::after {
                content: '✔';
                color: #fff;
                position: absolute;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: 0;
                display: block;
            }
            .stepper .nav-tabs [data-toggle='tab'] {
                width: 25px;
                height: 25px;
                margin: 20px auto;
                border-radius: 100%;
                border: none;
                padding: 0;
                color: #f1f1f1;

            }
            .stepper .nav-tabs [data-toggle='tab']:hover {
                background: transparent;
                border: none;
            }
            .stepper .nav-tabs > .active > [data-toggle='tab'], .stepper .nav-tabs > .active > [data-toggle='tab']:hover, .stepper .nav-tabs > .active > [data-toggle='tab']:focus {
                color: #3ea7f1;
                cursor: default;
                border: none;
            }
            .stepper .tab-pane {
                position: relative;
                padding-top: 50px;
            }
            .stepper .round-tab {
                width: 25px;
                height: 25px;
                line-height: 22px;
                display: inline-block;
                border-radius: 25px;
                background: #fff;
                border: 2px solid #3ea7f1;
                color: #3ea7f1;
                z-index: 2;
                position: absolute;
                left: 0;
                text-align: center;
                font-size: 14px;
            }
            .stepper .completed .round-tab {
                background: #3ea7f1;
            }
            .stepper .completed .round-tab::after {
                content: '✔';
                color: #fff;
                position: absolute;
                left: 0;
                right: 0;
                margin: 0 auto;
                top: 0;
                display: block;
            }
            .stepper .active .round-tab {
                background: #fff;
                border: 2px solid #3ea7f1;
            }
            .stepper .active .round-tab:hover {
                background: #fff;
                border: 2px solid #3ea7f1;
            }
            .stepper .active .round-tab::after {
                display: none;
            }
            .stepper .disabled .round-tab {
                background: #fff;
                color: #f1f1f1;
                border-color: #f1f1f1;
            }
            .stepper .disabled .round-tab:hover {
                color: #3ea7f1;
                border: 2px solid #3ea7f1;
            }
            .stepper .disabled .round-tab::after {
                display: none;
            }
            .login-bg a:hover, .login-bg a:focus{
                color: #555;
                outline: none;
            }

        </style>

    @endpush


    <div class="container">



        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                <div class="text-center">
                    <a href="/"><img style="padding: 0px" src="{{asset('sheari-logo-1.png')}}" class="login-logo"/></a>
                </div>
                <div class="profile-bar">

                    <form id="regForm" method="post" action="/register"  enctype="multipart/form-data">
                        @csrf
                        <div class="pos login-tab">
                        </div>
                        <h1><span>
التسجيل كمقدم خدمة</span></h1>

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="stepper">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a class="persistant-disabled" href="#stepper-step-1" data-toggle="tab" aria-controls="stepper-step-1" role="tab" title="Step 1">
                                                <span class="round-tab">1</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a class="persistant-disabled" href="#stepper-step-2" data-toggle="tab" aria-controls="stepper-step-2" role="tab" title="Step 2">
                                                <span class="round-tab">2</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a class="persistant-disabled" href="#stepper-step-3" data-toggle="tab" aria-controls="stepper-step-3" role="tab" title="Step 3">
                                                <span class="round-tab">3</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="disabled">
                                            <a class="persistant-disabled" href="#stepper-step-4" data-toggle="tab" aria-controls="stepper-step-4" role="tab" title="Complete">
                                                <span class="round-tab">4</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" role="tabpanel" id="stepper-step-1">
                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                                    <div class="user-bg">
                                                                        <label class="check-box">
                                                                            شركة
                                                                            <input type="radio"   name="provider_type" id="company"
                                                                                   onclick="getRadio()">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-6 col-md-6">
                                                                    <div class="user-bg">
                                                                        <label class="check-box">
                                                                            <script type="text/javascript">
                                                                                function getRadio() {
                                                                                    var x = document.getElementById("one");
                                                                                    if (x.checked) {

                                                                                        document.getElementById("UserType").value = "one";
                                                                                        document.getElementById("DIVCompany").style.display = 'none';
                                                                                        document.getElementById("CompanyName").value = " ";

                                                                                    } else {

                                                                                        document.getElementById("UserType").value = "company";
                                                                                        document.getElementById("DIVCompany").style.display = 'block';
                                                                                    }


                                                                                }
                                                                            </script>

                                                                            فرد

                                                                            <input type="radio" name="provider_type" id="one"
                                                                                   onclick="getRadio()">
                                                                            <input type="hidden" id="UserType" name="provider_type">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                @if ($errors->has('provider_type'))
                                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('provider_type') }}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="btn btn-primary next-step">التالى</span>

                                        </div>

                                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-2">
                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg" id="DIVCompany">
                                                            <div class="row">

                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <script type="text/javascript">
                                                                        function getCompany() {
                                                                            var MNC = document.getElementById("MNC");
                                                                            var LTD = document.getElementById("LTD");
                                                                            var PVT = document.getElementById("PVT");
                                                                            var Registered = document.getElementById("Registered");
                                                                            if (MNC.checked) {

                                                                                document.getElementById("CompanyType").value = "MNC";
                                                                                document.getElementById("VIP").checked = true;

                                                                            } else if (LTD.checked) {

                                                                                document.getElementById("CompanyType").value = "LTD";

                                                                                document.getElementById("VIP").checked = false;
                                                                            } else if (PVT.checked) {

                                                                                document.getElementById("CompanyType").value = "PVT";
                                                                                document.getElementById("VIP").checked = false;

                                                                            } else if (Registered.checked) {

                                                                                document.getElementById("CompanyType").value = "Registered";
                                                                                document.getElementById("VIP").checked = false;

                                                                            }


                                                                        }
                                                                    </script>
                                                                    <input type="hidden" id="CompanyType" value="Registered"
                                                                           name="provider_company_type">
                                                                    <p>اختر نوع الشركة</p>
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-md-12">
                                                                            <p class="import-compnay">حساب التميز</p>
                                                                            <div class="row" style="border: 2px solid#e1eaf2;margin-right: 0px;margin-left: 0px;border-radius: 18px;">

                                                                                <div class="col-xs-12 col-md-6">
                                                                                    <div class="user-bg" style="border: none; float: none">
                                                                                        <label class="check-box">
                                                                                            قابضة
                                                                                            <input type="radio" name="ctype" class="ctype" id="MNC"
                                                                                                   onclick="getCompany()" >
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-xs-12 col-md-6">
                                                                                    <div class="user-bg" style="border: none; float: none">
                                                                                        <label class="check-box">
                                                                                            مساهمة
                                                                                            <input type="radio" name="ctype" class="ctype" id="LTD"
                                                                                                   onclick="getCompany()">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xs-12 col-md-12" >
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-md-6">

                                                                                    <div class="user-bg" style="border: none; float: none">
                                                                                        <label class="check-box" >
                                                                                            محدودة
                                                                                            <input type="radio" name="ctype" class="ctype" id="PVT"
                                                                                                   onclick="getCompany()">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-xs-12 col-md-6">

                                                                                    <div class="user-bg" style="border: none; float: none">
                                                                                        <label class="check-box">
                                                                                            ناشئة
                                                                                            <input type="radio" name="ctype" class="ctype" id="Registered"
                                                                                                   onclick="getCompany()">
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if ($errors->has('provider_company_type'))
                                                                <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('provider_company_type') }}</strong>
                                                        </span>
                                                            @endif
                                                        </div>
                                                        <div class="time-bg">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>الاسم*</label>
                                                                        <input type="text" name="name" required/>
                                                                        @if ($errors->has('name'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <script type="text/javascript"
                                                                            src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyBJEJYZ4EU2nWnOmjkkSaKw3TxUSO5lTMM&libraries=places&language=ar-AU"></script>
                                                                    <script type="text/javascript">
                                                                        google.maps.event.addDomListener(window, 'load', function () {
                                                                            var places = new google.maps.places.Autocomplete(document.getElementById('Location'));
                                                                            google.maps.event.addListener(places, 'place_changed', function () {
                                                                                var place = places.getPlace();
                                                                                // var address = place.formatted_address;


                                                                            });
                                                                        });
                                                                    </script>


                                                                    <label>العنوان‎*</label>
                                                                    <div class="form-group">
                                                                        <input type="text" placeholder="" name="address" required
                                                                               id="Location"/>
                                                                    </div>
                                                                    @if ($errors->has('address'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <label>الدولة*</label>
                                                                    <div class="form-group">


                                                                        {!! Form::select("country_id",countries(),null,['class'=>'form-group ','id'=>'Country','placeholder'=>'اختر الدولة', 'required'])!!}

                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12" id="DIVCity">
                                                                    <label>المدينة*</label>
                                                                    <div class="form-group">
                                                                        {!! Form::select("city_id",cities(),null,['class'=>'form-group ','id'=>'area','placeholder'=>'اختر المدينة ' ,'disabled'])!!}
                                                                    </div>

                                                                </div>

                                                                <div class="col-xs-12 col-sm-12 col-md-12" id="DIVregion">
                                                                    <label>المنطقة*</label>
                                                                    <div class="form-group">
                                                                        {!! Form::select("region_id",regions(),null,['class'=>'form-group ','id'=>'area','placeholder'=>'اختر المنطقة ' ,'disabled'])!!}
                                                                    </div>

                                                                    @if ($errors->has('region_id'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('region_id') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="btn btn-primary next-step">التالى</span>
                                            <span class="btn btn-warning prev-step">الرجوع</span>

                                        </div>
                                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-3">
                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <div class="row">

                                                                <script type="text/javascript">
                                                                    function getMobile() {
                                                                        var CCode = document.getElementById('CCode').value;
                                                                        var CMobile = document.getElementById('CMobile').value;
                                                                        if (CCode == "") {
                                                                            alert("مفتاح الدولة");
                                                                            document.getElementById('CMobile').value = "";
                                                                            document.getElementById('Mobile').value = "";
                                                                        } else {
                                                                            var res = CMobile.charAt(0);
                                                                            if (res == "0") {
                                                                                CMobile = CMobile.substring(1);
                                                                            } else {
                                                                                CMobile = CMobile.substring(0);
                                                                            }
                                                                            document.getElementById('Mobile').value = CCode + "" + CMobile;
                                                                        }
                                                                    }

                                                                    function isNumber(evt) {
                                                                        evt = (evt) ? evt : window.event;
                                                                        var charCode = (evt.which) ? evt.which : evt.keyCode;
                                                                        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                                                            return false;
                                                                        }
                                                                        return true;
                                                                    }

                                                                    function resetField() {
                                                                        document.getElementById('CMobile').value = "";
                                                                        document.getElementById('Mobile').value = "";
                                                                    }

                                                                </script>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>مفتاح الدولة *</label>
                                                                        <select class="form-group" id="CCode" onchange="return resetField()"
                                                                                required>
                                                                            <option value="" disabled selected>مفتاح الدولة</option>
                                                                            <option value="966">966</option>
                                                                            <option value="971">971</option>
                                                                            <option value="965">965</option>
                                                                            <option value="973">973</option>
                                                                            <option value="968">968</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>رقم الجوال*</label>
                                                                        <input type="text" name="phone" id="CMobile" required
                                                                               placeholder="مثال : 512345678"
                                                                        />

                                                                        @if ($errors->has('phone'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>صورة  *</label>
                                                                    <input type="file" name="image" />

                                                                    @if ($errors->has('image'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>



                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <script type="text/javascript">
                                                                            function getUserName(getval) {
                                                                                //UserName
                                                                                document.getElementById("UserName").value = getval;
                                                                                document.getElementById("PageURL").value = getval;
                                                                            }
                                                                        </script>
                                                                        <label>البريد الإلكتروني*</label>
                                                                        <input type="email" name="email" required
                                                                               onchange="return getUserName(this.value)"/>

                                                                        @if ($errors->has('email'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>الرقم السري*</label>

                                                                        <input type="password" name="password" required/>

                                                                        @if ($errors->has('password'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>تأكيد الرقم السري*</label>
                                                                        <input type="password" name="password_confirmation" required/>
                                                                        @if ($errors->has('password'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="btn btn-primary next-step">التالى</span>
                                            <span class="btn btn-warning prev-step">الرجوع</span>
                                        </div>

                                        <div class="tab-pane fade" role="tabpanel" id="stepper-step-4">
                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>نبذة عنا ( قل شيئا سيراه الآخرون ) :
                                                                        </label>
                                                                        <textarea class="form-control" rows="8" name="bio"
                                                                                  required></textarea>

                                                                        @if ($errors->has('bio'))
                                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('bio') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <script type="text/javascript">
                                                                    function getTypeReg() {
                                                                        var Charitable = document.getElementById("Charitable");
                                                                        var Delivery = document.getElementById("Delivery");
                                                                        var LoMap = document.getElementById("LoMap");

                                                                        var HdnType = document.getElementById("Type").value;

                                                                        if (Charitable.checked) {

                                                                            var n = HdnType.includes("Charitable");
                                                                            if (n) {

                                                                            } else {
                                                                                document.getElementById("Type").value = "Charitable";
                                                                                HdnType = HdnType + "," + document.getElementById("Type").value;
                                                                            }
                                                                        }
                                                                        if (Delivery.checked) {
                                                                            var n = HdnType.includes("Delivery");
                                                                            if (n) {

                                                                            } else {
                                                                                document.getElementById("Type").value = "Delivery";
                                                                                HdnType = HdnType + "," + document.getElementById("Type").value;
                                                                            }
                                                                        }
                                                                        if (LoMap.checked) {
                                                                            var n = HdnType.includes("Location on Map");
                                                                            if (n) {

                                                                            } else {
                                                                                document.getElementById("Type").value = "Location on Map";
                                                                                HdnType = HdnType + "," + document.getElementById("Type").value;
                                                                            }
                                                                        }


                                                                        document.getElementById("Type").value = HdnType;
                                                                        //alert(HdnType);
                                                                    }
                                                                </script>
                                                                <input type="hidden" id="Type" value="Location on Map" name="Type">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <label>خدمات لوجستية إضافية      </label>
                                                                    <hr/>
                                                                    <label class="check-box">
                                                                        عروض خيرية
                                                                        <input type="checkbox" name="charitable" id="Charitable"
                                                                               value="Charitable" onclick="getTypeReg()">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="check-box">
                                                                        خدمات توصيل
                                                                        <input type="checkbox" name="delivery" id="Delivery"
                                                                               value="Delivery" onclick="getTypeReg()">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="check-box">
                                                                        الموقع على الخريطة
                                                                        <input type="checkbox" name="map" id="LoMap" value="LoMap"
                                                                               onclick="getTypeReg()" checked>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="plus" style="display:none">
                                                <div class="col-xs-12 col-sm-12 col-md-12" >
                                                    <div class="form-group">
                                                        <label> عدد الموظفين  *</label>
                                                        <input type="text" name="emp_no" id=" " required
                                                               placeholder="مثال : 50-10"
                                                        />

                                                        @if ($errors->has('emp_no'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('emp_no') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12"  >
                                                    <div class="form-group">
                                                        <label> سنة الإنشاء    *</label>
                                                        <input type="number" name="creation_year" id=" " required
                                                               placeholder="مثال : 2000"
                                                        />

                                                        @if ($errors->has('creation_year'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('creation_year') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12"  >
                                                    <div class="form-group">
                                                        <label> السجل الضريبى *</label>
                                                        <input type="number" name="commerical_no" id=" " required
                                                               placeholder="مثال : 512345678"
                                                        />

                                                        @if ($errors->has('commerical_no'))
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('commerical_no') }}</strong>
                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <label>اختر مجال الخدمه</label>

                                                    </div>
                                                </div>
                                            </div>



                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <label>قسم الاعلانات</label>

                                                            <div class="form-group">

                                                                {!! Form::select("ads_category",ad_category()
                                                                ,null,['class'=>'form-group ','id'=>'','placeholder'=>'اختر القسم الرئيسي', 'required'])!!}

                                                            </div>



                                                        </div>
                                                    </div>
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <label>القسم الرئيسي*</label>

                                                            <div class="form-group">

                                                                {!! Form::select("country_id",category(),
                                                                null,['class'=>'form-group ','id'=>'Department123','placeholder'=>'اختر القسم الرئيسي', 'required'])!!}

                                                            </div>


                                                            <div id="DIVSubDept">
                                                                <div id="DIVSubDept">
                                                                    <div><label>القسم الفرعي*</label></div>
                                                                    {{--                                                {!! Form::select("category_id",subCategory(),null,['class'=>'form-group ','id'=>'Department123','placeholder'=>'اختر القسم الفرعى', 'required'])!!}--}}
                                                                </div>

                                                            </div>


                                                            {{--                                        <div id="DIVSubDept">--}}
                                                            {{--                                            <div><label>الخدمة * </label></div>--}}
                                                            {{--                                            <div id="DIVService">--}}
                                                            {{--                                                {!! Form::select("service_id",services(),null,['class'=>'form-group ','id'=>'Department123','placeholder'=>'اختر الخدمة  ', 'required'])!!}--}}
                                                            {{--                                            </div>--}}

                                                            {{--                                            @if ($errors->has('service_id'))--}}
                                                            {{--                                                <span class="invalid-feedback" role="alert">--}}
                                                            {{--                                                            <strong>{{ $errors->first('service_id') }}</strong>--}}
                                                            {{--                                                        </span>--}}
                                                            {{--                                            @endif--}}
                                                            {{--                                        </div>--}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="input_5" class="col-sm-3 col-form-label">حدد موقعك على الخريطة</label>
                                                <div class="col-sm-9">
                                                    <div id="mapCanvas" style="height:450px;" class="col-md-12"></div>
                                                    <input type="hidden" value="24.774265" id="lat" name="lat" />
                                                    <input type="hidden" value="46.738586" id="lng" name="lng" />
                                                    @if($errors->has('lat'))
                                                        <div class="alert alert-danger">{{$errors->first('lat')}}</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="tab">
                                                <div class="form-group">
                                                    <div class="time-bg">
                                                        <div class="time-bg">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="user-bg">
                                                                        <!--<p data-toggle="collapse" data-target="#agreement">I agree the terms and conditions of sheari.com.sa</p>-->
                                                                        <label class="check-box" data-toggle="collapse"
                                                                               data-target="#agreement">
                                                                            الموافقة
                                                                            <input type="radio" name="agree">
                                                                            <span class="checkmark"></span>
                                                                        </label>


                                                                        <div id="agreement" class="collapse">
                                                                            <p>

                                                                                برجاء الاطلاع علي الشروط والاحكام داخل الموقع
                                                                            </p>
                                                                        </div>
                                                                        <span href="#!" class="nexr-btn" data-toggle="collapse"
                                                                              data-target="#agreement">عرض</span>
                                                                    </div>
                                                                    @if ($errors->has('agree'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('agree') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="align">
                                                    <button type="submit" id="submitBtn">حفظ</button>
                                                    <span class="btn btn-warning prev-step">الرجوع</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>













                    </form>
                </div>
                <div class="login-bg" style="background-color: #999">
                    <h5><span  style="background-color: #999; color: #fff" span>عضو في باكيج؟</span></h5>
                    <a style="background-color:#fbfbfb; border-radius: 21px; padding: 7px 41px; border: 1px solid #fbfbfb;" href="/login">الدخول</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('website/bootstrap-3-3-4-dist/js/Jq.js')}}"></script>
    <script src="{{asset('website/bootstrap-3-3-4-dist/post.js')}}"></script>
    <script src='https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js'></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script>

        /*jslint browser: true*/
        /*global $, jQuery, alert*/
        (function($) {
            'use strict';

            $(function() {

                $(document).ready(function() {

                    function triggerClick(elem) {
                        $(elem).click();
                    }

                    var $progressWizard = $('.stepper'),
                        $tab_active,
                        $tab_prev,
                        $tab_next,
                        $btn_prev = $progressWizard.find('.prev-step'),
                        $btn_next = $progressWizard.find('.next-step'),
                        $tab_toggle = $progressWizard.find('[data-toggle="tab"]'),
                        $tooltips = $progressWizard.find('[data-toggle="tab"][title]');

                    // To do:
                    // Disable User select drop-down after first step.
                    // Add support for payment type switching.

                    //Initialize tooltips
                    $tooltips.tooltip();

                    //Wizard
                    $tab_toggle.on('show.bs.tab', function(e) {
                        var $target = $(e.target);

                        if (!$target.parent().hasClass('active, disabled')) {
                            $target.parent().prev().addClass('completed');
                        }
                        if ($target.parent().hasClass('disabled')) {
                            return false;
                        }
                    });

                    // $tab_toggle.on('click', function(event) {
                    //     event.preventDefault();
                    //     event.stopPropagation();
                    //     return false;
                    // });

                    $btn_next.on('click', function() {


                        $tab_active = $progressWizard.find('.active');
                        // check inputs in div and display message if not true

                        $tab_active.next().removeClass('disabled');

                        $tab_next = $tab_active.next().find('a[data-toggle="tab"]');
                        triggerClick($tab_next);

                    });
                    $btn_prev.click(function() {
                        $tab_active = $progressWizard.find('.active');
                        $tab_prev = $tab_active.prev().find('a[data-toggle="tab"]');
                        triggerClick($tab_prev);
                    });
                });
            });

        }(jQuery, this));
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNvA2QV6mjVCWjS6l2lI7nZhTcZuUoCZU&callback=initMap&language=ar&region=EG"></script>
    <script type="text/javascript">
        var marker;
        var lat;
        var lng;
        var map;
        function updateMarkerPosition(latLng) {
            document.getElementById('lat').value = latLng.lat();
            document.getElementById('lng').value = latLng.lng();
        }

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }

        function initialize() {
            var lat = document.getElementById('lat').value;
            var lng = document.getElementById('lng').value;
            if (!lat && !lng) {
                var latLng = new google.maps.LatLng(24.598411724742483, 46.7138671875);
            } else {
                var latLng = new google.maps.LatLng(lat, lng);
            }

            map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 3,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            marker.set(map);
            updateMarkerPosition(latLng);
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
                updateMarkerPosition(event.latLng);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script>
        $('#Country').change(function () {

            var val = $(this).val();
            var base_url = "{{asset('/')}}";
            if (val == "") {
                val = 0;
            }
            $.ajax({
                type: "GET",
                url: base_url + "regions/" + val,
                success: function (data) {

                    $('#DIVCity').html(data);
                }
            });
        });
    </script>

    <script>
        $('.onclickclose').click(function () {
            $(this).remove();
        });

        $('#Department123').change(function () {

            var val = $(this).val();
            var base_url = "{{asset('/')}}";
            if (val == "") {
                val = 0;
            }

            $.ajax({
                type: "GET",
                url: base_url + "subcategories/" + val,
                success: function (data) {
                    $('#DIVSubDept').append(data);
                }
            });
        });

        $('.ctype').change(function(){
            var value = $( this ).attr('id')
            if(value=="LTD" || value=="MNC")
            {

                $('#plus').show();

            }else{
                $('#plus').hide();
            }
        });

    </script>
@endpush
