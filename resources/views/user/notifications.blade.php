@extends('layouts.user')

@section('content')

    @push('style')

        <link href="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/post.css" rel="stylesheet" />
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
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar2">
                    <h1><span><i class="fa fa-bell-o"></i> التنبيهات</span>
                    </h1>
                </div>
                <h1>
                    <span>
                        <a data-toggle="modal" data-target="#myModal" href="#"
                             style="float: left;
                             border-radius: 10px !important; margin: 15px 0px" class="btn btn-warning">مسح التنبيهات</a>
                    </span>
                </h1>

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">مسح التنبيهات</h4>
                            </div>
                            <div class="modal-body">
                                <p>هل أنت متأكد من مسح جميع التبيهات الواردة في حسابك الشخصي ؟ ( تراجع / مسح جميع التنبيهات )</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">اغلاق</button>

                                <a href="{{route('user.delete_notifications')}}" class="btn btn-warning">مسح جميع التنبيهات</a>
                            </div>
                        </div>

                    </div>
                </div>


                @foreach (\App\Notification::where('user_id',auth()->id())->where('read','no')
               ->latest()->get() as
               $notification)

                <div class=" col-xs-12 alert alert-info"
                     role="alert"

                     style="background:#fff; border: 1px solid #ccc; border-radius: 18px; position: relative">

                    @if($notification->type == 'order')
                        @php
                            $order = \App\Order::find($notification->item_id);
                        @endphp
                        @if($notification->notification_status == 'pending')
                            <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-1.png')}}"></span>
                        @elseif($notification->notification_status == 'canceled')
                            <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-4.png')}}"></span>

                        @elseif($notification->notification_status == 'finished')
                            <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-2.png')}}"></span>

                        @elseif($notification->notification_status == 'accepted')
                            <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-3.png')}}"></span>

                        @elseif($notification->notification_status == 'price_updated')
                            <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-3.png')}}"></span>

                        @endif
                    @else

                    @endif

                        <span class="sr-only">تنبيه :</span>
                        <a href="/user/order/{{$notification->item_id}}"
                           style="font-weight: normal" class="alert-link">
                            <span style="color: #bcc732; font-size: 16px; font-weight: normal">
                                {{$notification->title}}
                            </span> , رقم  الطلب :  {{$notification->item_id}} الرجاء مراجعة صفحة الطلبات
                        </a>
                        @if($notification->type == 'order')
                        <a style="position: absolute; left: 40px; font-size: 18px" href="/user/order/{{$notification->item_id}}"
                           class="text-left">
                            <i class="fa fa-eye"></i></a>
                        @endif
                        <a style="position: absolute; left: 20px; font-size: 18px;color: #9c1f1f" href="{{route('user.delete_notification',['id'=>$notification->id])}}"
                           class="text-left"> <i class="fa fa-trash"></i>
                        </a>
                </div>

                @endforeach


            </div>


            @include('layouts.side')

        </div>

    </div>
 @endsection
