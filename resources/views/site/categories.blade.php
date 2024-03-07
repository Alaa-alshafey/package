@extends('layouts.app')

@section('content')

    <div class="department">
        <div class="container">
            <h1><span>الأقسام  </span></h1>
            <div class="row">

                @foreach($categories as $category)
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <a style="overflow: hidden;margin: 0 10px;"  href="{{route('subCategory',$category->id)}}">
                            <img src="{{getimg($category->image)}}" alt="" width="300px" height="154px"/>
                            <h4>   {{$category->name()}} </h4>
                        </a>
                    </div>
                @endforeach

        </div>
    </div>
    </div>

@endsection
