@extends('layouts.user')

@section('content')

    @push('style')

        <style>
            .item_selected{
                border: 1px solid #c0c0c0;
                overflow: hidden;
                padding: 5px;
                border-radius: 10px;
                box-shadow: 2px 2px 2px #c0c0c0;
                margin-bottom: 10px !important;
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
            h5.label-info{
                width: 100px;
                height: 30px;
                line-height: 27px;
                border-radius: 8px;
                background-color: #7cd92d;

            }

            h5.label-info{
                font-weight: normal;
                font-size: 14px;
                padding: 18px 0;
                line-height: 0px;
            }

            a.btn-success{
                padding: 18px 0;
                line-height: 0px !important;
                font-weight: normal;
            }

            table button{
                width: 200px;
            }

        </style>


    @endpush

    <div class="container">
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-8 col-md-9">
                @if(auth()->user()->role == 'provider')

                    <div class="profile-bar2">
                        <h1><span><i class="fa fa-arrow-left"></i> الطلبات الواردة</span></h1>
                    </div>


                    <ul id="order-nav" class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="tab" href="#providerPending"> جديد <span style="background-color: #bcc732" class="badge">{{count($pendingProvider)}}</span></a></li>
                        <li><a data-toggle="tab" href="#providerIn"> جاري العمل  <span style="background-color: #bcc732" class="badge">{{count($acceptedProvider)}}</span></a></li>
                        <li><a data-toggle="tab" href="#finishedProvider"> منتهي  <span style="background-color: #bcc732" class="badge">{{count($finishingProvider)}}</span></a></li>
                        <li><a data-toggle="tab" href="#canceledProvider"> ملغية  <span style="background-color: #bcc732" class="badge">{{count($canceledProvider)}}</span></a></li>
                    </ul>
                    <div class="clearfix">

                    </div>
                    <div class="tab-content">
                        <div id="providerPending" class="tab-pane fade in active">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم مقدم الطلب </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingProvider as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->client->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>

                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="providerIn" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم مقدم الطلب </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($acceptedProvider as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->client->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>

                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="finishedProvider" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم مقدم الطلب </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($finishingProvider as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->client->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>

                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="canceledProvider" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم مقدم الطلب </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($canceledProvider as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->client->name?? ''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>
                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                @endif


                {{-- comment data

                <div class="list-group ">

                    @foreach($pendingProvider as $item)

                        <div class="item_selected">
                            <a
                                    style="margin: 10px 0"
                                    href="{{route('user.showOrder',[$item->id])}}"
                                    class="list-group-item   col-xs-12 ">
                                <h5 class="label label-info mr-5" style="left: 0px; margin: 6px; position: absolute;">
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
                                    {{$item->details}}
                                </p>
                            </a>

                            <div class="clearfix"></div>

                            @if($item->status=='accepted' || $item->status=='finished')

                                <a href="{{route('message',['id'=>$item->id])}}" style="
                            width: 100px;
                            height: 30px;

                        border-radius: 8px !important;
                        background-color: #337ab7;
                        display: block;
                        margin: 5px 7px;
                        float: left;
                        line-height: 20px;
                        font-size: 14px;
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

                --}}




                    <div class="profile-bar2">
                        <h1><span><i class="fa fa-arrow-right"></i> الطلبات الصادرة </span></h1>
                    </div>


                    <ul id="order-nav" class="nav nav-tabs nav-justified">
                        <li class="active"><a data-toggle="tab" href="#userPending"> جديد <span style="background-color: #bcc732" class="badge">{{count($pendingUser)}}</span></a></li>
                        <li><a data-toggle="tab" href="#userIn"> جاري العمل <span style="background-color: #bcc732" class="badge">{{count($acceptedUser)}}</span></a></li>
                        <li><a data-toggle="tab" href="#finishedUser"> منتهي <span style="background-color: #bcc732" class="badge">{{count($finishingUser)}}</span></a></li>
                        <li><a data-toggle="tab" href="#canceledUser"> ملغي <span style="background-color: #bcc732" class="badge">{{count($canceledUser)}}</span></a></li>
                    </ul>
                    <div class="clearfix">

                    </div>
                    <div class="tab-content">
                        <div id="userPending" class="tab-pane fade in active">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم المزود </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingUser as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->provider->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>

                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="userIn" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم المزود</th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($acceptedUser as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->provider->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>

                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success">
                                                    <i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div id="finishedUser" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th>اسم المزود </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($finishingUser as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->provider->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>

                                                @if($item->status == 'finished')


                                                    <a data-toggle="modal" data-target="#myModal{{$item->id}}" href="#" class="btn btn-success"><i class="fa fa-star"></i> اضف تقييمك </a>

                                                @endif
                                                <div id="myModal{{$item->id}}" class="modal fade" role="dialog">
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

                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="comment" placeholder="اكتب تعليق علي الخدمه " required></textarea>
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


                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>
                                                <a href="{{route('message',['id'=>$item->id])}}"
                                                   class="btn btn-success"><i class="fa fa-envelope"></i>راسلني</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="canceledUser" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-condensed table-bordered table-content table-justified">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب  </th>
                                        <th> عنوان الطلب </th>
                                        <th> اسم المزود </th>
                                        <th> تاريخ الطلب </th>
                                        <th> العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($canceledUser as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->client->name??''}}</td>
                                            <td>{{$item->created_at->toDateString()}}</td>
                                            <td>
                                                <a href="{{route('user.showOrder',[$item->id])}}" class="btn btn-success"><i class="fa fa-money"></i>التفاصيل</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                {{-- comment data

                <div class="list-group ">
                    @foreach($pendingUser as $item)
                        <div class="item_selected">
                            <a
                                    style="margin: 10px 0"
                                    href="{{route('user.showOrder',[$item->id])}}" class="list-group-item   col-xs-12 ">
                                <h5 class="label label-info mr-5" style="left: 0px; margin: 6px; position: absolute;">
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
                                    {{$item->details}}
                                </p>
                            </a>


                            <div class="clearfix"></div>

                            @if($item->status=='accepted' || $item->status=='finished')
                                <a href="{{route('message',['id'=>$item->id])}}" style="
                            width: 100px;
                            height: 30px;

                        border-radius: 8px !important;
                        background-color: #337ab7;
                        display: block;
                        margin: 5px 7px;
                        float: left;
                        line-height: 20px;
                        font-size: 14px;
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


                            <div class="clearfix"></div>
                        </div>
                    @endforeach



                        <div class="text-center">
                            {!! $pendingUser->links() !!}
                        </div>


                </div>
                --}}
                <div class="cleafix"></div>
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
