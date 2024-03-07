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
    {!! Form::select("cat_event_id",$categories,(isset($category)? $category->cat_event_id : null),
    ['class'=>'form-control ','id'=>'area_id','placeholder'=>'اختر القسم الرئيسي '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم القسم الفرعي </label>
    {!! Form::text("title",(isset($category)? $category->title : null),['class'=>'form-control ','placeholder'=>'اكتب اسم القسم  هنا'])!!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
