@extends('layouts.app')

@section('content')

    @push('style')
        <link href="{{ asset('/website/')}}/amssoftech.css" rel="stylesheet" />
        {{--        <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/post.css" rel="stylesheet" />--}}
        <style>
            #regForm {
                background-color: #ffffff;
                padding: 10px;
                width: 100%;
                float: left;
                direction: rtl;
            }
            button {
                font-family: 'Janna LT' !important;
                background-color: #98c64c;
                color: #ffffff;
                border: none;
                padding: 10px 20px;
                font-size: 17px;
                /*font-family: Raleway;*/
                cursor: pointer;
            }

            button:hover {
                opacity: 0.8;
            }

            #prevBtn {
                background-color: #bbbbbb;
            }

            #nextBtn {
                float: left;
                color: #ffffff;
                background: #176083;
            }

            #submitBtn{
                float:left;
            }

            input, select {
                font-family: 'Janna LT' !important;
                padding: 6px 10px;
                width: 100%;
                font-size: 17px;
                border: 1px solid #aaaaaa;
                line-height: 25px !important;
            }

            input:hover, input:focus, select:hover, select:focus {
                outline: 0;
                border: 1px solid #176083;
            }

            /* Mark input boxes that gets an error on validation: */
            input.invalid {
                background-color: #ffdddd;
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

        <div class="profile-bar">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('resend.active') }}">
                @csrf
                <h1><span>اعادة ارسال الرمز </span></h1>

                <div class="form-group">
                    <div class="time-bg">
                        <div class="time-bg">
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label> البريد الإلكترونى  *</label>
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                <button type="submit" class="btn  btn-primary" id="submitBtn">استعاده رمز التفعيل</button>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
            </div>
        </div></div>
     </div>
</div>
@endsection
