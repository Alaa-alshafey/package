
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
    <label>اختر  المستهدف من الاشعار  </label>
    {!! Form::select("notification_target",notificationTarget(),null,['class'=>'form-control ','placeholder'=>'اختر  المستهدف من الاشعار  '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>عنوان الاشعار</label>
    {!! Form::text("notification_title",null,['class'=>'form-control ','placeholder'=>'عنوان الاشعار'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>موضوع الاشعار</label>
    {!! Form::text("notification_body",null,['class'=>'form-control ','placeholder'=>'موضوع الاشعار'])!!}
</div>

<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>