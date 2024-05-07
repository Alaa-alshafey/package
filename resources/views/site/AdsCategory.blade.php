@extends('layouts.app')

@section('content')

    <div class="department">
        <div class="container">
            <h1><span> قسم الاعلانات </span></h1>

            <div class="row">

                @foreach($categories as $category)
                    <div class="col-xs-6 col-sm-6 col-md-3" style="margin-bottom: 20px">
                        <a  href="{{route('adservice',[$category->id])}}">
                            <img style="width: 300px; height: 154px !important;" class="img-responsive" src="{{getimg($category->image)}}" width="300px" height="154px"/>
                            <h4>{{$category->name()}}</h4>
                        </a>
                    </div>
                @endforeach

            </div>



        </div>
    </div>

@endsection
