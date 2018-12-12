@extends('templates.master')

@section('content')
<div id="map" style="width: 1500px; height: 500px"></div></align> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJfQgQL9MaM83aHUs5vxwi6O6JeVoU63Y&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    var map;
    var homeIcon = 'https://maps.gstatic.com/mapfiles/ms2/micons/red-pushpin.png';
    var marker = [];
    var myLatlng ;
    var circle;
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
        var marker = new google.maps.Marker({
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
					myLatlng = event.latLng;
                    console.log(myLatlng.lat());
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
        marker = [];
    }
    // function nearbySearch(){
    //     var request = {
    //         location: {lat: -6.554364, lng: 106.723409},
    //         radius: '1500',
    //         type: ['school']
    //     };

    //     service = new google.maps.places.PlacesService(map);
    //     service.nearbySearch(request, callback);
    // }

    // function callback(results, status) {
    //         console.log(results);
    //         // if (status == google.maps.places.PlacesServiceStatus.OK) {
    //         //   for (var i = 0; i < results.length; i++) {
    //         //     var place = results[i];
    //         //     createMarker(results[i]);
    //         //   }
    //         // }
    // }

    // function runQuery(){
    //     directionsDisplay.setMap(null);
	// 	infoHere.close();

    //     geocoder.geocode({'location': myLatlng}, function(results, status) {
    //         if(status === 'OK'){
    //             if(results[0]){
    //                 map.setZoom(map.getZoom());
    //                 var marker = new google.maps.Marker({
	// 						icon: homeIcon,
	// 						position: myLatlng,
	// 						map: map
    //                 });

    //                 google.maps.event.addListener(marker,'click', (function(marker){
	// 							return function() {
	// 								directionsDisplay.setMap(null);
	// 								infoHere.close();

	// 								nearby.forEach(function(marker) {
	// 									marker.setMap(null);
	// 								});
	// 								nearby.forEach(function(marker) {
	// 									marker.setMap(map);
	// 								});
	// 							};
	// 				})(marker));
                    
    //                 markers.push(marker);

                    


                        
    //             }
    //         }
    //     }
    // }
        

</script>
@endsection