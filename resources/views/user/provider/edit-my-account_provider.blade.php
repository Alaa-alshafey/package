@extends('layouts.user')

@section('content')

    @push('style')

        <style>

            .work_single{
                border: 1px solid #ddd;
                margin-bottom: 15px;
                max-height: 450px;
            }
            .work_single h3{
                margin-top: 10px;
                color: #676767;
                text-align: center;
                font-size: 15px;
            }

            .work_single img{
                height: 200px;
                margin: 5px 20px;
                padding: 5px;
                border: 1px solid #ddd;
                overflow: hidden;
                width: 80%;
            }

            .work_single div.paragraph{
                text-align: center;
                margin: -10px;
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
                from {top: 0; opacity: 0;}
                to {top: 30px; opacity: 1;}
            }

            @keyframes fadein {
                from {top: 0; opacity: 0;}
                to {top: 30px; opacity: 1;}
            }

            @-webkit-keyframes fadeout {
                from {top: 30px; opacity: 1;}
                to {top: 0; opacity: 0;}
            }

            @keyframes fadeout {
                from {top: 30px; opacity: 1;}
                to {top: 0; opacity: 0;}
            }

            .edit-input small{
                display: inline-block;
                text-align: center;
                width: 100%;
            }
        </style>


    @endpush


    <div class="container">
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <form  action="{{route('user.client')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="profile-bar edit-input mar-bot">
                        <div>
                            <h1><span><i class="fa fa-user"></i> تفاصيل المستخدم </span></h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <small>نوع الحساب :</small><br />
                                        <input type="text" value="مزود خدمة " disabled/>
                                    </td>
                                    <td>
                                        <small>اسم المستخدم :</small><br />
                                        <input type="text" value="{{$provider->name}}"  name="name" />
                                    </td>
                                    <td>
                                        <small>البريد الإلكتروني :</small><br />
                                        <input type="email" value="{{$provider->email}}" disabled/>
                                    </td>
                                    <td>
                                        @php

                                            $phone = $provider->phone;
                                            $code = substr($phone,0,3);

                                            $phone = substr($phone,3);
                                        @endphp
                                        <small>الجوال :</small><br />
                                        <select name="code"
                                                class=""
                                                style="width: 30%; float: right;
                                                border-radius: 5px !important;">
                                            <option value="0" disabled >اختر الدولة</option>
                                            <option value="973" disabled {{($code === '973')? 'selected':''}}>973</option>
                                            <option value="965" disabled {{($code === '965')? 'selected':''}}>965</option>
                                            <option value="968" disabled {{($code === '968')? 'selected':''}}>968</option>
                                            <option value="966" disabled {{($code === '966')? 'selected':''}}>966</option>
                                            <option value="971" disabled {{($code === '965')? 'selected':''}}>971</option>
                                        </select>
                                        <input  style="width: 70%; float: right;border-radius: 5px !important "
                                                type="text"
                                                value="{{$phone}}"
                                                name="phone"/>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <small>الاسم :</small><br />
                                        <input type="text" value="{{$provider->name}} " class="width" name="name"/>
                                    </td>
                                    <td colspan="2">
                                        <small>صورة الحساب :</small><br />
                                        <div class="old_image"><img class="img-responsive"
                                                                    src="{{getimg($provider->image)}}" /> </div>
                                        <input style="width: 200px;
float: right;" type="file" class="width" name="image"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <small style="text-align: right">نبذة عامة :</small><br />
                                        <textarea name="bio" class="summernote form-control summary-ckeditor" id="summary-ckeditor" required="required" title="Contents">{!! html_entity_decode($provider->bio)  !!}</textarea>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="2">
                                        <small>
                                            خصم باكيج:
                                        </small>
                                         @if($provider->is_special)
                                            <input placeholder="%"
                                                   type="number"  value="{{$provider->discount}}"
                                                   class="form-control" name="discount"/>
                                        @endif
                                    </td>
                                    @if(!$provider->is_special)
                                        <td colspan="2">
                                            <a style="margin-top: 12px; display: inline-block; border-radius: 14px !important;" href="/user/pay" class="btn btn-primary"><p><i style="color: #bcc732; font-size: 20px;margin-top: 5px;position: relative; top: 3px; margin-left: 8px; display: inline-block" class="fa fa-star"></i>الارتقاء للعضوية المتميزة</p></a>
                                        </td>
                                    @endif


                                </tr>
                            </table>
                        </div>



                        <div class="">
                            <h2 class=""><span>
                                <i class="fa fa-clipboard" style=" color: #176083; "></i>
                            المجالات المشترك بها :
                        </span></h2>
                            <div class="review-bg" id="comment">


                                <div class="row">
                                    @foreach($provider->SubCategories as $item )
                                        <div class="col-xs-6 col-md-3">
                                            <a style="display: block; margin-bottom: 10px"
                                               href="#">
                                                <button class="btn btn-primary btn-block">{{$item->name()}}</button></a>

                                        </div>
                                    @endforeach
                                        @if(isset($provider->ads_category))
                                            <div class="col-xs-6 col-md-3">
                                                <a style="display: block; margin-bottom: 10px"
                                                   href="{{route('adservice',$provider->ads_category)}}">
                                                    <button class="btn btn-primary btn-block">{{$provider->adsCategory->name()}}</button></a>

                                            </div>

                                        @endif
                                </div>


                            </div>
                        </div>



                        <div class="regi-head">
                            <h2><span><i class="fa fa-briefcase"></i> إضافة مجال جديد للمجالات :</span></h2>
                            {!! Form::select("sub_category_id",subCategory(),null,
                            ['class'=>'form-group form-control  ',
                            'id'=>'','placeholder'=>' اختر  المجال' ,''])!!}

                        </div>

                        <div class="regi-head" style="padding-bottom: 40px">
                            <h2><span><i class="fa fa-briefcase"></i> أعمالنا</span></h2>



                            <div class="row">
                                @if($provider->projects)


                                    @foreach($provider->projects as $project)


                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <a style="text-align: center;
display: block;
position: relative;
overflow: hidden;margin: 8px 1px;
min-height: 230px;
"  href="#" data-toggle="modal" data-target="#myModal{{$project->id}}">


                                                @if(isset($project->price))
                                                    <span id="price">
                                                                <span class="text">السعر التقديري</span>
                                                        {{ $project->price }} RS
                                                            </span>                                                @endif

                                                <span class="" style="color: #fff;padding: 8px 0;display: block; text-align: center; background: #bbb9b9">
                                                @if($project->file_type == 'image')
                                                        <i class="fa fa-picture-o fa-2x"></i>
                                                    @elseif($project->file_type == 'video')
                                                        <i class="fa fa-video-camera fa-2x"></i>
                                                    @else
                                                        <i class="fa fa-file-audio-o fa-2x"></i>
                                                    @endif
                                            </span>


                                                    <img src="{{getimg($project->file)}}"
                                                         style="width: 100%;
                                                        height: 200px"
                                                         alt=""
                                                         class="img-responsive img-fluid" />
                                                <h4 style="
	margin: 0px 0px;
	color: #fff;
	font-size: 16px;
	text-align: center;
	background-color: #006bb3;
	padding: 19px;
	border-bottom-left-radius: 20px;
	border-bottom-right-radius: 20px;
	min-height: 60px;
">
                                                    @if(mb_strlen($project->title)> 10)
                                                        {{mb_substr($project->title,0,10)}}...
                                                    @else
                                                        {{$project->title}}
                                                    @endif
                                                </h4>
                                            </a>


                                        </div>


                                        <div id="myModal{{$project->id}}"
                                             class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">{{$project->title}}</h4>
                                                    </div>

                                                    <div class="modal-body text-center">
                                                        <img style="margin: auto"
                                                             src="{{getimg($project->file)}}" class="img-responsive"
                                                        />
                                                        <p style="margin-top: 20px" class="">{{$project->description}}</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>

                                                        <a
                                                                href="{{route('user.editProject',['id'=>$project->id])}}"
                                                                class="btn btn-primary"
                                                                style="border-radius: 14px !important;">
                                                            <p>تعديل المشروع</p>
                                                        </a>

                                                        <a href="{{route('user.removeProject',['id'=>$project->id])}}"
                                                           class="btn btn-primary"
                                                           style="border-radius: 14px !important;">
                                                            <p>مسح المشروع</p>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach



                                    @endif

                                </div>


                            <a href="{{route('user.addProject')}}" class="btn btn-primary"
                               style="margin-right: 20px;
    display: block;
    height: 40px;
    line-height: 20px;
    border-radius: 8px !important;

"><p>اضافة مشروع جديد </p></a>
                            <br>
                        </div>
                        <!--<div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">
                                        <small>الخبرات والمهارات:</small><br />
                                        <b>
                                            <input type="text" value=""
                                                   style="width:100%;" name="skills"/>
                                        </b>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        -->

                        <div class="regi-head">
                            <h2><span><i class="fa fa-briefcase"></i>  خدمات لوجيستية اضافية</span></h2>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="check-box">
                                    عروض خيرية
                                    <input type="checkbox" name="charitable" id="Charitable"
                                           value="Charitable" onclick="getTypeReg()" {{$provider->charitable?"checked":''}}>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check-box">
                                    خدمات توصيل
                                    <input type="checkbox" name="delivery" id="Delivery"
                                           value="Delivery" onclick="getTypeReg()" {{$provider->delivery?"checked":''}}>
                                    <span class="checkmark"></span>
                                </label>
                                <label class="check-box">
                                    الموقع على الخريطة
                                    <input type="checkbox" name="map" id="LoMap" value="LoMap" {{$provider->map?"checked":''}}
                                           onclick="getTypeReg()" checked>
                                    <span class="checkmark"></span>
                                </label>

                                <label class="check-box">

                                    هل لديكم حساب في ( معروف )؟
                                    <input type="checkbox" name="account_maroof" id=""
                                           value="yes" {{($provider->account_maroof == 'yes')?"checked":''}}>
                                    <span class="checkmark"></span>
                                </label>


                                <label class="check-box">

                                    هل لديكم وثيقة العمل الحر؟
                                    <input type="checkbox" name="account_freelancer" id=""
                                           value="yes" {{($provider->account_freelancer == 'yes')?"checked":''}}>
                                    <span class="checkmark"></span>
                                </label>


                                <label class="check-box">

                                    هل نشاطكم موثق بسجل تجاري؟
                                    <input type="checkbox" name="commerical" id="commerical"
                                           value="yes" {{($provider->commerical_no != null)?"checked":''}}>
                                    <span class="checkmark"></span>
                                </label>


                                <div class="form-group" style="display: none;" id="commericalNumber" >
                                    <label> السجل الضريبى *</label>
                                    <input type="number"
                                           value="{{$provider->commerical_no }}"
                                           name="commerical_no" id=""
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



                        <div class="regi-head">
                            <h2><span><i class="fa fa-map-marker"></i> الموقع</span></h2>
                        </div>

                        <div class="col-sm-12">
                            <small >حدد موقعك على الخريطة</small>
                            <div id="mapCanvas" style="height:450px;" class="col-md-12"></div>
                            <input type="hidden" value="{{$provider->lat}}" id="lat" name="lat" />
                            <input type="hidden" value="{{$provider->lng}}" id="lng" name="lng" />
                            @if($errors->has('lat'))
                                <div class="alert alert-danger">{{$errors->first('lat')}}</div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <small>الدولة:</small><br />
                                        <input type="text" value="{{$provider->City->country->name()}}" class="width" disabled/>
                                    </td>
                                    <td>
                                        <small>المدينة:</small><br />
                                        <input type="text" value="{{$provider->City->name()}}" class="width" disabled/>
                                    </td>
                                </tr>

                            </table>
                        </div>


                        <br />
                        <button type="submit" class="btn btn-primary" style="border-radius: 14px !important;"><i class="fa fa-save"></i> حفظ</button>
                    </div>
                </form>
            </div>
            @include('layouts.side')
        </div>
    </div>


    @push('script')
        <script>
            (function($) {
                'use strict';

                // commericalNumber commerical

                if (document.getElementById('commerical').checked) {
                    $("#commericalNumber").show();
                } else {
                    $("#commericalNumber").hide();
                }

                $('#commerical').change(function () {
                    if (this.checked) {
                        $("#commericalNumber").show();

                    } else {
                        $("#commericalNumber").hide();
                    }
                });
            }(jQuery, this));

        </script>
    @endpush

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ9fjKJMbJHN-Xs8zEOIIk6CApqefwMgQ&callback=initMap&language=ar&region=EG"></script>-->

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ9fjKJMbJHN-Xs8zEOIIk6CApqefwMgQ&language=ar&region=EG"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&callback=initMap&language=ar"></script>


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


@endsection
