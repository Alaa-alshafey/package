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
    <label>الاسم  </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  الاسم  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الإيميل </label>   <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'أكتب هنا  الايميل'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الجوال </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::number("phone",null,['class'=>'form-control','placeholder'=>'أكتب هنا رقم الجوال'])!!}
</div>

@if(!isset($user))
    <div class="form-group col-md-6 pull-left">
        <label>باسورد </label>
        <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد">
    </div>

    <div class="form-group col-md-6 pull-left">
        <label>   إعادة كتابة الباسورد </label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="أعد هنا كتابة الباسورد">
    </div>


@endif



<div class="form-group col-md-12 pull-left">
    <label>اختر  الدولة  </label>  <span class="label bg-danger help-inline">مطلوب</span>
    {!! Form::select("country_id",countries(),isset($user)?$user->city->country->id:null,['class'=>'form-control ','id'=>'country_id','placeholder'=>'اختر الدولة'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اختر  المدينة  </label>  <span class="label bg-danger help-inline">مطلوب</span>

        <div id="cities">
            {!! Form::select("city_id",cities(),null,['class'=>'form-control ','id'=>'city_id','placeholder'=>'اختر المدينة اولا '])!!}
        </div>

</div>

 <div class="form-group col-md-12 pull-left">
     <label>التفعيل</label>
        {!! Form::select("is_verified",['1'=>'مفعل','0'=>'غير مفعل'],null,['class'=>'form-control'])!!}

 </div>

<div class="form-group col-md-6 pull-left">
    <label>    صورة العضو  </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
    @if (isset($user))
    <img src="{{getimg($user->image)}}" class="img-preview">
    @endif
</div>

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>    الوظيفة    </label>--}}
    {{--{!! Form::text("job",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>    لينك اكونت  فيس بوك  </label>--}}
    {{--{!! Form::url("facebook_link",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>    لينك اكونت  انستجرام   </label>--}}
    {{--{!! Form::url("instagram_link",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}


{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>  تاريخ الميلاد   </label>--}}
    {{--{!! Form::date("birth_date",null,['class'=>'form-control '])!!}--}}
{{--</div>--}}



{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>اختر  القسم الرئيسي  </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>--}}
    {{--{!! Form::select("category",$categories,null,['class'=>'form-control ','id'=>'area_id','placeholder'=>'اختر القسم الرئيسي '])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label>   القسم الفرعى   </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>--}}
    {{--{!! Form::select("category_id",[],null,['class'=>'form-control','placeholder'=>'اختر القسم الرئيسى اولا'])!!}--}}
{{--</div>--}}

<div class="form-group col-md-12 pull-left">

    <label>    العنوان على الخريطة  </label>

    <div class="form-group">
        <div id="map" style="width: 100%; height: 300px;"></div>

        <div class="clearfix">&nbsp;</div>
        <div class="m-t-small">
            <div class="col-sm-4">
                <label class="p-r-small control-label">خط الطول</label>
            </div>
            <div class="col-sm-6">
                {{ Form::text('lat', null,['id'=>'us_restaurant-lat','class'=>'form-control']) }}
            </div>
            <div class="col-sm-4">
                <label class="p-r-small  control-label">خط العرض </label>
            </div>
            <div class="col-sm-6">
                {{ Form::text('lng', null,['id'=>'us_restaurant-lon','class'=>'form-control']) }}
            </div>
            <div class="col-sm-4">
                <label class="p-r-small  control-label"> العنوان </label>
            </div>
            <div class="col-sm-6">
                {{ Form::text('address', null,['id'=>'us_restaurant-address','class'=>'form-control']) }}
            </div>
        </div>
    </div>
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@push('scripts')
    {{--<script>--}}
        {{--$("#country_id").change(function () {--}}
            {{--var country_id = $("#country_id").val();--}}
            {{--console.log(country_id);--}}
            {{--var base_url = "{{asset('/')}}";--}}
            {{--$.ajax({--}}
                {{--type: 'get',--}}
                {{--url: base_url + "dashboard/ajax_country/" + country_id,--}}
                {{--success: function (data) {--}}
                    {{--console.log(data);--}}
                    {{--$.each(data, function (key, value) {--}}
                        {{--var option = '<option value="' + value.id + '">' + value.ar_name + '</option>';--}}
                        {{--$("#city_id").append(option);--}}
                    {{--});--}}
                {{--},--}}
                {{--error: function () {--}}

                {{--}--}}
            {{--});--}}

        {{--});--}}


    {{--</script>--}}
    <script src="{{asset('admin\assets\js\plugins\pickers\location\location.js')}}"></script>
    <script type="text/javascript"
    src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAFy8ih8fexXMujtfjYR9OWU7iSKl34mjs&language=ar'></script>
    <script>
        $('#map').locationpicker({
            location: {
                latitude: "{{isset($user) ? $user->lat : 24.671042662570517}}",
                longitude:"{{isset($user) ? $user->lng : 46.608573781250016}}"
            },
            radius: 300,
            inputBinding: {
                latitudeInput: $('#us_restaurant-lat'),
                longitudeInput: $('#us_restaurant-lon'),
                locationNameInput: $('#us_restaurant-address')
            },
            enableAutocomplete: false,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
    </script>

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
