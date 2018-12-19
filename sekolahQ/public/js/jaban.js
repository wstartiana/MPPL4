$(document).ready(function(){
    
		var map, geocoder, service, circle, myLatlng, radius=1000, status, directionsDisplay, directionsService, myLocation, infoHere;
		var markers = [], nearby = [], keyword = [], nearest = [];
		var homeIcon = 'https://maps.gstatic.com/mapfiles/ms2/micons/red-pushpin.png';
		var foundIcon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';

		$(document).ready(function(){
			radius = $('#ex1').val()*1000;
			setKeyword();
		});

		//ini slider buat radius
		$('#ex1').slider({
			formatter: function(value) {
				radius = value*1000;
				$('#radNum').html(value+'Km');
				return value+" Km";
			}
		});
		$('#ex1').change(function(){
			runQuery();
		});

		//radio buat jenjang
		$('input[name=jenjang]').change(function(){
			setKeyword();
			runQuery();
		});

		function setKeyword(){
			keyword = $('input[name=jenjang]:checked').val();
		}

		//buat ngambil lokasi pake browser
		function getLoc(){
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(myPos,errPos);
		  }
		}
		function myPos(pos){
	    myLatlng = {lat: pos.coords.latitude, lng: pos.coords.longitude};
			initMap();
		}
		function errPos(err){
			console.log(err);
			switch(err.code) {
				default:
					myLatlng = {lat: -6.597853, lng: 106.797682};
					initMap();
		      break;
		  }
		}

		function initMap() {
			//inisialisasi map awal dan nilai awal variabel
			map = new google.maps.Map(document.getElementById('myMap'), {
				center: myLatlng,
				zoom: 15,
				clickableIcons: false,
				fullscreenControl: false,
				mapTypeId: 'roadmap'
			});

			infoHere = new google.maps.InfoWindow();
			circle = new google.maps.Circle;
			geocoder = new google.maps.Geocoder;
			directionsService = new google.maps.DirectionsService;
	    directionsDisplay = new google.maps.DirectionsRenderer({
				suppressMarkers: true,
				preserveViewport: true,
				polylineOptions: {
	      	strokeColor: "red"
	    	}
			});
			service = new google.maps.places.PlacesService(map);
			var input = document.getElementById('pac-input');
		  var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			//nambahin listener buat action di map nya
			google.maps.event.addListener(map, 'click', function (event) {
				markers.forEach(function(marker) {
					marker.setMap(null);
				});
				markers = [];
				myLatlng = event.latLng;
				runQuery();
			});

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
					(place.geometry.viewport)?bounds.union(place.geometry.viewport):bounds.extend(place.geometry.location);
	      });
	      map.fitBounds(bounds);
				map.setZoom(15);
	    });
		}

		function runQuery() {
			directionsDisplay.setMap(null);
			infoHere.close();

			geocoder.geocode({'location': myLatlng}, function(results, status) {
				if(status === 'OK'){
					if(results[0]){
						map.setZoom(map.getZoom());

						var marker = new google.maps.Marker({
							icon: homeIcon,
							position: myLatlng,
							map: map
						});

						google.maps.event.addListener(marker,'click', (function(marker){
								return function() {
									directionsDisplay.setMap(null);
									infoHere.close();

									nearby.forEach(function(marker) {
										marker.setMap(null);
									});
									nearby.forEach(function(marker) {
										marker.setMap(map);
									});
								};
						})(marker));

						markers.push(marker);
						service.getDetails({ placeId: results[0].place_id }, function(place, status) {
							if(status === google.maps.places.PlacesServiceStatus.OK) {
								$('#alamatRumah').html('<b>'+place.name);
								$('#alamatJalan').html(place.formatted_address);
								myLocation = place;

								circle.setMap(null);
								circle = new google.maps.Circle({
									map: map,
									center: myLatlng,
									radius: radius,
									strokeColor: '#07A8BD',
									strokeOpacity: 0.8,
									strokeWeight: 2,
									fillColor: '#07A8BD',
									fillOpacity: 0.1,
									clickable: false
								});

								service.nearbySearch({
									location: myLatlng,
									radius: radius-2000,
									keyword: keyword,
									type: ['school','sekolah']
								}, callback);
							}
						});
					}
				}
			});
		}

		function callback(results, status) {
			nearby.forEach(function(marker) {
				marker.setMap(null);
			});
			nearby = [];
			nearest = [];

			$('#rekomendasi').empty();

			if(status == google.maps.places.PlacesServiceStatus.OK) {
				for(var i = 0; i < results.length; i++) {
					var infowindow = new google.maps.InfoWindow();
					var marker = new google.maps.Marker({
						icon: foundIcon,
						title: results[i].name,
						map: map,
						position: results[i].geometry.location
					});

					var content = results[i].name;

					google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){
			        return function() {
			           infowindow.setContent(content);
			           infowindow.open(map,marker);
			        };
			    })(marker,content,infowindow));

					nearby.push(marker);

					results[i].distance = euclidGeom(myLatlng,results[i].geometry.location);
					nearest.push(results[i]);
		    }
		  }

			nearest.sort(function(a, b){return a.distance-b.distance});
			$.each( nearest, function( key, value ) {
			  $('#rekomendasi').append("<li style='width:100%; vertical-align: middle;'><a id='"+key+"' onClick='liClick(this.id);' class='col-md-10'>"+value.name+"</a><i id='"+key+"' style='margin:0;' class='btn btn-default fa fa-external-link fa-lg col-md-2' onClick='openDetail(this.id)'></i></li>");
			});

		}

		function euclidGeom(src,dest) {
			return Math.sqrt((Math.pow(src.lat()-dest.lat(),2))+Math.pow(src.lng()-dest.lng(),2));
		}

		function liClick(val) {
			var markHere;

			nearby.forEach(function(marker) {
				if(marker.position == nearest[val].geometry.location){
					marker.setMap(map);
					markHere = marker;
				} else marker.setMap(null);
			});

			directionsDisplay.setMap(map);

			directionsService.route({
				origin: myLocation.geometry.location,
	      destination: nearest[val].geometry.location,
	      travelMode: 'DRIVING'
			},function(response, status) {
			    if (status === 'OK') {
						infoHere.close();

						var content = '<center><b>'+nearest[val].name+'</b></center><hr style="padding:2px; margin:10px;"></hr>'+
						'Estimasi Perjalanan Darat<br>'+
						'Jarak Tempuh: '+response.routes[0].legs[0].distance.value/1000 +" Km<br>"+
						'Waktu Tempuh: '+response.routes[0].legs[0].duration.text;

						infoHere.setContent(content);

						directionsDisplay.setDirections(response);
						infoHere.open(map,markHere);
			    } else {
			      window.alert('Directions request failed due to ' + status);
			    }
				});
		}

		function openDetail(val) {
			$('#detailNama').html(nearest[val].name);
			$('#detailAlamat').html(nearest[val].vicinity);
			$('#detailText').empty();
			$('#gallery').empty();
			var it = 0;

			var content = nearest[val].distance;

			$('#detailText').html();

			service.getDetails({ placeId: nearest[val].place_id }, function(place, status) {
				if(status === google.maps.places.PlacesServiceStatus.OK) {
					if(!place.photos){
						$('#gallery').append('<div class="item active"><center><img src= "https://mosaikweb.com/wp-content/plugins/lightbox/images/No-image-found.jpg" ></center></div>');

						return;
					}

					place.photos.forEach(function(photo) {
						var photo = photo.getUrl({'maxHeight': 300});

						if(it==0) $('#gallery').append('<div class="item active"><center><img src='+photo+'></center></div>');
						else $('#gallery').append('<div class="item text-center"><center><img src='+photo+'></center></div>');

						it++;
					});
				}
			});

			$('#detail').modal('show');
		}
	
});