@extends('admin.layout')
@section('title')
    تقييمات الطلبات
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقييمات الطلبات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل تقييمات الطلبات والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th> رقم الطلب </th>
                <th>اسم مزود الخدمة</th>
                <th>اسم العميل</th>
                <th>تقييم العميل</th>
                <th>تعليق العميل</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rates as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->provider->name}}</td>
                    <td>{{$item->client->name}}</td>
                    <td>{{$item->rate}}</td>
                    <td>{{$item->comment}}</td>

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
