<?php
require("dbConnect.php"); // connect to database
echo "are we here?";
// if user has pressed the submit button
if (isset($_POST['signin'])) {
    // if the username and password fields are not empty or null
    echo "sign in button was pressed";
    if (isset($_POST['username']) && $_POST['username'] !== '' &&
        isset($_POST['password']) && $_POST['password'] !== '') {
            // if password input and database password match
            if (checkPassword($_POST['username'], $_POST['password'], $conn)) {
                echo "Login successful.";
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


function checkPassword($username, $password, $conn) {
    echo "Checking password";
    try {
        $query = $conn->prepare(
            'SELECT * FROM user
            WHERE
            `username` = :username and `passwordHash` = SHA2(CONCAT(:password, `salt`'
        );
        // // get salt
        // $saltQuery = $conn->prepare(
        //     'SELECT salt FROM user
        //     WHERE
        //     username = :username'
        //     );

        // $saltQuery->bindValue(':username', $username);        
        // $saltQuery->execute();

        // if ($saltQuery->rowCount() === 1) {
        //     $query = $conn->prepare(
        //         'SELECT * FROM user
        //         WHERE
        //         username = :username and passwordHash = :passwordHash'
        //     );
            
        //     $salt = $saltQuery['salt'];
        //     echo "$salt";
        //     $passwordHash = hash('sha256', $password.$salt);
        //     echo "$passwordHash";
        //     $query->bindValue(':passwordHash', $passwordHash);
        $query->bindValue(':username', $username);
        $query->bindValue(':password', $password);
        
        $query->execute();

        return $query->rowCount() === 1;
        // } else {
        //     // invalid username
        //     return false;
        // }
    } catch (PDOException $error) {
        echo "Failed: ", $error->getMessage();
        return false;
    }    
}
?>