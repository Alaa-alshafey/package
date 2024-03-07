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
    {!! Form::select("cat_event_id",$categories,null,['class'=>'form-control ',
    'id'=>'Category','placeholder'=>'اختر القسم الرئيسي '])!!}
</div>


<div class="form-group col-md-12 pull-left" id="subCat">
    <label>اختر  القسم الفرعي  </label>
    {!! Form::select("sub_cat_id",$categories,null,['class'=>'form-control ','id'=>'area_id','placeholder'=>'اختر القسم الرئيسي ','disabled'=>'disabled'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>عنوان البطاقة </label>
    {!! Form::text("title",null,['class'=>'form-control ','placeholder'=>'اكتب اسم القسم  هنا'])!!}
</div>


@if (isset($event->image))
    <div class="form-group col-md-12 pull-left">
        <label> صورة البطاقة الحالية  :</label>
        <img class="img-preview" src="{{getimg($event->image)}}">
    </div>
@endif

<div class="form-group col-md-12 pull-left">
    <label>صورة البطاقة </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

