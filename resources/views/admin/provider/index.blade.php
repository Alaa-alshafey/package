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
            <h5 class="panel-title">كل الموردين </h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            عرض كل الموردين  والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم
        </div>


        {!!Form::open( ['route' => 'admin.provider.updateAll' ,'id'=>'update-form','class'=>'form-inline', 'method' => 'Post','enctype'=>"multipart/form-data",'files' => true]) !!}
        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th> # </th>
                <th> الإسم الاول </th>
                <th> رقم الهوية </th>
                <th> الايميل </th>
                <th> حاله العضوية </th>
                <th> العمليات </th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $key=>$admin)
                <tr>
                    <td>
                        <input type="checkbox" name="ids[]" @if($admin->registration) checked="checked" @endif value="{{$admin->id}}">
                    </td>
                    <td>{{$key+1}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->identity}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        <span class="label label-info">مورد </span>
                    </td>

                    {{--{!!Form::open( ['route' => ['admin.provider.destroy',$admin->id] ,'id'=>'delete-form'.$admin->id, 'method' => 'Delete']) !!}
                    {!!Form::close() !!}--}}
                    <td>
                        @if($admin->is_top == 0)
                            <a href="{{route('admin.provider.top',$admin->id)}}" data-toggle="tooltip" data-original-title="اعلي الصفحه"> <i class="icon-arrow-up5 text-inverse" style="margin-left: 10px"></i> </a>
                        @else
                            <a href="{{route('admin.provider.removeT',$admin->id)}}" data-toggle="tooltip" data-original-title="اسفل الصفحه"> <i class="icon-arrow-down5 text-inverse" style="margin-left: 10px"></i> </a>
                        @endif
                        <a href="{{route('admin.provider.edit',$admin->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                        <a href="{{route('admin.provider.view',$admin->id)}}" data-toggle="tooltip" data-original-title="عرض "> <i class="fas fa-eye text-success" style="margin-left: 10px"></i> </a>

                        @if($admin->is_verified == 0)
                            <a href="{{route('admin.active.user',$admin->id)}}"
                               data-toggle="tooltip" data-original-title="تفعيل">
                                <i class="fa fa-hand-point-up text-brown" style="margin-left: 10px"></i> </a>
                        @endif

                        @if($admin->is_active == 1)
                            <a href="{{route('admin.provider.block',$admin->id)}}" data-toggle="tooltip" data-original-title="حظر "> <i class="fa fa-ban text-brown" style="margin-left: 10px"></i> </a>
                        @endif
                        @if($admin->is_active == 0)
                            <a href="{{route('admin.provider.active',$admin->id)}}" data-toggle="tooltip" data-original-title="تنشيط "> <i class="fa fa-check text-purple" style="margin-left: 10px"></i> </a>
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
                            <a href="{{route('admin.provider.destroy',$admin->id)}}" data-toggle="tooltip"
                               data-original-title="حذف ">
                                <i style="text-decoration: line-through; color: #000" class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                        {{--<a href="#" onclick="Delete({{$admin->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <footer class="dker p-a" style="padding: 20px">
            <div class="row">
                <div class="col-sm-4 hidden-xs">
                    <select name="action" id="action" class="form-control c-select w-sm inline v-middle" required="">
                        <option value="">الخيارات</option>
                        <option value="registration">توثيق </option>
                        <option value="non_registration">الغاء التوثيق </option>
                    </select>
                </div>
                <div class="col-sm-4 hidden-xs">
                    <button type="submit" id="submit_all" class="btn white">تنفيذ</button>
                </div>
            </div>
        </footer>

        {!!Form::close() !!}



    </div>
    <!-- /basic initialization -->




    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا المورد ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف المورد تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>

    <script>
        function Update(id) {

            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد توثيق  الموردين؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('update-form').submit();
                }
                else{
                    swal("تم االإلفاء", "حذف المورد تم الغاؤه",'info',{buttons:'موافق'});
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
