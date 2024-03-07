<div>
<div class="onclickclose">
    <i class="fa fa-close label label-danger">حذف</i>
</div>

@foreach($sub_categories as $category)
    <label class="check-box">
       {{$category->name()}}
        <input type="checkbox" name="sub_categories[]" value="{{$category->id}}"  >
        <span class="checkmark"></span>
    </label>
@endforeach
</div>
<script>
    $('.onclickclose').click(function () {

        $(this).parent().remove();
    });
</script>
{{--{!! Form::select("sub_category_id",$sub_categories,null,['class'=>'form-group ','id'=>'sub_category_id2','placeholder'=>'اختر الفرع الرئيسي', 'required'])!!}--}}

{{--<script>--}}
{{--    $('#sub_category_id2').change(function () {--}}

{{--        var val1 = $(this).val();--}}
{{--        var base_url = "{{asset('/')}}";--}}
{{--        if (val1 == "") {--}}
{{--            val1 = 0;--}}
{{--        }--}}

{{--        $.ajax({--}}
{{--            type: "GET",--}}
{{--            url: base_url + "/services/" + val1,--}}
{{--            success: function (data) {--}}
{{--                $('#DIVService').html(data);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<script>--}}
{{--    $('#sub_category_id2').change(function () {--}}

{{--        var val1 = $(this).val();--}}
{{--        var base_url = "{{asset('/')}}";--}}
{{--        if (val1 == "") {--}}
{{--            val1 = 0;--}}
{{--        }--}}

{{--        $.ajax({--}}
{{--            type: "GET",--}}
{{--            url: base_url + "/dashboard/services/" + val1,--}}
{{--            success: function (data) {--}}
{{--                $('#services').html(data);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
