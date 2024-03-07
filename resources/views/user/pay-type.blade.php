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

            a.btn-primary{
                margin-bottom: 15px;
            }

        </style>


    @endpush



    <div class="container">
        <div class="row profile-bg mar-bot">

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar">
                    <div class="box">
                        <h2 class="text-right"><span style="font-size: 26px !important;">طرق الدفع</span></h2>
                        <div class="row">
                            @if(!auth()->user()->is_special)
                                <div class="col-xs-12 col-md-4">
                                    <a type="" href="{{route('user.pay_star')}}"
                                       class="btn btn-block btn-primary" style="border-radius: 14px !important;"><i class="fa fa-star"></i>دفع للتميز</a>
                                </div>

                            @endif
                            <div class="col-xs-12 col-md-4">
                                <a type="" href="{{route('user.pay_design')}}"
                                   class="btn btn-block btn-primary" style="border-radius: 14px !important;"><i class="fa fa-plus-square"></i>دفع تصميم البطاقة</a>
                            </div>

                            @if(auth()->user()->role == 'provider')
                                <div class="col-xs-12 col-md-4">
                                    <a type="" href="{{route('user.pay_commission')}}" class="btn btn-block btn-primary" style="border-radius: 14px !important;"><i class="fa fa-money"></i> دفع عمولة الموقع </a>
                                </div>
                            @endif
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
        </script>
    @endpush
@endsection
