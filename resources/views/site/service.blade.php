@extends('layouts.app')

@section('content')

    <div class="department">
        <div class="container">
            <h1><span>الخدمات </span></h1>

            <div class="row">

                @foreach($services as $service)
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <a href="{{route('single_service',['id'=>$service->id])}}">
                            <img src="{{getimg($service->image)}}"/>
                            <h4>{{$service->name()}}</h4>
                        </a>
                    </div>
                @endforeach

            </div>



        </div>
    </div>

@endsection
