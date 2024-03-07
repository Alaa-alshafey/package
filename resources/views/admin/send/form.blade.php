
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<div class="form-group col-md-12 pull-left">
    <label>اختر  المستهدف من الرسالة</label>
    {!! Form::select("send_target",sendTarget(),
    null,['class'=>'form-control selecttype','placeholder'=>'اختر  المستهدف من الرسالة  '])!!}
</div>
<div class="form-group col-md-12 pull-left showtype" style="display:none">
    <label>اختر القسم</label>
    <Select class="form-control" name="type">
        <option></option>
        
    </Select>
</div>

<div class="form-group col-md-12 pull-left">
    <label>اختر  نوع الارسال</label>
    {!! Form::select("send_type",sendType(),
    null,['class'=>'form-control ','placeholder'=>'اختر  نوع الارسال  '])!!}
</div>


<div class="form-group col-md-12 pull-left">
    <label>الرسالة</label>
    {!! Form::textarea("send_body",
    null,['class'=>'form-control ',
    'placeholder'=>'الرسالة'])!!}
</div>

<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>