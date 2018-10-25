function initMap() {
    console.debug("Initializing map");
    var mymap = L.map('mapId').setView([43.257691, -79.870204], 16);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZ2Fkcml3YXUiLCJhIjoiY2pub3VjdGE3MDJuMTNwcXRkY21oejBscCJ9.BY26EUc35ApKv2sX0jcUHA', 
        {    
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }
    ).addTo(mymap);

    indigo = L.marker([43.257691, -79.870204]).addTo(mymap);
    indigo.bindPopup('<a href="parking.html"><b>Indigo</b></a><br>').openPopup();

    kingJames = L.marker([43.256922, -79.869390]).addTo(mymap);
    kingJames.bindPopup('<a href="error.html"><b>King and James</b></a><br>').openPopup();

    uPark = L.marker([43.254869, -79.868786]).addTo(mymap);
    uPark.bindPopup('<a href="error.html"><b>UPark</b></a><br>').openPopup();
}
