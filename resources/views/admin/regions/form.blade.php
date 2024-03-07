
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
    <label>اختر  المنطقة  </label>
    @if (!isset($region))
    {!! Form::select("country_id",$country,null,['class'=>'form-control ','id'=>'country_id','placeholder'=>'اختر الدولة'])!!}
    @else
        {!! Form::select("country_id",$country,$region->city->country->id,['class'=>'form-control ','id'=>'country_id','placeholder'=>'اختر الدولة'])!!}
    @endif
</div>

<div class="form-gr oup col-md-12 pull-left">
    <label>اختر  المدينة  </label>

    @if (!isset($region))
        <div id="cities">
            {!! Form::select("city_id",[],null,['class'=>'form-control ','id'=>'area','placeholder'=>'اختر الدولة اولا '])!!}
        </div>
    @else
        <div id="cities">
            {!! Form::select("city_id",cities(),null,['class'=>'form-control ','id'=>'area','placeholder'=>'اختر المدينة اولا '])!!}
        </div>
    @endif

</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم الحي </label>
    {!! Form::text("ar_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الحي باللغة العربية  هنا'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اسم الحي بالانجليزية </label>
    {!! Form::text("en_name",null,['class'=>'form-control ','placeholder'=>'اكتب اسم الحي   باللغة الانجليزية هنا'])!!}
</div>

<br>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>


    @push('scripts')
        <script>
            $('#country_id').change(function () {
                var val = $(this).val();
                var base_url = "{{asset('/')}}";
                if (val == "") {
                    val = 0;
                }
                $.ajax({
                    type: "GET",
                    url: base_url + "dashboard/regions/" + val,
                    success: function (data) {
                        $('#cities').html(data);
                    }
                });
            });

        </script>
    @endpush
