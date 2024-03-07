@extends('layouts.app')

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
        <div class="row profile-bg mar-bot">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="profile-bar2">
                    <h1><span><i class="fa fa-question-circle"></i> طلبات سوق باكيج</span></h1>
                </div>
                <form method="post" action="/ar/professional/market-request-search">
                    <div class="profile-bar1">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ابحث عن..." name="Search">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> البحث</button>
                        </span>
                        </div>
                    </div>
                </form>
                <div class="row">
                    @foreach($orders as $order)
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="market-pro-list">
                                <a href="#">

                                    <img src="{{getimg($order->service->image)}}" alt="" width="240px" height="160px">
                                    <h2>{{$order->title}}</h2>

                                </a>
                                <div class="row pro-like">
                                    <div class="col-xs-4 col-sm-4 col-md-4">

                                        <a href="/ar/professional/message/2/Client-Name1" data-toggle="tooltip" data-placement="top" title="" data-original-title="بدء محادثة مع مستخدم"><i class="fa fa-comments-o"></i></a>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <a href="#!" data-toggle="tooltip" data-placement="top" title="" data-original-title="مشاركة 0"><i class="fa fa-share-alt"></i></a>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <a
                                                href="/ar/professional/market-request-details/4/Compiler-Design" data-toggle="tooltip"
                                                data-placement="top"
                                                title="" data-original-title="مشاهدات 314"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>

    <div id="snackbar">Feedback submitted successfully. </div>
@endsection
