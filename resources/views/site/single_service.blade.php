@extends('layouts.app')

@section('content')

    @push('style')

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


            .select2-container--default .select2-selection--single{
                border: none;
            }
            .selectdiv{
                overflow: hidden;
                padding: 3px;border-radius: 24px;
                background: #fff !important;
            }

            .select2-results__group{ background-color:#006bb3; color: #fff}

            .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
                color: #fff;
                background-color: #808080;
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
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="profile-bg mar-bot">
                        <br />
                        <form method="get" action="{{route('searchProvider')}}" >
                            <div class="profile-bar1">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                        <div class="form-group">
                                            {!! Form::select("country_id",countries(),request()->country_id,['class'=>'form-control select2','id'=>'Country','placeholder'=>'اختر الدولة'])!!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-3" id="DIVCity">
                                        <div class="form-group">
                                            {!! Form::select("city_id",cities(),request()->city_id,['class'=>'form-group form-control select2 ','id'=>'area','placeholder'=>'اختر المدينة ' ])!!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <select name="category_id" class="form-control  select2" style="border: none">

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
                                    <div class="col-xs-12 col-sm-8 col-md-3" >
                                        <button type="submit" class="btn btn-primary" style="border-radius: 10px !important; width:100%; " ><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="green-bg">
        <div class="container">
            <div class="row">
                @forelse($providers as $provider)
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="professional" style="position: relative">
                            <a href="{{route('profile',[$provider->id])}}">
                                <div class="prog" style="" >
                                    @if($provider->is_special)
                                        <div class="pro" data-toggle="tooltip" data-placement="top" title="مقدم خدمة متميز‎">
                                            <i class="fa fa-star"></i>
                                        </div>
                                    @endif
                                    <img src="{{getimg($provider->image)}}" alt="" />
                                    <div  @if($provider->is_special) style="background-color: #009de1" @endif  class="name-text text-center">
                                        <a  href="{{route('profile',[$provider->id])}}">
                                            {{$provider->name}}
                                        </a>
                                    </div>

                                </div>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                        <div class="professional-head">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-map-marker"></i> {{$provider->City->name()}}
                                    <p></p>
                                </div>
                                <div class="col-xs-6">


                                    @for($i=0; $i < $provider->rate(); $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                    @for($i=5; $i > $provider->rate(); $i--)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @endfor
                                    <p></p>

                                </div>
                                @if($provider->account_maroof  == 'yes')
                                    <div class="col-xs-6">
                                        <img src="{{asset('img/maarof.png')}}" class="fa fa-heart" style="width: 14px!important; height: 14px !important;">  معروف
                                        <p></p>
                                    </div>
                                @endif

                                @if($provider->account_freelancer == 'yes')
                                    <div class="col-xs-6">
                                        <img src="{{asset('img/freelancer_icon2.png')}}"
                                             class="fa fa-heart" style="width: 14px!important; height: 14px !important;"> العمل الحر
                                        <p></p>
                                    </div>
                                @endif

                                @if($provider->charitable)
                                <div class="col-xs-6">
                                        <i class="fa fa-heart"></i> خصم خيري
                                        <p></p>
                                </div>
                                @endif
                                <div class="col-xs-6">

                                    <b>عقود </b>  :  {{$provider->orders()->count()}}
                                    <p></p>
                                </div>
                                <div class="col-xs-12">
                                    <i class="fa fa-eye"></i> عدد الزيارات :
                                    <i class="badge"

                                    >{{count($provider->providerCount)}}</i>
                                    <p></p>
                                </div>
                                @if($provider->commerical_no)
                                <div class="col-xs-12">
                                    <i class="fa fa-save"></i> السجل التجاري :
                                    <i class="badge"

                                    >{{$provider->commerical_no}}</i>
                                    <p></p>
                                </div>
                                @endif
                                @if($provider->delivery)
                                    <div class="col-xs-12">
                                         <i class="fa fa-car"></i> توصيل
                                        <p></p>
                                    </div>
                                @endif


                                <div class="col-xs-12">
                                    <i class="fa fa-circle {{$provider->online?'green':'red'}}"></i>
                                    {{$provider->online?"متصل حاليا":'غير متصل'}}
                                    <p></p>
                                </div>
                                <div class="profile_data" style="">
                                    <div class="col-xs-12 text-center">
                                        <a style="background: #337ab7; color: #fff; padding: 5px; display: inline-block; width: 100%; margin-bottom: 10px"  href="{{route('profile',[$provider->id])}}">التفاصيل</a>
                                    </div>
                                    <div class="col-xs-12 text-center">
                                        <a style="background: #337ab7; color: #fff; width: 100%; display: inline-block; padding: 5px" href="{{route('user.post-requirement',[$provider->id])}}">طلب خدمة</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty

                    <div class="container">
                        <div class="row">
                            <br>
                            <div class="col-xs-12 col-sm-10 col-md-8 col-md-offset-2 col-sm-offset-2 ">
                                <div class="professional" style="font-size: x-large;font-weight: bold;
border: 2px solid #ccc;
padding: 5px;
border-radius: 8px;
color:#006bb3;

">
قريبا سنكون هنا                                </div>
                            </div>
                        </div>
                    </div>

                @endforelse

                <div class="clearfix"></div>
                @if(count($providers) > 0)
                    {{$providers->appends(request()->query())->links() }}
                @endif

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
    </script>
@endpush