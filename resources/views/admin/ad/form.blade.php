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
    <label>عنوان الاعلان </label>
    {!! Form::text("title",null,['class'=>'form-control ','placeholder'=>'اكتب عنوان  الاعلان هنا'])!!}
</div>

@if (isset($ad->image))
    <div class="form-group col-md-12 pull-left">
        <label> صورة الاعلان الحالية  :</label>
        <img class="img-preview" src="{{getimg($ad->image)}}">
    </div>
@endif
<div class="form-group col-md-12 pull-left">
    <label>صورة الاعلان </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اللينك</label>
    {!! Form::text("url",null,['class'=>'form-control ','placeholder'=>'اكتب اللينك هنا'])!!}
</div>
<div class="form-group col-md-12 pull-left">
    <label>تاريخ الانتهاء </label>
    {!! Form::date("Expired_date",null,['class'=>'form-control '])!!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
