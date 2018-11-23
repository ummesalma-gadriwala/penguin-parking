<?php
require_once("dbConnect.php"); // connect to database

// validate user sign in form input
if (isset($_POST['signin'])) {
    if (isset($_POST['username']) && $_POST['username'] != '' &&
        isset($_POST['password']) && $_POST['password'] != '') {
            if (checkPassword($_POST['username'], $_POST['password'])) {
                echo "alert(Successful!)";
            }
        } else {
            echo "alert(Enter username and password to sign in.)";
        }
}


function checkPassword($username, $password) {
    try {
        $query = $conn->prepare(
            'SELECT * FROM user
            WHERE
            `username` = :username and `password` = SHA2(CONCAT(:password, `salt`), 0)'
            );
    
        $query->bindParam(':password', $password);
        $query->bindParam(':username', $username);

        return $query->rowCount() === 1;
    } catch (PDOException $error) {
        echo "Failed: ", $error->getMessage();
        return false;
    }
    

    
}
?>