<div id="dir" >
    <div id="map" class="border-bottom" style="height: 500px;width: 100%"></div>
</div>

@section('script')
    {!! Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyBj4RhP7hWBjlajAqF1Gwsir-uF_jeS8-c&libraries=places&language=ar') !!}
    <script >
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 24.7128688, lng: 46.8126935},
                zoom: 9
            });

            if ($('#bounders').val()=='') {

                var bounds = [
                    {lat: 24.943944934407117, lng: 46.23451969062501},
                    {lat: 24.51485745266444, lng: 46.23451969062501},
                    {lat: 24.51485745266444, lng: 47.26998111640626},
                    {lat: 24.943944934407117, lng: 47.26998111640626}
                ];
            }else{
                var  bounds=JSON.parse($('#bounders').val());
                map.setCenter({
                    lat:bounds[0].lat,
                    lng:bounds[0].lng
                });
                map.setZoom(11);

            }

            // Construct the polygon.
            var color;
            if($('#color').val()==''){
                color='#ff0020';
            }else{
                color=$('#color').val();
            }
      /*      var Rectangle = new google.maps.Rectangle({
                bounds: bounds,
                fillColor:color,
                editable: true,
                draggable: true,
            });
            $('#color').change(function () {
               Rectangle.setOptions({fillColor:$('#color').val()});
            });
            Rectangle.setMap(map);

            Rectangle.addListener('bounds_changed',function () {
                console.log(Rectangle.getBounds().toJSON());
                $('#bounders').val(JSON.stringify(Rectangle.getBounds().toJSON()));
            });*/
            var marker = new google.maps.Marker({
                position: {lat:bounds[0].lat,lng:bounds[0].lng},
                map: map,
                draggable: true,
            });
            google.maps.event.addListener(marker, 'dragend', function(e) {
                $('#marker').val(JSON.stringify(marker.getPosition()));
            });
            var polygon = new google.maps.Polygon({
                paths: bounds,
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35,
                editable: true,
                draggable: true,

            });
            $('#color').change(function () {
                polygon.setOptions({fillColor:$('#color').val(),strokeColor:$('#color').val()});
            });
            polygon.setMap(map);
            polygon.getPaths().forEach(function(path, index) {
                google.maps.event.addListener(path, 'insert_at', function(){
                    console.log('insert');
                    console.log(pathToJSON(polygon.getPath().getArray()));
                });

                google.maps.event.addListener(path, 'remove_at', function(){
                    console.log('remove');
                    console.log(pathToJSON(polygon.getPath().getArray()));
                });

                google.maps.event.addListener(path, 'set_at', function(){
                    console.log('modified');
                    console.log(pathToJSON(polygon.getPath().getArray()));
                });
            });
            google.maps.event.addListener(polygon, 'dragend', function(){
                console.log('drag polygon');
                console.log(pathToJSON(polygon.getPath().getArray()));
            });




            /*  polygon.addListener('bounds_changed',function () {
              path=[];
              polygon.getPath().getArray().forEach(function (i) {
                  path.push({lat:i.lat(),lng:i.lng()});
              });
              $('#bounders').val(JSON.stringify(path));
              console.log(JSON.stringify(path));
          });*/



        }
        function pathToJSON(points){
            var path=[];
        points.forEach(function (i) {
                path.push({lat:i.lat(),lng:i.lng()});
            });
        path=JSON.stringify(path);
        $('#bounders').val(path);
        return path;
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
@endsection
