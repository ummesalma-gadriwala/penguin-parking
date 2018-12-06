<?php
require_once("dbConnect.php"); // connect to database
include("validate.php");

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
            // echo "Error: ", $error->getMessage();
        }
    } else {
        echo '<script type="text/javascript">window.alert("Invalid input data. Please try again.");</script>';
        // echo "Invalid input data.";
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
?>