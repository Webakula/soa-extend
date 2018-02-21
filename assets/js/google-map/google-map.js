function initMap() {
    var maps = [];
    $('.wa-gmap').each(function () {
        inp = $(this).find('.address');
        if (inp.data('value').length) {

            coords = inp.data('value').split(' ');
        } else {
            coords = inp.val().split(' ');
        }
        lat = parseFloat(coords[0]);
        lng = parseFloat(coords[1]);
        var myLatLng = {lat: lat, lng: lng};
        var container = $(this).find('.gmap-container')[0];
        console.log(container, container.id);
        var map = new google.maps.Map(document.getElementById(container.id), {
            zoom: 15,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!',
            draggable: true
        });
        google.maps.event.addListener(marker, "dragend", function (event) {
            inp.val(event.latLng.toString().replace(/\(|\)/gi, ''));
        });
        google.maps.event.addListener(marker, "drag", function (event) {
            inp.val(event.latLng.toString().replace(/\(|\)/gi, ''));
        });
        $('.set-marker-to-address').click(function () {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': $('#address').val()}, function (results, status) {
                if (status == 'OK') {
                    loc = results[0].geometry.location;
                    map.setCenter(loc);
                    marker.setPosition(loc);
                    inp.val(loc.toString().replace(/\(|\)/gi, ''));
                } else {
                    if(status=='ZERO_RESULTS') {
                        alert('Извините, по адресу '+$('#address').val()+' ничего найти не удалось')
                    }
                }
            });
        });
    });
    return maps;
}
initMap();