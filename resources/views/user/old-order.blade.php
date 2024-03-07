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


        </style>


    @endpush

    <div class="container">
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-8 col-md-9" style="margin-top: 30px">

                    <div class="row">
                        <div class="col-md-12 order-md-1" >
                            <!--<h4 class="mb-3">    رقم  الطلب : {{$order->id}}</h4>-->
                            <br>
                            <div class="needs-validation" novalidate>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <span id="print" style="background-color: #f7f7f7">

                                    <div class="mb-3">
                                        <h4 for="username">رقم الطلب</h4>
                                        <p>{{$order->id}}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label >عنوان الطلب</label>
                                        <p > {{$order->title}}  </p>

                                    </div>


                                    <div class="mb-3">
                                        <label for="lastName">تفاصيل الطلب</label>
                                        <p>{{$order->details}}</p>
                                    </div>

                                    @if(auth()->user()->role == 'provider')
                                        <div class="mb-3">
                                        <label for="username">اسم مقدم الطلب</label>
                                        <p>{{$order->user->name}}</p>
                                    </div>


                                        <div class="mb-3">
                                        <label for="username">بريد مقدم الطلب</label>
                                        <p>{{$order->user->email}}</p>
                                    </div>


                                        <div class="mb-3">
                                        <label for="username">رقم مقدم الطلب</label>
                                        <p>{{$order->user->phone}}</p>
                                    </div>

                                    @else
                                        <div class="mb-3">
                                        <label for="username">اسم مزود الخدمة</label>
                                        <p>{{$order->provider->name}}</p>
                                    </div>


                                        <div class="mb-3">
                                        <label for="username">بريد مزود الخدمة</label>
                                        <p>{{$order->provider->email}}</p>
                                    </div>


                                        <div class="mb-3">
                                        <label for="username">رقم مزود الخدمة</label>
                                        <p>{{$order->provider->phone}}</p>
                                    </div>

                                    @endif




                                    <div class="mb-3">
                                        <label for="time">الأهمية</label>
                                        <p>{{$order->important}}</p>
                                    </div>


                                    <div class="mb-3">
                                        <label for="time">المدة المتوقعة    </label>
                                        <p>{{$order->expected_time}} يوم </p>
                                    </div>


                                    <div class="mb-3">
                                        <label for="date">  الميزانية التقديرية الاساسية </label>
                                        <p>{{$order->expected_money}} ريال </p>
                                    </div>


                                    @if($order->discount > 0)
                                        <div class="mb-3">
                                            <label for="date">  عميل متميز يحصل علي خصم  {{ $order->discount }} %</label>
                                            <p>{{$order->price_after_discount}} ريال </p>
                                        </div>
                                    @endif

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



                                            @if($order->attachment)
                                                <div class="mb-3">
                                                    <label for="date">  المرفقات   </label>
                                                    <a href="{{getimg($order->attachment)}}">تحميل</a>
                                                </div>
                                            @endif


                                </div>
                                <div class="row">

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


                                </div>
                            </span>
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
                domtoimage.toJpeg(document.getElementById('print'), { quality: 0.95 })
                    .then(function (dataUrl) {
                        var link = document.createElement('a');
                        link.download = 'my-image-name.jpeg';
                        link.href = dataUrl;
                        link.click();
                    });

            }


        </script>


    @endpush

    @php

    @endphp

 @endsection
