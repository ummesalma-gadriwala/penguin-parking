<?php
require_once("dbConnect.php"); // connect to database

if (isset($_POST['register'])) {
    // paramaters are set
    if (isset($_POST['fullName']) &&
        isset($_POST['username']) &&
        isset($_POST['dateOfBirth']) &&
        isset($_POST['email']) &&
        isset($_POST['password']) &&
        isset($_POST['passwordRetype'])) {
    // get parameters
    $fullName = $_POST["fullName"];
    $username = $_POST["username"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRetype = $_POST["passwordRetype"];
    
    // validate user registration form input
    if (validateName($fullName) &&
        validateUsername($username) &&
        validateDate($dateOfBirth) &&
        validateEmail($email) &&
        validatePassword($password, $passwordRetype)) {

        try {
            // valid user information, add to database
            $stmt = $conn->prepare(
                'INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
                VALUES
                (:fullName, :username, :dateOfBirth, :email, SHA2(CONCAT(:password, :salt), 0), :salt)'
            );

            $salt = generateSalt();
            
            $stmt->bindValue(':fullName', $fullName);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':dateOfBirth', $dateOfBirth);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':salt', $salt);
            
            $stmt->execute();
            
            echo "New user created!";
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
            exit();
        } catch (PDOException $error) {
            echo "Error: ", $error->getMessage();
        }
    } else {
        echo "Invalid input data.";
    }
}
}

function generateSalt() { 
    // Generate an alphanumeric salt of length 10
    echo "generating salt";
    $length = 10;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLength = strlen($characters) - 1;
    $string = "";
    for($i=0; $i<$length; $i++){
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}

function validateName($name) {
    $pattern = '/^[A-Za-z]+[ ][A-Za-z]+$/';

    return preg_match($pattern, $name) === 1;
}

function validateUsername($username) {
    $pattern = "/^[A-z]+[A-z0-9.-]*$/";

    return preg_match($pattern, $username) === 1;
}

function validateDate($date) {
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