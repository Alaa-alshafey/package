<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>
        لوحة تحكم باكيج
        |
        @yield('title')</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="{{asset('admin/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
@yield('header')
<!-- Core JS files -->

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        {{--<a class="navbar-brand" href="/dashboard"><img src="/admin/assets/images/logo.png" alt=""></a>--}}
        <a class="navbar-brand" href="{{url('/dashboard')}}">لوحة تحكم باكيج</a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a  data-toggle="collapse" class="sidebar-mobile-main-toggle" data-target=".sidebar-category"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
            </li>

        </ul>

        {{--<p class="navbar-text"><span class="label bg-success">متصل اﻵن</span></p>--}}

        <ul class="nav navbar-nav navbar-right">

            {{--<li class="dropdown language-switch">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<img src="{{asset('admin/assets/images/flags/sa.png')}}" class="position-left" alt="">--}}
            {{--عربي--}}
            {{--</a>--}}
            {{--</li>--}}


            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <span>{{auth::user()->name}}</span>
                    <i class="caret"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" onclick="$('#logout').submit()"><i class="icon-switch2"></i> تسجيل خروج</a></li>
                    {!! Form::open(['route'=>'logout','id'=>'logout','class'=>'hide']) !!}
                    {!! Form::close() !!}
                </ul>
            </li>


        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
    @include('admin.nav')
    <!-- Main content -->
        <div class="content-wrapper">
        @include('admin.breadcrumb')
        <!-- Content area -->
            <div class="content">
                @if(Session::has('success'))
                    <div class="alert  alert-styled-left"
                         style="background-color:#ce8936;border-color: #dc9846;color: white">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">اغلاق</span></button>
                        <span class="text-semibold"></span>عظيم !<a href="#"
                            class="alert-link"> {{ Session::get('success') }} </a>
                        .
                    </div>
                @endif

                @if(Session::has('error'))

                    <div class="alert bg-warning alert-styled-left">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">اغلاق</span></button>
                        <span class="text-semibold"></span>عفواً !<a href="#"
                                                                     class="alert-link"> {{ Session::get('error') }} </a>
                        .
                    </div>
            @endif

            @yield('content')

            <!-- Footer -->
                <div class="footer text-muted text-center">

                    &copy; 2018. <a href="http://panorama-q.com">تم التطوير والبرمجة</a> بواسطة <a href="#"
                                                                                                   target="_blank">
                        مؤسسة باكيج  </a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
</div>





<!--    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/loaders/pace.min.js')}}"></script>-->
    <script type="text/javascript" src="{{asset('admin/assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
{{-- <link href="{{asset('admin/assets/icon-picker/css/fontawesome-iconpicker.min.css')}}" rel="stylesheet">--}}

    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>





    <script type="text/javascript"
            src="{{asset('admin/assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/pagination/bootpag.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/pagination/bs_pagination.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/pagination/datepaginator.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <script>

</script>

    {{--  @include('sweet::alert')--}}
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/ui/nicescroll.min.js')}}"></script>
    <!-- moniem comment by order of morsy-->
    {{--<script type="text/javascript" src="{{asset('admin/assets/js/core/app.js')}}"></script>--}}
<!-- moniem comment by order of morsy-->
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/components_pagination.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('admin/assets/js/pages/layout_fixed_custom.js')}}"></script>--}}
    @yield('script')





<!--    com-->

{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
{{-- @include('sweet::alert') --}}
<!-- /page container -->

@stack('scripts')
<script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('.kar-tab').on('click' , function(e){
            e.preventDefault();
            $('.displayBlock').removeClass('displayBlock');
            $(this).next('ul.hidden-ul').toggleClass('displayBlock')
        })
        $('select').addClass('selectNew');
        $('.selectNew').select2();
    })


</script>
</body>
</html>
