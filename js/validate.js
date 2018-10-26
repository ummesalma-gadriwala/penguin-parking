function validateUserRegistrationForm(form) {
    console.debug("Validating user registration form data");

    // Full name
    var fullName = form.fullName.value;
    // Full name format: First Last
    // From the start(^) of the string to the end($), 
    // there must be two sets of letters seperated by a single space, and
    // case insensitive.
    var fullNameRegExp = new RegExp("^[A-Za-z]+[ ][A-Za-z]+$");
    
    if (fullName === '') {
        window.alert("Enter a name.");
        return false;
    }

    if (!fullNameRegExp.test(fullName))
    {
        window.alert("Invalid name format.");
        return false;
    }
    
    // Username
    var username = form.username.value;
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

    // Date of Birth
    var dateOfBirth = form.dateOfBirth.value;
    // Date of Birth format: yyyy-mm-dd

    var dateOfBirthRegExp = new RegExp("^([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))$");

    if (dateOfBirth === '') {
        window.alert("Enter a date of birth.");
        return false;
    }

    if (!dateOfBirthRegExp.test(dateOfBirth))
    {
        window.alert("Invalid date format.");
        return false;
    }

    // Email
    var email = form.email.value;
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

    // Password
    var password = form.password.value;
    // Password format:
    // at least 8 characters
    // must contain at least one uppercase letter
    // must contain at least one numeric character
    // must contain at least one special character

    // Three regex to test if there is at least one match for each of the three cases
    var upperCaseRegExp = new RegExp("[A-Z]");
    var numericRegExp = new RegExp("[0-9]");
    var specialRegExp = new RegExp("[!@#$%^&*,./-]");

    console.debug("Uppercase:", !upperCaseRegExp.test(password))
    console.debug("Numeric:", !numericRegExp.test(password))
    console.debug("Special:", !specialRegExp.test(password))

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

    return true;
}