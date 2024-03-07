@extends('layouts.app')

@section('content')

    @push('style')
        <link href="{{ asset('/website/')}}/amssoftech.css" rel="stylesheet" />
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
                <div class="text-center">
                    <a href="/"><img src="{{asset('logo-1.png')}}" style=" padding: 0" class="login-logo"/></a>
                </div>

                <div class="profile-bar">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        {!!Form::open( ['route' => 'update-password' ,
                        'class'=>'form ',
                        'method' => 'Post','files' => false]) !!}
                        @csrf
                        <div class="profile-bar2">
                        <h1><span><i class="fa fa-question-circle"></i>ادخل كود التفعيل </span></h1>


                        <div class="form-group">
                            <small>البريد الالكتروني</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

" type="email" class="form-control"
                                   name="email" required="">
                        </div>

                        <div class="form-group">
                            <small>كود التفعيل</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

" type="text" class="form-control"
                                   name="mobile_confirmation" required="">
                        </div>




                        <div class="form-group">
                            <small>الباسورد الجديد</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

" type="password" class="form-control"
                                   name="password" required="">
                        </div>

                        <div class="form-group">
                            <small>تأكيد الباسورد</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

" type="password" class="form-control"
                                   name="password_confirmation">
                        </div>


                        <div class="form-group">
                            <button style="border-radius: 20px" type="submit" class="nexr-btn">ارسال</button>
                        </div>
                    </div>
                    {!!Form::close() !!}

                </div>


            </div>
        </div>
    </div>
@endsection
