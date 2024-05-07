@extends('admin.layout')
@section('title')
    إرسال رسالة جديدة
@endsection

@section('header')

@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">إرسال رسالة جديدة</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">

                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    {!!Form::open( ['route' => 'admin.sends.store' ,
                    'class'=>'form phone_validate',
                     'method' => 'Post','files' => true]) !!}
                    @include('admin.send.form')
                    {!!Form::close() !!}
                </div>
            </div>
        </div>
    </div>
<!-- #END# Basic Validation -->
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('admin/assets/js/pages/form_layouts.js')}}"></script>
<script>
    $(".selecttype").on('change', function () {
        if ($(this).val() == 'providerTypes' || $(this).val() == 'providerAds' ) {
            $(".showtype").show();

            var key = $(this).val();
            $.ajax({
                url: '{{ route("selectcategoryTypes") }}',
                method: 'GET',
                data:key,
                success: function (response) {
                    // Clear existing options
                    $("select[name='type']").empty();

                    // Append new options
                    $.each(response, function (index, category) {
                        $("select[name='type']").append('<option value="' + category.id + '">' + category.ar_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    // handle error
                    console.error(xhr.responseText);
                }
            });

        } else {
            $(".showtype").hide();
        }
    })
</script>
    <script>
        $(document).ready(function() {
            $('.send_type').on('change',function() {

              
                if ($(this).val() === 'whatsapp') {
                    $('.image_upload').show();
                } else {
                    $('.image_upload').hide();
                }
            });
        });
    </script>

@endsection
