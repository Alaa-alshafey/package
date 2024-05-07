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
    <label>اسم  </label>
    {!! Form::text("name",null,['class'=>'form-control ','placeholder'=>'اكتب الاسم  هنا'])!!}
</div>


@if (isset($slider->image))
    <div class="form-group col-md-12 pull-left">
        <label> صورة  السلايدر الحالية  :</label>
        <img class="img-preview" src="{{getimg($slider->image)}}">
    </div>
@endif
<div class="form-group col-md-12 pull-left">
    <label>صورة السلايدر  </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اختار نسخه العرض </label>
    {!! Form::select('image_for',[
    'mobile'    => 'نسخة الجوال',
    'web'       =>  'نسخة الموقع'
    ],(isset($slider)?$slider->image_for: null),['placeholder'  => 'اختر نسخة العرض','class'=>'form-control']) !!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
