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
            }

            .order-status{
                margin-top: 30px;
            }


        </style>

        <style>
            #print{
                padding: 20px;
                background-color: #337ab7;
                color: #fff;
                border-radius: 25px;
            }

            #print .sheari-heading{
                margin-bottom: 30px;
            }

            #print .item{

                margin-bottom: 20px;
            }

            #print .item .label-info,#print .item .label-success,#print .item .label-danger{
                padding: 5px 30px;
                border-radius: 5px;
                font-size: 14px;

                float: left;
                width: 50%;
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

                                    <div class="col-xs-12 text-center">
                                        <div class="logo-img"><img src="{{asset('sheari-logo-3.png')}}" style="max-width: 120px"></div>
                                        <h2 class="sheari-heading">باكيج  </h2>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="item col-xs-12 col-md-6">
                                         <b>رقم الطلب :</b> {{$order->id}}
                                    </div>


                                    <div class="item col-xs-12 col-md-6">
                                        <b>عنوان الطلب:</b> {{$order->title}}
                                    </div>

                                    <div class="item col-xs-12 col-md-6">
                                        <b>اسم مقدم الطلب:</b> {{$order->client->name}}
                                    </div>

                                    <div class="item col-xs-12 col-md-6">
                                        <b>اسم مزود الخدمة:</b> {{$order->provider->name}}
                                    </div>



                                    <div class="item col-xs-12 col-md-6">
                                        <b>جوال مقدم الطلب:</b> {{$order->client->phone}}
                                    </div>

                                    <div class="item col-xs-12 col-md-6">
                                        <b>جوال مزود الخدمة:</b> {{$order->provider->phone}}
                                    </div>

                                    <div class="col-xs-12 item">
                                        <b>بيانات الطلب:</b>
                                        <p class="lead">
                                            {{$order->details}}
                                        </p>
                                    </div>


                                    <div class="col-xs-12 col-md-6 item">
                                        <b>الاهمية : </b> <span class="label label-info">{{$order->important}}</span>
                                    </div>


                                    <div class="col-xs-12 col-md-6 item">
                                        <b>الحاله : </b> <span class="label label-info">{{OrderStatus($order->status)}}</span>
                                    </div>


                                    <div class="col-xs-12 col-md-6 item">
                                        <b>المدة المتوقعه : </b> <span class="label label-danger">{{$order->expected_time}} يوم</span>
                                    </div>

                                    <div class="col-xs-12 col-md-6 item">
                                        <b>الميزانية التقديرية الاساسية : </b> <span class="label label-success">{{$order->expected_money}} ريال</span>
                                    </div>

                                    @if($order->discount > 0)

                                        <div class="col-xs-12 col-md-6 item">
                                            <b> عميل متميز يحصل علي خصم  <span class="label label-danger">{{ $order->discount }} %</span> : </b>
                                            <p style="margin-top: 10px"> الميزانية بعد االخصم : <span class="label label-success">{{$order->price_after_discount}} ريال </span> </p>
                                        </div>
                                    @endif


                                    @if($order->attachment)
                                        <div class="col-xs-12 col-md-6 item">
                                         <label for="date">   المرفقات:   </label>
                                            <a
                                                    class="label label-info"
                                                    href="{{getimg($order->attachment)}}"
                                                    download="download">تحميل</a>
                                        </div>
                                    @endif





                                    {{--
                                    @if(auth()->user()->role == 'client')
                                        @if($order->status=='pending')
                                            <div class="col-md-3 mb-3">

                                                <a href="#">
                                                    <button class="btn btn-primary btn-lg btn-block" type="button">  جاري المراجعة </button>
                                                </a>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <a href="{{route('user.cancelOrder',[$order->id])}}">

                                                    <button style="" class="btn btn-danger btn-lg btn-block" type="button"> إلغاء الطلب</button>
                                                </a>
                                            </div>

                                        @endif

                                        @if($order->status=='finished')
                                                <div class="col-md-3 mb-3">

                                                    <a href="#">
                                                        <button class="btn btn-primary btn-lg btn-block" type="button"> الطلب منتهي </button>
                                                    </a>
                                                </div>
                                        @endif

                                        @if($order->status=='canceled')
                                                <div class="col-md-3 mb-3">

                                                    <a href="#">
                                                    <button class="btn btn-primary btn-lg btn-block" type="button"> تم الغاء طلبك  </button>
                                                    </a>
                                                </div>
                                        @endif

                                    @endif


                                    @if(auth()->user()->role == 'provider')
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

                                        <div class="col-md-3 mb-3">
                                                    <a href="{{route('user.cancelOrder',[$order->id])}}">

                                                        <button style="" class="btn btn-danger btn-lg btn-block" type="button"> الغاء الطلب</button>
                                                    </a>
                                                </div>

                                        @elseif($order->status=='finished')
                                                    <div class="col-md-3 mb-3">
                                                        <a href="">
                                                            <button
                                                                    class="btn btn-primary btn-lg btn-block"
                                                                    type="button">الطلب منتهي </button>
                                                        </a>
                                                    </div>
                                        @elseif ($order->status=='canceled')
                                                        <div class="col-md-3 mb-3">
                                                            <a href="#">
                                                                <button class="btn btn-primary btn-lg btn-block"
                                                                        type="button"> الطلب ملغي </button>
                                                            </a>
                                                        </div>


                                        @else
                                            <div class="col-md-3 mb-3">
                                                <a href="{{route('user.cancelOrder',[$order->id])}}">

                                                    <button class="btn btn-danger btn-lg btn-block" type="button"> الغاء الطلب</button>
                                                </a>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <a href="{{route('user.finishOrder',[$order->id])}}">
                                                    <button style="" class="btn btn-warning btn-lg btn-block" type="button"> انهاء الطلب  </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endif

                                        <div class="col-md-3 mb-3">
                                            <a href="{{route('message',['id'=>$order->id])}}">
                                                <button style=""
                                                        class="btn btn-success btn-lg
                                                        btn-block" type="button">مراسلة </button>
                                            </a>
                                        </div>


                                        <div class="col-md-3">

                                            <a href="#" class="btn btn-success btn-lg
                                                        btn-block" type="button"

                                                    onclick="JPEG()">حفظ وتحميل</a>



                                        </div>
                                   --}}

                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="status">
                                <div class="col-xs-12 item">
                                    @if(auth()->user()->id == $order->provider_id)

                                        @if($order->status == 'pending')

                                            <div class="row" style="
border: 1px solid #ddd;
margin: 12px -2px;
padding: 6px 0px;
padding-top: 17px;">
                                                <label style="
font-size: 14px;

text-align: center;

display: block;

margin-bottom: 10px;
font-weight: normal">يمكنك تحديث قيمة العقد بكتابة السعر المناسب والكبس علي تحديث السعر او يرجي مراسلة العميل للاتفاق</label>
                                                <div class="col-xs-6">

                                                    {!!Form::open( ['route'=> 'user.updateOrderPrice','class'=>'form ', 'method' => 'Post','files' => true]) !!}
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="number"
                                                               placeholder="تحديث السعر بقيمة العمل الخاصة بك."
                                                               name="update_price" class="form-control" style="box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
border-radius: 16px !important">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <input type="hidden"
                                                               name="order_id"
                                                               value="{{$order->id}}">


                                                        <input
                                                                style="border-radius: 14px !important;"

                                                                type="submit" value="تحديث السعر" class="btn btn-primary btn-block" >
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

                                    @if($order->status=='pending')
                                        <div class="col-md-3 mb-3">
                                            <a href="{{route('user.cancelOrder',[$order->id])}}">

                                                <button style="" class="btn btn-danger btn-lg btn-block" type="button"> إلغاء الطلب</button>
                                            </a>
                                        </div>
                                    @endif

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

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            @include('user.side')

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


    @endpush

    @php

    @endphp

 @endsection
