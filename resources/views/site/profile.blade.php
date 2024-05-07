@extends('layouts.app')

<style>

    .panel-success{
        background-color: #edefee !important;
    }

    .panel-success > .panel-heading{
        background-color: #edefee !important;
        color: #222;
        padding: 20px ;
        border-color: #edefee !important;
    }

    .back a{
        min-height: 5px !important;
        display: block;
    }

    .panel-success > .panel-heading .panel-title a{
        font-size: 21px;
        color: #555555 !important;
    }

    .panel-success > .panel-heading .panel-title a i{
        font-size: 15px;
    }

    .panel-success > .panel-heading .panel-title a i img{
        width: 60px;
        height:30px;
        margin-left: -20px;
    }

    .collapse.in{
        padding: 20px 10px;
    }



    .panel-success .panel-collapse {
        background-color: #fff;
    }
    .red{
        color: red !important;
    }

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
        margin-top: -30px;
    }

    .form select{
        -webkit-border-radius: 16px !important;
        -moz-border-radius: 16px !important;
        border-radius: 16px !important;
        box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
        padding: 5px 0 !important;
    }
    .form input{
        box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
        border-radius: 16px !important;
    }
    .form textarea{
        box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
        border-radius: 16px !important;
    }

    .form small{
        font-size: 16px;
        margin-bottom: 14px;
        display: inline-block;
    }
    #more {display: none;}

</style>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="profile-bar">
                    <div class="prog" style="display: block; width: 100px" >
                        @if($provider->is_special)
                            <div class="pro" style="margin: 13px -32px 0px 0" data-toggle="tooltip" data-placement="top"
                                 title="مقدم خدمة متميز‎">
                                <i class="fa fa-star"></i>
                            </div>
                        @endif
                        {{--                    @if($provider->is_special)--}}
                        {{--                        <div class="pro" data-toggle="tooltip" data-placement="top" title="وسام التميز">--}}
                        {{--                            <i class="fa fa-star"></i>--}}
                        {{--                        </div>--}}
                        {{--@endif--}}



                        <img style="margin-right: -22px !important;" src="{{getimg($provider->image)}}"  />


                    </div>
                    <div class="name">{{$provider->name}}</div>

                    @if($provider->is_special)
                        @if(($provider->discount > 0))
                            <div class="offer-bg" style="position: relative;background:  transparent; color:  #cc2255; border: 1px solid #D0D2D0; border-radius: 18px">
                                <small style="font-weight: bolder; font-size: 18px;">خصم باكيج</small> : <b style="
                                        position: absolute;
                                        background-image: url({{asset('/')}}/dis.png);
                                        left: 10px;
                                        top: 0;
                                        background-repeat: no-repeat;
                                        width: 48px;
                                        height: 50px;
                                        overflow: hidden;
                                        padding: 0px 5px;
                                        line-height: 30px;
                                        color:#fff;
                                        text-align: center;
                                        ">{{$provider->discount}}% </b>
                            </div>
                        @else
                            <div class="offer-bg" style="position: relative;background:  transparent; color:  #cc2255; border: 1px solid #D0D2D0; border-radius: 18px">
                                <small style="font-weight: bolder; font-size: 18px;">خصم باكيج</small> : <b style="
                                        position: absolute;
                                        background-image: url({{asset('/')}}/dis.png);
                                        left: 10px;
                                        top: 0;
                                        background-repeat: no-repeat;
                                        width: 48px;
                                        height: 50px;
                                        overflow: hidden;
                                        padding: 0px 5px;
                                        line-height: 30px;
                                        color:#fff;
                                        text-align: center;
                                        ">0% </b>
                            </div>
                        @endif
                    @endif
                    <div class="re-icon">
                        <span>{{$provider->rate()}} <i class="fa fa-star"></i></span>
                        <small> تقييم</small>
                    </div>
                    <div class="re-icon">
                        <span>{{$provider->orders()->count()}}</span>
                        <small>عقود مبرمة</small>
                    </div>
                    <div class="re-icon" style="width: 100%">
                        <a style="background: #337ab7; color: #fff; width: 100px; display: inline-block; padding: 5px" href="{{route('user.post-requirement',[$provider->id])}}">طلب خدمة</a>
                    </div>
                </div>
                <div class="profile-bar">
                    <ul class="pro-list">

                        <li><i class="fa fa-map-marker"></i> {{$provider->City->name()}}</li>
                        <li><i class="fa fa-clock-o"></i> {{$provider->created_at}}</li>

                        <li>
                            <i class="fa fa-circle {{$provider->online?'green':'red'}}"></i>
                            {{$provider->online?"متصل حاليا":'غير متصل'}}

                        </li>

                        <!--<li><i class="fa fa-circle green"></i> Online</li>-->
                        <li><i class="fa fa-institution"></i>

                            @isset($provider->provider_type)
                                @if($provider->provider_type=='one')
                                    شخصى
                                @else
                                    أعمال
                                @endif
                                @else
                                    شخصى
                                    @endisset

                        </li>

                        <li><i class="fa fa-thumbs-up"></i>
                            @if($provider->is_special)
                                مميز
                            @else
                                عادي
                            @endif
                        </li>



                        <li>
                            <a href="{{route('user.post-requirement',[$provider->id])}}"><i class="fa fa-umbrella"></i> طلب خدمة </a>
                        </li>


                        @if($provider->charitable)
                            <li><i class="fa fa-heart"></i> خصم خيري</li>
                        @endif

                        <li><i class="fa fa-eye"></i>زيارات : <span class="badge">{{count($provider->providerCount)}}</span></li>





                        <!--<li><i class="fa fa-institution"></i> Freelancer</li>-->
                    </ul>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="back">
                    <h2 class="title">
                        <span>
                            <i class="fa fa-users" style=" color: #176083; "></i>
                            من نحن
                        </span>

                    </h2>


                    @php
                        $bio = html_entity_decode(($provider->bio));
                    @endphp

                    <div class="panel-group" id="about">
                        <!-- start panel 1-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#desc"
                                       data-toggle="collapse"
                                       data-parent="#about">
                                            اعرف المزيد
                                        <i style="border-radius: 50%;
                                         color: #fff;">
                                            <img  class="pull-left" src="{{asset('img/line.png')}}">
                                        </i></a>
                                </h3>
                            </div>

                            <div id="desc" class="panel-collapse collapse lead " style="font-size: 21px !important; padding: 10px 20px; word-wrap: break-word  ">
                                {!! $bio !!}
                            </div>
                        </div>
                        <!-- end panel 1-->
                    </div>

                </div>

                <div class="back">

                    <h2 class="title"><span>
                                <i class="fa fa-clipboard" style=" color: #176083; "></i>
                            مجالاتنا
                        </span></h2>


                    <div class="panel-group" id="subCategories">

                    <!-- start panel 1-->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="#desSubCategories"
                                   data-toggle="collapse"
                                   data-parent="#subCategories">
                                    عرض المجالات
                                    <i>     <img  class="pull-left" src="{{asset('img/line.png')}}">
                                    </i></a>
                            </h3>
                        </div>

                        <div id="desSubCategories"
                             class="panel-collapse collapse lead ">
                                <div class="review-bg" id="comment">

                                    <div class="row">
                                        @foreach($provider->SubCategories as $item )
                                            <div class="col-xs-6 col-md-3">
                                                <a style="display: block; margin-bottom: 10px"
                                                   href="{{route('service',$item->id)}}">
                                                    <button class="btn btn-primary btn-block">{{$item->name()}}</button></a>

                                            </div>
                                        @endforeach

                                        @if(isset($provider->ads_category))
                                            <div class="col-xs-6 col-md-3">
                                                <a style="display: block; margin-bottom: 10px"
                                                   href="{{route('adservice',$provider->ads_category)}}">
                                                    <button class="btn btn-primary btn-block">{{$provider->adsCategory->name()}}</button></a>

                                            </div>

                                        @endif
                                    </div>




                            </div>
                        </div>
                    </div>
                    <!-- end panel 1-->


                </div>


                </div>


                <div class="back">

                    <h2 class="title"><span>
                                <i class="fa fa-shopping-cart" style=" color: #176083; "></i>
 عرض أعمالنا                         </span>
                    </h2>

                    <div class="panel-group" id="panel_projects">

                        <!-- start panel 1-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#panel_projects_des"
                                       data-toggle="collapse"
                                       data-parent="#panel_projects">
                                        عرض أعمالنا
                                        <i >     <img  class="pull-left" src="{{asset('img/line.png')}}">
                                        </i>
                                    </a>
                                </h3>
                            </div>

                            <div id="panel_projects_des"

                                 class="panel-collapse collapse lead ">

                                <div class="" style=" " id="comment">

                                    <div class="row">


                                        @if($provider->projects)

                                            @foreach($provider->projects as $project)


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

                                            <span class="" style="color: #fff;padding: 8px 0;display: block; text-align: center; background: #bbb9b9">
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
                                                            @endif</h4>
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

                            </div>
                        </div>
                        <!-- end panel 1-->

                    </div>
                </div>
                <div class="back">
                    <h2 class="title"><span>
                                <i class="fa fa-refresh" style=" color: #176083; "></i>طلب جديد</span></h2>


                    <div class="panel-group" id="panel_projects">

                        <!-- start panel 1-->
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a id="send_order_a" href="#panel_send_order"
                                       data-toggle="collapse"
                                       data-parent="#send_order">
                                    إنشاء طلب
                                        <i >     <img  class="pull-left" src="{{asset('img/line.png')}}">
                                        </i>
                                    </a>
                                </h3>
                            </div>

                            <div id="panel_send_order"
                                 class="panel-collapse collapse lead ">

                                <div class="" id="comment">

                                    @guest
                                        <div class="review-bg text-center" id="comment" style="min-height: 100px !important;">
                                            <a style="position: relative ;" href="/login" class="text-center">
                                                <button  class="btn btn-primary " style="padding: 5px 20px ;font-size: 20px; border-radius: 15px !important;"> اطلب من هنا </button>
                                                <i
                                                        style="
                                                        position: absolute;
                                                        bottom: -28px;
                                                        left: 48%;
                                                        color: #7cd92d;
                                                        font-size: 30px;
                                                        "
                                                        class="fa fa-hand-o-up" aria-hidden="true"></i>
                                            </a>

                                        </div>
                                    @endguest
                                    @auth
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        {!!Form::open( ['route' => ['user.post-order',$provider->id] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}
                                        <div class="form-group">
                                            <div class="time-bg">
                                                <div class="row">

                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   placeholder="أكتب عنوان طلبك" required="required"  value="{{old('title')}}" name="title"/>
                                                        </div>
                                                    </div>


                                                    {{--
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            {!! Form::select("important",['قصوى'=>'قصوى','متوسطة'=>'متوسطة','عادية'=>'عادية'],null,['class'=>'form-group form-control  ','id'=>'' ,'placeholder'=>'اﻷهمية'])!!}
                                                        </div>
                                                    </div>

                                                    --}}

                                                    {{--
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <input type="text"
                                                                   placeholder="المدة المتوقعة للتنفيذ"
                                                                   class="form-control"
                                                                   value="{{old('expected_time')}}"
                                                                   name="expected_time"
                                                                   required="required" />
                                                        </div>
                                                    </div>
                                                    --}}


                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <label> ملحوظه : الميزانية التقديرية لك قابلة للتحديث من قبل مزود الخدمة</label>
                                                            <input type="number"
                                                                   min="0"
                                                                   placeholder="ميزانية  العميل التقديرية SR"
                                                                   class="form-control" value="{{old('expected_money')}}" name="expected_money" required="required" />
                                                        </div>
                                                    </div>


                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                        <textarea
                                                                placeholder="اكتب تفاصيل الطلب كاملة"
                                                                class="form-control"
                                                                name="details"
                                                                class="summernote"
                                                                id="contents"
                                                                title="details"
                                                                rows="10" style="width: 100%">{{old('details')}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <small>المرفقات   </small>
                                                        <div class="form-group" >
                                                            <input type="file"
                                                                   class="form-control"
                                                                   name="attachment">
                                                        </div>
                                                    </div>


                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <small>                                            حدد موقعك علي الخريطة</small>
                                                        <div class="form-group" >
                                                            <label class="check-box" style="


display: block;
height: 42px;
text-align: center;
width: 42px;
background: #337ab7;
">
                                                                <input onchange="check_map()"
                                                                       type="checkbox" name="check_" id="check_" value="yes">
                                                                <span class="checkmark"></span>
                                                            </label>

                                                        </div>

                                                    </div>


                                                    <script>
                                                        function check_map() {
                                                            if (document.getElementById("check_").checked) {
                                                                document.getElementById('mapselected').style.display="block";

                                                            } else {
                                                                document.getElementById('mapselected').style.display="none";
                                                            }
                                                        }

                                                    </script>


                                                    <div id="mapselected" style="display: none">

                                                        <div class="col-sm-12">
                                                            <small >حدد موقعك على الخريطة</small>
                                                            <div id="mapCanvas" style="height:450px;" class="col-md-12"></div>
                                                            <input type="hidden" value="24.774265" id="lat" name="lat" />
                                                            <input type="hidden" value="46.738586" id="lng" name="lng" />
                                                            @if($errors->has('lat'))
                                                                <div class="alert alert-danger">{{$errors->first('lat')}}</div>
                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="align">
                                                <button type="submit"  style="
padding: 20px;

line-height: 0;

font-size: 22px;

border-radius: 19px !important;
"
                                                        class="form-control btn btn-primary" >إرسال</button>
                                            </div>
                                        </div>
                                        </form>
                                    @endauth
                                </div>

                            </div>
                        </div>
                        <!-- end panel 1-->

                    </div>
                </div>


                <div class="clearfix"></div>
                <br>
                <div class="back" style="margin-top: 40px">
                    <h2 class="title"><span>
                    <i class="fa fa-comments" style=" color: #176083; "></i>
                            بيانات التواصل

                        </span></h2> <h5>ينصح بالتواصل عبر المنصة لمصلحة الطرفين</h5>

                    <div class="panel-group" id="panel_contact_us">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="#panel_contact_us_des"
                                       data-toggle="collapse"
                                       data-parent="#panel_contact_us">
                                        عرض بيانات التواصل
                                        <i>     <img  class="pull-left" src="{{asset('img/line.png')}}">
                                        </i>
                                    </a>
                                </h3>
                            </div>

                            <div id="panel_contact_us_des"
                                 class="panel-collapse collapse lead ">

                                    @guest

                                    <div class="review-bg text-center" id="comment" style="padding: 30px 0">

                                        <a style="outline: none;
                                        position: relative ;" href="/login" class="text-center">
                                            <button  class="btn btn-primary " style="padding: 5px 20px ;font-size: 20px; border-radius: 15px !important;"> يتطلب تسجيل الدخول </button>
                                            <i
                                                    style="
                                                        position: absolute;
                                                        bottom: -28px;
                                                        left: 48%;
                                                        color: #7cd92d;
                                                        font-size: 30px;
                                                        "
                                                    class="fa fa-hand-o-up" aria-hidden="true"></i>
                                        </a>

                                    </div>

                                    @endguest
                                    @auth
                                        @if(auth()->user()->is_special == 1)
                                            <div class="review-bg" id="comment">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <small>البريد الإلكترونى  :</small><br>
                                                                {{$provider->email}}
                                                            </td>
                                                            <td>
                                                                <small>الهاتف المحمول  :</small><br>
                                                                {{$provider->phone}}
                                                            </td>



                                                        </tr>
                                                        <tr>
                                                            @if($provider->emp_no)
                                                                <td colspan="">
                                                                    <small>
                                                                        عدد الموظفين  :
                                                                    </small><br />
                                                                    {{$provider->emp_no}}
                                                                </td>
                                                            @endif
                                                            @if($provider->creation_year)
                                                                <td colspan="">
                                                                    <small>
                                                                        سنة الإنشاء    :
                                                                    </small><br />
                                                                    {{$provider->creation_year}}
                                                                </td>
                                                            @endif
                                                            @if($provider->commerical_no)
                                                                <td colspan="">
                                                                    <small>
                                                                        السجل التجارى    :
                                                                    </small><br />
                                                                    {{$provider->commerical_no}}
                                                                </td>
                                                            @endif


                                                        </tr>

                                                        </tbody></table>
                                                </div>

                                            </div>
                                        @else

                                                <div class="review-bg text-center" id="comment" style="padding: 30px 0">
                                                    <p class="lead">لايمكنك مشاهدة بيانات العضو لأنك لا  تملك عضوية  التميز وفي حين رغبتك ترقية العضوية يرجى زيارة صفحة الدفع وترقية العضوية</p>
                                                    <a style="position: relative ;" href="{{route('user.pay_star')}}" class="text-center">
                                                        <button  class="btn btn-primary " style=" font-size: 31px; border-radius: 15px !important;"> ادفع من هنا </button>
                                                        <i style="position: absolute; bottom: -47px;left: 46%;color:#7cd92d;font-size: 30px;" class="fa fa-hand-o-up" aria-hidden="true"></i>
                                                    </a>
                                                </div>

                                        @endif
                                    @endauth



                            </div>
                        </div>

                    </div>

                </div>
                <div class="back">
                    <h2 class="title"><span>
                                <i class="fa fa-heart" style=" color: #176083; "></i>
                            تقييم أعضاء باكيج
                        </span></h2>
                    <div class="review-bg" id="comment">
                        <div class="media">

                            <div class="media-body">
                                @foreach($provider->comment() as $comment)
                                    <?php
                                    $user = \App\Models\User::find($comment->user_id);
                                    ?>
                                    <div class="alert alert-info" role="alert">
                                        <p class="alert-link">اسم المستفيد:  {{ $user->name }}</p>
                                        <p href="#" class="alert-link"> التعليق: {{$comment['comment']}}     </p>
                                        <p href="#" class="alert-link">تقيم : {{$comment['rate']}} نجوم     </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                {{--        <div class="background">--}}
                {{--            <h2 class="title"><span>قائمة الأعمال</span></h2>--}}
                {{--            <div class="row">--}}
                {{--                <div class="col-xs-12 col-sm-4 col-md-4">--}}

                {{--                    <h4>عفوا لاتوجد نتائج</h4>--}}

                {{--                </div>--}}

                {{--            </div>--}}
                {{--        </div>--}}




            </div>

        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&callback=initMap&language=ar&region=EG"></script>

    <script type="text/javascript">
        var marker;
        var lat;
        var lng;
        var map;
        function updateMarkerPosition(latLng) {
            document.getElementById('lat').value = latLng.lat();
            document.getElementById('lng').value = latLng.lng();
        }

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }

        function initialize() {
            var lat = document.getElementById('lat').value;
            var lng = document.getElementById('lng').value;
            if (!lat && !lng) {
                var latLng = new google.maps.LatLng(24.598411724742483, 46.7138671875);
            } else {
                var latLng = new google.maps.LatLng(lat, lng);
            }

            map = new google.maps.Map(document.getElementById('mapCanvas'), {
                zoom: 3,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            marker.set(map);
            updateMarkerPosition(latLng);
            google.maps.event.addListener(map, 'click', function (event) {
                placeMarker(event.latLng);
                updateMarkerPosition(event.latLng);
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);


        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = " المزيد";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = " اغلاق";
                moreText.style.display = "inline";
            }
        }



    </script>
@endsection
