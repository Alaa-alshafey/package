@extends('admin.layout')
@section('header')
    @endsection
@section('title')
الصفحة الرئيسية والاحصائيات
@endsection

@section('content')


    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-grey-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin"> </h3>
                        <span class="text-uppercase text-size-mini">عدد عضويات الاداره</span>
                        <br>
                        {{$admins }}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-users  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-success has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">  </h3>
                        <span class="text-uppercase text-size-mini">عدد عضويات العملاء</span>
                        <br>
                        {{$clients}}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-users2  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-info has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">  </h3>
                        <span class="text-uppercase text-size-mini">عدد عضويات مزودى الخدمه</span>
                        <br>
                        {{$providers}}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-user-tie  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-pink-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">  </h3>
                        <span class="text-uppercase text-size-mini">عدد الدول </span>
                        <br>
                        {{$countries}}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-location4  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-teal-700 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">  </h3>
                        <span class="text-uppercase text-size-mini">عدد المدن </span>
                        <br>
                        {{$cities}}
                    </div>
                    <div class="media-right media-middle">
                        <i class="icon-location3  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-blue-700 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin"> </h3>
                        <span class="text-uppercase text-size-mini">عدد الأحياء </span>
                        <br>
                        {{$regions}}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-location3  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-grey has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">  </h3>
                        <span class="text-uppercase text-size-mini">عدد الرسائل </span>
                        <br>
                        {{$contacts}}
                    </div>

                    <div class="media-right media-middle">
                        <i class="icon-envelop3  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
         </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel panel-body bg-orange-400 has-bg-image">
                <div class="media no-margin">
                    <div class="media-body">
                        <h3 class="no-margin">   </h3>
                        <span class="text-uppercase text-size-mini">عدد الأقسام </span>
                        <br>
                        {{$categories}}
                    </div>
                    <div class="media-right media-middle">
                        <i class="icon-bin2  icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>



    </div>




@endsection


@section('script')


@endsection
