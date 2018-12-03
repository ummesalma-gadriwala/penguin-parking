<?php 
function validateParkingName($name) {
    // Parking Name is one word (single string comprising of letters only)
    $pattern = '/^[A-Za-z]+$/';

    return preg_match($pattern, $name) === 1;
}

function validateInteger($i, $min, $max) {
    // validate if i is an integer between min and max (inclusive)
    $number = intval($i, 10);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateFloat($f, $min, $max) {
    // validate if f is a float between min and max (inclusive)
    $number = floatval($f);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateURL($url) {
    $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

    return preg_match($pattern, $url) === 1;
}

function validateName($name) {
    // Two words comprising of letters only
    $pattern = '/^[A-Za-z]+[ ][A-Za-z]+$/';

    return preg_match($pattern, $name) === 1;
}

function validateUsername($username) {
    // Single string with letters, numbers, `.` and `-` special characters only
    $pattern = "/^[A-z]+[A-z0-9.-]*$/";

    return preg_match($pattern, $username) === 1;
}

function validateDate($date) {
    // Pattern: yyyy-mm-dd
    $pattern = "/^([12][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01]))$/";

    return preg_match($pattern, $date) === 1;
}

function validateEmail($email) {
    // Email format: xyz@domain.abc
    // xyz maybe alphabets, numbers or special characters.
    // domain 
    // abc is 2 or more alphabets only.
    $pattern = "/^[A-z0-9.!#$%&'*+=?^_`{|}~-]+[@][A-z0-9.-]+[.][A-z]{2,}$/";

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