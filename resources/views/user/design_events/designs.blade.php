@extends('layouts.app')

@section('content')

    @push('style')

        <link href="https://sheari.com.sa/common/User/ar/bootstrap-3.3.4-dist/post.css" rel="stylesheet" />
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
        <div class="row">
            <div class="col-xs-12 col-md-12 mar-bot">
                <div class="profile-bar">

                    <h1 class="post-head"><span>أختر بطاقتك</span></h1>

                    @if(count($images) > 0)

                        @foreach($images as $image)
                            <div class="col-xs-12 col-md-6 event_item" style="overflow: hidden">
                                <a href="{{route('user.single_event',['id'=>$image->id])}}"
                                   class="single_item hidden-sm hidden-xs">
                                    <img class=""
                                         src="{{getimg($image->image)}}">
                                  <p style="">{{$image->title}}</p>
                                </a>
                                <a style="" href="{{getimg($image->image)}}"  target="_blank"
                                   class="single_item  hidden-md hidden-lg"
                                   type="button">
                                    <img class=""
                                         src="{{getimg($image->image)}}">
                                    <p style="">تحميل الصورة</p>

                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-xs-12">
                            <p class="text-center">سنكون هنا قريبا</p>
                            <a class="btn btn-success btn-bordered btn-block" href="{{route('user.design_events')}}">الرجوع للتصفح</a>
                        </div>
                    @endif
                </div>
            </div>
            @include('user.side')
        </div>
    </div>


    @push('script')
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
        <script>
            $(document).ready(function() {
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
            });
        </script>
    @endpush
@endsection
