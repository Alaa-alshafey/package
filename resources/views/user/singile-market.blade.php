@extends('layouts.user')

@section('content')


@push('style')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&libraries=places&language=en-AU"></script>
<style>
    body{ background: #fafafa;}
    .widget-area.blank {
        background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        -ms-box-shadow: none;
        -o-box-shadow: none;
        box-shadow: none;
    }
    body .no-padding {
        padding: 0;
    }
    .widget-area {
        background-color: #fff;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -ms-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        -o-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
        float: left;
        margin-top: 30px;
        padding: 25px 30px;
        position: relative;
        width: 100%;
    }
    .status-upload {
        background: none repeat scroll 0 0 #f5f5f5;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        float: left;
        width: 100%;
    }
    .status-upload form {
        float: left;
        width: 100%;
    }
    .status-upload form textarea {
        background: none repeat scroll 0 0 #fff;
        border: medium none;
        -webkit-border-radius: 4px 4px 0 0;
        -moz-border-radius: 4px 4px 0 0;
        -ms-border-radius: 4px 4px 0 0;
        -o-border-radius: 4px 4px 0 0;
        border-radius: 4px 4px 0 0;
        color: #777777;
        float: left;

        font-size: 14px;
        height: 142px;
        letter-spacing: 0.3px;
        padding: 20px;
        width: 100%;
        resize:vertical;
        outline:none;
        border: 1px solid #F2F2F2;
    }

    .status-upload ul {
        float: left;
        list-style: none outside none;
        margin: 0;
        padding: 0 0 0 15px;
        width: auto;
    }
    .status-upload ul > li {
        float: left;
    }
    .status-upload ul > li > a {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        color: #777777;
        float: left;
        font-size: 14px;
        height: 30px;
        line-height: 30px;
        margin: 10px 0 10px 10px;
        text-align: center;
        -webkit-transition: all 0.4s ease 0s;
        -moz-transition: all 0.4s ease 0s;
        -ms-transition: all 0.4s ease 0s;
        -o-transition: all 0.4s ease 0s;
        transition: all 0.4s ease 0s;
        width: 30px;
        cursor: pointer;
    }
    .status-upload ul > li > a:hover {
        background: none repeat scroll 0 0 #606060;
        color: #fff;
    }
    .status-upload form button {
        border: medium none;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        border-radius: 4px;
        color: #fff;
        float: right;
         font-size: 14px;
        letter-spacing: 0.3px;
        margin-right: 9px;
        margin-top: 9px;
        padding: 6px 15px;
    }
    .dropdown > a > span.green:before {
        border-left-color: #2dcb73;
    }
    .status-upload form button > i {
        margin-right: 7px;
    }

</style>
@endpush

<div class="container mar-top">
    <div class="row" style="margin-top:30px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{asset('/')}}">الرئيسية</a></li>
                @if($ad->type=='order')
                <li class="breadcrumb-item " aria-current="page"> <a href="{{route('user.market-request')}}"> طلبات سوق باكيج</a> </li>
                @else
                    <li class="breadcrumb-item " aria-current="page"> <a href="{{route('user.market-offer')}}"> عروض سوق باكيج</a> </li>

                @endif
                    <li class="breadcrumb-item active" aria-current="page"> {{$ad->title}}</li>
            </ol>
        </nav>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12">
            <img src="{{getimg($ad->image)}}" alt="" height="540px">
            <h2>{{$ad->title}}  </h2>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <br>
            <b>التفاصيل:</b>
            <p>
                {{($ad->description)}}
            </p>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody><tr>
                        <td>
                            <small>الاسم:</small><br>
                            <b>{{$ad->user->name}}  </b>
                        </td>
                        <td colspan="2">
                            <small>البريد الإلكتروني:</small><br>
                            <b> {{$ad->user->email}}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>الجوال.:</small><br>
                            <b>{{$ad->user->phone}}</b>
                        </td>

                        <td>
                            <small>تاريخ التقديم:</small><br>
                            <b>{{$ad->user->created_at->diffForHumans()}}</b>
                        </td>
                    </tr>


                    <tr>
                        @if($ad->attachment)
                            <td>
                                <small>المرفقات.:</small><br>
                                <b><a href="{{getimg($ad->attachment)}}"> تحميل المرفقات</a></b>
                            </td>

                        @endif


                        <td>
                            <small>مده التنفيذ  :</small><br>
                            <b>{{$ad->time_count}} ساعة </b>
                        </td>
                    </tr>


                    </tbody></table>
            </div>


            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="widget-area no-padding blank" style="margin: 20px">
                            <div class="status-upload">

                                    {!!Form::open( ['route' => ['user.addComment',$ad->id] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}

                                    <textarea name="comment" placeholder="اكتب تعليقك هنا ........." ></textarea>

                                    <button type="submit" class="pull-left   btn btn-success" style="border-radius: 15px !important;"><i class="fa fa-share"></i> اضف تعليقك </button>
                                {!!Form::close() !!}
                            </div><!-- Status Upload  -->
                        </div><!-- Widget Area -->
                    </div>

                </div>
                <h1 style="margin: 10px">التعليقات </h1>
                    <div class="card">
                        @foreach($ad->comments as $comment)
                              <div class="card-body">
                    <div class="row">

                        <div class="col-md-2">
                            <img style=" width: 100px; height: 100px; " src="{{getimg($comment->user->image)}}" class="img img-rounded img-fluid"/>
                            <p class="text-secondary text-center" style="margin: 10px; text-align: right">{{ ($comment->user->name)}}</p>
                        </div>
                        <div class="col-md-10">

                            <div class="clearfix"></div>
                            <p>  {{$comment->comment}}</p>

                        </div>
                    </div>

                </div>
                         @endforeach
            </div>
            </div>

        </div>
    </div>
</div>

@endsection
