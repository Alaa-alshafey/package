@extends('layouts.app')

@section('content')


    @push('style')
        <link href="{{ asset('/website/amssoftech.css')}}" rel="stylesheet" />
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
            .login-bg a:hover, .login-bg a:focus{
                color: #555;
                outline: none;
            }
            #regForm select{
                -webkit-border-radius: 16px !important;
                -moz-border-radius: 16px !important;
                border-radius: 16px !important;
               box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
                padding: 5px 0 !important;
            }
            #regForm input{
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
            }

            .select2-container--default .select2-selection--single{
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 16px;
                min-height: 46px;
                padding-top: 10px;
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);

            }
            .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow{
                left: -1px;
                right: auto;
                top: 20%;
            }
             #nextBtn{
                 float: left;
                 color:#ffffff;
                 background:#006bb3;
                 padding: 10px 30px;
             }
            .checkmark{
                border: 1px solid #006bb3;
            }
            .user-bg{
                color: #006bb3;
            }

            .user-bg label{
                color: #555555;
            }
            #regForm input[type='file']{
                width: 98% !important;
            }

        </style>
    @endpush
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8">
                <div class="text-center">
                    <a href="/"><img src="{{asset('logo-1.png')}}" style="padding: 0" class="login-logo" /></a>
                </div>
                <div class="profile-bar">

                    <form id="regForm" method="post" action="/register">
                        @csrf


                        <div class="pos login-tab">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <h1><span>التسجيل كعضو(مستفيد)</span></h1>
                        <span style="color: #7dc416; font-weight: bold">( اشتراك مجاني )</span>

                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="tab">
                            <div class="form-group">
                                <div class="time-bg">
                                    <div class="time-bg">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>الاسم*</label>
                                                    <input type="text" placeholder="يرجى ادخال الاسم  "
                                                           name="name" />
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <label>الدولة*</label>
                                                <div class="form-group">


                                                    {!! Form::select("country_id",countries(),null,
                                                    ['class'=>'form-group select2',
                                                    'id'=>'Country','placeholder'=>'اختر الدولة'])!!}

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" id="DIVCity">
                                                <label>المدينة*</label>
                                                <div class="form-group">
                                                    {!! Form::select("city_id",cities(),null,
                                                    ['class'=>'form-group select2','id'=>'area','placeholder'=>'اختر المدينة ' ,'disabled'])!!}
                                                </div>

                                            </div>

                                            {{--
                                            <div class="col-xs-12 col-sm-12 col-md-12" id="DIVregion">
                                                <label>المنطقة*</label>
                                                <div class="form-group">
                                                    {!! Form::select("region_id",regions(),null,['class'=>'form-group ','id'=>'area','placeholder'=>'اختر المنطقة' ,'disabled'])!!}
                                                </div>

                                            </div>
                                            --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label style="margin-top: 15px">مفتاح الدولة *</label>
                                                    <select class="select2" id="CCode" onchange="return resetField()" required>
                                                        <option value="" disabled selected>اختر الدولة</option>
                                                        <option value="973">البحرين 973</option>
                                                        <option value="965">الكويت 965</option>
                                                        <option value="968">عمان 968</option>
                                                        <option value="966">المملكة العربية السعودية  966</option>
                                                        <option value="971">الإمارات العربية المتحدة 971</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label> رقم الجوال (بدون الرمز الدولي) مثل (05xxxxxxxxxx)*</label>

                                                    <input type="text"
                                                           id="CMobile" placeholder="مثال : 512345678"
                                                           onchange="return getMobile()"
                                                           onkeypress="return isNumber(event)"/>
                                                    @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                    <input type="hidden" name="phone" id="Mobile" />
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>البريد الإلكتروني*</label>
                                                    <script type="text/javascript">
                                                        function getUserName(getval)
                                                        {
                                                            document.getElementById("UserName").value=getval;

                                                        }
                                                    </script>
                                                    <input type="email" name="email" id="email"
                                                           onblur="checkEmail(this.value)"
                                                           onchange="return getUserName(this.value)"/>

                                                    <span class="invalid-feedback" id="email_not_found" style="display: none" role="alert">
                                                            <strong>هذا البريد مستخدم من قبل </strong>
                                                        </span>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                    @push('script')

                                                    <script>



                                                    </script>
                                                    @endpush
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <div class="user-bg">

                                                        <span style="color: #7dc416; font-weight: bold">( اشتراك مدفوع )</span>
                                                        <p>احصل على جميع الخصومات المقدمة من الشركات العملاقة حصريا للعملاء المتميزين فقط</p>
                                                        <label class="check-box">
                                                            احصل على عضوية التميز
                                                            <input type="checkbox" name="rq" id="VIP" value="VIP">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="form-group">
                                <div class="time-bg">
                                    <div class="time-bg">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>المستخدم*</label>
                                                    <input type="text" name="email" id="UserName"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label>الرقم السري*</label>
                                                    <input type="password" name="password"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">

                                                    <label>تأكيد الرقم السري*</label>
                                                    <input type="password" name="password_confirmation"/>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="form-group">
                                <div class="time-bg">
                                    <div class="time-bg">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="user-bg">
                                                    <!--                                                    <p data-toggle="collapse" data-target="#agreement">I agree the terms and conditions of sheari.com.sa</p>-->
                                                    <label class="check-box" data-toggle="collapse" data-target="#agreement">
                                                        الموافقة
                                                        <input type="radio" name="agree">
                                                        <span class="checkmark"></span>
                                                    </label>

                                                    <div id="agreement" class="collapse">
                                                        <p>
                                                            بإمكانكم الاطلاع على الشروط واﻷحكام عبر الصفحة الرئيسية
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="align">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)">السابق</button>
                                <button type="button" id="nextBtn" onclick="nextPrev(1)">التالي</button>
                                <button type="submit" id="submitBtn">تسجيل</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-bg" style="background-color: #999">
                    <h5><span  style="background-color: #999; color: #fff">عضو في باكيج؟</span></h5>
{{--                    <a href="/en/guest/customer-registration"><i class="fa fa-language"></i> English</a>--}}
                    <a style="background-color:#fbfbfb; border-radius: 21px; padding: 7px 41px; border: 1px solid #fbfbfb;" href="{{route('login')}}">دخول</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('website/bootstrap-3-3-4-dist/post.js')}}"></script>
    <script>
        $('#Country').change(function () {

            var val = $(this).val();
            var base_url = "{{asset('/')}}";
            if (val == "") {
                val = 0;
            }
            $.ajax({
                type: "GET",
                url: base_url + "regions/" + val,
                success: function (data) {
                    $('#DIVCity').html(data);
                }
            });


        });


        function checkEmail(email) {
            token = "{{csrf_token() }}";
            $.ajax({
                type: 'POST',
                url: "{{route('checkEmail')}}",
                data: {_token: token, email: email}
            }).success(function (data) {
                if (data.msg == true) {
                    $("#email_not_found").css("display", "inline-block");
                } else {
                    $("#email_not_found").css("display", "none");
                }
            });
        }


    </script>



        <script type="text/javascript">
            function getMobile()
            {
                var CCode=document.getElementById('CCode').value;
                var CMobile=document.getElementById('CMobile').value;
                if(CCode=="")
                {
                    alert("اختر الدولة");
                    document.getElementById('CMobile').value="";
                    document.getElementById('Mobile').value="";
                }
                else
                {
                    var res = CMobile.charAt(0);
                    if(res=="0")
                    {
                        CMobile=CMobile.substring(1);
                    }
                    else
                    {
                        CMobile=CMobile.substring(0);
                    }

                    document.getElementById('Mobile').value=CCode+""+CMobile;

                }
            }

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function resetField()
        {
            document.getElementById('CMobile').value="";
            document.getElementById('Mobile').value="";
        }

    </script>


@endpush
