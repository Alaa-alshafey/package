<div id="dir" >
    <label> </label>
  {{--  <input id="searchInput" class="controls" type="text" name="place[]" >--}}
    <div id="map" class="border-bottom" style="height: 500px"></div>
    <ul id="geoData" style="display:none;">
        <li>Full Address: <span id="location"></span></li>
        <li>Postal Code: <span id="postal_code"></span></li>
        <li>Country: <span id="country"></span></li>


        <li>Latitude: <span id="lat"></span></li>
        <li>Longitude: <span id="lon"></span></li>
    </ul>


</div>

@section('script')
{!! Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&libraries=places&language=ar') !!}
<script >
    function initMap() {
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var init = new google.maps.LatLng(parseFloat($('#start_lat').val()), parseFloat($('#start_lng').val()));
        directionsDisplay = new google.maps.DirectionsRenderer();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: init,
            zoom: 8
        });
        google.maps.event.trigger(map, "resize");

        directionsDisplay.setMap(map);

        var start ={lat: parseFloat($('#start_lat').val()), lng: parseFloat($('#start_lng').val())};
        var end ={lat: parseFloat($('#end_lat').val()), lng: parseFloat($('#end_lng').val())};

        var start_marker = new google.maps.Marker({
            position: start,
            map: map,
            label:'A',
            title: 'start'
        });
        var end_marker = new google.maps.Marker({
            position: end,
            map: map,
            label:'B',
            title: 'end'
        });


    }
/*    function mapLocation() {
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var start = new google.maps.LatLng(parseFloat($('#start_lat').val()), parseFloat($('#start_lng').val()));
            var mapOptions = {
                zoom: 7,
                center: start
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);
            google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
        }

        function calcRoute() {
            var start =  google.maps.LatLng(parseFloat($('#start_lat').val()), parseFloat($('#start_lng').val()));
            //var end = new google.maps.LatLng(38.334818, -181.884886);
            var end =  google.maps.LatLng(parseFloat($('#end_lat').val()), parseFloat($('#end_lng').val()));
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    directionsDisplay.setMap(map);
                } else {
                    alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
                }
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }
    mapLocation();*/

    google.maps.event.addDomListener(window, 'load', initMap);
</script>
    @endsection
