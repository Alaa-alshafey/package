@extends('layouts.user')

@section('content')

    @push('style')

        <style>
            .loader {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
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
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @keyframes fadein {
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @-webkit-keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }

            @keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }
            .box p{
                font-size: 15px;
                color: #5e5c5c;

            }
            .box  span{
                font-size: 14px;
                color: #5e5c5c;
                font-weight: normal;
                text-align: right;
            }

            .item{
                text-align: right !important;
                padding: 3px;
                overflow: hidden;
                margin-bottom: 20px;
            }

            .item p{
                margin-right: 5px;
            }

            .item .iban{
                font-size: 12px !important;
            }
            .item .iban span{
                font-size: 12px !important;
            }
            .item .name_a{
                word-spacing: 8px;
            }

            #account_ p{
                font-size: 17px !important;
            }
            #account_ p span{
                font-size: 17px !important;
            }

            .right_text{
                text-align: right !important;
                margin-right: 20px;
                margin-bottom: 30px;
                border-bottom: 1px solid #98c64c !important;
                padding-bottom: 5px;
                color: #0164ca;
                display: inline-block;
                float: right;
                font-size: 20px;
            }

            .pay_{
                background: #dddddd;
                border-radius: 5px;
                padding: 10px;
            }

            .item img{
                height: 120px !important;
            }

            @media (max-width:767px){
                #account_ p span{
                    letter-spacing: 6px !important;
                }
                #account_ p span.second{
                    letter-spacing: 1px !important;
                }

                #account_ p.word{
                    word-spacing: 10px !important;
                }

                .item{
                    text-align: center !important;

                }
            }
        </style>


    @endpush



    <div class="container">
        <div class="row profile-bg mar-bot">

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar">
                    <div class="box">
                        <h2 class="text-right"><span style="font-size: 26px !important;">دفع مبلغ تصميم بطاقتك (5 ريال)</span></h2>

                        <!--Paypal integration-->
                        <!--

                        <div class="row">
                            <h2 class="text-center" style="color: #5e5c5c; font-weight: normal;
                            font-size: 20px;
                            margin-bottom: 23px;"> اختر الطريقة المناسبة : </h2>
                            <h3 class="right_text">1- الدفع الالكتروني </h3>
                            <form method="post" class="text-center" action="{{route('user.account_star')}}">
                                @csrf
                                <div class=" text-center loader" id="spinner" style=" display: none;    margin: 0 auto;"></div>

                                <div class="text-center">

                                    <button id="clickpay" type="submit" class="text-center" style="text-align: center;
    background-color: #3a66c6;
    color: white;">

                                        <i class="fa fa-cc-visa"></i> <i
                                                class="fa fa-cc-mastercard"></i>  تفضل بالدخول لاستكمال عمليه الدفع  الالكتروني وتحويل عضوية التميز
                                    </button>

                                </div>
                            </form>

                        </div>-->

                        <br>



                        <div class="row">
                            <h3 class="right_text"> التحويل البنكي</h3>
                            <div class="clearfix"></div>

                            <div class="col-xs-12 col-md-4"><p class="pay_"> 1 - انسخ رقم الحساب </p></div>
                            <div class="col-xs-12 col-md-4"><p class="pay_"> 2 - أكبس على أيقونة المصرف </p></div>
                            <div class="col-xs-12 col-md-4"><p class="pay_"> 3 -  قم بإجراء التحويل </p></div>

                            <div class="col-xs-12 block">
                                <h3 style="margin-bottom: 20px;">  يرجي إرسال اﻹيصال من هنا</h3>
                                <a style="border-radius: 14px !important;" href="{{route('user.send_report')}}" class="btn btn-block btn-success">ارسال صورة التحويل (صورة) </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-md-offset-3">
                                <h2 class="text-center"><span style="font-size: 26px !important;">الحساب الرسمي </span></h2>
                                <div class="item" id="account_">

                                    <a target="_blank" href="https://new.alahlionline.com/ui/#/login/full-login-login" class=""><img class="img-responsive" src="{{asset('img/1.png')}}"></a>
                                    <br>
                                    <p><small>رقم الحساب : </small> <span  style="letter-spacing: 8px">14700000123707</span></p>
                                    <p><small>اّيبان : </small> <span class="second" style="letter-spacing: 2px">SA8510000014700000123707</span></p>
                                    <p style="word-spacing: 25px" class="word">مــــؤســـســــة شــــعــــاري دلـــيـــلـــــي</p>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                            <h2 class="text-center"><span style="font-size: 26px !important;">الحسابات البديلة </span></h2>
                            <div class="col-md-4">
                                <div class="item">
                                    <a target="_blank" href="https://www.bankalbilad.com/ar/personal/Pages/home.aspx" class=""><img class="img-responsive" src="{{asset('img/2.png')}}"></a>
                                    <br>
                                    <p><small> رقم الحساب :</small> <span>866587853480002</span></p>
                                    <p class="iban"><small>اّيبان : </small> <span>SA1115000866587853480002</span></p>
                                    <p class="name_a">سـعـد ظـافـر سـعـد اﻷحـمـري</p>
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="item">
                                    <a target="_blank" href="https://www.baj.com.sa/Aljaziraonline" class=""><img class="img-responsive" src="{{asset('img/3.png')}}"></a>
                                    <br>
                                    <p><small>رقم الحساب :</small> <span style="letter-spacing: 3px">19361715001</span></p>
                                    <p class="iban"><small>اّيبان : </small> <span>SA8960000000019361715001</span></p>
                                    <p class="name_a">سـعـد ظـافـر سـعـد اﻷحـمـري</p>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="item">
                                    <a target="_blank" href="https://www.almubasher.com.sa/portal/auth/login.do?locale=ar_SA" class=""><img class="img-responsive" src="{{asset('img/4.png')}}"></a>
                                    <br>
                                    <p><small>رقم الحساب : </small> <span>329608010116857</span></p>
                                    <p class="iban"><small>اّيبان : </small> <span>SA9380000329608010116857</span></p>
                                    <p class="name_a">سـعـد ظـافـر سـعـد اﻷحـمـري</p>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
            @include('layouts.side')

        </div>
    </div>

    <!-- Bank Details -->
     <!-- End Bank Details -->

    @push('script')

        <script>
            $("#clickpay").click(function(){
                $("#spinner").show();
                $('#clickpay').hide();
            });

            $('.block').bind('fade-cycle', function() {
                $(this).fadeOut('fast', function() {
                    $(this).fadeIn('fast', function() {
                        $(this).trigger('fade-cycle');
                    });
                });
            });

            $('.block').each(function(index, elem) {
                setTimeout(function() {
                    $(elem).trigger('fade-cycle');
                }, index * 250);
            });
        </script>
    @endpush
@endsection
