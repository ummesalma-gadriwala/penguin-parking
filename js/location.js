function getLocation() {
    console.debug("Getting location");

    // get coordinate input box elements to load the geolocation coordinates into them
    latitudeElement = document.getElementById("latCoord");
    longitudeElement = document.getElementById("longCoord");
    locationButton = document.getElementById("geoLocate");
    if (navigator.geolocation) {
        // geolocation is supported by browser
        console.debug("Geolocation supported by browser");
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        // if browser does not support geolocation, disable the autolocate button.
        console.debug("Geolocation not supported by browser");
        alert("Geolocation is not supported by your browser.\nPlease manually enter the location coordinates.");
        latitudeElement.value = "";
        longitudeElement.value = "";
        locationButton.disabled = true;
    }
}

function showPosition(position) {
    console.debug("Showing position");
    latitudeElement = document.getElementById("latCoord");
    longitudeElement = document.getElementById("longCoord");
    
    // display the lat, long coordinates in the textboxes on the screen
    // make textboxes readonly after setting value
    console.debug("  Position: ", position.coords.latitude, position.coords.longitude);
    latitudeElement.value = position.coords.latitude;
    longitudeElement.value = position.coords.longitude;
    latitudeElement.readOnly = true;
    longitudeElement.readOnly = true;
}

function showError(error) {
    // display any error as an alert box pop up
    console.log("Error encountered, ", error.code);

    locationButton = document.getElementById("geoLocate");
    latitudeElement = document.getElementById("latCoord");
    longitudeElement = document.getElementById("longCoord");

    switch(error.code) {
        case error.PERMISSION_DENIED:
            // if user denies permission, 
            // the location button is disabled and 
            // user is prompted to manually enter coordinates
            alert("User denied the request for Geolocation.\nPlease manually enter the location coordinates.");
            latitudeElement.value = "";
            longitudeElement.value = "";
            locationButton.disabled = true;
            break;
        case error.POSITION_UNAVAILABLE:
            // if location information is unavailable, the location button is disabled
            alert("Location information is unavailable.\nPlease manually enter the location coordinates.");
            latitudeElement.value = "";
            longitudeElement.value = "";
            locationButton.disabled = true;
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
} 