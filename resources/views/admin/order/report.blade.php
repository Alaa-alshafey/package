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
            <h5 class="panel-title">تقاير الطلبات </h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open(['route'=>'admin.orders.report.filter','class'=>'form phone_validate', 'method' => 'post']) !!}
            {{csrf_field()}}
            @include('admin.order.report-form')
            {!!Form::close() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th>رقم الطلب</th>
                <th>تفاصيل الطلب</th>
                <th>حالة الطلب</th>
                <th>نوع الخدمه</th>
                <th>طالب الخدمه </th>
                <th>سعر الخدمه</th>
                <th>الموعد</th>
                <th>تقييم الطلب</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key=>$order)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$order->id}}</td>
                    <td>{{$order->details}}</td>
                    <td><span class="label label-info">{{$order->status}}</span></td>
                    <td>{{$order->title}}</td>
                    <td>{{$order->user->name}}</td>
                        
                    <td>{{$order->provider->service_price ?? 0 }}</td>
                    <td>{{$order->time}}</td>
                    <td>{{$order->rate}}</td>
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
