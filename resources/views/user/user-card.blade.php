@extends('layouts.user')

@section('content')

    @push('style')

        <link href="{{asset('css/card.css')}}" rel="stylesheet" />

        <style>

        </style>

    @endpush



    <div class="container">
        <div class="row profile-bg mar-bot">

            <div class="col-xs-12 col-sm-8 col-md-9 hidden-xs hidden-sm" id="card">
                <div class="profile-bar">
                    <div class="">
                        <h2 style="font-weight: normal" class="text-right"><span style="font-weight: normal">بطاقة العضوية الخاصة بك</span></h2>

                        <div class="row" >
                            <button class="btn btn-success"
                                    style="
padding: 10px;
margin: 20px 2px;
text-align: center;
border-radius: 11px !important;
display: inline-block;

"
                                    onclick="JPEG()">تحميل نسخة من بطاقة العضوية</button>
                            <div class="card" id="print">

                                <div class="border_card">
                                    <div class="top">
                                        <div class="col-md-4">
                                            <span>  {{auth()->user()->id}} : No </span>
                                            <p style="margin-right: 7px">الفنون الرقميه بمنصـه باكيج </p>
                                            <p class="let">www.sheari.net</p>
                                        </div>
                                        <div class="col-md-4">

                                            <p class="spe text-center"> بـطـاقـة عــضـويـة</p>


                                        </div>
                                        <div class="col-md-4" style="line-height: 30px; margin-right: -1px">
                                            <img src="{{asset('img/logo-0.png')}}" class="img-responsive" />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="body">
                                        <div class="col-xs-12">
                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <p style="font-size: 24px">العضو <span style="display: inline-block; margin-right: 50px"> | </span></p>
                                                    </div>
                                                    <div class="col-xs-7">
                                                        <p class="" style="font-size: 24px; margin-right: 20px">
                                                            {{auth()->user()->name}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-xs-12">
                                            <div class="col-md-2">
                                                <p style='
                    color:#555;
                    text-align: right;
                    display: inline-block;
                    margin-right: 10px;
                    line-height: 285px;
                    font-size: 24px;
                    overflow: hidden;

                    '>المجال
                                                </p>

                                            </div>
                                            <div class="col-xs-10">
                                                <table style='text-align: center;

                    line-height: 50px; font-size: 12px;'>
                                                    <tr>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[0]))
                                                                {{auth()->user()->SubCategories[0]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif

                                                        </td>


                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[1]))
                                                                {{auth()->user()->SubCategories[1]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[2]))
                                                                {{auth()->user()->SubCategories[2]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>

                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[3]))
                                                                {{auth()->user()->SubCategories[3]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[4]))
                                                                {{auth()->user()->SubCategories[4]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>

                                                            @if(isset(auth()->user()->SubCategories[5]))
                                                                {{auth()->user()->SubCategories[5]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[6]))
                                                                {{auth()->user()->SubCategories[6]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>

                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[7]))
                                                                {{auth()->user()->SubCategories[7]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                    </tr>


                                                    <tr>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[8]))
                                                                {{auth()->user()->SubCategories[8]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[9]))
                                                                {{auth()->user()->SubCategories[9]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[10]))
                                                                {{auth()->user()->SubCategories[10]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>

                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[11]))
                                                                {{auth()->user()->SubCategories[11]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                    </tr>



                                                    <tr>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[12]))
                                                                {{auth()->user()->SubCategories[12]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[13]))
                                                                {{auth()->user()->SubCategories[13]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>
                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[14]))
                                                                {{auth()->user()->SubCategories[14]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>

                                                        <td style='
                            border: 2px solid #39758e;
                            color: #fff;
                            border-radius: 10px;'>
                                                            @if(isset(auth()->user()->SubCategories[15]))
                                                                {{auth()->user()->SubCategories[15]->ar_name}}
                                                            @else
                                                                {{"--"}}
                                                            @endif
                                                        </td>


                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">

                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <p style="font-size: 24px;line-height: 80px">البوابة <span style="display: inline-block; margin-right: 50px"> | </span></p>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <p class="" style="font-size: 24px; word-spacing: 24px">
                                                            لزيارة صفحتنا الشخصية عبر بوابة
                                                            <br>

                                                            <span style="letter-spacing: 18px; margin-top: 5px;

margin-right: -18px;

display: inline-block;"> www.sheari.net
                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12">

                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <p style="font-size: 24px;line-height: 80px">التواصل <span style="display: inline-block; margin-right: 30px"> | </span></p>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <p class="" style="font-size: 18px">
                                                            <span style="letter-spacing: 11px; font-size: 20px ; display:inline-block; margin-right:100px">{{auth()->user()->phone}}</span>
                                                            <br>

                                                            <span style="word-spacing: 1px;
                                                        margin-top: 5px;

margin-right: -11px;

display: inline-block;"> ننصح بالتواصل عبر بوابة (باكيج) للحصول علي كافة الخدمات
                                                        </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="bootom">
                                    <div class="col-xs-6">
                                        <img class="img-responsive" style="position: relative; top: -5px; width: 60px; height: 60px" src="{{asset('img/icon.png')}}">
                                    </div>
                                    <div class="col-xs-6">
                                        <p style='float: left; font-size: 15px;'>
                                            <span style="letter-spacing: 2px;
margin-right: -2px;
"> {{auth()->user()->created_at->toDateString()}}</span>
                                            <br>صـالحـة لمدة عام
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            @include('layouts.side')

        </div>

        <div class="row hidden-lg hidden-md">
            <p> يمكنك اظهار بطاقة العضوية في الشاشات الكبيرة (كومبيوتر - لابتوب )</p>
        </div>
    </div>

    <!-- Bank Details -->
     <!-- End Bank Details -->

    @push('script')

        <script src="{{asset('js/dist/image.js')}}"></script>

        <script>
    function JPEG() {
        domtoimage.toJpeg(document.getElementById('print'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();
            });

    }


</script>


    @endpush
@endsection
