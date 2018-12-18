@extends('templates.master')

@section('content')
<input id="pac-input" style="width: 300px; height: 40px" type="text" placeholder="Search Box">
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
			radius: 4000,
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
                
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        
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
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
				var places = searchBox.getPlaces();
				if (places.length == 0) {
					return;
				}

				var bounds = new google.maps.LatLngBounds();
				places.forEach(function(place) {
                    markerPin = new google.maps.Marker({
							icon: homeIcon,
							position: place.geometry.location,
							map: map
                        });
							(place.geometry.viewport)?bounds.union(place.geometry.viewport):bounds.extend(place.geometry.location);
				});
				map.fitBounds(bounds);
                        map.setZoom(15);
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
        var myID = [
            @foreach ($result as $data)
                "{{ $data->id_sekolah}}",
            @endforeach
        ];

        makeMarker(myLatlng, myS, myID);
    }

    function makeMarker(myLatlng,myS, myID){
        var banyak = myLatlng.length;
        // console.log(myID[i]);
        // console.log(typeof(myLatLng));
        judul = [];
        // membuat objek info window
        var infowindow = new google.maps.InfoWindow();

        for (var i=0; i<banyak; i++){
            // mebuat konten untuk info window
            let str = myS[i];
            // console.log(str);
            let result = str.link("{{ route('lihatSekolah', ":id")}}");
            result = result.replace(':id', myID[i]);
            // var contentString = '<a href="#"><h4>Nama Sekolah</h4><a>';
            //MARKER
            marker[i] = new google.maps.Marker({
                position: myLatlng[i],
                map: map,
                title: myS[i]
            });
            // console.log(result);
            google.maps.event.addListener(marker[i], 'click', function(e){
                // console.log(e);
                infowindow.setPosition(e.latLng);
                // infowindow.setContent(result);
                infowindow.setOptions({
                    content: result,
                    // position: marker[i].position

                });
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
        mapNul();
        var posisi = new google.maps.LatLng(globalLatlng.lat(), globalLatlng.lng());
        markerPin = new google.maps.Marker({
							icon: homeIcon,
							position: posisi,
							map: map
                        });
        circle = new google.maps.Circle({
			map: map,
			center: posisi,
            radius: document.getElementsByName("radius")[0].value * 1000,
            
			strokeColor: '#07A8BD',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#07A8BD',
			fillOpacity: 0.1,
			clickable: false
		});        
        // console.log("panjang "+result.length);
        var result_parsed = JSON.parse(result); 

        var myS = [];
        var myLatlng = [];
        var myID = [];
        var panjang = result_parsed['sekolah'].length;
        for (var i=0; i<panjang ; i++){
            var lat_local = result_parsed['sekolah'][i]['latitude'];
            var lng_local = result_parsed['sekolah'][i]['longitude'];
            // console.log(result_parsed['sekolah'][i]);
            console.log(getDistanceFromLatLonInKm(lat_local, lng_local));
            var radius= document.getElementsByName("radius")[0].value;
            console.log(radius);
            if (getDistanceFromLatLonInKm(lat_local, lng_local)<radius ){
                // console.log("MASUK");
                myLatlng.push({lat: lat_local, lng: lng_local});
                myS.push(result_parsed['sekolah'][i]['nama_sekolah']);
            }
        }
        

        makeMarker(myLatlng, myS, myID);
        
    }

    function getXML(){
        var http = new XMLHttpRequest();
        var url = '/sekolah/lihatSekolah';
        // var params = 'location=ipsum&radius=binny&jenis_sekolah';
        // var form_data = document.getElementsByName("form1");
        var form_data = document.forms.namedItem("form1");
        var params = new FormData(form_data);
        // params.append("jenjang","ayam");
        http.open('POST', url, true);

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                console.log(http.responseText);
                callPin( http.responseText ); 
            }
        }
        http.send(params);
    }

    function getDistanceFromLatLonInKm(lat2,lon2) {
        var lat1 = globalLatlng.lat();
        var lon1 = globalLatlng.lng();
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1); 
        var a = 
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            Math.sin(dLon/2) * Math.sin(dLon/2)
            ; 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c; // Distance in km
        return d;
    }
    function deg2rad(deg) {
        return deg * (Math.PI/180)
    }
//  console.log(getDistanceFromLatLonInKm(-6.552260, 106.718840, -6.560010, 106.767470) );
    

</script>
@endsection