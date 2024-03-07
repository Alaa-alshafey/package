@extends('layouts.user')

@section('content')

    @push('style')

        <style>


            .work_single{
                border: 1px solid #ddd;
                margin-bottom: 15px;
                height: 300px;
                overflow: scroll;
            }
            .work_single h3{
                margin-top: 10px;
                color: #676767;
                text-align: center;
                font-size: 15px;
            }

            .work_single img{
                height: 200px;
                margin: 5px 20px;
                padding: 5px;
                border: 1px solid #ddd;
                overflow: hidden;
                width: 80%;
            }
            .work_single div.paragraph{
                text-align: center;
                margin-top: -16px;
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
            div.bordered_data small{
                display: block;
                text-align: center;
                background: #ccc;
                padding: 8px;
                margin-bottom: -12px;
                font-size: 14px;
                border-radius: 15px;
            }
            div.bordered_data b{
                border: 1px solid #ccc;
                display: block;
                border-radius: 14px;
                padding-right: 15px;
                min-height: 25px;
                margin-bottom: 7px;
                font-weight: inherit;
                box-shadow: inset 1px 0px 2px 0px
                rgba(0,0,0,.25);
                padding-top: 5px;
                padding-bottom: 5px;
                overflow: hidden;
            }



            .profile-bar h1 a > i.badge{
                background-color: #bcc732;
                padding: 7px 46px;
                border-radius: 10px;
                font-size: 18px;
                font-style: inherit;
                font-weight: normal;
                margin-left: 20px;
            }

            .cardbt{
                padding: 15px;
                width: 90%;
                margin: 10px auto;
                font-size: 18px;
                border-radius: 14px !important;
            }
        </style>


    @endpush

@php
$user=auth()->user();
@endphp
    <div class="container">
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="profile-bar mar-bot">
                    <div>
                        <h1><span><i class="fa fa-user"></i> تفاصيل المستخدم</span>
                            <a href="{{route('user.editMyAccount')}}">
                                <i  class="badge"> إضافة وتعديل</i></a></h1>
                    </div>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-6 bordered_data">
                                <small> الحساب :</small><br />
                                <b>
                                    @isset($user->provider_type)
                                        @if($user->provider_type=='one')
                                            شخصى
                                        @else
                                            شركة
                                        @endif
                                        @else
                                            شخص
                                                @endisset
                                </b>
                            </div>
                            <div class="col-xs-6 bordered_data">
                                <small>اﻷسم :</small><br />
                                <b>{{$user->name}}</b>
                            </div>
                            <div class="col-xs-6 bordered_data">
                                <small>البريد :</small><br />
                                <b> {{$user->email}}</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>الجوال :</small><br />
                                <b>{{$user->phone}}</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>العنوان.:</small><br />
                                <b>{{$user->address}}</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>
                                    الخصم :
                                </small><br />

                                <!--                                    <b>0%</b>-->
                                <b>{{$user->discount}}%</b>
                            </div>

                            <div class="col-xs-6 bordered_data">
                                <small>
                                    نوع الحساب :
                                </small><br />
                                @if($user->is_special)
                                    <b>مميز</b>
                                @else
                                    <b>عادي</b>
                                @endif
                            </div>

                            @if($user->emp_no)
                                <div class="col-xs-6 bordered_data">
                                    <small>
                                        عدد الموظفين  :
                                    </small><br />
                                    <b>{{$user->emp_no}}</b>
                                </div>

                            @endif

                            @if($user->creation_year)
                                <div class="col-xs-6 bordered_data">
                                    <small>
                                        سنة الإنشاء    :
                                    </small><br />
                                    <b>{{$user->creation_year}}</b>
                                </div>

                            @endif

                            @if($user->commerical_no)
                                <div class="col-xs-6 bordered_data">
                                    <small>
                                        السجل التجارى    :
                                    </small><br />
                                    <b>{{$user->commerical_no}}</b>
                                </div>

                            @endif
                            <div class="col-xs-6 bordered_data">

                            </div>

                            <div class="col-xs-12 bordered_data" style="overflow: scroll">
                                <small>نبذة عامة :</small><br />
                                <textarea class="form-control summary-ckeditor" id="summary-ckeditor" rows="5" disabled>{!! html_entity_decode($user->bio)  !!}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="regi-head">
                        <h2><span><i class="fa fa-briefcase"></i> مجالاتنا</span></h2>
                        <div class="review-bg" id="comment">
                            @foreach(auth()->user()->SubCategories as $item )
                                <div class="col-xs-6 col-md-3">

                                <div style="display: block;margin-bottom: 10px;">

                                    <form id="delete-form{{$item->id}}"
                                          action="{{route('user.delete_sub_category',['id'=>$item->id])}}"
                                          method="post">

                                        @csrf

                                        <input type="hidden" value="{{$item->id}}"
                                               name="sub_category_id">
                                        <input type="hidden"
                                               value="{{auth()->user()->id}}"
                                               name="user_id">
                                    </form>

                                    <button onclick="Delete({{$item->id}})"
                                            style="position: relative;" class="btn btn-primary btn-block show-modal">{{$item->name()}}

                                        <a style="position: absolute; color: #fff; left: 0"
                                           class=""><i class="fa fa-trash"></i>
                                        </a>

                                    </button>

                                    <script>
                                        function Delete(id) {
                                            var item_id=id;
                                            console.log(item_id);
                                            swal({
                                                title: "هل أنت متأكد ",
                                                text: "هل تريد حذف هذا ؟",
                                                icon: "warning",
                                                buttons: ["الغاء", "موافق"],
                                                dangerMode: true,

                                            }).then(function(isConfirm){
                                                if(isConfirm){
                                                    document.getElementById('delete-form'+item_id).submit();
                                                }
                                                else{
                                                    swal("تم االإلفاء", "تم الغاؤه",'info',{buttons:'موافق'});
                                                }
                                            });
                                        }
                                    </script>


                                </div>

                                </div>
                            @endforeach

                            <div class="col-xs-6 col-md-3">
                                <div style="display: block; margin-bottom: 10px">
                                    @if(isset(auth()->user()->ads_category))

                                        <form id="delete-form-ads"
                                              action="{{route('user.delete_ads_category',
                                              ['id'=>auth()->user()->ads_category])}}"
                                              method="post">

                                            @csrf

                                            <input type="hidden" value="{{auth()->user()->ads_category}}"
                                                   name="ads_category">
                                            <input type="hidden"
                                                   value="{{auth()->user()->id}}"
                                                   name="user_id">
                                        </form>

                                        <button onclick="DeleteAds({{auth()->user()->ads_category}})"
                                                style="position: relative;" class="btn btn-primary btn-block show-modal">{{auth()->user()->adsCategory->ar_name}}
                                            <a style="position: absolute; color: #fff; left: 0"
                                               class=""><i class="fa fa-trash"></i>
                                            </a>
                                        </button>

                                        <script>
                                            function DeleteAds(id) {
                                                var item_id=id;
                                                console.log(item_id);
                                                swal({
                                                    title: "هل أنت متأكد ",
                                                    text: "هل تريد حذف هذا ؟",
                                                    icon: "warning",
                                                    buttons: ["الغاء", "موافق"],
                                                    dangerMode: true,

                                                }).then(function(isConfirm){
                                                    if(isConfirm){
                                                        document.getElementById('delete-form-ads').submit();
                                                    }
                                                    else{
                                                        swal("تم االإلفاء", "تم الغاؤه",'info',{buttons:'موافق'});
                                                    }
                                                });
                                            }
                                        </script>

                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <div class="regi-head">
                        <h2><span><i class="fa fa-briefcase"></i> أعمالنا</span></h2>
                        <div class="row">
                            @if($user->projects)
                                @foreach($user->projects as $project)
                                    <div class="col-xs-6 col-sm-6 col-md-4">
                                        <a style="text-align: center;
display: block;
position: relative;
overflow: hidden;margin: 8px 1px;
min-height: 230px;
"  href="#" data-toggle="modal" data-target="#myModal{{$project->id}}">

                                            @if(isset($project->price))
                                                <span id="price">
                                                    <span class="text">السعر التقديري</span>
                                                    {{ $project->price }} RS
                                                </span>
                                            @endif

                                            <span class=""
                                                 style="color: #fff;padding: 8px 0;
                                                 display: block; text-align: center;
                                                  background: #bbb9b9">

                                                @if($project->file_type == 'image')
                                                   <i class="fa fa-picture-o fa-2x"></i>
                                               @elseif($project->file_type == 'video')
                                                   <i class="fa fa-video-camera fa-2x"></i>
                                               @else
                                                   <i class="fa fa-file-audio-o fa-2x"></i>
                                               @endif
                                            </span>

                                            <img src="{{getimg($project->file)}}"
                                                 style="width: 100%;
                                                        height: 200px"
                                                        alt=""
                                                        class="img-responsive img-fluid" />

                                            <h4 style="
	margin: 0px 0px;
	color: #fff;
	font-size: 16px;
	text-align: center;
	background-color: #006bb3;
	padding: 19px;
	border-bottom-left-radius: 20px;
	border-bottom-right-radius: 20px;
	min-height: 60px;
">
                                                @if(mb_strlen($project->title)> 10)
                                                    {{mb_substr($project->title,0,10)}}...
                                                @else
                                                    {{$project->title}}
                                                @endif
                                            </h4>
                                        </a>
                                    </div>


                                    <div id="myModal{{$project->id}}"
                                         class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{$project->title}}</h4>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img style="margin: auto"
                                                         src="{{getimg($project->file)}}" class="img-responsive"
                                                    />
                                                    <p style="margin-top: 20px" class="">{{$project->description}}</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">اغلاق</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            @endif



                        </div>


                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">

                            <tr>
                                <td colspan="2">


                                    <div class="checkbox disabled">
                                        <label style="padding-right:20px;">
                                            <input type="checkbox" value="" {{$user->map?"checked":''}} disabled style="margin-right:-20px;">
                                            الموقع علي الخريطة                                        </label>
                                    </div>


                                    <div class="checkbox disabled">
                                        <label style="padding-right:20px;">
                                            <input type="checkbox" value="" {{$user->delivery?"checked":''}} disabled style="margin-right:-20px;">
                                            خدمات التوصيل                                        </label>
                                    </div>


                                    <div class="checkbox disabled">
                                        <label style="padding-right:20px;">
                                            <input type="checkbox" value=""  {{$user->charitable?"checked":''}}  disabled style="margin-right:-20px;">
                                            خصومات خيرية                                        </label>
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </div>

                        <h2><span><i class="fa fa-map-marker"></i> الموقع</span></h2>
                            <div class="review-bg" id="comment">
                                <iframe
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&q={{$provider->lat}},{{$provider->lng}}"
                                        frameborder="0" style="border:0;height:300px;
                                width: 100%;border: 5px solid #ccc;border-radius: 14px;" allowfullscreen="" class="mb-5"></iframe>
                            </div>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <small>الدولة:</small><br />
                                    <b>{{$user->City->country->name()}}</b>
                                </td>
                                <td>
                                    <small>المدينة:</small><br />
                                    <b>{{$user->City->name()}}  </b>
                                </td>
                            </tr>
                            
                        </table>
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-xs-12 col-sm-6 col-md-6">--}}
{{--                            <div class="regi-head">--}}
{{--                                <h2><span><i class="fa fa-certificate"></i> السجل التجاري</span></h2>--}}
{{--                            </div>--}}
{{--                            <div class="certi">--}}
{{--                                <img src="/common/User/en/Tradelicense/default.jpg" height="310"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12 col-sm-6 col-md-6">--}}
{{--                            <div class="regi-head">--}}
{{--                                <h2><span><i class="fa fa-youtube"></i> البرومو الدعائي</span></h2>--}}
{{--                            </div>--}}
{{--                            <iframe width="100%" height="310" src="/common/User/en/Tradelicense/default.jpg" frameborder="0" allowfullscreen></iframe>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
            @include('layouts.side')

        </div>
    </div>





@endsection