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
    <label>اختر نوع القسم الرئيسي</label>
    {!! Form::select("type", ['normal' => 'قسم عادى', 'ads' => 'قسم اعلانات'], null, ['class' => 'form-control', 'id' => 'area_id', 'placeholder' => 'اختر نوع القسم الرئيسي']) !!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم القسم باللغة العربية</label>
    {!! Form::text("ar_name", null, ['class' => 'form-control', 'placeholder' => 'اكتب اسم القسم هنا']) !!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم القسم بالانجليزية</label>
    {!! Form::text("en_name", null, ['class' => 'form-control', 'placeholder' => 'اكتب اسم القسم هنا']) !!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>حالة العرض</label><br>
    {!! Form::radio("status", 1, true) !!} عرض
    {!! Form::radio("status", 0) !!} عدم العرض
</div>

@if (isset($category->image_price))
    <div class="form-group col-md-12 pull-left">
        <label>صورة قائمة الاسعار الحالية:</label>
        <img class="img-preview" src="{{ getimg($category->image_price) }}">
    </div>
@endif

<div class="form-group col-md-12 pull-left">
    <label>صورة بقائمة الاسعار</label>
    {!! Form::file("image_price", null, ['class' => 'form-control']) !!}
</div>
@if (isset($category->image))
    <div class="form-group col-md-12 pull-left">
        <label>صورة القسم الرئيسى الحالية:</label>
        <img class="img-preview" src="{{ getimg($category->image) }}">
    </div>
@endif

<div class="form-group col-md-12 pull-left">
    <label>صورة القسم الرئيسى</label>
    {!! Form::file("image", null, ['class' => 'form-control']) !!}
</div>



<br>
<br>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
