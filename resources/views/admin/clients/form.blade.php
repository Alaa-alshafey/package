
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


<div class="form-group col-md-6 pull-left">
    <label>إسم العضو</label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'أكتب هنا اسم العضو'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>الإيميل</label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'أكتب هنا اسم الايميل'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>رقم الجوال</label>
    {!! Form::tel("mobile",null,['class'=>'form-control','placeholder'=>'أكتب هنا رقم الجوال'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>باسورد</label>
    <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد">
</div>

<div class="form-group col-md-6 pull-left">
    <label>إعادة كتابة الباسورد</label>
    <input type="password" class="form-control" name="password_confirmation" placeholder="أعد هنا كتابة الباسورد">
</div>


<div class="form-group col-md-12">
    <label class="text-semibold"> صور شخصية : </label>
    <div class="media no-margin-top">
        <div class="media-body">
            <input  type="file" class="file-styled" name="profile_picture" multiple="multiple" data-height="200">
            <span class="help-block">الصيغ المسموح بها : gif, png, jpg , jpeg</span>
        </div>
    </div>

</div>
{{--<div class="form-group col-md-12">--}}
    {{--<label>التفعيل</label>--}}
    {{--{!! Form::select("is_active",['1'=>'مفعل','0'=>'غير مفعل'],null,['class'=>'form-control'])!!}--}}
{{--</div>--}}

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>