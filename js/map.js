function searchResult(arr) {
    // initialize a map from the OpenStreet map instance
    console.debug("Initializing map", arr);

    latitude = arr[0]["latitude"];
    longitude = arr[0]["longitude"];
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

    // create markers for the sample search results' lat, long coordinate and add them to the map
    console.debug("Display search results on a live map");

    for (i = 1; i < arr.length; i++) {
        parkingName = arr[i]["name"];
        latitude = arr[i]["latitude"];
        longitude = arr[i]["longitude"];
        console.log(name, latitude, longitude);

        var marker = L.marker([latitude, longitude]).addTo(mymap);
        // add a pop up to the marker with a link that reroutes to the parking spot's page
        marker.bindPopup('<a href="parking.php?name=' + parkingName + '"><b>' + parkingName + '</b></a><br>').openPopup();
    }
}

function indigoParkingResult() {
    // initialize a map from the OpenStreet map instance
    console.debug("Initializing map");

    // the map is centred at user's current location (hardcoded here) with a zoom level set at 16
    var mymap = L.map('mapId').setView([43.257691, -79.870204], 16);
    
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2Fkcml3YXUiLCJhIjoiY2pub3VjdGE3MDJuMTNwcXRkY21oejBscCJ9.BY26EUc35ApKv2sX0jcUHA', 
        {    
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }
    ).addTo(mymap);
    
    // For Indigo parking in particular, add only one marker on the live map
    console.debug("Indigo Parking on live map");
    indigo = L.marker([43.257691, -79.870204]).addTo(mymap);
    indigo.bindPopup('<a href="https://ca.parkindigo.com/en/car-park/32-james-street-south" target="_blank">Indigo Parking Garage</a>').openPopup();
}