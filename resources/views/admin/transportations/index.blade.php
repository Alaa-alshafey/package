@extends('admin.layout')
@section('title')
صناديق العملاء
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">كل صناديق العملاء</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل صناديق العملاء والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th> العضو </th>
                <th> نوع السيارة </th>
                <th> حجم الصندوق </th>
                <th> السعر المقترح </th>
                <th> الحالة </th>
                <th> تاريخ الارسال </th>
                <th> العمليات </th>
            </tr>
            </thead>
            <tbody>
            @foreach($transports as $key=>$transport)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$transport->client->name}}</td>
                    <td>{{isset($transport->carType)?$transport->carType->name:""}}</td>
                    <td>{{$transport->size->name}}</td>
                    <td>{{$transport->offered_price}}</td>
                    <td>@if($transport->is_ended == 1)
                    <span class="label label-success">
                        منتهي
                    </span>
                        @else
                            <span class="label label-danger">
                        غير منتهي
                    </span>
                        @endif
                    </td>
                    <td>{{$transport->created_at}}</td>
                    {!!Form::open( ['route' => ['admin.transportations.destroy',$transport->id] ,'id'=>'delete-form'.$transport->id, 'method' => 'Delete']) !!}
                    {!!Form::close() !!}
                    <td>
                        <a href="{{route('admin.transportations.show',$transport->id)}}"><i class="fa fa-eye"></i></a>
                        {!! Html::nbsp(5) !!}
                        <a href="#" onclick="Delete({{$transport->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
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
                text: "هل تريد حذف هذا العضو ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف العضو تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        };
    </script>



@endsection
@section('script')

    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src=" {{asset('admin/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/datatables_extension_buttons_init.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/assets/js/pages/form_layouts.js')}}"></script>


@endsection
