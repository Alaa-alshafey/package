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
    <label>عنوان الاعلان باللغة العربية </label>
    {!! Form::text("title_ar",null,['class'=>'form-control ','placeholder'=>'عنوان الاعلان باللغة العربية'])!!}
</div>
<div class="form-group col-md-12 pull-left">
    <label> عنوان الاعلان بالانجليزية </label>
    {!! Form::text("title_en",null,['class'=>'form-control ','placeholder'=>'عنوان الاعلان بالانجليزية '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label> اختر نوع البانر </label>
    {!! Form::select("banner_type",[
    'ads' => 'بانر للعلانات',
    'app'   => 'بانر عام'
    ],@$banner->banner_type,['class'=>'form-control ','placeholder'=>'اختر نوع البانر'])!!}
</div>



<div class="form-group col-md-12 pull-left">
    <label> تفاصيل الاعلان بالعربية </label>
    {!! Form::textarea("description_ar",null,['class'=>'form-control ','placeholder'=>' تفاصيل الاعلان بالعربية '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label> تفاصيل الاعلان بالانجليزية </label>
    {!! Form::textarea("description_en",null,['class'=>'form-control ','placeholder'=>' تفاصيل الاعلان بالانجليزية '])!!}
</div>

@if (isset($banner->file))
    <div class="form-group col-md-12 pull-left">
        <label> صورة الاعلان الرئيسى الحالية  :</label>
        <img class="img-preview" src="{{($banner->file)}}">
    </div>
@endif
<div class="form-group col-md-12 pull-left">
    <label>صورة الاعلان الرئيسى </label>
    {!! Form::file("file",null,['class'=>'form-control '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label> تاريخ انتهاء الاعلان </label>
    {!! Form::date("end_date",null,['class'=>'form-control '])!!}
</div>


<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
