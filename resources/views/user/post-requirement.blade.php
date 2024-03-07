@extends('layouts.user')

@section('content')

    @push('style')

        <link href="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/post.css" rel="stylesheet" />

        <style>
            .form select{
                -webkit-border-radius: 16px !important;
                -moz-border-radius: 16px !important;
                border-radius: 16px !important;
                box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                padding: 5px 0 !important;
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
        </style>

        <script type="text/javascript">

            function FromDate(getID) {
                var TID="";
                if(getID=="AdsFrom")
                {
                    TID="AdsTo";
                }
                else if(getID=="ChannelFrom")
                {
                    TID="ChannelTo";
                }
                else if(getID=="NewspaperFrom")
                {
                    TID="NewspaperTo";
                }
                else if(getID=="CelebrityFrom")
                {
                    TID="CelebrityTo";
                }

                document.getElementById(TID).value = "";
                var dateString = document.getElementById(getID).value;
                var target = new Date(dateString);
                var now = new Date;

                if(now<=target)
                {
                    return true;
                }
                else
                {
                    alert("Starting date must be current or future date.");
                    document.getElementById(getID).value = "";

                    return false;
                }

            }
            function ToDate(getID) {

                var TID="";
                if(getID=="AdsTo")
                {
                    TID="AdsFrom";
                }
                else if(getID=="ChannelTo")
                {
                    TID="ChannelFrom";
                }
                else if(getID=="NewspaperTo")
                {
                    TID="NewspaperFrom";
                }
                else if(getID=="CelebrityTo")
                {
                    TID="CelebrityFrom";
                }
                var dateString = document.getElementById(getID).value;
                var toDate1 = new Date(dateString);
                var datestring1 = document.getElementById(TID).value;
                var FromDate = new Date(datestring1);
                if(FromDate<=toDate1)
                {

                    return true;
                }
                else
                {
                    alert("End date must be Start or future date.");
                    document.getElementById(getID).value = "";

                    return false;
                }

            }

        </script>

    @endpush

    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 mar-bot">
                <div class="profile-bar">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                         {!!Form::open( ['route' => ['user.post-order',$id] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}

                        <h1 class="post-head">تقديم الطلبات</h1>
                        <div class="tab">
                            <div class="form-group">
                                <div class="time-bg">
                                    <div class="row">
                                    <!--
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <small>الاسم   </small>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" required="required" disabled       value="{{auth()->user()->name}}" name="title"/>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <small>البريد   </small>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" required="required"  disabled value="{{auth()->user()->email}}" name="title"/>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <small>الجوال   *</small>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="" required="required" disabled value="{{auth()->user()->phone}}" name="title"/>
                                                    </div>
                                                </div>

-->
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text"
                                                       class="form-control"
                                                       placeholder="أكتب عنوان طلبك" required="required"  value="{{old('title')}}" name="title"/>
                                            </div>
                                        </div>


                                        {{--<div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                {!! Form::select("important",['قصوى'=>'قصوى','متوسطة'=>'متوسطة','عادية'=>'عادية'],null,['class'=>'form-group form-control  ','id'=>'' ,'placeholder'=>'اﻷهمية'])!!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text"
                                                       placeholder="المدة المتوقعة للتنفيذ"
                                                       class="form-control" value="{{old('expected_time')}}" name="expected_time" required="required" />
                                            </div>
                                        </div>--}}

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <input type="number"
                                                       min="0"
                                                       placeholder="ميزانية  العميل التقديرية SR"
                                                       class="form-control" value="{{old('expected_money')}}" name="expected_money" required="required" />
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                        <textarea
                                                                placeholder="اكتب تفاصيل الطلب كاملة"
                                                                class="form-control" name="details"
                                                                class="summernote" id="contents"
                                                                title="details" rows="10" style="width: 100%">{{old('details')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <small>المرفقات   </small>
                                            <div class="form-group" >
                                                <input type="file"
                                                       class="form-control"
                                                       name="attachment">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <small>                                            حدد موقعك علي الخريطة</small>
                                            <div class="form-group" >
                                                <label class="check-box" style="


display: block;
height: 42px;
text-align: center;
width: 42px;
background: #337ab7;
">
                                                    <input onchange="check_map()"
                                                           type="checkbox" name="check_" id="check_" value="yes">
                                                    <span class="checkmark"></span>
                                                </label>

                                            </div>

                                        </div>


                                        <script>
                                            function check_map() {
                                                if (document.getElementById("check_").checked) {
                                                    document.getElementById('mapselected').style.display="block";

                                                } else {
                                                    document.getElementById('mapselected').style.display="none";
                                                }
                                            }

                                        </script>


                                        <div id="mapselected" style="display: none">

                                          <div class="col-sm-12">
                                            <small >حدد موقعك على الخريطة</small>
                                            <div id="mapCanvas" style="height:450px;" class="col-md-12"></div>
                                            <input type="hidden" value="24.774265" id="lat" name="lat" />
                                            <input type="hidden" value="46.738586" id="lng" name="lng" />
                                            @if($errors->has('lat'))
                                                <div class="alert alert-danger">{{$errors->first('lat')}}</div>
                                            @endif
                                        </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="align">
                                <button type="submit"  >إرسال</button>
                            </div>
                        </div>
                        </form>
            </div>
            @include('layouts.side')
                </div>
    </div>





    <div id="snackbar">Feedback submitted successfully. </div>

    @push('script')
        <script>




            
        </script>
        <script src="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/post.js"></script>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script>

            $(function () {
                $('[data-toggle="tooltip"]').tooltip();

            })
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.summernote').summernote({
                    height: 110,
                    tabsize: 2,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['hello', 'helloImage']],
                        ['insert2', ['helloDropdown']],
                    ]
                });
            });
        </script>
        <!--Editor end-->

        <script src="/common/User/en/bootstrap-3.3.4-dist/post.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $("DIVSubDept").hide();
            });
        </script>    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&callback=initMap&language=ar&region=EG"></script>

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
            $(document).ready(function() {
                $("#DIVSubDept").hide();
                $('#Department123').on('change',function(){

                    $("#HDNSubDept").val("All");
                    $("#DIVSubDept").show();
                    var DepartmentName = $(this).val();

                    $("#ShowDept").val(DepartmentName);
                    $.ajax({
                        type:'POST',
                        url:"/ar/guestaction/dept",
                        data:{DepartmentName:DepartmentName},
                        success:function(data)
                        {

                            var abc1='<label class="check-box">';
                            //var abc2='Sub department 01';

                            var abc4='<span class="checkmark"></span>';
                            var abc5='</label>';
                            // alert(data);
                            $("#DIVSubDept").html("<div><label>اختر القسم الفرعي</label></div>");



                            var dataObj = jQuery.parseJSON(data);
                            var sno=1;
                            if(dataObj){
                                $(dataObj).each(function(){

                                    var abc3='<input type="checkbox" name="SubDept'+sno+'" id="SubDept'+sno+'" value="'+this.SubDepartmentName+'" onclick="getDept(this.id,this.value)">';
                                    var allHtml=abc1+""+this.SubDepartmentName+""+abc3+""+abc4+""+abc5;

                                    $('#DIVSubDept').append(allHtml);
                                    sno++;
                                });

                                // alert(sno-1);
                                $("#TotalSubDept").val(sno-1);
                            }




                        },
                    });

                });


            });
        </script>
    @endpush
@endsection
