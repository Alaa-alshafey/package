@extends('layouts.app')

@section('content')

    @push('style')

        <link href="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/post.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>





            #draggable-element {
                width: 100px;
                height: 10px;
                background-color: #fff;
                color: black;
                padding: 10px 12px;
                cursor: move;
                position: absolute;
                /* important (all position that's not `static`) */
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
            ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
                color: #555;
                opacity: 1; /* Firefox */
                font-size: 24px;
            }
            #fff a{
                background: #006bb3;
                color: #fff;
                padding: 5px;
                display: block;
                text-align: center;
                width: 200px;
                margin: auto;
            }
        </style>


    @endpush
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mar-bot">
                <div class="profile-bar hidden-sm hidden-xs">


                    <h1 class="post-head"><span>أدرج النص وقم بتحميل بطاقتك</span></h1>
                    <div  id="printEvent" style="">

                        <div id="draggable" style="">
                            <textarea  class="selector"
                                       style=""
                                       autofocus  type="text"
                                       placeholder="أدراج النص هنا . متاح كتابة سطرين"></textarea>
                        </div>

                        <img class="event_image" src="{{getimg($single->image)}}">
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12  text-center">

                        <button id="foo" style="width: 200px" href="#" class="btn btn-success btn-lg" type="button"

                                onclick="JPEG()">حفظ وتحميل</button>


                        <button style="width: 200px" href="#"  onclick="goBack()" class="btn btn-danger btn-lg" type="button">رجوع</button>

                    </div>
                </div>
            </div>
            <div class="profile-bg mar-bot hidden-lg hidden-md">

                <h1 class="post-head">
                    <span style="line-height: 40px; border-bottom: 1px solid #98c64c !important;
padding-bottom: 5px;
color: #0164ca; font-size: 18px">يمكنك تحميل البطاقة وتحريرها على جهازك</span>
                </h1>
                <br>
                <p class="lead" style="
	text-align: center;
	font-size: 20px;
	width: 85%;
	margin: 24px auto;">اضغط مطولا علي حفظ وتحرير ومن ثم فتحة في علامة تبويب متصفح جديدة</p>
                <div class="col-xs-12">
                    <a style="width: 200px; display: block; margin: auto" href="{{getimg($single->image)}}"  target="_blank"
                        class="btn btn-success btn-lg"
                       type="button">حفظ وتحرير </a>
                    <br>
                </div>
            </div>
            {{--@include('user.side')--}}
        </div>
    </div>


    @push('script')

    {{--
    <script src="https://sheari.net/common/User/ar/bootstrap-3.3.4-dist/post.js">
    --}}

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>


    <script src="{{asset('js/dist/image.js')}}"></script>

    <script>
        function JPEG() {

            domtoimage.toJpeg(document.getElementById('printEvent'), { quality: 1 })
                .then(function (dataUrl) {

                    var link = document.createElement('a');

                    link.download = 'my-design.jpeg';

                    link.href = dataUrl;

                    link.click();

                    var base_url = "{{asset('/')}}";

                    window.location = base_url + "user/design/events/success";

                });


        }


    </script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    {{--
    <!-- Load widget code -->
    <script type="text/javascript" src="http://feather.aviary.com/imaging/v2/editor.js"></script>

    <!-- Instantiate the widget -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    --}}

    <script
            src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"
            integrity="sha256-0vBSIAi/8FxkNOSKyPEfdGQzFDak1dlqFKBYqBp1yC4="
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            init();

            $('#Category').change(function () {

                var val = $(this).val();
                var base_url = "{{asset('/')}}";
                if (val == "") {
                    val = 0;
                }
                url =  base_url + "events/sub_categories/" + val;

                console.log(url);
                $.ajax({
                    type: "GET",
                    url: base_url + "events/sub_categories/" + val,

                    success: function (data) {
                        $('#subCat').html(data);
                    }
                });


            });

            // $( "#draggable" ).draggable();

            $( ".selector" ).draggable({
                cancel: ".title"
            });


            // Getter


            var cancel = $( ".selector" ).draggable( "option", "cancel" );

// Setter
            $( ".selector" ).draggable( "option", "cancel", ".title" );

            $( ".selector" ).droppable({
                drop: function( event, ui ) {
                    $( this )
                        .addClass( "isDropped" )
                        .html( "Dropped!" );
                }
            });


            function touchHandler(event) {
                var touch = event.changedTouches[0];

                var simulatedEvent = document.createEvent("MouseEvent");
                simulatedEvent.initMouseEvent({
                        touchstart: "mousedown",
                        touchmove: "mousemove",
                        touchend: "mouseup"
                    }[event.type], true, true, window, 1,
                    touch.screenX, touch.screenY,
                    touch.clientX, touch.clientY, false,
                    false, false, false, 0, null);

                touch.target.dispatchEvent(simulatedEvent);
                event.preventDefault();
            }

            function init() {
                document.addEventListener("touchstart", touchHandler, true);
                document.addEventListener("touchmove", touchHandler, true);
                document.addEventListener("touchend", touchHandler, true);
                document.addEventListener("touchcancel", touchHandler, true);
            }

        });

        function goBack() {
            window.history.back();
        }
    </script>
    @endpush

@endsection
