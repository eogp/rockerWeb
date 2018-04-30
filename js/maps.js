/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {
    //Inicio del mapa
    var map;
    var inicio = {lat: -34.609103, lng: -58.381300};
    if(document.getElementById('lat').value!=="" && document.getElementById('long').value!==""){
       inicio = {lat: parseFloat(document.getElementById('lat').value), 
                     lng: parseFloat(document.getElementById('long').value)};     
    }
    map = new google.maps.Map(document.getElementById('map'), {
        center: inicio,
        zoom: 14,
        disableDefaultUI: true
    });
    if(document.getElementById('lat').value!=="" && document.getElementById('long').value!==""){
       var marker = new google.maps.Marker({
          position: inicio,
          map: map
        });     
    }
    //---------------------------------



    /*----------autocomplete---------------*/
    var input = document.getElementById('search');

    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-22.096829, -65.596095),
            new google.maps.LatLng(-54.844040, -68.311902));


    var options = {
        types: ['address']
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);
    
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });
                

    autocomplete.addListener('place_changed', function () {
        // Get the place details from the autocomplete object.

        marker.setVisible(false);
        var place = autocomplete.getPlace();
        //RECUPERO DE DATOS-------------------------------
        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }

        //RECUPERO DE COORDENADAS-------------------------------
        document.getElementById('lat').value = place.geometry.location.lat().toString();
        document.getElementById('long').value = place.geometry.location.lng().toString();
        //VALIDACION-------------------------------
        $("#search").parent().addClass("has-success").removeClass("has-error");
        $("#search-error").remove();
        // VISUALIZACION EN MAPS-----------------------
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            alert("No details available for input: '" + place.name + "'");

            return;
        }
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    }
    );

    input.disabled = false;

});                   