<?php
require_once("dbConnect.php");
include("validate.php");
session_start();
$parkingName = $_GET['name'];

if (isset($_POST["addReview"])) {
    // prompt user to log in to add review if not already
    if (!isset($_SESSION['isLoggedIn'])) {
        echo "<script type='text/javascript'>window.alert('Sign in to add your review.');</script>";
        exit();
    }
    // get parameters
    if (isset($_POST["rating"])) {

        $review = $_POST["review"];
        $rating = $_POST["rating"];
        $username = $_SESSION["username"];
        $parkingID = $_SESSION["parkingID"];
        
        if (validateInteger($rating, 0, 5)) {
            try {
                echo "data is valid";
                // valid data, add review to database

                // find userID from username (username is unique)
                $query = $conn->prepare(
                    'SELECT id FROM user
                    WHERE
                    `username` = :username'
                );
        
                $query->bindValue(':username', $username);
                $query->execute();
                $result = $query->fetch();
                $userID = $result['id'];

                // find parkingID from parkingName (parkingName is unique)
                $query = $conn->prepare(
                    'SELECT id FROM parkingSpace
                    WHERE
                    `name` = :parkingName'
                );
        
                $query->bindValue(':parkingName', $parkingName);
                $query->execute();
                $result = $query->fetch();
                $parkingID = $result['id'];

                // insert review into db
                $stmt = $conn->prepare(
                    'INSERT INTO review (parkingID, userID, review, rating)
                    VALUES (:parkingID, :userID, :review, :rating)'
                );
        
                $stmt->bindValue(':parkingID', $parkingID);
                $stmt->bindValue(':userID', $userID);
                $stmt->bindValue(':review', $review);
                $stmt->bindValue(':rating', $rating);
                
                $stmt->execute();
                
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name=" . $parkingName);
                exit();
            } catch (PDOException $error) {
                echo "Error: ", $error->getMessage();
            }
        }
    }
}

?>