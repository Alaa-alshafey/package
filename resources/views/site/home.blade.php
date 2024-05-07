@extends('layouts.app')

@push('style')
    <style>

        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------------- */

        .carousel {
            margin-bottom: 60px;
        }

        .select2-container--default .select2-selection--single{
            border: none;
        }
        .selectdiv{
            overflow: hidden;
            padding: 3px;border-radius: 24px;
            background: #fff !important;
            margin-bottom: 14px;
        }

        .select2-results__group{ background-color:#006bb3; color: #fff}

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
            color: #fff;
            background-color: #808080;
        }
        .carousel-control {
            top: 76%;
        }

        .carousel-caption {
            z-index: 10;
        }

        .carousel .item {
            height: 500px;
            background-color:#bbb;
            overflow:hidden;
        }
        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            height: 500px;
        }





        #searchForm {
            position:absolute;
            top:40%;
        }

        /* RESPONSIVE CSS
        -------------------------------------------------- */
        @media (max-width: 768px) {

            .carousel-inner>.item>img, .carousel-inner>.item>a>img {
                max-width:inherit;
            }

            .carousel-caption p {
                margin-bottom: 20px;
                font-size: 21px;
                line-height: 1.4;
            }
            #owl-demo .item img{
                max-height: 250px !important;
                object-fit: cover !important;
            }
        }

        ::placeholder { /* Firefox, Chrome, Opera */
            color: white;
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: white;
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
            color: white;
        }

        .owl-prev i, .owl-next i{

            transform: none !important;

            font-size: 40px; !important;

            color: #fff; !important;

            font-weight: bold; !important;
        }
        .owl-prev,.owl-next{
            background: rgba(0, 0, 0, 0.25) !important;
            height: 150px !important;
            width: 40px !important;
            border-radius: 10px !important;
            font-size: 20px !important;
        }
        .owl-prev {
            width: 100px !important;
            height: 100% !important;
            position: absolute;
            top: -6px;
            left: -4px;
            display: block !important;
            border: none !important;
            border-radius: 0 !important;

        }
        .owl-next {
            width: 100px !important;
            height: 100% !important;
            position: absolute;
            top: -6px;
            right: -4px;
            display: block !important;
            border: none !important;
            border-radius: 0 !important;
        }
        


    </style>
    @endpush
@section('content')

        <div id="owl-demo" class="owl-carousel owl-theme" dir="ltr">

            @foreach(\App\Models\Slider::all() as $key=>$slider)
                <div class="item">
                    <img class="img-responsive" src="{{getimg($slider->image)}}">
                </div>
            @endforeach
        </div>

        <br>

    <div class="clearfix"></div>

    <div class="department">

        <div class="search-bg">
            <div class="container">
                <form method="get" action="{{route('searchProvider')}}"   >
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-3">

                            <div class="form-group selectdiv">
                                {!! Form::select("country_id",countries(),null,
                                ['class'=>'form-control select2','id'=>'Country','placeholder'=>'اختر الدولة'])!!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3" id="">
                            <div class="form-group selectdiv"  id="DIVCity">

                                {!! Form::select("city_id",cities(),null,['class'=>'form-control select2','id'=>'city_id','placeholder'=>'اختر المدينة ' ])!!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group selectdiv" style="">

                                <select name="category_id" class="form-group form-control select2" style="border: none">

                                    <option value="">اختر القسم</option>

                                    @if(categories())
                                        @foreach(categories() as $category)
                                            @if($category->subCategories)
                                                <optgroup class="category"  label="{{$category->ar_name}}">
                                                    @foreach($category->subCategories as $subCategory)
                                                        <option value="{{$subCategory->id}}">{{$subCategory->ar_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <button type="submit"> البحث <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            <br>
            <br>
            <h1><span>اﻷقسام الرئيسية</span></h1>
            <div class="row">

                <?php
                $i = 0;
                ?>
                @foreach($categories as $category)
                    <?php ++$i?>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <a style="text-align: center;
display: block;
position: relative;
overflow: hidden;margin: 8px 1px;
min-height: 230px;
"  href="{{route('subCategory',$category->id)}}">
                            <img src="{{getimg($category->image)}}" alt="" width="300px" height="154px"/>
                            <h4>   {{$category->name()}} </h4>
                            {{--<div class="box-cat">{{$i}}</div>--}}
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


@endsection

@push('script')
    <script>
        $('#Country').change(function () {

            var val = $(this).val();
            var base_url = "{{asset('/')}}";
            if (val == "") {
                val = 0;
            }
            $.ajax({
                type: "GET",
                url: base_url + "regions2/" + val,
                success: function (data) {

                    $('#DIVCity').html(data);
                }
            });
        });

        $(document).ready(function(){
            $("#owl-demo").owlCarousel({
                slideSpeed : 4000,
                paginationSpeed : 4000,
                items : 1,
                autoplay:true,
                autoplayTimeout:4000,
                loop:true,
                itemsTablet: false,
                itemsMobile : false,
                nav:true,
                dots: false,
                navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],

            });
        });
    </script>
@endpush
