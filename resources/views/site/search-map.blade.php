@extends('layouts.app')

@section('content')


@push('style')

    <style>
    #map {
    height: 100%;
    width: 100%;
    }
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    }
    .label {
    color: #000;
    background-color: white;
    border: 1px solid #000;
    font-family: "Lucida Grande", "Arial", sans-serif;
    font-size: 12px;
    text-align: center;
    white-space: nowrap;
    padding: 2px;
    }
    .label.green {
    background-color: #58D400;
    }
    .label.red {
    background-color: #D80027;
    color: #fff;
    }
    .label.yellow {
    background-color: #FCCA00;
    }
    .label.turquoise {
    background-color: #00D9D2;
    }
    .label.brown {
    background-color: #BF5300;
    color: #fff;
    }


    .select2-container--default .select2-selection--single{
        border: none;
    }
    .selectdiv{
        overflow: hidden;
        padding: 3px;border-radius: 24px;
        background: #fff !important;
    }

    .select2-results__group{ background-color:#006bb3; color: #fff}

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
        color: #fff;
        background-color: #808080;
    }
    </style>
<script src="http://cdn.sobekrepository.org/includes/gmaps-markerwithlabel/1.9.1/gmaps-markerwithlabel-1.9.1.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&callback=initMap&language=ar" type="text/javascript"></script>

@endpush

<div class="department">
    <div class="container">
        <h1 class=""><span>البحث بالموقع : </span></h1>
         <div class="row">
{{--            <div class="col-xs-12 col-sm-4 col-md-3">--}}
{{--                <div class="search-form">--}}
{{--                    <form method="post" action="/ar/guestaction/searchonGoogleMap_sp">--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control" id="Country" name="Country">--}}
{{--                                <option selected disabled>اختر الدولة</option>--}}
{{--                                <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>--}}
{{--                                <option value="البحرين ">البحرين </option>--}}
{{--                                <option value="الكويت ">الكويت </option>--}}
{{--                                <option value="المملكة العربية السعودية">المملكة العربية السعودية</option>--}}
{{--                                <option value="عمان ">عمان </option>--}}

{{--                            </select>--}}


{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control" id="browsers1" name="City">--}}
{{--                                <option selected disabled>اختر المدينة</option>--}}
{{--                                <option value="أبها ">أبها </option>--}}
{{--                                <option value="الأحساء ">الأحساء </option>--}}
{{--                                <option value="الباحة ">الباحة </option>--}}
{{--                                <option value="الجبيل ">الجبيل </option>--}}
{{--                                <option value="الخبر ">الخبر </option>--}}
{{--                                <option value="الخرج ">الخرج </option>--}}
{{--                                <option value="الدمام">الدمام</option>--}}
{{--                                <option value="الرياض">الرياض</option>--}}
{{--                                <option value="الطائف ">الطائف </option>--}}
{{--                                <option value="الظهران ">الظهران </option>--}}
{{--                                <option value="القصيم ">القصيم </option>--}}
{{--                                <option value="القنفذة ">القنفذة </option>--}}
{{--                                <option value="الكويت العاصمة">الكويت العاصمة</option>--}}
{{--                                <option value="المدينة المنورة ">المدينة المنورة </option>--}}
{{--                                <option value="المنامة">المنامة</option>--}}
{{--                                <option value="بيشة ">بيشة </option>--}}
{{--                                <option value="تبوك">تبوك</option>--}}
{{--                                <option value="جدة ">جدة </option>--}}
{{--                                <option value="جيزان ">جيزان </option>--}}
{{--                                <option value="حائل ">حائل </option>--}}
{{--                                <option value="حفر الباطن ">حفر الباطن </option>--}}
{{--                                <option value="دبي">دبي</option>--}}
{{--                                <option value="رأس تنورة ">رأس تنورة </option>--}}
{{--                                <option value="مسقط ">مسقط </option>--}}
{{--                                <option value="مكة المكرمة ">مكة المكرمة </option>--}}
{{--                                <option value="نجران ">نجران </option>--}}
{{--                                <option value="وادي الدواسر ">وادي الدواسر </option>--}}
{{--                                <option value="ينبع ">ينبع </option>--}}

{{--                            </select>--}}


{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control" id="browsers2" name="Department">--}}
{{--                                <option selected disabled>اختر القسم</option>--}}
{{--                                <option value=" العروض التقديمية "> العروض التقديمية </option>--}}
{{--                                <option value=" الواقع الافتراضي VR"> الواقع الافتراضي VR</option>--}}
{{--                                <option value="أفكار دعائية حصرية ">أفكار دعائية حصرية </option>--}}
{{--                                <option value="أنظمة الصوت والضوء">أنظمة الصوت والضوء</option>--}}
{{--                                <option value="الإنتاج والإخراج الفني ">الإنتاج والإخراج الفني </option>--}}
{{--                                <option value="البحوث والخدمات الإلكترونية ">البحوث والخدمات الإلكترونية </option>--}}
{{--                                <option value="التحليل والنقد الإعلامي">التحليل والنقد الإعلامي</option>--}}
{{--                                <option value="التسويق الإلكتروني">التسويق الإلكتروني</option>--}}
{{--                                <option value="التصميم الهندسي ">التصميم الهندسي </option>--}}
{{--                                <option value="التصوير الرقمي">التصوير الرقمي</option>--}}
{{--                                <option value="التغطيات الإعلامية ">التغطيات الإعلامية </option>--}}
{{--                                <option value="التمثيل">التمثيل</option>--}}
{{--                                <option value="الحملات الدعائية والانتخابية">الحملات الدعائية والانتخابية</option>--}}
{{--                                <option value="الرسوم الكرتونية المتحركة">الرسوم الكرتونية المتحركة</option>--}}
{{--                                <option value="الطباعة الرقمية ">الطباعة الرقمية </option>--}}
{{--                                <option value="الفن التشكيلي والخط ">الفن التشكيلي والخط </option>--}}
{{--                                <option value="القصاصون والرواة">القصاصون والرواة</option>--}}
{{--                                <option value="المناهج الإلكترونية">المناهج الإلكترونية</option>--}}
{{--                                <option value="المهارات الإذاعية ">المهارات الإذاعية </option>--}}
{{--                                <option value="المواهب الفنية والإنشاد">المواهب الفنية والإنشاد</option>--}}
{{--                                <option value="تصميم إنفو جرافيك">تصميم إنفو جرافيك</option>--}}
{{--                                <option value="تصميم الأزياء والمجوهرات ">تصميم الأزياء والمجوهرات </option>--}}
{{--                                <option value="تصميم المجسمات">تصميم المجسمات</option>--}}
{{--                                <option value="تصميم جرافيك - مطبوعات">تصميم جرافيك - مطبوعات</option>--}}
{{--                                <option value="تصميم مواقع وتطبيقات ">تصميم مواقع وتطبيقات </option>--}}
{{--                                <option value="تصميم وسائل تعليمية ">تصميم وسائل تعليمية </option>--}}
{{--                                <option value="تطبيقات أوفيس">تطبيقات أوفيس</option>--}}
{{--                                <option value="تقديم دورات جرافيك">تقديم دورات جرافيك</option>--}}
{{--                                <option value="تقنيات رقمية حديثة  ">تقنيات رقمية حديثة  </option>--}}
{{--                                <option value="تنظيم الاحتفالات واللقاءات ">تنظيم الاحتفالات واللقاءات </option>--}}
{{--                                <option value="شاشات العرض التفاعلية">شاشات العرض التفاعلية</option>--}}
{{--                                <option value="فرق العروض الترفيهية">فرق العروض الترفيهية</option>--}}
{{--                                <option value="هدايا دعائية وإعلانية ">هدايا دعائية وإعلانية </option>--}}
{{--                                <option value="هوية الزي الموحد ">هوية الزي الموحد </option>--}}

{{--                            </select>--}}

{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <button type="submit"><i class="fa fa-search"></i> البحث</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <script type="text/javascript">--}}
{{--                var geocoder;--}}
{{--                var map;--}}
{{--                var location1 = 'AMS Softech, Thokar No 8, Block C, Jamia Nagar, Okhla, New Delhi, Delhi, India';--}}

{{--                function initialize() {--}}
{{--                    geocoder = new google.maps.Geocoder();--}}
{{--                    var latlng = new google.maps.LatLng(-34.397, 150.644);--}}
{{--                    var myOptions = {--}}
{{--                        zoom: 15,--}}
{{--                        center: latlng,--}}
{{--                        mapTypeControl: true,--}}
{{--                        mapTypeControlOptions: {--}}
{{--                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU--}}
{{--                        },--}}
{{--                        navigationControl: true,--}}
{{--                        mapTypeId: google.maps.MapTypeId.ROADMAP--}}
{{--                    };--}}
{{--                    map = new google.maps.Map(document.getElementById("map_canvas1"), myOptions);--}}
{{--                    if (geocoder) {--}}
{{--                        geocoder.geocode({--}}
{{--                            'address': location1,--}}

{{--                        }, function(results, status) {--}}
{{--                            if (status == google.maps.GeocoderStatus.OK) {--}}
{{--                                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {--}}
{{--                                    map.setCenter(results[0].geometry.location);--}}

{{--                                    var infowindow = new google.maps.InfoWindow({--}}
{{--                                        // content: '<b><a href="/en/guest/index">' + address + '</a></b>Md Shamsuddin<br/>Developer',--}}
{{--                                        content: '<b><a href="/en/guest/index" target="_blank">Amssoftech</a></b>Md Shamsuddin<br/>Developer',--}}
{{--                                        size: new google.maps.Size(150, 50)--}}
{{--                                    });--}}

{{--                                    var marker = new google.maps.Marker({--}}
{{--                                        position: results[0].geometry.location,--}}
{{--                                        map: map,--}}
{{--                                        title: location1--}}
{{--                                    });--}}
{{--                                    infowindow.open(map, marker);//on load show the location--}}
{{--                                    google.maps.event.addListener(marker, 'click', function() {--}}
{{--                                        infowindow.open(map, marker);--}}
{{--                                    });--}}

{{--                                } else {--}}
{{--                                    alert("No results found");--}}
{{--                                }--}}
{{--                            } else {--}}
{{--                                alert("Geocode was not successful for the following reason: " + status);--}}
{{--                            }--}}
{{--                        });--}}
{{--                    }--}}
{{--                }--}}
{{--                google.maps.event.addDomListener(window, 'load', initialize);--}}
{{--            </script>--}}

{{--            <script type="text/javascript">--}}
{{--                var locations1 = [--}}
{{--                    ['Location 1 Name', 'New York, NY', 'Location 1 URL'],--}}
{{--                    ['Location 2 Name', 'Newark, NJ', 'Location 2 URL'],--}}
{{--                    ['Location 3 Name', 'Philadelphia, PA', 'Location 3 URL']--}}
{{--                ];--}}

{{--                var locations = [--}}

{{--                    [' Studio Mix Pro', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/151'],--}}

{{--                    ['Abdullah Alamri', 'المدينة المنورة Saudi Arabia', '/ar/guest/user-profile/469'],--}}

{{--                    ['Alattas agency', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/236'],--}}

{{--                    ['algram2011195', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/402'],--}}

{{--                    ['cerative', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/140'],--}}

{{--                    ['شركة ملتقى احلى النجوم', 'طريق الامام سعود بن عبدالعزيز بن محمد الفرعي، الرياض السعودية', '/ar/guest/user-profile/508'],--}}

{{--                    ['event plus', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/181'],--}}

{{--                    ['fayez', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/401'],--}}

{{--                    ['goldenthoughts', 'Riyadh, Al Jubail Saudi Arabia', '/ar/guest/user-profile/412'],--}}

{{--                    ['hakamie', 'الجبيل Saudi Arabia', '/ar/guest/user-profile/483'],--}}

{{--                ];--}}

{{--                var geocoder;--}}
{{--                var map;--}}
{{--                var bounds = new google.maps.LatLngBounds();--}}

{{--                function initialize() {--}}


{{--                    var latlng = new google.maps.LatLng(-34.397, 150.644);--}}
{{--                    var myOptions = {--}}
{{--                        zoom: 15,--}}
{{--                        center: latlng,--}}
{{--                        mapTypeControl: true,--}}
{{--                        mapTypeControlOptions: {--}}
{{--                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU--}}
{{--                        },--}}
{{--                        navigationControl: true,--}}
{{--                        mapTypeId: google.maps.MapTypeId.ROADMAP--}}
{{--                    };--}}
{{--                    map = new google.maps.Map(document.getElementById("shams_map"), myOptions);--}}

{{--                    for (i = 0; i < locations.length; i++) {--}}


{{--                        geocodeAddress(locations, i);--}}
{{--                    }--}}
{{--                }--}}
{{--                google.maps.event.addDomListener(window, "load", initialize);--}}

{{--                function geocodeAddress(locations, i) {--}}
{{--                    var title = locations[i][0];--}}
{{--                    var address = locations[i][1];--}}
{{--                    var url = locations[i][2];--}}
{{--                    geocoder.geocode({--}}
{{--                            'address': locations[i][1]--}}
{{--                        },--}}

{{--                        function(results, status) {--}}
{{--                            if (status == google.maps.GeocoderStatus.OK) {--}}
{{--                                var marker = new google.maps.Marker({--}}
{{--                                    //icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',--}}
{{--                                    icon: '/common/sheari-map-icon.png',--}}
{{--                                    map: map,--}}
{{--                                    position: results[0].geometry.location,--}}
{{--                                    title: title,--}}
{{--                                    animation: google.maps.Animation.DROP,--}}
{{--                                    address: address,--}}
{{--                                    url: url--}}
{{--                                })--}}
{{--                                infoWindow(marker, map, title, address, url);--}}
{{--                                bounds.extend(marker.getPosition());--}}
{{--                                map.fitBounds(bounds);--}}
{{--                            } else {--}}
{{--                                alert("geocode of " + address + " failed:" + status);--}}
{{--                            }--}}
{{--                        });--}}
{{--                }--}}

{{--                function infoWindow(marker, map, title, address, url) {--}}

{{--                    // var html ='<img src="" alt="" style="float:left; width:100px; height:100px;"/> <div style="float:left;"><div><b>"' + title + '"</b><p>"' + address + '"<br></div><div><a href="' + url + '" target="_blank">View Profile</a></p></div></div>';--}}
{{--//   var html = "<div><b>" + title + "</b><p>" + address + "<br></div><div><a href='" + url + "' target='_blank'>View Profile</a></p></div>";--}}
{{--//    iw = new google.maps.InfoWindow({--}}
{{--//      content: html,--}}
{{--//      maxWidth: 350--}}
{{--//    });--}}
{{--//    iw.open(map, marker);--}}

{{--                    google.maps.event.addListener(marker, 'click', function() {--}}
{{--                        var html = "<div><h3>" + title + "</h3><p>" + address + "<br></div><div><a href='" + url + "' target='_blank'>اطلب الان</a></p></div>";--}}
{{--                        iw = new google.maps.InfoWindow({--}}
{{--                            content: html,--}}
{{--                            maxWidth: 350--}}
{{--                        });--}}
{{--                        iw.open(map, marker);--}}
{{--                    });--}}
{{--                }--}}

{{--                function createMarker(results) {--}}
{{--                    var marker = new google.maps.Marker({--}}
{{--                        icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png',--}}
{{--                        map: map,--}}
{{--                        position: results[0].geometry.location,--}}
{{--                        title: title,--}}
{{--                        animation: google.maps.Animation.DROP,--}}
{{--                        address: address,--}}
{{--                        url: url--}}
{{--                    })--}}
{{--                    bounds.extend(marker.getPosition());--}}
{{--                    map.fitBounds(bounds);--}}
{{--                    infoWindow(marker, map, title, address, url);--}}
{{--                    return marker;--}}
{{--                }--}}
{{--            </script>--}}
             <div class="col-xs-12 col-sm-4 col-md-3">
                 <div class="search-form">
                     <form method="post" action="#">

                         <div class="form-group">
                             {!! Form::select("country_id",countries(),null,['class'=>'form-control select2','id'=>'country_id','placeholder'=>'اختر الدولة', 'required'])!!}
                         </div>
                         <div class="form-group"  id="DIVCity">

                             {!! Form::select("city_id",cities(),null,['class'=>'form-control select2','id'=>'city_id','placeholder'=>'اختر المدينة ' ,'disabled'])!!}

                         </div>
                         <div class="form-group">
                             <select id="category_id"
                                     name="category_id"
                                     class="form-group form-control select2" style="border: none">

                                 <option value="">اختر القسم</option>

                                 @if(categories())
                                     @foreach(categories() as $category)
                                         @if($category->subCategories)
                                             <optgroup class="category"  label="{{$category->ar_name}}">
                                                 @foreach($category->subCategories as $subCategory)
                                                     <option value="{{$subCategory->id}}">{{$subCategory->ar_name}}</option>
                                                 @endforeach
                                             </optgroup>
                                         @endif
                                     @endforeach
                                 @endif
                             </select>
                         </div>
                         <div class="form-group">
                             <button style="border: none;
padding: 0px;
border-radius: 5px !important;" type="button" id="search_btn"><i class="fa fa-search"></i> البحث</button>
                         </div>
                     </form>
                 </div>
             </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="map-back">
                    <div id="map" style="width:100%; height:500px; padding: 5px;border: 10px solid #ccc;"></div>
                </div>
            </div>

             <style>
                 .form-group select{
                     border-radius: 14px !important;
                     border: 1px solid #ccc;
                 }
             </style>


         </div>
    </div>
</div>


@push('script')


        <script>
            $('#search_btn').click(function () {


                var country_id= $('#country_id').val();
                var city_id= $('#city_id').val();
                var category_id= $('#category_id').val();

                initMap2(country_id,city_id,category_id );
            });


            $('#country_id').change(function () {

                var val = $(this).val();
                var base_url = "{{asset('/')}}";
                if (val == "") {
                    val = 0;
                }

                $.ajax({
                    type: "GET",
                    url: base_url + "regions2/" + val,
                    success: function (data) {

                        $('#DIVCity').html(data);
                    }
                });
            });
        </script>

<script>

    function initMap() {
        var bp = {lat: 22.184863065758872, lng: 46.04631};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: bp
        });
        var locations;
        $.getJSON( "/getCleaners", function( data ) {
            locations=data;
            var image = "{{asset('map.png')}}";
            for (var i = 0; i < locations.length; i++) {
                var item = locations[i];
                var place = locations[i];
                var myLatLng = new google.maps.LatLng(place[1], place[2]);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: image,
                    shape: image,
                    title: place[0],
                    // label: {
                    //     text: place[0],
                    //     color: "#176083",
                    //     fillColor:'red',
                    //     fontSize: "15px",
                    //     fontWeight: "bold"
                    // },
                    zIndex: place[3],
                    url: place[6]
                });


                google.maps.event.addListener(marker, 'click', function() {
                    window.location.href = this.url;
                });

                // var contentString = i+' :66666';
                // infowindow = new google.maps.InfoWindow({
                //     content: contentString
                // });
                var infowindow = new google.maps.InfoWindow(); /* SINGLE */

                google.maps.event.addListener(marker, "mouseover", function (e) {
                    infowindow.close();
                    infowindow.setContent( '<a href='+'"'+this.url+'"'+'</a>'+ this.title );
                    infowindow.open(map, this);

                });


                // var marker = new MarkerWithLabel({
                //     position: {lat: item[1], lng: item[2]},
                //     map: map,
                //     icon: icons[item[3]].url,
                //     labelContent: item[0],
                //     labelAnchor: new google.maps.Point(item[4], item[5]),
                //     // the CSS class for the label
                //     labelClass: "label " + item[3],
                //     labelInBackground: true
                // });
                //
                // google.maps.event.addListener(marker, 'click', function() {
                //     window.location.href = this.url;
                // });
            }
        });



    }
    function initMap2(country_id,city_id,category_id) {

        var bp = {lat: 22.184863065758872, lng: 46.04631};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: bp
        });
        var locations;
        $url='{{asset('/')}}getCleaners?country_id='+country_id+'&city_id='+city_id+'&category_id='+category_id;
        $.getJSON($url, function( data ) {
            locations=data;
            var icons = {
                'green': {
                    url: "{{asset('map.png')}}",
                    color: '#58D400'
                },
                'yellow': {
                    url: "{{asset('map.png')}}",
                    color: '#FCCA00'
                },
                'red': {
                    url: "{{asset('map.png')}}",
                    color: '#D80027'
                },
                'turquoise': {
                    url: "{{asset('map.png')}}",
                    color: '#00D9D2'
                },
                'brown': {
                    url: "{{asset('map.png')}}",
                    color: '#BF5300'
                }
            };
            var image = "{{asset('map.png')}}";
            var shape = {
                coord: [1, 1, 1, 20, 18, 20, 18 , 1],
                type: 'poly'
            };
            for (var i = 0; i < locations.length; i++) {
                var item = locations[i];
                var place = locations[i];
                var myLatLng = new google.maps.LatLng(place[1], place[2]);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: image,
                    shape: image,
                    title: place[0],
                    // label: {
                    //     text: place[0],
                    //     color: "#176083",
                    //     fillColor:'red',
                    //     fontSize: "15px",
                    //     fontWeight: "bold"
                    // },
                    zIndex: place[3],
                    url: place[6]
                });


                google.maps.event.addListener(marker, 'click', function() {
                    window.location.href = this.url;
                });

                // var contentString = i+' :66666';
                // infowindow = new google.maps.InfoWindow({
                //     content: contentString
                // });
                var infowindow = new google.maps.InfoWindow(); /* SINGLE */

                google.maps.event.addListener(marker, "mouseover", function (e) {
                    infowindow.close();
                    infowindow.setContent( '<a href='+'"'+this.url+'"'+'</a>'+ this.title );
                    infowindow.open(map, this);

                });


                // var marker = new MarkerWithLabel({
                //     position: {lat: item[1], lng: item[2]},
                //     map: map,
                //     icon: icons[item[3]].url,
                //     labelContent: item[0],
                //     labelAnchor: new google.maps.Point(item[4], item[5]),
                //     // the CSS class for the label
                //     labelClass: "label " + item[3],
                //     labelInBackground: true
                // });
                //
                // google.maps.event.addListener(marker, 'click', function() {
                //     window.location.href = this.url;
                // });
            }
        });



    }
    initMap();
</script>
    @endpush
@endsection
