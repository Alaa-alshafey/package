@extends('layouts.app')

@section('content')

    @push('style')
        <link href="{{ asset('/website/')}}/amssoftech.css" rel="stylesheet" />
        <link href="{{ asset('/website/')}}/bootstrap-3-3-4-dist/post.css" rel="stylesheet" />

        <style>
            .profile-bar small{
                margin-right: 10px;
                font-size: 13px;
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
            .profile-bar form select.form-control,
            .profile-bar form input[type='file'] {
                border-radius: 16px !important;
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
            }

            .profile-bar form input[type='submit']{
                border-radius: 16px !important;
                box-shadow: none;
                margin: 0;
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


                    {!!Form::open( ['route' => 'addContact' ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}
                        <div class="form-group" style="display: none;">
                            <label for="faxonly">Fax Only
                                <input type="checkbox" name="faxonly" id="faxonly" />
                            </label>
                        </div>
                    <div class="profile-bar2">

                        <div class="form-group">
                            <small>الاسم  :  </small>
                            <input type="text" class="form-control" placeholder="من فضلك ادخل الاسم هنا" name="name" required>
                        </div>


                        <div class="form-group">
                            <small>الايميل    :  </small>
                            {!! Form::email("email",null,['class'=>'form-control ','id'=>'','required','placeholder'=>'من فضلك ادخل البريد الالكتروني هنا ' ])!!}
                        </div>

                        <div class="form-group">
                            <small>رقم الجوال    :  </small>
                            {!! Form::number("phone",null,['class'=>'form-control ',
                            'id'=>'','required',
                            'placeholder'=>'050xxxxxxxxxx'])!!}
                        </div>


                        {{--                        <div class="form-group">--}}
                        {{--                            <small>عنوان الموضوع :     </small>--}}
                        {{--                            <input type="text" class="form-control" name="subject" required>--}}
                        {{--                        </div>--}}

                        <div class="form-group">

                            <small>  موضوع التواصل     :   </small>

                            {!! Form::select("type",['شكوى'=>'شكوى','اقتراح'=>'اقتراح','طلب تواصل'=>'طلب تواصل','استفسار'=>'استفسار','تنبيه'=>'تنبيه',' طلب لقاء'=>' طلب لقاء','   شكر'=>'   شكر'],null,['class'=>'form-control select2','id'=>'type','placeholder'=>'حدد النوع  ', 'required'])!!}

                        </div>
                        <div class="form-group">
                            <small>  الرسالة  :   </small>
                            <textarea type="text" class="form-control" name="message" placeholder="من فضلك ادخل موضوع الرسالة هنا " required></textarea>
                        </div>

                        <div class="form-group">
                            <small>  المرفقات  :   </small>
                            {!! Form::file("file",null,
                            ['class'=>'form-control ','id'=>'', ])!!}
                        </div>

                        <input type="submit" value="ارسال"
                               class="form-control btn btn-primary" style="margin: 10px 0px">



                    </div>
                    {!!Form::close() !!}

                </div>


            </div>
        </div>
    </div>

@endsection
