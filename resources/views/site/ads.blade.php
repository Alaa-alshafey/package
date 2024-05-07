@extends('layouts.app')

@section('content')


@push('style')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&libraries=places&language=en-AU"></script>

@endpush

<div class="container mar-top">
    <div class="row">
        <form method="get" action="{{route('searchAds')}}" class="col-xs-12">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="search-b row">
                    <div class="col-xs-4 col-sm-4">
                        <div class="input-group ">
                            <label>كلمة البحث  </label>
                            <input type="text" class="form-control" placeholder="ابحث عن..." name="keyword">
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4">
                        <div class="input-group  ">
                            <label>حدد القسم</label>
                            <select type="text" class="form-control" placeholder="ابحث عن..." name="category_id">
                                @foreach( \App\AdsCategory::all() as $categoryads)
                                    <option value="" disabled selected>اختر القسم </option>
                                    <option value="{{$categoryads->id}}">{{$categoryads->name()}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-4 col-sm-4">
                        <label>قم بالبحث  </label>
                        <span class="input-group-btn  col-xs-12  ">
                            <button class="btn btn-search" type="submit"><i class="fa fa-search"></i> البحث</button>
                        </span>
                    </div>




                </div>
            </div>
        </form>
        <div class="col-xs-12 col-sm-12 col-md-12"  style="margin: 15px">
            <h1 class="title"><span>  اعلانات  باكيج</span></h1>
        </div>
    </div>

    <div class="row " style="margin-top: 10px">
        @foreach($ads as $ad)
            <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="market-pro-list">
                <a href="{{route('showads',$ad->id)}}">
                    <img src="{{getimg($ad->image)}}" alt="" width="240px" height="160px">


                </a>
                        <h2>{{$ad->title}}  </h2>
                <div class="row pro-like text-center">



                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{{route('showads',$ad->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="مشاهدة  "><i class="fa fa-eye"></i></a>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
    </div>

    <div class="row text-center">
        {{ $ads->links() }}
    </div>

</div>

@endsection
