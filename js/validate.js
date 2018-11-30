function validateUserRegistrationForm(form) {
    console.debug("Validating user registration form data");

    // Full name
    var fullName = form.fullName.value;
    
    // Username
    var username = form.username.value;

    // Date of Birth
    var dateOfBirth = form.dateOfBirth.value;

    // Email
    var email = form.email.value;
    
    // Password
    var password = form.password.value;
    var passwordRetype = form.passwordRetype.value;

    return validateFullName(fullName) 
        && validateUsername(username) 
        && validateDate(dateOfBirth)
        && validateEmail(email)
        && validatePassword(password, passwordRetype);
}

function validateSearchForm(form) {
    console.debug("Validating search form data");

    // Name
    var name = document.getElementById("name").value;

    // Latitude
    var latitude = document.getElementById("latCoord").value;

    // Longitude
    var longitude = document.getElementById("latCoord").value;

    // Radius
    var radius = document.getElementById("radius").value;

    return validateParkingName(name)
        && validateLatitude(latitude)
        && validateLongitude(longitude)
        && validateRadius(radius);
}

function validateFullName(fullName) {
    console.debug("Validating full name");
    // Full name format: First Last
    // From the start(^) of the string to the end($), 
    // there must be two sets of letters seperated by a single space, and
    // case insensitive.
    var fullNameRegExp = new RegExp("^[A-Za-z]+[ ][A-Za-z]+$");
    
    if (fullName === '') {
        window.alert("Enter name.");
        return false;
    }

    if (!fullNameRegExp.test(fullName))
    {
        window.alert("Invalid name format.");
        return false;
    }
    

    return true;
}

function validateParkingName(fullName) {
    console.debug("Validating full name");
    // Full name format: First Last
    // From the start(^) of the string to the end($), 
    // there must be two sets of letters seperated by a single space, and
    // case insensitive.
    var fullNameRegExp = new RegExp("^[A-Za-z ]+$");
    
    if (fullName !== '') {
        if (!fullNameRegExp.test(fullName))
        {
            window.alert("Invalid name format.");
            return false;
        }
    }

    return true;
}

function validateUsername(username) {
    console.debug("Validating username");
    // Username format: username
    // From the start(^) of the string to the end($), 
    // there must be one string consisting of letters, numbers, '.', and '-'
    // beginning with a letter
    // between 2 and 30 characters.
    var usernameRegExp = new RegExp("^[A-z]+[A-z0-9.-]*$");

    if (!(2 <= username.length && username.length <= 30)) {
        window.alert("Enter a username between 2 and 30 characters.");
        return false;
    }

    if (!usernameRegExp.test(username))
    {
        window.alert("Invalid username format.");
        return false;
    }

    return true;
}

function validateDate(date) {
    console.debug("Validating date");
    // Date format: yyyy-mm-dd
    var dateRegExp = new RegExp("^([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))$");

    if (date === '') {
        window.alert("Enter a date.");
        return false;
    }

    if (!dateRegExp.test(date))
    {
        window.alert("Invalid date format.");
        return false;
    }

    return true;
}

function validateEmail(email) {
    console.debug("Validating email");
    // Email format: xyz@domain.abc
    // xyz maybe alphabets, numbers or special characters.
    // domain 
    // abc is 2 or more alphabets only.
    var emailRegExp = new RegExp("^[A-z0-9.!#$%&'*+/=?^_`{|}~-]+[@][A-z0-9.-]+[.][A-z]{2,}$");

    if (email === '') {
        window.alert("Enter an email.");
        return false;
    }

    if (!emailRegExp.test(email))
    {
        window.alert("Invalid email.");
        return false;
    }

    return true;
}

function validatePassword(password, passwordRetype) {
    console.debug("Validating password");
    // Password format:
    // at least 8 characters
    // must contain at least one uppercase letter
    // must contain at least one numeric character
    // must contain at least one special character

    // Three regex to test if there is at least one match for each of the three cases
    var upperCaseRegExp = new RegExp("[A-Z]");
    var numericRegExp = new RegExp("[0-9]");
    var specialRegExp = new RegExp("[!@#$%^&*,./-]");

    if (password.length < 8) {
        window.alert("Password must be at least 8 characters long.");
        return false;
    }

    if (!upperCaseRegExp.test(password) ||
        !numericRegExp.test(password) ||
        !specialRegExp.test(password))
    {
        window.alert("Invalid password.");
        return false;
    }

    // Test to see if password and password retype are the same
    if (!(password === passwordRetype)) {
        window.alert("Passwords do not match.");
        return false;
    }

    return true;
}

function validateLatitude(latitude) {
    console.debug("Validating latitude coordinates");

    // Latitude must be a value between -90 and 90.
    if (latitude !== '') {
        let latitudeFloat = parseFloat(latitude);
        if (!(-90 <= latitudeFloat && latitudeFloat <= 90)) {
            window.alert("Enter valid latitude coordinates.")
            return false;
        }
    }

    return true;
}

function validateLongitude(longitude) {
    console.debug("Validating longitude coordinates");

    // Longitude must be a value between -180 and 180.
    if (longitude !== '') {
        let longitudeFloat = parseFloat(longitude);
        if (!(-180 <= longitudeFloat && longitudeFloat <= 180)) {
            window.alert("Enter valid longitude coordinates.")
            return false;
        }
    }
    return true;
}

function validateRadius(radius) {
    console.debug("Validating radius");

    // Radius must be a value between 0 and 50.
    if (radius !== '') {
        let radiusInt = parseInt(radius);
        if (!(0 <= radiusInt && radiusInt <= 0)) {
            window.alert("Enter valid radius.")
            return false;
        }
    }
    return true;
}

function validateRadios(radios) {
    console.debug("Validating one radio is selected");

    // ensure at least one radio button is checked;
    let checkedCount = 0;
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            checkedCount++;
        }
    }

    if (checkedCount != 1) {
       window.alert("Select one option.");
       return false;   
    }

    return true;
}