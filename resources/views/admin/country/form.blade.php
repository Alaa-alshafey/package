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
    <label>اسم الدولة باللغة العربية </label>
    {!! Form::text("ar_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الدوله  هنا'])!!}
</div>
<div class="form-group col-md-12 pull-left">
    <label>اسم الدولة بالانجليزية </label>
    {!! Form::text("en_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الدوله  هنا'])!!}
</div>

<br>
<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>