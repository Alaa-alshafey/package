<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="{{asset('admin/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/login.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container" style="background-image: linear-gradient(#1d58e2, #1d68a7);  ;margin-bottom: 30px;">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                @if(session()->has('status'))
                <div class="alert alert-danger">
                    <center>{{session()->get('status')}}</center>
                </div>
                @endif

                <!-- Advanced login -->
                <form method="POST" action="{{ route('login') }}">
                    {!! csrf_field() !!}
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object text-warning-400" style=" background-image: linear-gradient(#1d58e2, #1d68a7); border:1px solid rgb(191, 145, 59)">
                                <img src="{{asset('admin/assets/images/KhadomLogo.png')}}" style="width: 120px;">
                            </div>
                            <h5 class="content-group-lg">تسجيل الدخول <small class="display-block">ادخل بياناتك</small></h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input id="email" oninvalid="this.setCustomValidity('من فضلك قم بادخال الايميل بشكل صحيح')" type="email" placeholder="اكتب الايميل" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback has-feedback-left">

                            <input id="password" type="password" placeholder="اكتب الباسورد" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-blue btn-block" style="background-image: linear-gradient(#1d58e2, #1d68a7);border-color: rgb(191, 145, 59)">تسجيل دخول <i class="icon-circle-left2 position-right"></i></button>
                        </div>
                        <span class="help-block text-center no-margin">جميع الحقوق محفوظة  <a href="#">شركة الفكرة الرائعة</a></span>
                    </div>
                </form>
                <!-- /advanced login -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
