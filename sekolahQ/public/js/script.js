$(document).ready(function(){

    var myLatlng = {lat: -6.554364, lng: 106.723409};

    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatlng,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

    var request = {
        location: myLatlng,
        radius: '1500',
        type: ['school']
    };

    //MARKER
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"Hello World!"
    });
    
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
});