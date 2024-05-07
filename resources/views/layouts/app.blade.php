<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="your, tags"/>
    <meta name="description" content="باكيج  هو أكبر تجمع فني وتقني يعمل بتقنية البحث بالفلترة والنطاق الجغرافي على مستوى المملكة والخليج وهو أول منصة ذكية تفاعلية في الفنون والرقميات الحديثة تعمل كدليل مصنف وفق الخدمات والموثوقية بحيث يتاح للمستفيد التسجيل مجانا وتقييم مزود الخدمة بعد انتهاء الطلب ."/>
    <meta name="subject" content="باكيج ">
    <meta name="copyright" content="فنون الرقميه">
    <meta name="language" content="AR">
    <meta name="robots" content="index,follow" />
    <meta name="revised" content="" />
    <meta name="abstract" content="">
    <meta name="topic" content="">
    <meta name="summary" content="باكيج  هو أكبر تجمع فني وتقني يعمل بتقنية البحث بالفلترة والنطاق الجغرافي على مستوى المملكة والخليج وهو أول منصة ذكية تفاعلية في الفنون والرقميات الحديثة تعمل كدليل مصنف وفق الخدمات والموثوقية بحيث يتاح للمستفيد التسجيل مجانا وتقييم مزود الخدمة بعد انتهاء الطلب .">
    <meta name="Classification" content="Business">
    <meta name="author" content="name, sheari@hotmail.com">
    <meta name="designer" content="">
    <meta name="copyright" content="package.sa">
    <meta name="reply-to" content="sheari@hotmail.com">
    <meta name="owner" content="باكيج">
    <meta name="url" content="http://www.sheari.net">
    <meta name="identifier-URL" content="http://www.packge.sa">
    <meta name="directory" content="submission">
    <meta name="category" content="">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="7 days">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <title> موقع بكج </title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/post.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/css/bootstrap-rtl.min.css" rel="stylesheet" />
    <link href="{{asset('/OwlCarousel/dist/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('/OwlCarousel/dist/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/website/')}}/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/website/')}}/ams.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon"
          href="{{ asset('logo-1.png')}}"/>
    @stack('style')
<STYLE>

    /* ==========================================
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
        width: 100%;
        height: 100%;
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

    body {

    }
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

    @media screen and (min-width: 992px) {
        #owl-demo .item img{
            height: 500px;
        }

    }

    @media screen and (max-width: 992px) {
        #owl-demo .item img{
            height: 350px;
        }

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
</STYLE>

    <!-- Styles -->
 </head>
<body style="background: #f7f7f7;">
    <div id="app">

        <main class="py-4" style="  background-image: url('/img/background1.png');
        background-size: cover ;
        background-repeat: no-repeat;
        background-attachment: fixed;
">
            <a  target="_blank" href="https://api.WhatsApp.com/send?phone=9660506601144"
                style="position:fixed; z-index: 99; bottom: 10%; left: 25px; text-align: center">
                <img src="{{asset('img/w.png')}}" style="width: 50px; height: 50px; ">
                <br>
                <span style="color: #22b258">دردش معنا</span>
            </a>
            @yield('content')
        </main>


    </div>

{{--    <div class="counter-bg">--}}
{{--        <div class="container">--}}
{{--            <div class="col-xs-12 col-sm-6 col-md-6">&copy; copyright {{date('Y')}}. Sheari. All right reserved.</div>--}}

{{--        </div>--}}
{{--    </div>r--}}


    <script src = "{{asset('/website/')}}/jquery.min.js"></script>
    <script src="{{ asset('/website/')}}/bootstrap-3-3-4-dist/js/Jq.js"></script>
    <script src="{{ asset('/website/')}}/bootstrap-3-3-4-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{asset('/OwlCarousel/dist/owl.carousel.min.js')}}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( 'summary-ckeditor',{
            contentsLangDirection: 'rtl',

        } );

    </script>

        <script>
        $(function () {
            {{-- $('[data-toggle="tooltip"]').tooltip()--}}
        })
    </script>

    <script>


        $(function() {

            $(document).ready(function() {
                $('.select2').select2({
                    dir: "rtl",
                });
            });

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

        messaging.onMessage(function(payload) {

            const noteTitle = payload.notification.title;

            const noteOptions = {

                body: payload.notification.body,

                icon: payload.notification.icon,

            };

            new Notification(noteTitle, noteOptions);

        });



    </script>



    @stack('script')
</body>
</html>
