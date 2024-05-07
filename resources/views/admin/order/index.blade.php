@extends('admin.layout')
@section('title')
  الطلبات
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">كل الطلبات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل الطلبات   والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th>رقم الطلب</th>
                <th>تفاصيل الطلب</th>
                <th>حالة الطلب</th>
                <th>الخدمه</th>
                <th>طالب الخدمه </th>
                <th>سعر الخدمه</th>
                <th>الموعد</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->details}}</td>
                    <td><span class="label label-info">{{OrderStatus($item->status)}}</span></td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->provider->service_price??""}}</td>
                    <td>{{$item->time}}</td>
                    {!!Form::open( ['route' => ['admin.order.destroy',$item->id] ,'id'=>'delete-form'.$item->id, 'method' => 'Delete']) !!}
                    {!!Form::close() !!}
                    <td>
                        <a href="{{route('admin.order.show',$item->id)}}" data-toggle="tooltip" data-original-title="عرض الاوردر"> <i class=" icon-eye text-inverse" style="margin-left: 10px"></i> </a>
                        <a href="#" onclick="Delete({{$item->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic initialization -->




    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا المدينة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف المدينة تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>


@endsection
@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/datatables_extension_buttons_init.js')}}"></script>
@endsection
