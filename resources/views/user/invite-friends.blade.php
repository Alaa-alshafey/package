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
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar">
{{--                    <div>--}}
{{--                        <h1><span><i class="fa fa-share"></i> قم بإرسال دعوة لأصدقائك</span></h1>--}}
{{--                    </div>--}}
{{--                    <form method="post" action="/ar/professionalaction/share-referral-code">--}}
{{--                        <textarea class="form-control" rows="5" placeholder="أدخل البريد الإلكتروني مع وضع فاصلة نهاية كل بريد إلكتروني" name="EmailList" required=""></textarea>--}}
{{--                        <br>--}}
{{--                        <button type="submit" class="nexr-btn">إرسال دعوة</button>--}}
{{--                    </form>--}}
                    <div class="regi-head">
                        <h2><span><i class="fa fa-share-alt"></i> وسائل المشاركة </span></h2>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="input-group">

                                <span class="input-group-addon" id="basic-addon1"><button onclick="URLCopy()" type="button"><i class="fa fa-link"></i> نسخ الرابط</button></span>
                                <input type="text" class="form-control" id="CURL" value="{{route('home')}}  ">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('home')}}" title="Share on Facebook"><i class="fa fa-facebook"></i> المشاركة في الفيسبوك</a>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <a target="_blank" href="https://twitter.com/home?status={{route('home')}}" title="Share on Twitter"><i class="fa fa-twitter"></i> المشاركة في تويتر</a>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <a href="whatsapp://send?text={{route('home')}}" data-action="share/whatsapp/share" title="Share on Whats App"><i class="fa fa-whatsapp"></i> المشاركة في واتساب</a>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{route('home')}}&amp;title=&amp;summary=&amp;source=" title="Share on Linkedin"><i class="fa fa-linkedin"></i> المشاركة في linked in</a>
                        </div>
                    </div>
                </div>

{{--                <div class="profile-bar1 mar-bot">--}}
{{--                    <div>--}}
{{--                        <h2><span><i class="fa fa-user"></i> المستخدمين المسجلين عبر الدعوات</span></h2>--}}
{{--                    </div>--}}

{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered">--}}

{{--                            <tbody><tr>--}}
{{--                                <th>الاسم</th>--}}
{{--                                <th>تاريخ التسجيل</th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2">عفوا لاتوجد نتائج</td>--}}

{{--                            </tr>--}}
{{--                            </tbody></table>--}}
{{--                    </div>--}}

{{--                </div>--}}

            </div>
            @include('layouts.side')
        </div>
    </div>

    <div id="snackbar">Feedback submitted successfully. </div>

@endsection
