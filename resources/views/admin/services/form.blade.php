@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="form-group col-md-12 pull-left">
    <label>اختر  القسم الرئيسي  </label>
    @if (!isset($service))
    {!! Form::select("main_category_id",$categories,null,['class'=>'form-control ','id'=>'main_category_id','placeholder'=>'اختر القسم الرئيسي '])!!}
   @else
    {!! Form::select("main_category_id",$categories,$categoriyId,['class'=>'form-control ','id'=>'main_category_id','placeholder'=>'اختر القسم الرئيسي '])!!}
    @endif
</div>

<div class="form-group col-md-12 pull-left">
    <label>اختر  القسم الفرعى  </label>
    <div id="sub_category">
        {!! Form::select("sub_category_id",[],null,['class'=>'form-control ','id'=>'sub_category_id','placeholder'=>'اختر القسم الرئيسي أولُا '])!!}
    </div>
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم الخدمة باللغة العربية </label>
    {!! Form::text("ar_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الخدمة  هنا'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم الخدمة بالانجليزية </label>
    {!! Form::text("en_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الخدمة  هنا'])!!}
</div>

    @if (isset($service->image))
        <div class="form-group col-md-12 pull-left">
            <label> صورة الخدمة   الحالية  :</label>
            <img class="img-preview" src="{{getimg($service->image)}}">
        </div>
    @endif

<div class="form-group col-md-12 pull-left">
    <label>صورة الخدمة  </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
</div>

<br>
<br>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@push('scripts')
    <script>
$('#main_category_id').change(function () {

var val = $(this).val();
var base_url = "{{asset('/')}}";
if (val == "") {
val = 0;
}

$.ajax({
type: "GET",
url: base_url + "dashboard/subcategories/" + val,
success: function (data) {
$('#sub_category').html(data);
}
});
});



</script>
@endpush
