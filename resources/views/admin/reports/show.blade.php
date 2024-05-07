@extends('admin.layout')
@section('title')
  المدفوعات الواحدة
@endsection

@section('header')

@endsection
@section('content')

    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-button-init-basic">
      
            <tbody>
          
            <tr>
            <td>
           <b> رقم الطلب : </b>{{$report->id}}
            </td>
            </tr>
            <tr>
            <td>
            <b>نوع الخدمة : </b> <span class="label label-info">{{($report->type == 1)? ' عمولة الموقع' : 'عضوية التميز'}}</span>
            </td>
            </tr>
            <tr>
            <td>
            <b>   التفاصيل:  </b>{{$report->message}}
            </td>
            </tr>
            <tr>
            <td>
            <b>  اسم المستخدم: </b> {{$report->user->name}}
         </td>
            </tr>


            <tr>
                <td>
                    <b>  بريد المستخدم: </b> {{$report->user->email}}
                </td>
            </tr>

            @if($report->user->role == 'provider')

                <tr>
                    <td>
                        <b> عمولة المستخدم: </b> {{$report->user->commission}} ريال
                    </td>
                </tr>


            @endif
            <tr>
            <td>
            <b>     صورة التحويل: </b>
                <img src="{{getimg($report->image)}}" class="img-responsive"/>
          </td>
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
