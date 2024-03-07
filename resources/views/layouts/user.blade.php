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
    <link href="{{ asset('/site/')}}/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('/site/')}}/amssoftech.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/ams.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-1.png')}}" />




    @stack('style')


    <style>
        /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

        .progress {
            width: 150px;
            height: 150px;
            background: none;
            position: relative;
        }

        .progress::after {
            content: "";
            width:100%;
            height:100%;
            border-radius: 50%;
            border: 6px solid #eee;
            position: absolute;
            top: 0;
            left: 0;
        }

        .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .progress .progress-left {
            left: 0;
        }

        .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 6px;
            border-style: solid;
            position: absolute;
            top: 0;
        }

        .progress .progress-left .progress-bar {
            left: 100%;
            border-top-right-radius: 80px;
            border-bottom-right-radius: 80px;
            border-left: 0;
            -webkit-transform-origin: center left;
            transform-origin: center left;
        }

        .progress .progress-right {
            right: 0;
        }

        .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
        }

        .progress .progress-value {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        /*
        *
        * ==========================================
        * FOR DEMO PURPOSE
        * ==========================================
        *
        */

        .progress-bar {
            border-color: #176083 !important;
        }
        .rounded-lg {
            border-radius: 1rem;
        }

        .text-gray {
            color: #aaa;
        }

        div.h4 {
            line-height: 1rem;
        }

        #myFooter {
            background-color: #006bb3;
            color: white;
        }

        #myFooter .row {
            margin-bottom: 60px;
        }

        #myFooter .info{
            text-align: justify;
            color: #afb0b1;
        }

        #myFooter ul {
            list-style-type: none;
            padding: 0;
            line-height: 1.7;
        }
        .form-control{
            padding: 0px 6px;
        }
        #myFooter h5 {
            font-size: 18px;
            color: white;
            font-weight: bold;
            margin-top: 30px;
        }

        #myFooter .logo{
            margin-top: 10px;
            border: none;
            float: none;
        }

        #myFooter .second-bar .logo a{
            color:white;
            font-size: 18px;
            font-weight: bold;
            line-height: 68px;
            margin: 0;
            padding: 0;
        }

        #myFooter a {
            color: #d2d1d1;
            text-decoration: none;
        }

        #myFooter a:hover,
        #myFooter a:focus {
            text-decoration: none;
            color: white;
        }

        #myFooter .second-bar {
            text-align: center;
            background-color: #175172;
            text-align: center;
        }

        #myFooter .second-bar a {
            font-size: 22px;
            color: #9fa3a9;
            padding: 10px;
            transition: 0.2s;
            line-height: 68px;
        }

        #myFooter .second-bar a:hover {
            text-decoration: none;
        }

        #myFooter .social-icons {
            float:right;
        }


        #myFooter .facebook:hover {
            color: #0077e2;
        }

        #myFooter .google:hover {
            color: #ef1a1a;
        }

        #myFooter .twitter:hover {
            color: #00aced;
        }

        @media screen and (max-width: 767px) {
            #myFooter {
                text-align: center;
            }

            #myFooter .info{
                text-align: center;
            }
        }

        .cardbt{
            padding: 15px;
            width: 100%;
            margin: 7px auto;
            font-size: 16px;
            border-radius: 7px !important;
        }



        /* CSS used for positioning the footers at the bottom of the page. */
        /* You can remove this. */



        .content{
            flex: 1 0 auto;
            -webkit-flex: 1 0 auto;
            min-height: 200px;
        }

        #myFooter{
            flex: 0 0 auto;
            -webkit-flex: 0 0 auto;
        }

        .fa{
            position: relative;
            right: -3px;
        }
        .navbar-nav > li a{
            padding: 10px 10px;
        }
        .navbar-nav > li{
            height: 85px;
        }


    </style>
    <!-- Styles -->
 </head>
<body style="background: #f7f7f7;" onload="initFirebaseMessagingRegistration()"> <div id="app">
    <!--<a href="/en/professional/dashboard" style="
    position: fixed;
    top: 45%;
    right: 0;
    z-index: 999;
    color: #fff;
    background-color: #013c98;
    padding: 5px 12px;
    border-radius: 4px 0px 0px 4px;
">-->
        <!--<i class="fa fa-language"></i> English</a>-->

        <header class="acc-back">
            <div class="container">
                <div class="row">
                    <div class="col-xs-10 col-sm-8 col-md-11">
                        <!--Mobile Navigation Start-->
                        <div class="mobile-nav">

                            <a href="#!" onclick="openNav()"><i class="fa fa-align-justify"></i><br /> القائمة</a>

                            <a href="{{route('user.pay')}}"><i class="fa fa-money"></i><br /> الدفع</a>
                            <a href="{{route('user.market-request')}}"><i class="fa fa-plus-square"></i><br> سوق باكيج </a>
                            <a href="/" class="logo"><img style="width: 53px !important;" src="{{asset('logo-1.png')}}" alt="" /></a>

                        </div>

                        <div id="mySidenav" class="sidenav">
                            <h2><i class="fa fa-align-justify"></i>  القائمة <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></h2>

                            <div class="mob-pro">
                                <div class="prog">
                                    <img src="{{getimg(auth()->user()->image)}}"  />
                                </div>
                                <a href="{{route('user.editMyAccount')}}" class="mob-edit"><i class="fa fa-edit"></i></a>
                                <div class="name">{{auth()->user()->name}} </div>
                                <ul>

                                    <li><a href="{{route('user.myAccount')}}"><i class="fa fa-user"></i>حسابي</a></li>
                                    <li><a href="{{route('user.notifications')}}"><i class="fa fa-bell-o"></i>التنبيهات</a></li>
                                    <li><a href="{{url('/user')}}"><i class="fa fa-compress"></i> الطلبات </a></li>
                                    <li><a href="{{route('user.editMyAccount')}}"><i class="fa fa-image"></i> إدارة صفحتي</a></li>
                                    <li><a href="{{route('user.invite-friends')}}"><i class="fa fa-group"></i> مشاركة مع الأصدقاء</a></li>
                                    <li><a href="{{route('user.myProjects')}}"><i class="fa fa-group"></i> اضافة وعرض المشاريع</a></li>
                                    <li><a href="{{route('user.password')}}"><i class="fa fa-unlock"></i> تغيير الرقم السري</a></li>
                                    <li><a href="{{route('user.market-request')}}"><i class="fa fa-plus-square"></i> سوق باكيج </a></li>
                                    {{--<li><a href="{{route('user.design_events')}}"><i class="fa fa-file"></i> تصاميم المناسبات</a></li>--}}

                                @if(auth()->user()->role == "provider")
                                        <li><a href="/user/card"><i class="fa fa-user"></i>بطاقة العضوية</a></li>
                                    @endif
                                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> تسجيل الخروج</a></li>
                                </ul>
                            </div>

                        </div>


                        <div class="mob-nav container">
                            <div class="row">
                                <div class="col-xs-3 lp rp">
                                    <a href="{{url('/user')}}" class="rb mob-act">
                                        <i class="fa fa-compress" aria-hidden="true"></i>
                                        <small>الطللبات</small>
                                    </a>
                                </div>
                                <div class="col-xs-3 lp rp">
                                    <a href="{{route('user.notifications')}}">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                    <small>التنبيهات</small>
                                    </a>
                                </div>

                            </div>
                        </div>



                        <!--Mobile Navigation End-->

                        <nav class="navbar desktop-nav">

                            @php
                                if (auth()->user()->role == 'client'){
                                    $orderNewCount = \App\Models\Order::where('user_id',auth()->user()->id)->where('status','pending')->count();

                                }else{
                                    $orderNewCount = \App\Models\Order::where('provider_id',auth()->user()->id)->where('status','pending')->count();

                                }
                            @endphp



                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="">Navigation <i class="glyphicon glyphicon-align-justify"></i></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                    <span class="log-out" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <img src="{{getimg(Auth::user()->image)}} "
                                             style="width: 50px;
padding: 3px;
margin-left: 8px;
border-radius: 50%;
margin-top: 16px;
height: 50px;
background-color: #bcc732;
">
                                    </span>
                                        <ul style="right: -40px;" class="dropdown-menu" role="menu">

                                            <li><a href="{{url('/user')}}"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
                                            <li><a href="{{route('user.myAccount')}}"><i class="fa fa-user"></i> حسابي</a></li>
                                            <li><a href="{{route('logout')}}" class="depo"><i class="fa fa-sign-out"></i> تسجيل الخروج</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="{{route('home')}}" style=""><i class="fa fa-home"></i>
                                            الرئيسية
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="{{route('user.notifications')}}"><i class="fa fa-bell-o"></i> التنبيهات <span class="badge">{{ \App\Models\Notification::where('read','no')->where('user_id',auth()->id())->count()}}</span></a>

                                    </li>
                                    <li>
                                        <!--                                    <a href="/ar/professional/directly-hired"><i class="fa fa-plus-square"></i> Directly Hired <span class="badge">0</span></a>-->
                                    </li>
                                    <li>
                                        <a href="{{route('user.pay')}}"><i class="fa fa-money"></i> الدفع</a>
                                    </li>


                                    <li><a href="{{route('user.market-request')}}"><i class="fa fa-plus-square"></i> سوق باكيج </a></li>

                                    <li><a href="{{url('/user')}}"><i class="fa fa-plus-square"></i> الطلبات <span class="badge">{{ $orderNewCount }}</span></a></li>
                                    {{--<li><a href="{{route('user.design_events')}}"><i class="fa fa-file"></i> تصاميم المناسبات</a></li>--}}
                                @if(auth()->user()->role == "provider")
                                        <li><a href="/user/card"><i class="fa fa-user"></i>بطاقة العضوية</a></li>
                                    @endif  </ul>
                            </div>
                        </nav>

                    </div>

                </div>
            </div>
        </header>
        <main class="py-4" style="

        background-image: url('/img/background1.png');
        background-size: cover ;
        background-repeat: no-repeat;
        background-attachment: fixed;



">
            <a  target="_blank" href="https://api.WhatsApp.com/send?phone=9660506601144" style="position:fixed; bottom: 10%; left: 25px; text-align: center">
                <img src="{{asset('img/w.png')}}" style="width: 50px; height: 50px; ">
                <br>
                <span style="color: #22b258">دردش معنا</span>
            </a>

            @yield('content')
        </main>
    <div class="text-center" style="margin: 20px 0;">
        <a href="https://play.google.com/store/apps/details?id=com.ash3arimobileapp"
           class="platform_link"><img style="border: 1px solid #fff; border-radius: 5px; width: 130px;" src="{{asset('img/353346.svg')}}" class="play-store"></a>
        <a href="https://apps.apple.com/us/app/id1523239962" class="platform_link"><img  style="width: 130px" src="{{asset('img/353410.svg')}}" class="play-store"></a>
    </div>
    </div>


<footer id="myFooter" dir="rtl">
    <div class="container">
        <div class="row">


            <div class="col-md-12 text-center">
                <img src="{{asset('sheari-logo-3.png')}}" class="">
            </div>
            <div class="clearfix">

            </div>
            <div class="col-md-6" style="">
                <h5>باكيج</h5>
                <p> {!!  getsetting('about') !!} </p>
            </div>


        <!--<div class="col-sm-3">
                    <h5>روابط سريعة</h5>
                    <ul>
                        <li><a href="{{asset('/')}}">الرئيسية</a></li>
                        <li><a href="{{route('providerRegister')}}">تسجيل مقدم الخدمة</a></li>
                        <li><a href="{{route('clientRegister')}}">تسجيل مستخدم  </a></li>
                        <li><a href="{{route('department')}}">  الأقسام  </a></li>
                    </ul>
                </div>-->
            <div class="col-md-3">
                <h5>من نكون</h5>
                <ul>
                    <li><a href="{{route('contact')}}">  تواصل معنا  </a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>السياسات</h5>
                <ul>
                    <li><a href="{{route('terms')}}">  الشروط والأحكام  </a></li>
                </ul>
            </div>

        </div>
    </div>
    <div class="second-bar">
        <div class="container text-center">
            <div class = "col-md-12">
                <h2 class="logo text-center" style = ""><a href="/">    @if(date('Y') == "2019") 2020 @else{{date('Y')}}@endif جميع الحقوق محفوظة لباكيج  </a></h2>
            </div>
        </div>
    </div>
</footer>

    <script src="{{ asset('/site/')}}/Jq.js"></script>
    @stack('script')
    <script src="{{ asset('/site/')}}/bootstrap.min.js"></script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })


    </script>


    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
        });
    </script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/roundSlider/1.3.2/roundslider.min.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>

    CKEDITOR.replace( 'summary-ckeditor',{
        contentsLangDirection: 'rtl'
    } );

</script>
<script>


    $(function() {

        $(".progress").each(function() {

            var value = $(this).attr('data-value');
            var left = $(this).find('.progress-left .progress-bar');
            var right = $(this).find('.progress-right .progress-bar');

            if (value > 0) {
                if (value <= 50) {
                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                } else {
                    right.css('transform', 'rotate(180deg)')
                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                }
            }

        })



        function percentageToDegrees(percentage) {

            return percentage / 100 * 360

        }


    });




</script>



<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>

<script>

    /*
    * apiKey: "AIzaSyC3zIV4wZjDmNMYZWw46bXJy4gDZQvKNec",
     authDomain: "sheariapp-dd792.firebaseapp.com",
     projectId: "sheariapp-dd792",
     storageBucket: "sheariapp-dd792.appspot.com",
     messagingSenderId: "736172931360",
     appId: "1:736172931360:web:6314bf8ebfa4e9e5f4ff45",
     measurementId: "G-WRF6V1WRXP"
    * */


    var firebaseConfig = {

        apiKey: "AIzaSyC3zIV4wZjDmNMYZWw46bXJy4gDZQvKNec",

        authDomain: "sheariapp-dd792.firebaseapp.com",

//        databaseURL: "https://XXXX.firebaseio.com",

        projectId: "sheariapp-dd792",

        storageBucket: "sheariapp-dd792.appspot.com",

        messagingSenderId: "736172931360",

        appId: "1:736172931360:web:6314bf8ebfa4e9e5f4ff45",

        measurementId: "G-WRF6V1WRXP"

    };



    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();



    function initFirebaseMessagingRegistration() {

        messaging.requestPermission()

            .then(function () {

                return messaging.getToken()

            })

            .then(function(token) {

                //console.log(token);



                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });



                $.ajax({

                    url: '{{ route("user.save-token") }}',

                    type: 'POST',

                    data: {

                        token: token

                    },

                    dataType: 'JSON',

                    success: function (response) {

                        //alert('Token saved successfully.');

                    },

                    error: function (err) {

                        console.log('User Chat Token Error'+ err);

                    },

                });



            }).catch(function (err) {

            console.log('User Chat Token Error'+ err);

        });

    }



    messaging.onMessage(function(payload) {

        const noteTitle = payload.notification.title;

        const noteOptions = {

            body: payload.notification.body,

            icon: payload.notification.icon,

        };

        new Notification(noteTitle, noteOptions);

    });



</script>

</body>
</html>
