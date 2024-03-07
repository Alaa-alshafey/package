<?php
$recever=Route::input('id');
?>

        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الرسائل</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('public/site/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>

        //  setInterval(soundCheck,1000);
        //  var first_run=0;
        // function soundCheck() {

        //    var oldMessage=$('#sound_check').val();
        //     $.ajax({
        //         type:'get',
        //         url:'{{URL::to('/sound')}}',
        //         datatype:'html',
        //         success:function(response){
        //             $('#sound_check').val(response);


        //             if (response != oldMessage) {
        //                 response=oldMessage;
        //                             if(first_run===0) {
        //                                 first_run = 1; //if the user just loaded the page, we want to acknowledge that so the chime will play next time if there is a new chat
        //                             } else {
        //                              var audio = document.getElementById("audio");
        //                              audio.play();
        //                             }

        //                }



        //            }
        //         });
        // }

    </script>
    <script>
        setInterval(seenMessage,1000);
        setInterval(allMessageView,1000);
        function seenMessage() {

            $.ajax({
                type:'get',
                url:'{{URL::to('/seen')}}',
                datatype:'html',
                success:function(response){

                    if(response > 0){
                        $('#smsnum').show();
                        $('#smsnum').html(response);
                    }else{
                        $('#smsnum').hide();
                    }

                }
            });
        }
        function allMessageView() {

            $.ajax({
                type:'get',
                url:'{{URL::to('/allmessageview')}}',
                datatype:'html',
                success:function(response){
                    $('#all-chat-message').html(response);
                }
            });
        }
        function seenUpdate() {
            $.ajax({
                type:'get',
                url:'{{URL::to('/seenUpdate')}}',
                datatype:'html'
            });
        }
        function singleSeenUpdate(id) {
            var sender=id;
            $.ajax({
                type:'get',
                url:'{{URL::to('/singleSeenUpdate')}}/'+sender,
                datatype:'html'
            });
        }
    </script>

</head>

<body>
<input type="hidden"id="sound_check">
<audio id="audio" src="https://notificationsounds.com/soundfiles/a86c450b76fb8c371afead6410d55534/file-sounds-1108-slow-spring-board.mp3" ></audio>

<div id="app">
    @yield('content')
</div>




</body>
</html>