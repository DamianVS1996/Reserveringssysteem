function maps() {

    var mapProp = {
        center:new google.maps.LatLng(51.856070,4.537088),
        zoom:18,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(51.85607, 4.537088),
        animation: google.maps.Animation.NONE,
        map: map
    });
}
google.maps.event.addDomListener(window, 'load', maps);