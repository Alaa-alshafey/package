@extends('admin.layout')
@section('title')
   العملاء
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">كل العملاء </h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل العملاء  والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th> الاسم </th>
                <th> رقم الجوال </th>
                <th> الايميل </th>
                <th> حاله العضوية </th>
                <th> العمليات </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key=>$admin)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->phone}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        <span class="label label-info">عميل </span>
                    </td>
                    {!!Form::open( ['route' => ['admin.client.destroy',$admin->id] ,'id'=>'delete-form'.$admin->id, 'method' => 'Delete']) !!}
                    {!!Form::close() !!}
                    <td>
                        <a href="{{route('admin.client.edit',$admin->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                        <a href="{{route('admin.show_client',$admin->id)}}"
                           data-toggle="tooltip" data-original-title="تعديل">
                            <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
                        @if($admin->is_active == 1)
                        <a href="{{route('admin.client.block',$admin->id)}}" data-toggle="tooltip" data-original-title="حظر "> <i class="fa fa-ban text-brown" style="margin-left: 10px"></i> </a>
                        @endif
                        @if($admin->is_active == 0)
                            <a href="{{route('admin.client.active',$admin->id)}}" data-toggle="tooltip" data-original-title="تنشيط "> <i class="fa fa-check text-purple" style="margin-left: 10px"></i> </a>
                        @endif
                        @if(!$admin->is_special)
                            <a href="{{route('admin.user.active_star',$admin->id)}}" data-toggle="tooltip"
                               data-original-title="تنشيط "> <i class="fa fa-star text-purple" style="margin-left: 10px"></i> </a>
                        @endif
                        @if($admin->is_special)
                            <a href="{{route('admin.user.block_star',$admin->id)}}" data-toggle="tooltip"
                               data-original-title="تنشيط ">
                                <i style="text-decoration: line-through; color: #000" class="fa fa-star text-purple" style="margin-left: 10px"></i> </a>
                        @endif
                        <a href="#" onclick="Delete({{$admin->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
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
                text: "هل تريد حذف هذا العميل ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف العميل تم الغاؤه",'info',{buttons:'موافق'});
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
