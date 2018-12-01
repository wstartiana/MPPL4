@extends('templates.master')

@section('content')
<div id="map" style="width: 1500px; height: 500px"></div></align> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJfQgQL9MaM83aHUs5vxwi6O6JeVoU63Y&libraries=places&callback=initAutocomplete" async defer></script>
<script>
        var myLatlng = [
            @foreach ($result as $data)
                {lat: {{ $data->latitude}}, lng: {{ $data->longitude}} },
            @endforeach
        ];
        var myS = [
            @foreach ($result as $data)
                "{{ $data->nama_sekolah}}",
            @endforeach
        ];
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -6.554364, lng: 106.723409},
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var request = {
            location: {lat: -6.554364, lng: 106.723409},
            radius: '1500',
            type: ['school']
        };
        var banyak = myLatlng.length;
        // console.log(myLatlng.length);
        // console.log(typeof(myLatLng));
        var marker = [];
        
        // membuat objek info window
        var infowindow = new google.maps.InfoWindow();

        for (var i=0; i<10; i++){
            // mebuat konten untuk info window
            var contentString = '<a href="#"><h4>Nama Sekolah</h4><a>';

            

            //MARKER
            marker[i] = new google.maps.Marker({
                position: myLatlng[i],
                map: map,
                title: myS[i]
            });
            google.maps.event.addListener(marker[i], 'click', function(e){
                // console.log(e);
                infowindow.setPosition(e.latLng);
                infowindow.setContent(contentString);
                // infowindow.setOptions({
                //     content: "makan",
                //     position: marker[i].position

                // });
                infowindow.open(map,marker[i]);
            });
        }
        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        function callback(results, status) {
            console.log(results);
            // if (status == google.maps.places.PlacesServiceStatus.OK) {
            //   for (var i = 0; i < results.length; i++) {
            //     var place = results[i];
            //     createMarker(results[i]);
            //   }
            // }
        }

</script>
@endsection