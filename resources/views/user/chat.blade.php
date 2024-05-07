@extends('layouts.user')

@section('content')

    @push('style')

        <style>

            .header{
                overflow: hidden;
            }

            .header strong{
                float: left;
            }
            .chat
            {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .chat li
            {
                margin-bottom: 10px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #B3A9A9;
            }

            .chat li.left .chat-body
            {
                margin-left: 60px;
            }

            .chat li.right .chat-body
            {
                margin-right: 60px;
            }


            .chat li .chat-body p
            {
                margin: 15px 0;
                color: #777777;
            }

            .panel .slidedown .glyphicon, .chat .glyphicon
            {
                margin-right: 5px;
            }

            .panel-body
            {
                overflow-y: scroll;
                height: 400px;
            }

            ::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar
            {
                width: 12px;
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar-thumb
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #555;
            }

            .loader {
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }

            /* Safari */
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
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
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @keyframes fadein {
                from {
                    top: 0;
                    opacity: 0;
                }
                to {
                    top: 30px;
                    opacity: 1;
                }
            }

            @-webkit-keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }

            @keyframes fadeout {
                from {
                    top: 30px;
                    opacity: 1;
                }
                to {
                    top: 0;
                    opacity: 0;
                }
            }
        </style>


    @endpush



    <div class="container">

        <div class="row profile-bg profile-bar mar-bot">
            <div class="col-xs-12">

                <h1  class="title" style="width:250px; border: none; margin-top: 0px">
                    <span style="padding-bottom: 5px;"> <i class="fa fa-envelope"></i>  دردشة الطلبات </span></h1>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-primary" style="margin-top: 17px; border-color: #bcc732">
                    <div class="panel-heading">
                     دردشة الطلبات

                    </div>

                    <div class="panel-body" id="chat_body">
                        <ul class="chat" >

                            @if($inbox)
                                @foreach($inbox as $in)
                                    @if($in->sender_id == auth()->user()->id)
                                        <li class="right clearfix">
                                            <span class="chat-img pull-right">
                                                <img
                                                        @if(getimg(auth()->user()->image))
                                                            src="{{getimg(auth()->user()->image)}}"
                                                        style="width: 50px;height: 40px;"
                                                        @else
                                                            src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle"
                                                        @endif
                                                />

                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <small class=" text-muted pull-left" style="color: #fff"><span class=""></span>{{$in->created_at->toDateString()}}</small>
                                                    <strong class="pull-right primary-font">{{auth()->user()->name}}</strong>
                                                </div>
                                                <p>
                                                    {{$in->message}}
                                                </p>
                                            </div>
                                        </li>
                                    @else
                                        <li class="left clearfix">
                                            <span class="chat-img pull-left">
                                            <img
                                                    @if(getimg($receiver->image))
                                                    src="{{getimg($receiver->image)}}" style="width: 50px;height: 40px;"
                                                    @else
                                                    src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle"
                                                    @endif
                                            />
                                            </span>
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font">{{$receiver->name}}</strong>
                                                    <small style="color: #fff" class="pull-right text-muted">
                                                        <span ></span>{{$in->created_at->toDateString()}}</small>
                                                </div>
                                                <p>{{$in->message}}</p>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                            @endif





                        </ul>
                    </div>

                    <div class="panel-footer">
                        <div class="input-group">

                        </div>

                        <form class="inline-form" method="post" enctype="multipart/form-data"
                              action="{{route('send_message')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
                                    <input type="hidden" name="user_id" value="{{$receiver_id}}">
                                    <input type="hidden" name="order_id" value="{{Route::input('id')}}">
                                    <input name="message" id="btn-input" style="padding: 16px 5px" type="text" class="form-control input-sm" placeholder="أكتب رسالتك ... " />
                                </div>
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-warning btn-5x"
                                           style="border-radius: 5px !important; width: 45%; display: inline-block"
                                           value="ارسال" id="btn-chat" >
                                    <a
                                            style="border-radius: 5px !important; width: 45%; display: inline-block"
                                            class="btn btn-danger" href="/user/my-account">خروج</a>
                                </div>
                            </div>
                        </form>
                    </div>




                </div>



            </div>
            @include('layouts.side')

        </div>
    </div>

    <!-- Bank Details -->
     <!-- End Bank Details -->

    @push('script')

        <script>
            $("#clickpay").click(function(){
                $("#spinner").show();
                $('#clickpay').hide();
            });

            setInterval(function() {
                window.location.reload();
            }, 60000);

            $('#chat_body').stop ().animate ({
                scrollTop: $('#chat_body')[0].scrollHeight
            },1000);
        </script>
    @endpush
    <div id="snackbar">Feedback submitted successfully.</div>
@endsection
