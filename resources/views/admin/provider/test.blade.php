@extends('admin.layout')
@section('title')
    الموردين
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> الموردين {{$provider->name}}</h5>
            <div class="heading-elements">
                <ul class="icons-list">

                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        {{--<div class="panel-body">--}}
        {{--عرض كل الموردين  والتحكم بهم وبكل العمليات الخاصة بهم مع امكانية البحث وتصدير تقارير وملفات وطباعتهم--}}
        {{--</div>--}}

        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> # </th>
                <th> الإسم الاول </th>
                <th>رقم الهوية</th>
                <th> الايميل </th>
                <th> حاله العضوية </th>
                <th>الهاتف</th>
                <th>الوظيفة</th>
                <th>الجنسية</th>
                <th>الجنس</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>#</td>
                <td>{{$provider->name}}</td>
                <td>{{$provider->identity}}</td>
                <td>{{$provider->email}}</td>
                <td>
                    <span class="label label-info">مورد </span>
                </td>
                <td>{{$provider->phone}}</td>
                <td>{{$provider->job}}</td>
                <td>{{$provider->nationality}}</td>
                <td>{{$provider->gender}}</td>
            </tr>
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


@endsection
@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/datatables_extension_buttons_init.js')}}"></script>
@endsection
