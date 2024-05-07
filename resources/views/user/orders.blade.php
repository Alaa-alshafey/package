@extends('layouts.user')

@section('content')

    @push('style')

        <style>
            .item_selected{
                border: 1px solid #ddd;
                overflow: hidden;
                padding: 5px;
                border-radius: 10px;
                box-shadow: 2px 2px 2px #ddd;
                margin-bottom: 5px;
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

            .list-group a h5.label{
                left: 20px;

                margin: 2% 2px;

                position: absolute;

                padding: 10px;

                border-radius: 10px;
                font-weight: normal;
                font-size: 14px;
                width: 100px;
            }

            h5{
                font-weight: normal;
                font-size: 14px;
            }


            a.btn-success{
                padding: 18px 0;
                line-height: 0px !important;
                font-weight: normal;
            }

            table button{
                width: 200px !important;
            }



        </style>


    @endpush

    <div class="container">
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar2">
                    <h1><span><i class="fa fa-arrow-left"></i> الطلبات المستمرة</span></h1>
                </div>
                <div class="list-group">

                    @foreach($pendingProvider as $item)
                        <div class="item_selected">
                            <a
                                    style="margin: 10px 0"
                                    href="{{route('user.showOrder',[$item->id])}}"
                                    class="list-group-item   col-xs-12 ">
                                <h5 style="width: 130px" class="label label-info mr-5">

                                    {{OrderStatus($item->status) }}

                                </h5>
                                <h4 class="list-group-item-heading push-right">
                                    @if($item->status == 'pending')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-1.png')}}"></span>
                                    @elseif($item->status == 'canceled')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-4.png')}}"></span>

                                    @elseif($item->status == 'finished')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-2.png')}}"></span>

                                    @elseif($item->status  == 'accepted')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-3.png')}}"></span>

                                    @else
                                        <i class="fa fa-edit"></i>
                                    @endif
                                    {{$item->title}} </h4>
                                <h5  class="list-group-item-heading push-left">    بتوقيت:  {{$item->created_at->format('Y-m-d')}} </h5>
                                <p class="list-group-item-text">
                                    {{$item->details}}
                                </p>
                            </a>

                            <div class="clearfix"></div>

                            @if($item->status=='accepted' || $item->status=='finished')
                                <a href="{{route('message',['id'=>$item->id])}}" style="
                           height: 30px;

                        border-radius: 8px !important;
                        background-color: #337ab7;
                        display: block;
                        margin: 10px 22px;
                        float: left;
                        line-height: 20px;
                        font-size: 14px;
                        width: 130px;
                        border: none;" class="btn btn-success">راسلني</a>
                            @endif

                            @if(auth()->user()->role == 'client')
                                @if($item->status=='finished')

                                    <a data-toggle="modal" data-target="#myModal" href="#" style="
                            width: 100px;
                            height: 30px;
                            border-radius: 8px !important;
                            background-color: #337ab7;
                            display: block;
                            margin: 5px 7px;
                            float: left;
                            line-height: 20px;
                            font-size: 14px;
                            border: none;" class="btn btn-success">اضف تقييمك</a>

                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">تقييم مزود الخدمة</h4>
                                                </div>
                                                <form action="{{route('user.rateProvider')}}" method="post" enctype="multipart/form-data">

                                                    <div class="modal-body">

                                                        @csrf
                                                        <input type="hidden" value="{{$item->id}}" name="order_id">
                                                        <div class="form-group">
                                                            <select name="rate" class="form-control" style="color: yellow; font-size: 14px; background: #0a001f">
                                                                <option value="1"> &#8270; عدد واحد نجمة </option>
                                                                <option value="2">&#8270; &#8270; عدد 2 نجمة </option>
                                                                <option value="3">&#8270; &#8270; &#8270; عدد 3 نجمة</option>
                                                                <option value="4">&#8270; &#8270; &#8270; &#8270; عدد 4 نجمة</option>
                                                                <option value="5">&#8270; &#8270; &#8270; &#8270;  &#8270; عدد 5 نجمة </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>

                                                        <input type="submit" class="btn btn-success" value="تقييم ">
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                            @endif

                        </div>
                    @endforeach

                    <div class="text-center">
                        {!! $pendingProvider->links() !!}
                    </div>

                </div>


                <div class="profile-bar2">
                    <h1><span><i class="fa fa-question-circle"></i> طلباتى   </span></h1>
                </div>
                <div class="list-group ">

                    @foreach($pendingUser as $item)
                        <div class="item_selected">
                            <a href="{{route('user.showOrder',[$item->id])}}" class="list-group-item   col-xs-12 ">
                                <h5 class="label label-info mr-5"  style="left: 20px;
                                    margin: 2% 0px;
                                    position: absolute;
                                    padding: 10px 4px;
                                    border-radius: 10px;
                                    width: 130px;

">

                                    {{OrderStatus($item->status) }}

                                </h5>
                                <h4 class="list-group-item-heading push-right">
                                    @if($item->status == 'pending')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-1.png')}}"></span>
                                    @elseif($item->status == 'canceled')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-4.png')}}"></span>

                                    @elseif($item->status == 'finished')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-2.png')}}"></span>

                                    @elseif($item->status  == 'accepted')
                                        <span><img style="width: 50px; height: 50px" src="{{asset('img/order_status/01-3.png')}}"></span>

                                    @else
                                        <i class="fa fa-edit"></i>
                                    @endif
                                    {{$item->title}} </h4>
                                <h5 class="list-group-item-heading push-left">    بتوقيت:  {{$item->created_at->format('Y-m-d')}} </h5>
                                <p class="list-group-item-text">
                                    @if(strlen($item->details) > 100)
                                        {{ mb_substr( $item->details,0,100) }} ...
                                    @else
                                        {{  $item->details }}
                                    @endif

                                </p>
                            </a>


                            <div class="clearfix"></div>

                            @if($item->status=='accepted' || $item->status=='finished')
                                <a href="{{route('message',['id'=>$item->id])}}" style="
                           height: 30px;

                        border-radius: 8px !important;
                        background-color: #337ab7;
                        display: block;
                        margin: 10px 22px;
                        float: left;
                        line-height: 20px;
                        font-size: 14px;
                        width: 130px;
                        border: none;" class="btn btn-success">راسلني</a>
                            @endif

                            @if(auth()->user()->role == 'client')
                                @if($item->status=='finished')

                                    <a data-toggle="modal" data-target="#myModal" href="#" style="
                            width: 100px;
                            height: 30px;
                            border-radius: 8px !important;
                            background-color: #337ab7;
                            display: block;
                            margin: 5px 7px;
                            float: left;
                            line-height: 20px;
                            font-size: 14px;
                            border: none;" class="btn btn-success">اضف تقييمك</a>

                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">تقييم مزود الخدمة</h4>
                                                </div>
                                                <form action="{{route('user.rateProvider')}}" method="post" enctype="multipart/form-data">

                                                    <div class="modal-body">

                                                        @csrf
                                                        <input type="hidden" value="{{$item->id}}" name="order_id">
                                                        <div class="form-group">
                                                            <select name="rate" class="form-control" style="color: yellow; font-size: 14px; background: #0a001f">
                                                                <option value="1"> &#8270; عدد واحد نجمة </option>
                                                                <option value="2">&#8270; &#8270; عدد 2 نجمة </option>
                                                                <option value="3">&#8270; &#8270; &#8270; عدد 3 نجمة</option>
                                                                <option value="4">&#8270; &#8270; &#8270; &#8270; عدد 4 نجمة</option>
                                                                <option value="5">&#8270; &#8270; &#8270; &#8270;  &#8270; عدد 5 نجمة </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">اغلاق</button>

                                                        <input type="submit" class="btn btn-success" value="تقييم ">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endif

                        </div>

                    @endforeach



                        <div class="text-center">
                            {!! $pendingUser->links() !!}
                        </div>


                </div>


                @if(auth()->user()->role == 'provider')
                    <table class="table table-responsive table-bordered" style="border-radius:10px !important;">
                        <tr>
                            <th colspan="2"><h2 class="btn btn-primary btn-block" style="padding: 10px 0; font-size: 18px; border-radius: 10px !important;">التكاليف الاجمالية </h2> </th>
                        </tr>
                        <tr>
                            <th>عدد العقود </th>
                            <td><button class="btn btn-waining"> {{auth()->user()->orders()->count()}} عقود </button></td>
                        </tr>
                        <tr>
                            <th>اجمالي المبالغ قبل الخصم الحصري</th>
                            @php
                                $all_prices = \App\Order::where('status','finished')->where('provider_id',auth()->id())->sum('expected_money');
                            @endphp
                            <td> <button class="btn  btn-info">{{number_format($all_prices,2)}} <span class="text-left">ريال</span></button> </td>
                        </tr>

                        <tr>
                            <th>اجمالي المستحقات بعد الخصم الحصري</th>
                            @php
                                $all_prices_after_discount = \App\Order::where('status','finished')->where('provider_id',auth()->id())->sum('price_after_discount');
                            @endphp

                            <td><button class="btn  btn-info">{{number_format($all_prices_after_discount,2)}} <span class="text-left">ريال</span></button></td>
                        </tr>

                        <tr>
                            <th>عمولة موقع باكيج </th>
                            <td>
                                <button class="btn  btn-info">{{number_format(auth()->user()->commission,2)}} <span class="text-left">ريال</span></button>
                                <a class="btn btn-small btn-primary" href="{{route('user.pay_commission')}}">أدفع عمولة الموقع </a>
                            </td>
                        </tr>
                    </table>
                @endif

            </div>
            @include('layouts.side')

        </div>
    </div>




 @endsection
