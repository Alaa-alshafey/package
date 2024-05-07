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
            <h5 class="panel-title"></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-button-init-basic">
      
            <tbody>
          
            @foreach($orders as $order)
            <tr>
            <td>
           <b> رقم الطلب : </b>{{$order->id}}
            </td>
            </tr>
            <tr>
            <td>
            <b>الخدمه : </b> {{$order->title}}
            </td>
            </tr>
            <tr>
            <td>
            <b>   التفاصيل:  </b>{{$order->user->service_details}}
            </td>
            </tr>
            <tr>
            <td>
            <b>  سعر الخدمه: </b> {{$order->user->service_price}}
         </td>
            </tr>
            <tr>
            <td>
            <b>   نوع الخدمه:  </b>
            </td>
            </tr>
            <tr>
            <td>
            <b>     الموعد: </b>
            {{$order->time}}
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
