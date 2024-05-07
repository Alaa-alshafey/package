@extends('layouts.app')

@section('content')


    @push('style')
        <link href="{{ asset('/website/')}}/amssoftech.css" rel="stylesheet" />
        <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/post.css" rel="stylesheet" />

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
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                <div class="profile-bar">
                    <form method="POST" action="{{ route('login') }}">
                        {!! csrf_field() !!}
                        <h1><span>تسجيل دخول العميل</span></h1>

                            <div class="form-group">
                                <div class="time-bg">
                                    <div class="time-bg">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label> اسم المستخدم*</label>
                                                    <input type="text" placeholder="البريد الإلكتروني"   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus/>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>الرقم السري*</label>
                                                    <input type="password" placeholder="اكتب الباسورد" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required/>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div>
                            <div class="align">
                                <button type="submit" id="submitBtn">تسجيل الدخول</button>
                                <label class="check-box">
                                    تذكرنى
                                    <input type="checkbox" name="registration">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-bg">
                    <h5><span>هل أنت زائر؟</span></h5>
                    <a href="../../index.html"><i class="fa fa-language"></i> English</a>
                    <a href="../../ar/guest/signup.html">سجل معنا</a>
                    <a href="../../index.html">هل نسيت كلمة المرور</a>
                </div>
            </div>
        </div>
    </div>
@endsection
