@extends('layouts.user')

@section('content')

    @push('style')

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
        <div class="row profile-bg mar-bot mr-5">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-xs-12 col-sm-8 col-md-9">
                {!!Form::open( ['route' => 'user.changePassword' ,'class'=>'form ', 'method' => 'Post','files' => false]) !!}
                    <div class="profile-bar2">
                        <h1><span><i class="fa fa-question-circle"></i>    تغيير كلمة المرور</span></h1>

                        <div class="form-group">
                            <small>الرقم السري القديم</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

" type="password" class="form-control" name="old_password" required="">
                        </div>
                        <div class="form-group">
                            <small>الرقم السري الجديد</small>
                            <input
                                    style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

"
                                    type="password" class="form-control" name="password" required="">
                        </div>
                        <div class="form-group">
                            <small>تأكيد الرقم السري الجديد</small>
                            <input style="
border-radius: 16px !important;
box-shadow: inset 2px 0px 6px 0px rgba(0,0,0,.25);

"

                                    type="password" class="form-control" name="password_confirmation" required="">
                        </div>
                        <div class="form-group">
                            <button style="border-radius: 20px" type="submit" class="nexr-btn">حفظ التغييرات</button>
                        </div>
                    </div>
                {!!Form::close() !!}
            </div>


@include('layouts.side')



        </div>
    </div>

@endsection
