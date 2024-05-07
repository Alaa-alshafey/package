@extends('admin.layout')
@section('title')
المدفوعات
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">كل المدفوعات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل المدفوعات   والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th>اسم المستخدم</th>
                <th>بريد المستخدم</th>
                <th>نوع الدفع</th>
                <th>ايصال الدفع</th>

                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->user->email}}</td>
                    <td>
                        <span class="label label-info">{{($item->type == 1)? ' عمولة الموقع' : 'عضوية التميز'}}</span></td>
              
                    <td><img src="{{getimg($item->image)}}" class="img-responsive img-fluid img-xs"></td>
                    {!!Form::open( ['route' => ['admin.reports.destroy',$item->id] ,'id'=>'delete-form'.$item->id, 'method' => 'Delete']) !!}
                    {!!Form::close() !!}
                    <td>
                    <a href="{{route('admin.reports.show',$item->id)}}"
                       data-toggle="tooltip" data-original-title="عرض"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>
                           <a href="#" onclick="Delete({{$item->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                        <a href="{{route('admin.active_star',['id'=>$item->id])}}"
                           data-toggle="tooltip" data-original-title="نجمة التميز">
                            <i class="icon-star-empty3 text-inverse" style="margin-left: 10px"></i> </a>


                        @if($item->user->role == 'provider')
                            <a href="{{route('admin.active_commission',$item->id)}}"
                               data-toggle="tooltip" data-original-title="تصفير السحاب">
                                <i class="icon-credit-card text-inverse" style="margin-left: 10px"></i> </a>
                        @endif



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
                text: "هل تريد حذف هذا المدفوع؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  تم الغاؤه",'info',{buttons:'موافق'});
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
