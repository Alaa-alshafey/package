@extends('admin.layout')
@section('title')
    تقرير
@endsection

@section('header')

@endsection
@section('content')
    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقاير مزودين الخدمات </h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open(['route'=>'admin.providers.report.filter','class'=>'form phone_validate', 'method' => 'post']) !!}
            {{csrf_field()}}
            @include('admin.provider.report-form')
            {!!Form::close() !!}
        </div>
         <table class="table datatable-button-init-basic">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> الإسم الاول </th>
                            <th> رقم الهوية </th>
                            <th> الايميل </th>
                            <th> الوظيفة </th>
                            <th> حاله العضوية </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->identity}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->job}}</td>
                                <td>
                                    <span class="label label-info">مورد </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
         </table>
    </div>
    <!-- /basic initialization -->
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/datatables_extension_buttons_init.js')}}"></script>
@endsection
