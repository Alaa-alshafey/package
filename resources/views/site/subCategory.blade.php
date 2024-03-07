@extends('layouts.app')

@section('content')

    @push('style')
        <style>

            #department_a{
                display: block;
                width: 100%;
                overflow: hidden;
                margin: 8px 0px;
            }
            #department_img{
                border-radius: 50%;
                padding: 0px;
                background-image: linear-gradient(to top,#4d4e4f,#9fa1a4);
                margin-bottom: 5px;
            }

            #department_h4{
                padding: 5px 0;
                border-radius: 12px;
                border: 2px solid#555;
                background-color:#9a9a9a;
                line-height: 30px;
                min-height: 50px;
            }
            @media (min-width: 992px ) {
                #divcol{
                    min-height: 340px;
                }
            }

            @media (max-width: 992px)  {
                #divcol{
                    min-height: 280px;
                }
            }

            #divcol{
                overflow: hidden; float: right;
            }
            img{
                width: 100%;
            }
        </style>
    @endpush

    <div class="department">
        <div class="container">
            <h1><span>القسم الفرعي</span></h1>

            <div class="row">

                @foreach($categories as $category)
                    <div class="col-xs-6 col-sm-6 col-md-3" id="divcol">
                        <a id="department_a"  href="{{route('service',[$category->id])}}">
                            <img id="department_img"
                                 src="{{getimg($category->image)}}"/>
                            <h4 id="department_h4">{{$category->name()}}</h4>
                        </a>
                    </div>
                @endforeach

            </div>



        </div>
    </div>

@endsection
