@extends('layouts.app')

@section('content')

    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


        <style>
            .form select{
                -webkit-border-radius: 16px !important;
                -moz-border-radius: 16px !important;
                border-radius: 16px !important;
                box-shadow: inset 2px 0px 10px 0px rgba(0,0,0,.25);
                padding: 5px 0 !important;

            }

        </style>


    @endpush

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mar-bot">
                <div class="profile-bar">

                    <h1 class="post-head"><span>اختر القسم</span></h1>

                    <form class="form" action="{{route('user.design_events_sub_categories')}}" method="post">
                        @csrf
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <h6>اختر قسم المناسبة الرئيسي</h6>
                                <select  id="Category" class="form-control select2" name="cat_id">
                                    <option selected value="">اختر القسم</option>
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-6" id="subCat">
                            <div class="form-group">
                                <h6>اختر قسم المناسبة الفرعي</h6>
                                <select class="form-control select2" name="sub_id" disabled="disabled">
                                    <option selected value="">اختر القسم</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-success" value="عرض البطاقات">
                        </div>
                    </form>
                </div>
            </div>
            @include('user.side')
        </div>
    </div>
    @push('script')
        {{--<script src="https://sheari.net/common/User/ar/bootstrap-3.3.4-dist/post.js">--}}
            <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script>
            $(function() {

                $(document).ready(function() {
                    $('.select2').select2({
                        dir: "rtl",
                    });
                });
            })
        </script>
    @endpush
@endsection
