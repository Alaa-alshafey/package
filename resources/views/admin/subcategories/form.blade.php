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
    {!! Form::select("category_id",$categories,null,['class'=>'form-control ','id'=>'area_id','placeholder'=>'اختر القسم الرئيسي '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم القسم باللغة العربية </label>
    {!! Form::text("ar_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم القسم  هنا'])!!}
</div>
<div class="form-group col-md-12 pull-left">
    <label>اسم القسم بالانجليزية </label>
    {!! Form::text("en_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم القسم  هنا'])!!}
</div>

@if (isset($category->image))
    <div class="form-group col-md-12 pull-left">
        <label> صورة القسم الفرعى الحالية  :</label>
        <img class="img-preview" src="{{getimg($category->image)}}">
    </div>
@endif
<div class="form-group col-md-12 pull-left">
    <label>صورة القسم الفرعى </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
