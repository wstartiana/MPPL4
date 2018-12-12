@extends('templates.master')

@section('content')
<div id="map" style="width: 1500px; height: 500px"></div></align> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJfQgQL9MaM83aHUs5vxwi6O6JeVoU63Y&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    var map;
    var homeIcon = 'https://maps.gstatic.com/mapfiles/ms2/micons/red-pushpin.png';
    var marker = [];
    var globalLatlng ;
    var circle;
    var markerPin;
    geolocationInit();
    
    function geolocationInit(){
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(success, fail);
        } else {
          // Browser doesn't support Geolocation
          alert("Browser not suported");
        }
    }
    
    function success(position){
        console.log(position);
        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;
        var posisi = new google.maps.LatLng(latval, lngval);
        createMap(posisi);
    }
    function fail(){
        alert("ggal");
    }

    function createMap(myLatlng){
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatlng,
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        markerPin = new google.maps.Marker({
							icon: homeIcon,
							position: myLatlng,
							map: map
                        });
        circle = new google.maps.Circle({
			map: map,
			center: myLatlng,
			radius: 1000,
			strokeColor: '#07A8BD',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#07A8BD',
			fillOpacity: 0.1,
			clickable: false
		});        
        
        //nambahin listener buat action di map nya
				google.maps.event.addListener(map, 'click', function (event) {
					// markers.forEach(function(marker) {
					// 	marker.setMap(null);
					// });
					// markers = [];
                    mapNul();
					globalLatlng = event.latLng;
                    console.log(globalLatlng.lat());
                    getXML();
					// runQuery();
				});

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

        makeMarker(myLatlng, myS);
    }

    function makeMarker(myLatlng,myS){
        var banyak = myLatlng.length;
        // console.log(myLatlng.length);
        // console.log(typeof(myLatLng));
        
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
    }

    function mapNul(){
        var banyak = marker.length;
        for (var i=0; i<banyak; i++){
            marker[i].setMap(null);
        }
        circle.setMap(null);
        markerPin.setMap(null);
        marker = [];
    }

    function callPin(result){
        var posisi = new google.maps.LatLng(globalLatlng.lat(), globalLatlng.lng());
        markerPin = new google.maps.Marker({
							icon: homeIcon,
							position: posisi,
							map: map
                        });
        circle = new google.maps.Circle({
			map: map,
			center: posisi,
			radius: 1000,
			strokeColor: '#07A8BD',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#07A8BD',
			fillOpacity: 0.1,
			clickable: false
		});        
        
        var result_parsed = JSON.parse(result); 

        var myLatlng = [];
        for (var i=0; i<result_parsed['sekolah'].length; i++){
            console.log(result_parsed['sekolah'][i]);
        }
        var myS = [
            "blabla",
            "ccc"

        ];

        makeMarker(myLatlng, myS);
        
    }

    function getXML(){
        var http = new XMLHttpRequest();
        var url = '/tampilpeta';
        // var params = 'location=ipsum&radius=binny';
        var params = '';
        http.open('GET', url, true);

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                // console.log(http.responseText);
                callPin( http.responseText ); 
            }
        }
        http.send(params);
    }
    

</script>
@endsection