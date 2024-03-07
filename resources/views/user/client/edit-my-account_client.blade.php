@extends('layouts.user')

@section('content')

    @push('style')

        <style>
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

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <small>نوع الحساب:</small><br />
                                        <input type="text" value="مستخدم عادي " disabled/>
                                    </td>
                                    <td>
                                        <small>اسم المستخدم:</small><br />
                                        <input type="text" value="{{$client->name}}"  name="name" />
                                    </td>
                                    <td>
                                        <small>البريد الإلكتروني:</small><br />
                                        <input type="email" value="{{$client->email}}" disabled/>
                                    </td>
                                    <td>
                                        @php

                                        $phone = $client->phone;
                                        $code = substr($phone,0,3);

                                        $phone = substr($phone,3);
                                        @endphp
                                        <small>الجوال.:</small><br />
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
                                    <td>
                                        <small>الوظيفة.:</small><br />
                                        <input type="text" value="{{$client->job}}" name="job"/>
                                    </td>
                                    <td colspan="2">
                                        <small>الاسم:</small><br />
                                        <input type="text" value="{{$client->name}} " class="width" name="name"/>
                                    </td>
                                    <td colspan="2">
                                        <small>صورة الحساب:</small><br />
                                        <div class="old_image"><img style="width: 100px;
    height: 100px;
    display: block;
    border-radius: 50%;
    overflow: hidden;
" src="{{getimg($client->image)}}" /> </div>
                                        <input type="file" class="width" name="image"/>
                                    </td>
                                </tr>


                                <tr>
                                    <td colspan="">
                                        <small style="margin-top: 28px;

display: inline-block;">
                                            نوع الحساب: حساب عادى                                        <br />
                                        </small><br />
                                    </td>

                                    @if(!$client->is_special)
                                        <td colspan="4">
                                            <a style="margin-top: 12px; display: inline-block; border-radius: 14px !important;" href="/user/pay" class="btn btn-primary"><p><i style="color: #bcc732; font-size: 20px;margin-top: 5px;position: relative; top: 3px; margin-left: 8px; display: inline-block" class="fa fa-star"></i>الارتقاء للعضوية المتميزة</p></a>
                                        </td>
                                    @endif

                                </tr>
                            </table>
                        </div>

                        <div class="regi-head">
                            <h2><span><i class="fa fa-map-marker"></i> الموقع</span></h2>

                        </div>


                        <div class="col-sm-12">
                            <small >حدد موقعك على الخريطة</small>
                            <div id="mapCanvas" style="height:450px;" class="col-md-12"></div>
                            <input type="hidden" value="{{$client->lat}}" id="lat" name="lat" />
                            <input type="hidden" value="{{$client->lng}}" id="lng" name="lng" />
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
                                        <input type="text" value="{{$client->City->country->name()}}" class="width" disabled/>
                                    </td>
                                    <td>
                                        <small>المدينة:</small><br />
                                        <input type="text" value="{{$client->City->name()}}" class="width" disabled/>
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
    </script>

@endsection
