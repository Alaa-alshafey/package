@extends('admin.layout')
@section('title')
     عرض المستخدم
@endsection

@section('header')

@endsection
@section('content')

    <style>
        .check-box{
            border: 1px solid #ddd;
            padding: 5px;
            clear: both;
            display: block;
            width: 250px;
            text-align: center;
        }

    </style>
    <!-- Basic initialization -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">   المستخدم :  {{$client->name}} </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
           <div class="row" style="padding: 20px">
                <p>     <b> الاسم </b> :{{$client->name}}  </p>
                <p>     <b>الرقم </b> :{{$client->phone}}  </p>
                <p>     <b>الايميل </b> :{{$client->email}}  </p>
               @if(getimg($client->image))

                <img style="width: 250px; height: 250px; border-radius: 50%" class="img-responsive img-content img-fluid" src="{{getimg($client->image)}}">

               @endif
                <p><b>    <span class="label label-info">عميل </span>
                    </b></p>



               <div class="panel panel-success">
                   <div class="panel-heading">تغيير العضوية الي مزود خدمة </div>
                   <div class="panel-body">
                       <form action="{{route('admin.changePermission')}}" method="post" enctype="multipart/form-data">

                           @if ($errors->any())
                               <div class="alert alert-danger">
                                   <ul>
                                       @foreach ($errors->all() as $error)
                                           <li>{{ $error }}</li>
                                       @endforeach
                                   </ul>
                               </div>
                           @endif


                           @csrf
                           <input type="hidden" value="{{$client->id}}" name="id" />

                           <div class="form-group">
                               <label>نوع الشركة*</label>
                               <select id="selectedCompany" name="provider_type" class="form-control">
                                   <option class="" value="">اختر النوع</option>
                                   <option value="one">فرد</option>
                                   <option value="company">شركة</option>
                               </select>
                           </div>


                           <div id="CompanySelect" style="display: none">
                               <div class="form-group">
                                   <label>اختر نوع الشركة</label>
                                   <select name="provider_company_type" class="form-control" >
                                       <option value="MNC">قابضة</option>
                                       <option value="LTD">مساهمة</option>
                                       <option value="PVT">محددوده</option>
                                       <option value="Registered" selected>ناشئة</option>
                                   </select>
                               </div>

                           </div>






                           <div class="form-group">



                               <div><label>القسم الفرعي*</label></div>

                               {!! Form::select("category_id",category(),
                               null,['class'=>'form-group ','id'=>'Department123','placeholder'=>'اختر القسم الرئيسي'])
                               !!}


                               <div class="form-group">
                                   <div id="DIVSubDept">
                                       <div id="DIVSubDept">
                                           <div><label>القسم الفرعي*</label></div>
                                           {{--                                                {!! Form::select("category_id",subCategory(),null,['class'=>'form-group ','id'=>'Department123','placeholder'=>'اختر القسم الفرعى', 'required'])!!}--}}
                                       </div>

                                   </div>
                               </div>

                           </div>


                           <div class="form-group">
                               <div class="time-bg">
                                   <div class="">
                                       <label style="margin: 15px 0; ">اختر مجال الخدمة : </label>
                                   </div>
                                   <div class="time-bg">
                                       <label>قسم إلاعلانات</label>

                                       <div class="form-group">

                                           {!! Form::select("ads_category",ad_category()
                                           ,null,['class'=>'form-group ','id'=>'','placeholder'=>'اختر مجال الخدمة'])!!}

                                       </div>


                                   </div>
                               </div>
                           </div>

                               <input type="submit" class="btn btn-success" value="تغيير العضوية">



                       </form>
                   </div>
               </div>

           </div>

        </div>
    </div>
    <!-- /basic initialization -->

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا الرساله ؟",
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

    <script>


        $('#Department123').change(function () {

            var val = $(this).val();
            var base_url = "{{asset('/')}}";
            if (val == "") {
                val = 0;
            }

            $.ajax({
                type: "GET",
                url: base_url + "subcategories/" + val,
                success: function (data) {
                    $('#DIVSubDept').append(data);
                }
            });
        });

        $('#selectedCompany').change(function () {
            var selectedItem = $(this). children("option:selected"). val();
            if(selectedItem == 'company'){
                $('#CompanySelect').css('display','block');
            }else {

                $('#CompanySelect').css('display','none');
            }
        })


    </script>
@endsection
