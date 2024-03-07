<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>موقع باكيج</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link href="{{ asset('/site/')}}/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('/site/')}}/amssoftech.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/ams.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/site/')}}/sheari-logo.png" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/roundSlider/1.3.2/roundslider.min.css" rel="stylesheet" />

    <style>
        .card{
            background-image: url({{asset('img/backgroud.png')}});
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 800px;
            margin: auto;
            border: 5px solid #ccc;
            padding: 40px 20px 80px 20px;
            text-align: right;
            color: #fff;
            font-family: "Janna LT";
        }

        .card .body{
            margin-top: 50px !important;
            margin-bottom: 40px !important;
        }
        .card .bootom{
            margin-top: 20px;
        }

        .card .top p{
            font-weight: normal;
            font-size: 16px;
        }

        .card .top span{
            background-color: #537290;
            padding: 8px 25px;
            display: inline-block;
            margin-bottom: 8px;
            border-radius: 12px;
            text-align: left;
            width: 174px;
        }

        .card .top p.spe{
            font-size: 24px;
            font-weight: bold;
        }
        .card .top p.let{
            letter-spacing: 7px;
        }

        .card .top img{
            width: 126px;
            height: 137px;
            margin: auto 40px;
            position: relative;
            top: -22px;
        }

        .card .body .item{
            background: #39708e;
            padding: 20px 15px;
            border-radius: 18px;
            font-weight: normal; !important;
            margin: 20px 0;

        }

        .card .border_card{
            border: 1px solid #267195;
            overflow: hidden;
            padding: 10px 0;
            border-radius: 18px;

        }


    </style>




</head>

<body>
    <div id="app">

        <div class="container">
            <div class="row profile-bg mar-bot">

                <div class="col-xs-12 col-sm-8 col-md-9">
                    <div class="profile-bar">
                        <div class="">
                            <h2 style="font-weight: normal" class="text-right"><span style="font-weight: normal">بطاقة العضوية الخاصة بك</span></h2>
                            <div class="row">
                                <div class="card">

                                    <div class="border_card">
                                        <div class="top">
                                            <div class="col-md-4">
                                                <span>: No  </span>
                                                <p>
                                                    يتمتع صاحب هذة الـعضوية
                                                    <br>
                                                    بميزات الموقع المـمنوحـة
                                                    <br>
                                                    وفق ميثاق التعاون الرقمي
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <img src="{{asset('sheari-logo-3.png')}}" class="img-responsive" />

                                            </div>
                                            <div class="col-md-4" style="line-height: 30px">
                                                <p class="spe">عــــــضــــويــــــــة</p>
                                                <p>الـفنـون الرقميـه بمنصـه شــعاري </p>
                                                <p class="let">www.sheari.net</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="body">
                                            <div class="col-xs-12">
                                                <div class="item">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <p style="font-size: 24px">العضو <span style="display: inline-block; margin-right: 50px"> | </span></p>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <p class="" style="font-size: 24px">

                                                                محمد عطا محمد
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-xs-12">
                                                <div class="col-md-2">
                                                    <p style='
                    color:#FFF;
                    text-align: right;
                    display: inline-block;
                    margin-right: 10px;
                    line-height: 174px;
                    font-size: 24px;
                    overflow: hidden;

                    '>المجال
                                                    </p>

                                                </div>

                                                <div class="col-xs-10">
                                                    <table style='text-align: center; width: 100%;

                    line-height: 50px; font-size: 18px;'>
                                                        <tr>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>

                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                        </tr>
                                                        <tr>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>

                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                        </tr>


                                                        <tr>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>
                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>

                                                            <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>شعار
                                                            </td>


                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">

                                                <div class="item">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <p style="font-size: 24px;line-height: 80px">البوابة <span style="display: inline-block; margin-right: 50px"> | </span></p>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <p class="" style="font-size: 24px; word-spacing: 24px">
                                                                لزيارة صفحتنا الشخصية عبر بوابة
                                                                <br>

                                                                <span style="letter-spacing: 18px; margin-top: 5px;

margin-right: -18px;

display: inline-block;"> www.sheari.net
                                                        </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-xs-12">

                                                <div class="item">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <p style="font-size: 24px;line-height: 80px">التواصل <span style="display: inline-block; margin-right: 30px"> | </span></p>
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <p class="" style="font-size: 18px">
                                                                <span style="letter-spacing: 11px;; display:inline-block; margin-right: -11px">{{auth()->user()->phone}}</span>
                                                                <br>

                                                                <span style="word-spacing: 1px;
                                                        margin-top: 5px;

margin-right: -11px;

display: inline-block;"> ننصح بالتواصل عبر بوابة (باكيج) للحصول علي كافة الخدمات
                                                        </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="bootom">
                                        <div class="col-xs-6">
                                            <img class="img-responsive" style="position: relative; top: -5px; width: 60px; height: 60px" src="{{asset('img/icon.png')}}">
                                        </div>
                                        <div class="col-xs-6">
                                            <p style='float: left; font-size: 15px;'>
                                                12 / 02 / 2020
                                                <br>صـالحـة لمدة عام
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                @include('layouts.side')

            </div>
        </div>


    </div>


    <link href="{{ asset('/site/')}}/font-awesome.min.css" rel="stylesheet" />
    <script src="{{ asset('/site/')}}/Jq.js"></script>
    <script src="{{ asset('/site/')}}/bootstrap.min.js"></script>

</body>
