@extends('layouts.user')

@section('content')

    @push('style')

        <style>
            .form input{
                box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                border-radius: 16px !important;
            }
            .form textarea{
                box-shadow: inset 1px 1px 4px 0px rgba(0,0,0,.25);
                border-radius: 16px !important;
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
        <div class="row profile-bg">
            <div class="col-xs-12 col-sm-8 col-md-9">
                {!!Form::open( ['route' => ['user.saveNewProject'] ,'class'=>'form ', 'method' => 'Post','files' => true]) !!}
                {{csrf_field()}}
                <div class="profile-bar edit-input mar-bot">

                    <div class="regi-head">
                        <h2><span> <a class="btn btn-primary" href="{{ route('user.addProject')}}"><i style="color: #fff" class="fa fa-briefcase"></i> اضافة عمل جديد </a> </span></h2>

                        <div class="row">
                            @if($projects)


                                @foreach($projects as $project)

                                    <div class="col-xs-6 col-sm-6 col-md-4">
                                        <a style="text-align: center;
display: block;
position: relative;
overflow: hidden;margin: 8px 1px;
min-height: 230px;
"  href="#"
                                           data-toggle="modal"
                                           data-target="#myModal{{$project->id}}"
                                        >

                                            @if(isset($project->price))
                                                <span id="price">
                                                                <span class="text">السعر التقديري</span>
                                                    {{ $project->price }} RS
                                                            </span>         @endif

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
">   {{str_limit($project->title,15)}} </h4>
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

                                                    <a
                                                            href="{{route('user.editProject',['id'=>$project->id])}}"
                                                            class="btn btn-primary"
                                                            style="border-radius: 14px !important;">
                                                        <p>تعديل المشروع</p>
                                                    </a>

                                                    <a href="{{route('user.removeProject',['id'=>$project->id])}}"
                                                       class="btn btn-primary"
                                                       style="border-radius: 14px !important;">
                                                        <p>مسح المشروع</p>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            @endif

                        </div>
                    </div>
                    <br />
                </div>
            </div>
            @include('layouts.side')
        </div>
    </div>


@endsection
