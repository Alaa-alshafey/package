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

            .profile-bg .order-md-1 p{

                box-shadow: inset 2px 0px 4px 0px rgba(0,0,0,.25);
                background-color: #fefefe;
                width: 100%;
                min-height: 35px;
                border-radius: 5px;
                text-align: center;
                line-height: 35px;
                padding: 5px;
                color:
                        #222;
                font-size: 15px;
            }
            .order-md-1 button,.order-md-1 a{
                display: block;
                margin-bottom: 15px;
                border-radius: 9px !important;
                text-align: center;
            }

            .mb-3 .btn{
                border-radius: 10px !important;
                margin-bottom: 10px;
            }

            .order-status{
                margin-top: 30px;
            }


        </style>

        <style>
            #print{
                border:5px solid #e1e1e1;
                color: #939594;
                background-color: #f4f4f2;
                border-radius: 15px;
                overflow: hidden;
                padding-right: 20px;
                padding-bottom: 20px;
            }

            #print .sheari-heading{
                margin-bottom: 10px;
            }

            #print div.item.btn-d{
                background-color: #92ad28 !important;
                /* min-height: 20px; */
                overflow: hidden;
                padding: 10px 0;
                border-radius: 14px;
                color: #fff;
            }
            #print div.item.btn-d label{
                color: #fff;
            }
            #print div.item.btn-d span{
                color: #fff;
            }
            #print div.item span{
                color: #337ab7;
                font-size: 17px;
                display: inline-block;
                width: 65%;
                text-align: center;
            }

            #print .item{
                border: 3px solid #e1e1e1;
                /* min-height: 20px; */
                overflow: hidden;
                padding: 10px 0;
                border-radius: 14px;
                margin-top: 8px;
            }
            #print .item label{
                color: #222;
                display: inline-block;
                width: 35% !important;
                text-align: right;

            }

            #print .item p{
                color: #337ab7;
                text-align:right;
                font-size: 17px;
            }


            #print .provider-details{
                padding: 40px ;
                background-color: #fbfbf9;
            }
            #print .provider-details p{
                color: #337ab7;
                font-size: 17px;
            }

            #print .item.custom{
                background-color: #337ab7;
                border-color: #22292f;
            }

            #print .item.custom label{
                color: #fff !important;
            }

            #print .item.custom span{
                color: #fff !important;
            }

                #print .item {
                    margin-left: 20px;
                }


            a.lead:hover{
                text-decoration: underline;
            }

        </style>

    @endpush

    <div class="container">
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-8 col-md-9" style="margin-top: 20px">

                    <div class="row">
                        <div class="col-md-12" >
                            <div class="print" id="print">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-6 col-md-7">

                                        <div class="provider-details">

                                            <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <h2 style="color: #337ab7">نموذج طلب </h2>
                                                    <img class="" style="height: 180px; width: 180px"
                                                         src="{{asset('img/logo.png')}}"/>
                                                </div>
                                                @if(auth()->user()->role == 'provider')
                                                    <div class="col-xs-12 text-center">
                                                        <a href="{{route('user.pay_commission')}}"  style="font-size: 18px; margin-bottom: 15px; display: inline-block" class="lead">نذكركم  بدفع  عمولة باكيج <br> (5% للعضوية العادية و 2% لعضوية التميز) <br> عبر صفحة الدفع </a>
                                                    </div>
                                                @endif
                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right"> مقدم الخدمة :</label>
                                                        <span class="text-center">{{$order->provider->name?? ''}} </span>
                                                    </div>
                                                </div>



                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right"> الجوال :</label>
                                                        <span class="text-center">{{$order->provider->phone?? ''}} </span>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">  طلب رقم :</label>
                                                        <span class="text-center">{{$order->id}} </span>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right"> تاريخ الطلب :</label>
                                                        <span class="text-center">{{$order->created_at->toDateString()}} </span>
                                                    </div>
                                                </div>



                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="order-details">

                                            <div class="row">
                                                <div class="item btn-d">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">حاله الطلب  :</label>
                                                        <span class="text-center ">{{OrderStatus($order->status)}}</span>
                                                    </div>
                                                </div>


                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">عنوان الطلب :</label>
                                                        <span class="text-center">{{$order->title}}</span>
                                                    </div>
                                                </div>


                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">مقدم الطلب :</label>
                                                        <span class="text-center">{{$order->client->name??''}}</span>
                                                    </div>
                                                </div>



                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">الجــوال :</label>
                                                        <span class="text-center ">{{$order->client->phone??''}}</span>
                                                    </div>
                                                </div>


                                                @if($order->details)
                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="text-right" style="display: block">بيانات الطلب :</label>
                                                        <p class="">{{$order->details}}</p>
                                                    </div>
                                                </div>
                                                @endif



                                                {{--<div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right">اهمية الطلب :</label>
                                                        <span class="text-center">{{$order->important}}</span>
                                                    </div>
                                                </div>





                                                <div class="item">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right"> المدة المتوقعة :</label>
                                                        <span class="text-center">{{$order->expected_time}} يوم </span>
                                                    </div>
                                                </div>
                                                --}}



                                                <div class="item custom">
                                                    <div class="col-xs-12 text-center">
                                                        <label class="pull-right"> ميزانية العميل :</label>
                                                        <span class="text-center">{{$order->expected_money}}  RS </span>
                                                    </div>
                                                </div>



                                                @if($order->discount > 0)


                                                    <div class="item">
                                                        <div class="col-xs-12 text-center">
                                                            <label class="pull-right"><i style="color: #337ab7" class="fa fa-star"></i> خصم التميز :</label>
                                                            <span class="text-center">{{$order->discount }}%</span>
                                                        </div>
                                                    </div>


                                                    <div class="item custom">
                                                        <div class="col-xs-12 text-center">
                                                            <label class="pull-right" style="width: 40% !important;"> السعر بعد الخصم :</label>
                                                            <span class="text-center" style="width: 60% !important;">{{number_format($order->price_after_discount,1)}} RS </span>
                                                        </div>
                                                    </div>

                                                @endif




                                            @if($order->attachment)
                                                    <div class="item">
                                                        <div class="col-xs-12 text-center">
                                                            <label class="pull-right"> المرفقات :</label>
                                                            <a href="{{getimg($order->attachment)}}" download="" class="text-center">تحميل</a>
                                                        </div>
                                                    </div>

                                                @endif





                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="status">
                                <div class="col-xs-12 item">
                                    @if(auth()->user()->id == $order->provider_id)

                                        @if($order->status == 'pending')

                                            <div class="row" style="
	border: 5px solid #ddd;
	margin: 12px -17px;
	padding: 6px 0px;
	padding-top: 17px;
	border-radius: 18px;
">

                                                <label style="
font-size: 18px;

text-align: center;

display: block;

margin-bottom: 10px;
font-weight: normal">هذا الحقل مخصص لمقدم الخدمة في حال رغبته تغيير تسعيرة العقد بشرط إشعار المستفيد بالسعر الجديد</label>
                                                <div class="col-xs-6">

                                                    {!!Form::open( ['route'=> 'user.updateOrderPrice','class'=>'form ','id'=>'integerForm', 'method' => 'Post','files' => true,]) !!}
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="number"
                                                               id=""
                                                               data-bv-integer="true"
                                                               data-bv-integer-message="قيمة رقمية صحيحة فقط"
                                                               placeholder="تحديث السعر بقيمة العمل الخاصة بك."
                                                               name="update_price" class="form-control"
                                                               style="box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                                                               padding: 24px 12px;border-radius: 16px !important">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <input type="hidden"
                                                               name="order_id"
                                                               value="{{$order->id}}">


                                                        <input style="padding: 12px 12px;
                                                                border-radius: 14px !important;"
                                                                type="submit" value="تحديث السعر"
                                                               class="btn btn-primary btn-block" >
                                                    </div>
                                                </div>


                                                {{ Form::close() }}


                                            </div>

                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="order-status">
                                <div class="row">


                                    @if(auth()->user()->id == $order->provider_id)
                                        {{-- it is provider --}}
                                            @if($order->status=='pending')
                                                <div class="col-md-3 mb-3">

                                                    <a data-toggle="modal" data-target="#myModal" href="#">
                                                        <button class="btn btn-primary
                                                    btn-lg btn-block" type="button"> موافقة</button>
                                                    </a>


                                                    <div id="myModal" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title"></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p> بالضغط على زر موافقة أنت تؤكد تسعيرة العميل وفي حال رغبتكم تعديل السعر يرجى مراسلة العميل للوصول لتفاهم نهائي.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">اغلاق</button>

                                                                    <a  href="{{route('user.acceptOrder',[$order->id])}}">
                                                                        <button class="btn btn-primary
                                                    "
                                                                                style="display: inline-block;
position: absolute;

left: 30px;

bottom: 30px;

width: 100px;

overflow: hidden;

background: #337ab7;
"
                                                                                type="button"

                                                                        > موافقة</button>
                                                                    </a>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>




                                                </div>
                                            @endif
                                            @if($order->status == 'accepted')

                                                <div class="col-md-3 mb-3">
                                                    <a href="{{route('user.finishOrder',[$order->id])}}">
                                                        <button style="" class="btn btn-warning btn-lg btn-block" type="button"> انهاء الطلب  </button>
                                                    </a>
                                                </div>

                                            @endif
                                    @else
                                        {{-- it is user --}}
                                    @endif

                                    @if($order->status != 'canceled')

                                        <div class="col-md-3 mb-3">
                                            <a href="{{route('message',['id'=>$order->id])}}">
                                                <button style=""
                                                        class="btn btn-success btn-lg
                                                        btn-block" type="button">مراسلة </button>
                                            </a>
                                        </div>
                                        @endif

                                    <div class="col-md-3 mb-3">

                                            <a href="#" class="btn btn-success btn-lg
                                                        btn-block" type="button"

                                               onclick="JPEG()">حفظ وتحميل</a>



                                        </div>

                                        @if($order->status=='pending')
                                            <div class="col-md-3 mb-3">
                                                <a href="{{route('user.cancelOrder',[$order->id])}}">

                                                    <button style="" class="btn btn-danger btn-lg btn-block" type="button"> إلغاء الطلب</button>
                                                </a>
                                            </div>
                                        @endif



                                </div>


                                @if($order->lat)
                                    <small>الموقع علي الخريطة</small>
                                    <div id="googleMap" style="width:100%;height:400px;"></div>
                                    <script>
                                        function myMap() {
                                            var lat = JSON.parse("{{ ($order->lat) }}");
                                            var lng = JSON.parse("{{ ($order->lng) }}");

                                            var latLng = new google.maps.LatLng(lat, lng);

                                            map = new google.maps.Map(document.getElementById('googleMap'), {
                                                zoom: 3,
                                                center: latLng,
                                                mapTypeId: google.maps.MapTypeId.ROADMAP
                                            });

                                            marker = new google.maps.Marker({
                                                position: latLng,
                                                map: map
                                            });
                                            marker.set(map);


                                            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                                        }

                                    </script>

                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&callback=myMap&language=ar"></script>

                                @endif
                            </div>
                        </div>
                    </div>

            </div>
            @include('layouts.side')

        </div>
    </div>


    @push('script')

        <script src="{{asset('js/dist/image.js')}}"></script>

        <script>
            function JPEG() {
                domtoimage.toJpeg(document.getElementById('print'), { quality: 1.0 })
                    .then(function (dataUrl) {
                        var link = document.createElement('a');
                        link.download = 'order.jpeg';
                        link.href = dataUrl;
                        link.click();
                    });

            }










        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js">

        </script>

        <script>

            $(document).ready(function() {
                $('#integerForm').bootstrapValidator({
                    fields: {
                        number: {
                            validators: {
                                integer: {
                                    message: 'The value is not an integer'
                                }
                            }
                        }
                    }
                }).on('success.form.bv', function(e) {
                    e.preventDefault(); // Prevent the form from submitting
                    //alert('I am going to do other things');

                    // ... Do whatever you want

                    // If you want to submit the form, use the defaultSubmit() method
                    // http://bootstrapvalidator.com/api/#default-submit
                    $('#integerForm').bootstrapValidator('defaultSubmit');
                });
            });

        </script>


    @endpush

    @php

    @endphp

 @endsection
