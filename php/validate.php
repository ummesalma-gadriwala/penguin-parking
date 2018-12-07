<?php 
function validateParkingName($name, &$nameValue = "") {
    // Parking Name is one word (single string comprising of letters only)
    $pattern = '/^[A-Za-z]+$/';

    // name is invalid, set value to empty
    if (preg_match($pattern, $name) !== 1) {
        $nameValue = "";
    }

    return preg_match($pattern, $name) === 1;
}

function validateInteger($i, $min, $max, &$iValue = "") {
    // validate if i is an integer between min and max (inclusive)
    $number = intval($i, 10);
    if ($number !== 0 &&
        $number >= $min &&
        $number <= $max) {
            return true;
    }
    $iValue = "";
    return false;
}

function validateFloat($f, $min, $max, &$fValue = "") {
    // validate if f is a float between min and max (inclusive)
    $number = floatval($f);
    if ($number !== 0 &&
        $number >= $min &&
        $number <= $max) {
            return true;
    }

    $fValue = "";
    return false;
}

function validateURL($url, &$urlValue = "") {
    $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

    // name is invalid, set value to empty
    if (preg_match($pattern, $url) !== 1) {
        $urlValue = "";
    }

    return preg_match($pattern, $url) === 1;
}

function validateName($name, &$nameValue = "") {
    // Two words comprising of letters only
    $pattern = '/^[A-Za-z]+[ ][A-Za-z]+$/';

    // name is invalid, set value to empty
    if (preg_match($pattern, $name) !== 1) {
        $nameValue = "";
    }

    return preg_match($pattern, $name) === 1;
}

function validateUsername($username, &$usernameValue = "") {
    // Single string with letters, numbers, `.` and `-` special characters only
    $pattern = "/^[A-z]+[A-z0-9.-]*$/";

    // username is invalid, set value to empty
    if (preg_match($pattern, $username) !== 1) {
        $usernameValue = "";
    }

    return preg_match($pattern, $username) === 1;
}

function validateDate($date, &$dateValue = "") {
    // Pattern: yyyy-mm-dd
    $pattern = "/^([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))$/";

    // date is invalid, set value to empty
    if (preg_match($pattern, $date) !== 1) {
        $dateValue = "";
    }

    return preg_match($pattern, $date) === 1;
}

function validateEmail($email, &$emailValue = "") {
    // Email format: xyz@domain.abc
    // xyz maybe alphabets, numbers or special characters.
    // domain 
    // abc is 2 or more alphabets only.
    $pattern = "/^[A-z0-9.!#$%&'*+=?^_`{|}~-]+[@][A-z0-9.-]+[.][A-z]{2,}$/";

    // email is invalid, set value to empty
    if (preg_match($pattern, $email) !== 1) {
        $emailValue = "";
    }

    return preg_match($pattern, $email) === 1;
}

function validatePassword($password, $passwordRetype) {
    // At least 8 characters
    // At least one digit
    // At least one symbol
    // At least one uppercase letter
    // must match passwordRetype
    $pattern = "/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/";

    return preg_match($pattern, $password) === 1 &&
        $password === $passwordRetype;
}

?>