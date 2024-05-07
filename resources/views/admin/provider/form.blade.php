@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="form-group">
    <label>نوع الشركة*</label>
    <select id="selectedCompany" name="provider_type" class="form-control">
        <option class="" value="">اختر النوع</option>
        <option selected = "<?= (isset($user) and (!$user->provider_type) and $user->provider_type == 'one')? "selected" : ""?>"


                value="one">فرد</option>
        <option selected="selected = "<?= (isset($user) and (!$user->provider_type) and $user->provider_type == 'company')? "selected" : ""?>"
                value="company">شركة</option>
    </select>
</div>


<div id="CompanySelect" style="display: none">
    <div class="form-group">
        <label>اختر نوع الشركة</label>
        <select name="provider_company_type" class="form-control" >
            <option <?php (isset($user) and (!$user->provider_company_type) and $user->provider_company_type == 'MNC')? 'selected' : ''?>
                    value="MNC" >قابضة</option>
            <option <?php (isset($user) and (!$user->provider_company_type) and $user->provider_company_type == 'LTD')? 'selected' : ''?>
                    value="LTD">مساهمة</option>
            <option <?php (isset($user) and (!$user->provider_company_type) and $user->provider_company_type == 'PVT')? 'selected' : ''?>
                    value="PVT">محددوده</option>
            <option <?php (isset($user) and (!$user->provider_company_type) and $user->provider_company_type == 'Registered')? 'selected' : ''?>
                    value="Registered">ناشئة</option>
        </select>
    </div>

</div>

<div class="form-group">
            <label >اختر مجال الخدمة : </label>

    {!! Form::select("ads_category",ad_category()
        ,(isset($user) and (!$user->ads_category)) ?$user->ads_category : null,['class'=>'form-group ','id'=>'','placeholder'=>'اختر مجال الخدمة'])!!}

</div>




<div class="form-group col-md-12 pull-left">
    <label>اختر  الدولة  </label>
    {!! Form::select("area_id",countries(),(isset($user)) ? $user->city->country->id : null,['class'=>'form-control ','id'=>'country_id','placeholder'=>'اختر الدولة'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>اختر  المدينة  </label>
    <div id="cities">
        {!! Form::select("city_id",cities(),(isset($user)) ? $user->city_id : null,['class'=>'form-control ','id'=>'city_id','placeholder'=>'اختر الدولة اولا '])!!}
    </div>
</div>
<!--
<div class="form-group col-md-12 pull-left">
    <label>اختر  الحى  </label>
    <div id="regions">
    </div>
</div>
-->
    <div class="form-group col-md-6 pull-left">
    <label>اختر  القسم الرئيسي  </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>
    {!! Form::select("main_category_id",category(),null,['class'=>'form-control ','id'=>'main_category_id','placeholder'=>'اختر القسم الرئيسي '])!!}
    </div>

    <div class="form-group col-md-6 pull-left">
    <label>   القسم الفرعى   </label> <span class="label bg-danger help-inline">مطلوب فقط للموردين</span>

        <div id="">
            {!! Form::select("category_id",subCategory(),null,['class'=>'form-control','id'=>'sub_category_id','placeholder'=>'اختر القسم الفرعى'])!!}
        </div>

    </div>

    <div class="form-group col-md-12 pull-left">
    <label>التفعيل</label>
        {!! Form::select("is_verified",['1'=>'مفعل','0'=>'غير مفعل'],(isset($user)? $user->is_verified : null),['class'=>'form-control'])!!}
    </div>

<div class="form-group col-md-6 pull-left">
    <label>الاسم  </label>
    {!! Form::text("name",(isset($user)? $user->name : null),['class'=>'form-control','placeholder'=>'  الاسم   '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> الإيميل </label>
    {!! Form::email("email",(isset($user)? $user->email : null),['class'=>'form-control','placeholder'=>'أكتب هنا  الايميل'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الجوال( مثال 966503955098) </label>
    {!! Form::text("phone",(isset($user)? $user->phone : null),['class'=>'form-control',
    'placeholder'=>'9665xxxxxxxx'])!!}
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
<div class="form-group col-md-6 pull-left">
    <label>    صورة العضو  </label>
    {!! Form::file("image",null,['class'=>'form-control '])!!}
    @if (isset($user))
    <img src="{{getimg($user->image)}}" class="img-preview">
    @endif
</div>




{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label> تفاصيل الخدمه  </label>--}}
    {{--{!! Form::text("service_details",null,['class'=>'form-control '])!!}--}}
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
    {{--{!! Form::text("birth_date",'03/18/2013',['class'=>'form-control daterange-single '])!!}--}}
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
                {{ Form::text('lat', isset($user)? $user->lat : 24.598411724742483,['id'=>'us_restaurant-lat','class'=>'form-control']) }}
            </div>
            <div class="col-sm-4">
                <label class="p-r-small  control-label">خط العرض </label>
            </div>
            <div class="col-sm-6">
                {{ Form::text('lng', isset($user)? $user->lng : 46.7138671875,['id'=>'us_restaurant-lon','class'=>'form-control']) }}
            </div>
            <div class="col-sm-4">
                <label class="p-r-small  control-label"> العنوان </label>
            </div>
            <div class="col-sm-6">
                {{ Form::text('address', isset($user)? $user->address : null,['id'=>'us_restaurant-address','class'=>'form-control']) }}
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>نبذة عنا ( قل شيئا سيراه الآخرون ) :
        </label>
        <textarea id="summary-ckeditor" class="form-control" rows="8" name="bio"
                  required>{{isset($user)? html_entity_decode($user->bio) : ''}}</textarea>

        @if ($errors->has('bio'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('bio') }}</strong>
            </span>
        @endif
    </div>
</div>





<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@push('scripts')
    {{--<script>--}}
        {{--$('#area_id').change(function () {--}}

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


        {{--$('#main_category_id').change(function () {--}}

            {{--var val = $(this).val();--}}
            {{--var base_url = "{{asset('/')}}";--}}
            {{--if (val == "") {--}}
                {{--val = 0;--}}
            {{--}--}}

            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--url: base_url + "/dashboard/subcategories/" + val,--}}
                {{--success: function (data) {--}}
                    {{--$('#sub_category_id').html(data);--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}



    {{--</script>--}}

    <script src="{{asset('admin\assets\js\plugins\pickers\location\location.js')}}"></script>


    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( 'summary-ckeditor',{
            contentsLangDirection: 'rtl',

        } );

    </script>

    <script type="text/javascript"
    src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAFy8ih8fexXMujtfjYR9OWU7iSKl34mjs&language=ar'></script>
    <script>

        $('#map').locationpicker({
            location: {
                latitude: "{{isset($user) ? $user->lat : 24.22516268491576}}",
                longitude:"{{isset($user) ? $user->lng : 39.67321093749998}}"
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

            var subCategory;
            $("#main_category_id").on('change', function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url:"/dashboard/sub_category/"+id,
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
                    subCategory=[];
                    if(data.length == 0)
                        data.push('لا توجد اقسام فرعية فى هذا القسم');
                    var val;
                    $.each(data, function(i,n){
                        val = i;
                        subCategory.push('<option value='+i+'>'+n+'</option>');
                    });
                    if(val == 0)
                        $('#sub_category_id').attr('disabled',true);
                    else
                        $('#sub_category_id').attr('disabled',false);
                    $('#sub_category_id').find('option').remove().end().append(subCategory).attr('placeholder',"__('website.e-select-city')");
                    // $("#city_id").selectpicker('refresh');
                    // console.log(data);
                }).fail(function (error) {
                    console.log('error');
                });

            });

            var service;
            $("#sub_category_id").on('click', function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url:"/dashboard/getServices/"+id,
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
                    service=[];
                    if(data.length == 0)
                        data.push('لا توجد خدمات فى هذا القسم الفرعى');
                    var val;
                    $.each(data, function(i,n){
                        val = i;
                        service.push('<option value='+i+'>'+n+'</option>');
                    });
                    if(val == 0)
                        $('#service_id').attr('disabled',true);
                    else
                        $('#service_id').attr('disabled',false);
                    $('#service_id').find('option').remove().end().append(service).attr('placeholder',"__('website.e-select-city')");
                    // $("#city_id").selectpicker('refresh');
                    // console.log(data);
                }).fail(function (error) {
                    console.log('error');
                });

            });

            var selectedItem = $("#selectedCompany"). children("option:selected"). val();
            if(selectedItem == 'company'){
                $('#CompanySelect').css('display','block');
            }else {
                $('#CompanySelect').css('display','none');
            }

            $('#selectedCompany').change(function () {
                var selectedItem = $(this). children("option:selected"). val();
                if(selectedItem == 'company'){
                    $('#CompanySelect').css('display','block');
                }else {

                    $('#CompanySelect').css('display','none');
                }
            })


        });



    </script>
@endpush