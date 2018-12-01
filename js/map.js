function searchResult(parkingLocations) {
    // initialize a map from the OpenStreet map instance
    console.debug("Initializing map", parkingLocations);

    latitude = parkingLocations[0]["latitude"];
    longitude = parkingLocations[0]["longitude"];
    // the map is centred at first parking location with a zoom level set at 16
    var mymap = L.map('mapId').setView([latitude, longitude], 16);
    
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2Fkcml3YXUiLCJhIjoiY2pub3VjdGE3MDJuMTNwcXRkY21oejBscCJ9.BY26EUc35ApKv2sX0jcUHA', 
        {    
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }
    ).addTo(mymap);

    var bounds = new L.LatLngBounds();

    // create markers for the sample search results' lat, long coordinate and add them to the map
    console.debug("Display search results on a live map");

    for (i = 0; i < parkingLocations.length; i++) {
        parkingName = parkingLocations[i]["name"];
        latitude = parkingLocations[i]["latitude"];
        longitude = parkingLocations[i]["longitude"];
        console.log(parkingName, latitude, longitude);

        var infoWindow = L.popup().setContent('<a href="parking.php?name=' + parkingName + '"><b>' + parkingName + '</b></a><br>');
        // add a pop up to the marker with a link that reroutes to the parking spot's page
        var marker = L.marker([latitude, longitude])
                      .bindPopup(infoWindow)
                      .addTo(mymap);

        bounds.extend(marker.getLatLng());
    }

    mymap.fitBounds(bounds);
}

function parkingResult(parkingSpot) {
    // initialize a map from the OpenStreet map instance
    console.debug("Initializing map", parkingSpot);
    latitude = parkingSpot["latitude"];
    longitude = parkingSpot["longitude"];
    parkingName = parkingSpot["name"];
    website = parkingSpot["website"];

    // the map is centred at user's current location (hardcoded here) with a zoom level set at 16
    var mymap = L.map('mapId').setView([latitude, longitude], 16);
    
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2Fkcml3YXUiLCJhIjoiY2pub3VjdGE3MDJuMTNwcXRkY21oejBscCJ9.BY26EUc35ApKv2sX0jcUHA', 
        {    
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }
    ).addTo(mymap);

    var bounds = new L.LatLngBounds();
    
    // For a single parking in particular, add only one marker on the live map
    console.debug("Single on live map");
    var infoWindow = L.popup().setContent('<a href="' + website + '"><b>' + parkingName + '</b></a><br>');
    // add a pop up to the marker with a link that reroutes to the parking spot's page
    var marker = L.marker([latitude, longitude])
                  .bindPopup(infoWindow)
                  .addTo(mymap);

    bounds.extend(marker.getLatLng());
    mymap.fitBounds(bounds);
}