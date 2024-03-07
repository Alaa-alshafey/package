@extends('admin.layout')
@section('title')
    بيانات مزود الخدمة
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
            <h5 class="panel-title"></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>


        <table class="table datatable-button-init-basic">

            <tbody>

            {{--@foreach($providers as $provider)--}}
                <tr>
                    <td>
                        <b> اسم مزود الخدمة : </b>{{$provider->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>رقم الهوية : </b> {{$provider->identity}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>   البريد الإلكتروني:  </b>{{$provider->email}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>  رقم الهاتف: </b> {{$provider->phone}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>     العمل الحالي: </b>
                        {{$provider->job}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>     الجنسية: </b>
                        {{$provider->nationality}}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> حالة الحساب : </b>
                        {{IsActive($provider->is_active)}}
                    </td>
                    <td>
                        <b> المنطقة التابع لها : </b>
                        {{$provider->City->ar_name}}
                    </td>
                </tr>

            <tr>
                <td>
                    @if (isset($provider))
                        <img src="{{getimg($provider->image)}}" class="img-preview" style="height: 50px; width: 50px">
                    @endif
                </td>
            </tr>

            <br>
            <div class="clearfix"></div>
            <!-- Add a header row with the "Select All" checkbox -->
            <tr>
                <td>المجالات</td>
                @if(count($provider->SubCategories) > 0)
                                <td style="float:right">
                                    <input type="checkbox" class="select-all-checkbox">
                                    تحديد الكل
                                                           <a style="display:none"  id='deleteSelected' class="btn btn-info" href="#">مسح الكل </a>

                                </td>
                @endif
                @if(count($provider->SubCategories) > 0)
                    @foreach($provider->SubCategories as $category)
                        <td style="clear: both;margin: 10px 0;" class="list-group-item subcategory" data-id="{{$category->id}}">
                            <input type="checkbox" class="delete-checkbox" value="{{$category->id}}">
                            {{$category->ar_name}}
                            <a class="btn btn-info" style="float: right" href="{{route('admin.delete_sub_category',['id'=>$category->id,'provider_id'=>$provider->id])}}">مسح المجال</a>
                        </td>
                    @endforeach

                @endif
            
                @if($provider->ads_category)
                    <td style="clear: both;margin: 10px 0;" class="list-group-item">
                        {{$provider->adsCategory->ar_name}} (مجال اعلانات)
                        <a style="float: left" class="btn btn-info" href="{{route('admin.delete_ads_category',['provider_id'=>$provider->id])}}">مسح المجال </a>
                    </td>
                @endif
            </tr>

            {{--@endforeach--}}
            </tbody>
        </table>
    </div>

    <div class="panel panel-success">
        <div class="panel-heading">اضافة مجالات لمزود الخدمة </div>
        <div class="panel-body">
            <form action="{{route('admin.addSubCategoriesToProvider')}}" method="post" enctype="multipart/form-data">

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
                <input type="hidden" value="{{$provider->id}}" name="id" />

                <div class="form-group">

                    <div><label>القسم الفرعي*</label></div>


                    {!! Form::select("category_id",category(),
                    null,['class'=>'form-control','id'=>'Department123',
                    'placeholder'=>'اختر القسم الرئيسي'])
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
                            <label style="margin: 15px 0; ">اختر مجال الخدمة(غير الزامي) : </label>
                        </div>
                        <div class="time-bg">
                            <label>قسم إلاعلانات</label>
                            <div class="form-group">
                                {!! Form::select("ads_category",ad_category()
                                ,null,['class'=>'form-group form-control','id'=>'','placeholder'=>'اختر مجال الخدمة'])!!}
                            </div>


                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-success" value="اضافة للمزود">



            </form>
        </div>
    </div>
    <!-- /basic initialization -->




@endsection

@push('scripts')

// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>


        $('#Department123').change(function () {

            var val = $(this).val();
            // alert(val);
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
        <script>
$(document).ready(function () {
    // Handle "Select All" checkbox
    $('.select-all-checkbox').click(function () {
        $('.delete-checkbox').prop('checked', this.checked);
        updateSelectedIds();
    });

    // Handle individual checkbox click
    $('.delete-checkbox').click(function () {
        updateSelectedIds();
    });

    // Handle delete selected button click
    $('#deleteSelected').click(function () {
        var selectedIds = getSelectedIds();
                if (selectedIds.length > 0) {
                   
                    // Perform your deletion logic using AJAX or form submission
                    // You can use selectedIds array to send data to your delete route
                    console.log('Selected IDs:', selectedIds);
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('admin.delete_selected_subcategories') }}',
                        data: { ids: selectedIds , provider : "{{ $provider->id }}" },
                        success: function (response) {
        if (response.success) {
                    selectedIds.forEach(function (id) {
                        // Remove the element with the corresponding data-id attribute
                        $('.subcategory[data-id="' + id + '"]').remove();
                    });

            // Show SweetAlert for success
            Swal.fire({
                title: 'تم مسح جميع المجالات!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            // Show SweetAlert for error
            Swal.fire({
                title: 'خطأ!',
                text: 'حدث خطأ أثناء مسح المجالات',
                icon: 'error',
                showConfirmButton: true
            });
        }
            
                        },
                        error: function (error) {
                            // Handle error
                        }
                    });
                } else {
                    alert('يرجى تحديد عناصر للحذف.');
                }
    });

    // Function to update selected IDs variable
    function updateSelectedIds() {
        var selectedIds = [];
        // Iterate over each checked checkbox
        $('.delete-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });
        if(selectedIds.length > 0 ){
            
            $("#deleteSelected").show();
        }
        // Store the selected IDs in a global variable or perform any other desired action
        window.selectedIds = selectedIds;
    }

    // Function to get selected IDs variable
    function getSelectedIds() {
        return window.selectedIds || [];
    }
});
    </script>

@endpush
