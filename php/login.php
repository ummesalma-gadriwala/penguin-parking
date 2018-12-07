<?php
require("dbConnect.php"); // connect to database
// if user has pressed the submit button
if (isset($_POST['signin'])) {
    // if the username and password fields are not empty or null
    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password'])) {
            // if password input and database password match
            if (checkPassword($_POST['username'], $_POST['password'], $conn)) {
                // Start session, set session variables to verify user is logged in
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = htmlspecialchars($_POST['username']); // to avoid XXS attacks
                
                // echo "Login successful.";
                // navigate to signed in page only accessible to logged in users
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/signedin.php");
                exit();
            } else {
                // Display alert if username does not match password.
                echo '<script type="text/javascript">window.alert("Incorrect username/password combination.");</script>';
                // echo("Incorrect username/password combination");
            }
    } else {
        // Display alert if user is not logged in
        echo '<script type="text/javascript">window.alert("Enter username/password to sign in.");</script>';
    }
}


function checkPassword($username, $password, $conn) {
    try {
        $query = $conn->prepare(
            'SELECT * FROM user
            WHERE
            `username` = :username and `passwordHash` = SHA2(CONCAT(:password, `salt`), 0)'
        );

        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        
        $query->execute();

        return $query->rowCount() === 1;
    } catch (PDOException $error) {
        // echo "Failed: ", $error->getMessage();
        return false;
    }    
}
?>