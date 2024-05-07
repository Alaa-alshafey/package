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

            div.bordered_data small{
                display: block;
                text-align: center;
                background: #ccc;
                padding: 8px;
                margin-bottom: -12px;
                font-size: 14px;
                border-radius: 15px;
            }
            div.bordered_data b{
                border: 1px solid #ccc;
                display: block;
                border-radius: 14px;
                padding-right: 15px;
                min-height: 25px;
                margin-bottom: 7px;
                font-weight: inherit;
                box-shadow: inset 1px 0px 2px 0px
                rgba(0,0,0,.25);
                padding-top: 5px;
                padding-bottom: 5px;
                overflow: hidden;
            }
        </style>


    @endpush


    <div class="container">
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar mar-bot">
                    <div>
                        <h1><span><i class="fa fa-user"></i> تفاصيل المستخدم</span>
                            <a href="{{route('user.editMyAccount')}}">
                                <i style="background-color:#7cd92d; padding: 7px 46px; border-radius: 10px; font-style:normal; font-size: 16px" class="badge">تعديل</i></a></h1>
                    </div>

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6 bordered_data">
                                <small> الحساب :</small><br />
                                <b>
                                                           شخص
                                </b>
                            </div>
                            <div class="col-xs-6 bordered_data">
                                <small>اﻷسم :</small><br />
                                <b>{{$client->name}}</b>
                            </div>
                            <div class="col-xs-6 bordered_data">
                                <small>البريد :</small><br />
                                <b> {{$client->email}}</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>الجوال :</small><br />
                                <b>{{$client->phone}}</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>
                                    نوع الحساب :
                                </small><br />
                                @if($client->is_special)
                                    <b>مميز</b>
                                @else
                                    <b>عادي</b>
                                @endif
                            </div>

                        </div>
                    </div>


{{--                    <div class="regi-head">--}}
{{--                        <h2><span><i class="fa fa-briefcase"></i> مجالاتنا</span></h2>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <small>القسم الرئيسي:</small><br />--}}
{{--                                    <b>62</b>--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <small>سعر الساعة الواحدة:</small><br />--}}
{{--                                    <b> </b>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2">--}}
{{--                                    <small>القسم الفرعي:</small><br />--}}
{{--                                    <b>--}}
{{-- {{$client->services->subCategory->name()}}--}}
{{--                                    </b>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2">--}}
{{--                                    <small>الخبرات والمهارات:</small><br />--}}
{{--                                    <b>{{$client->qualifications}}</b>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </div>--}}

                    <div class="regi-head">
                        <h2><span><i class="fa fa-map-marker"></i> الموقع</span></h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <small>الدولة:</small><br />
                                    <b>{{$client->City->country->name()}}</b>
                                </td>
                                <td>
                                    <small>المدينة:</small><br />
                                    <b>{{$client->City->name()}}</b>
                                </td>
                            </tr>

                        </table>
                    </div>


                </div>
            </div>
            @include('layouts.side')
        </div>
    </div>


 @endsection
