<?php
require("dbConnect.php"); // connect to database

// if user has pressed the submit button
if (isset($_POST['signin'])) {
    // if the username and password fields are not empty or null
    if (isset($_POST['username']) && $_POST['username'] !== '' &&
        isset($_POST['password']) && $_POST['password'] !== '') {
            // if password input and database password match
            if (checkPassword($_POST['username'], $_POST['password'])) {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = $_POST['username'];
                echo "Login successful.";
                // header("Location: http://" + $_SERVER['HTTP_HOST'] + "signedin.php");
                exit;
            } else {
                die("Incorrect username/password combination");
            }
        } else {
            die("Enter username/password to sign in.");
        }
}


function checkPassword($username, $password) {
    try {
        $query = $conn->prepare(
            'SELECT * FROM user
            WHERE
            username = :username and passwordHash = SHA2(CONCAT(:passwordAttempt, salt), 0)'
            );
    
        $query->bindValue(':passwordAttempt', $password);
        $query->bindValue(':username', $username);
        
        $query->execute();

        return $query->rowCount() === 1;
    } catch (PDOException $error) {
        echo "Failed: ", $error->getMessage();
        return false;
    }    
}
?>