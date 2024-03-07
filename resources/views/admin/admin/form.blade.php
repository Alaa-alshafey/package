
@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@if (isset($user))
    <div class="form-group col-md-12 pull-left">
    <label>التفعيل</label>

             {!! Form::select("is_active",['1'=>'مفعل','0'=>'غير مفعل'],null,['class'=>'form-control'])!!}

    </div>
@endif
<div class="form-group col-md-12 pull-left">
    <label>الاسم  </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  الاسم  '])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>  الدولة  </label>  <span class="label bg-danger help-inline">  مطلوب </span>
    @if(!isset($user))
    {!! Form::select("country_id",countries(),'اختر الدولة ',['class'=>'form-control','id'=>'country_id','placeholder'=>'اختر الدولة  '])!!}
    @else
        {!! Form::select("country_id",countries(),$country_id,['class'=>'form-control','id'=>'country_id','placeholder'=>'اختر الدولة  '])!!}
    @endif
</div>

<div class="form-group col-md-12 pull-left">
    <label>المدينة </label>  <span class="label bg-danger help-inline">مطلوب</span>
    @if(!isset($user))
    <div id="cities">
    {!! Form::select("city_id",cities(),null,['class'=>'form-control','id'=>'city_id','placeholder'=>'اختر المدينة اولا '])!!}
    </div>
    @else
        {!! Form::select("city_id",cities(),$city_id,['class'=>'form-control','id'=>'city_id'])!!}

    @endif
</div>

<div class="form-group col-md-6 pull-left">
    <label> الإيميل </label>   <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'أكتب هنا  الايميل'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الجوال </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'أكتب هنا رقم الجوال'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> رقم الهوية </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::text("identity",null,['class'=>'form-control','placeholder'=>'أكتب هنا رقم الهوية'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>باسورد </label>   <span class="label bg-danger help-inline">مطلوب</span>
    <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد">
</div>

<div class="form-group col-md-6 pull-left">
    <label>   إعادة كتابة الباسورد </label> <span class="label bg-danger help-inline">مطلوب</span>
    <input type="password" class="form-control" name="password_confirmation" placeholder="أعد هنا كتابة الباسورد">
</div>

<div class="form-group col-md-6 pull-left">
    <label>    صورة العضو  </label> <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
    @if (isset($user))
    <img src="{{getimg($user->image)}}" class="img-preview">
    @endif
</div>

<div class="form-group col-md-6 pull-left">
    <label>    الوظيفة    </label>
    {!! Form::text("job",null,['class'=>'form-control '])!!}
</div>

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>    لينك اكونت  فيس بوك  </label>--}}
    {{--{!! Form::url("facebook_link",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>    لينك اكونت  انستجرام   </label>--}}
    {{--{!! Form::url("instagram_link",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}



<div class="form-group col-md-6 pull-left">
<label>النوع</label>
{!! Form::select("gender",['1'=>'ذكر','0'=>'انثى'],null,['class'=>'form-control'])!!}
</div>


{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>اختر  القسم الرئيسي  </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>--}}
    {{--{!! Form::select("category",$categories,null,['class'=>'form-control ','id'=>'area_id','placeholder'=>'اختر القسم الرئيسي '])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>   القسم الفرعى   </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>--}}
    {{--{!! Form::select("category_id",[],null,['class'=>'form-control','placeholder'=>'اختر القسم الرئيسى اولا'])!!}--}}
{{--</div>--}}


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@push('scripts')
    {{--<script>--}}
        {{--$('#country_id').change(function () {--}}

            {{--var val = $(this).val();--}}
            {{--var base_url = "{{asset('/')}}";--}}
            {{--if (val == "") {--}}
                {{--val = 0;--}}
            {{--}--}}
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--url: base_url + "/dashboard/regions/" + val,--}}
                {{--success: function (data) {--}}
                    {{--$('#cities').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
        {{--</script>--}}
    <script>
        $(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var cities;
            var regions;
            $("#country_id").on('change', function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url:"/dashboard/city/"+id,
                    type:"GET",
                    // error:function (data) {
                    //     // console.log();
                    //     if (data.status==401){
                    //         window.location.href='/sign_in';
                    //     }
                    // },
                }).done(function (data) {
                    // var newOption = new Option(data.text, data.id, false, false);
                    // $('#city_id').append(newOption).trigger('change');
                    cities=[];
                    if(data.length == 0)
                        data.push('لا توجد مدن فى هذه الدولة');
                    var val;
                    $.each(data, function(i,n){
                        val = i;
                        cities.push('<option value='+i+'>'+n+'</option>');
                    });
                    if(val == 0)
                        $('#city_id').attr('disabled',true);
                    else
                        $('#city_id').attr('disabled',false);
                    $('#city_id').find('option').remove().end().append(cities).attr('placeholder',"__('website.e-select-city')");
                    // $("#city_id").selectpicker('refresh');
                    // console.log(data);
                }).fail(function (error) {
                    console.log('error');
                });
            });

            $("#city_id").on('click', function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url:"/dashboard/region/"+id,
                    type:"GET",
                    // error:function (data) {
                    //     // console.log();
                    //     if (data.status==401){
                    //         window.location.href='/sign_in';
                    //     }
                    // },
                }).done(function (data) {
                    // var newOption = new Option(data.text, data.id, false, false);
                    // $('#city_id').append(newOption).trigger('change');
                    regions=[];
                    if(data.length == 0)
                        data.push('لا توجد احياء فى هذه المدينة');
                    var val;
                    $.each(data, function(i,n){
                        val = i;
                        regions.push('<option value='+i+'>'+n+'</option>');
                    });
                    if(val == 0)
                        $('#region_id').attr('disabled',true);
                    else
                        $('#region_id').attr('disabled',false);
                    $('#region_id').find('option').remove().end().append(regions).attr('placeholder',"__('website.e-select-city')");
                    // $("#city_id").selectpicker('refresh');
                    // console.log(data);
                }).fail(function (error) {
                    console.log('error');
                });
            });

        });
    </script>
@endpush
