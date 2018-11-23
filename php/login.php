<?php
require_once("dbConnect.php"); // connect to database

// validate user sign in form input
if (isset($_POST['signin'])) {
    if (isset($_POST['username']) && $_POST['username'] != '' &&
        isset($_POST['password']) && $_POST['password'] != '') {
            if (checkPassword($_POST['username'], $_POST['password'])) {
                session_start();
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['username'] = $_POST['username'];
                header("Location: https://" + $_SERVER['HTTP_HOST'] + "signedin.php");
                exit;
            } else {
                die("Incorrect username/password combination");
            }
        } else {
            echo 'alert("Enter username and password to sign in.")';
        }
}


function checkPassword($username, $password) {
    try {
        $query = $conn->prepare(
            'SELECT * FROM user
            WHERE
            `username` = :username and `password` = SHA2(CONCAT(:password, `salt`), 0)'
            );
    
        $query->bindValue(':password', $password);
        $query->bindValue(':username', $username);
        
        $query->execute();

        return $query->rowCount() === 1;
    } catch (PDOException $error) {
        echo "Failed: ", $error->getMessage();
        return false;
    }
    

    
}
?>