
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
    <label>النوع باللغه العربية</label>
    {!! Form::text("name",null,['class'=>'form-control ','placeholder'=>'أكتب هنا النوع باللغة العربية'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>النوع باللغه الانجليزية</label>
    {!! Form::text("name_en",null,['class'=>'form-control ','placeholder'=>'أكتب هنا النوع باللغة الانجليزية'])!!}
</div>

<div class="form-group col-md-12">
    <label class="text-semibold"> صور السيارة : </label>
    <div class="media no-margin-top">
        <div class="media-body">
            <input  type="file" class="file-styled" name="photo" data-height="200">
            <span class="help-block">الصيغ المسموح بها : gif, png, jpg , jpeg</span>
        </div>
    </div>

</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>