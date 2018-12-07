<?php
require_once("dbConnect.php"); // connect to database
include("validate.php");

if (isset($_POST['register'])) {
    // paramaters are set
    if (isset($_POST['fullName']) && !empty($_POST['fullName']) &&
        isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['dateOfBirth']) && !empty($_POST['dateOfBirth']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['passwordRetype']) && !empty($_POST['passwordRetype'])) {
    // get parameters
    $fullName = htmlspecialchars($_POST["fullName"]);
    $username = htmlspecialchars($_POST["username"]);
    $dateOfBirth = htmlspecialchars($_POST["dateOfBirth"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordRetype = htmlspecialchars($_POST["passwordRetype"]);

    // Values for input box to preload data for an error form
    $fullNameValue = $fullName;
    $usernameValue = $username;
    $dateOfBirthValue = $dateOfBirth;
    $emailValue = $email;
    
    // validate user registration form input
    if (validateName($fullName, $fullNameValue) &&
        validateUsername($username, $usernameValue) &&
        validateDate($dateOfBirth, $dateOfBirthValue) &&
        validateEmail($email, $emailValue) &&
        validatePassword($password, $passwordRetype)) {

        try {
            // valid user information, add to database
            $stmt = $conn->prepare(
                'INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
                VALUES
                (:fullName, :username, :dateOfBirth, :email, SHA2(CONCAT(:password, :salt), 0), :salt)'
            );

            // Password is hashed using SHA2 and salted for privacy before storing in db
            $salt = generateSalt();
            
            $stmt->bindValue(':fullName', $fullName);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':dateOfBirth', $dateOfBirth);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':salt', $salt);
            
            $stmt->execute();
            
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
            exit();
        } catch (PDOException $error) {
            // If username already exists in table
            if ($error->getCode() === 1062) {
                echo '<script type="text/javascript">window.alert("Username already exists.");</script>';
                $usernameValue = "";
            }
        }
    } else {
        echo '<script type="text/javascript">window.alert("Invalid input data. Please try again.");</script>';
        // echo "Invalid input data.";
    }
}
}

function generateSalt() { 
    // Generate an alphanumeric salt of length 10
    $length = 10;
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLength = strlen($characters) - 1;
    $string = "";
    for($i=0; $i<$length; $i++) {
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}
?>