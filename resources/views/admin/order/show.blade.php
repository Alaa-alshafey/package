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
            <b>   التفاصيل:  </b>{{$order->details}}
            </td>
            </tr>
            <tr>
            <td>
            <b>  سعر الخدمه: </b> {{$order->provider->service_price}}
         </td>
            </tr>
            <tr>
            <td>
            <b>     الموعد: </b>
            {{$order->time}}
          </td>
            </tr>
            <tr>
                <td>
                    <b>     تاريخ الطلب: </b>
                    {{$order->created_at}}
                </td>
            </tr>
            <tr>
                <td>
                    <b>اسم مزود الخدمة: </b>
                    {{$order->provider->name}}
                </td>
                <td>
                    <b> ايميل مزود التعليق: </b>
                    {{$order->provider->email}}
                </td>
                <td>
                    <b> هاتف مزود التعليق: </b>
                    {{$order->provider->phone}}
                </td>
                <td>
                    <b> هوية مزود التعليق: </b>
                    {{$order->provider->identity}}
                </td>
            </tr>
            <tr>
                <td>
                    <b>     التعليقات: </b>
                    {{$order->comment}}
                </td>
            </tr>
            <tr>
                <td>
                    <b> اسم صاحب الطلب: </b>
                    {{$order->client->name}}
                </td>
                <td>
                    <b> ايميل صاحب الطلب: </b>
                    {{$order->client->email}}
                </td>
                <td>
                    <b> هاتف صاحب الطلب: </b>
                    {{$order->client->phone}}
                </td>
                <td>
                    <b> هوية صاحب الطلب: </b>
                    {{$order->client->identity}}
                </td>
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
