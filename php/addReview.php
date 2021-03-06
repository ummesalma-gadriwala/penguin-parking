<?php
require_once("dbConnect.php");
include("validate.php");
session_start();
$parkingName = $_GET['name'];

if (isset($_POST["addReview"])) {
    // prompt user to log in to add review if not already
    if (!isset($_SESSION['isLoggedIn'])) {
        echo "<script type='text/javascript'>window.alert('Sign in to add your review.');</script>";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name=" . $parkingName);
        exit();
    }
    // get parameters
    if (isset($_POST["rating"]) && !empty($_POST["rating"])) {
        // getting form parameters from POST
        $review = htmlspecialchars($_POST["review"]);
        $rating = htmlspecialchars($_POST["rating"]);
        $username = $_SESSION["username"];
        $parkingID = $_SESSION["parkingID"];

        // Convert rating and review using htmlspecialchars to prevent XXS attack
        $ratingValue = $rating;
        $reviewValue = $review;
        
        // rating must be an integer between 0 and 5, if rating validation fails, ratingValue is set to 0.
        if (validateInteger($rating, 0, 5, $ratingValue)) {
            try {
                // valid data, add review to database

                // find a single userID from username (username is unique)
                // userID not directly exposed on client-side for security
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

                // test if userID, parkingID combination already exists in database
                $query = $conn->prepare(
                    'SELECT *
                    FROM review
                    WHERE `parkingID` = :parkingID AND `userID` = :userID'
                );

                $query->bindValue(':parkingID', $parkingID);
                $query->bindValue(':userID', $userID);
                $query->execute();
                if ($query->rowCount() !== 0) {
                    echo '<script type="text/javascript">window.alert("You have already submitted a review for this parking space.");</script>';
                    exit();
                }

                // insert review into db
                $stmt = $conn->prepare(
                    'INSERT INTO review (parkingID, userID, review, rating)
                    VALUES (:parkingID, :userID, :review, :rating)'
                );
                
                // Using bindValue to precent XXS attacks
                $stmt->bindValue(':parkingID', $parkingID);
                $stmt->bindValue(':userID', $userID);
                $stmt->bindValue(':review', $review);
                $stmt->bindValue(':rating', $rating);
                
                $stmt->execute();
                
                // Reload parking page with new review added.
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name=" . $parkingName);
                exit();
            } catch (PDOException $error) {
                echo '<script type="text/javascript">window.alert("Error occurred. Please try again.");</script>';
                // echo "Error: ", $error->getMessage();
            }
        } else {
            // Display alert for invalid data.
            echo "<script type='text/javascript'>window.alert('Please enter a valid rating.');</script>";
        }
    } else {
        // Display alert if rating not entered.
        echo "<script type='text/javascript'>window.alert('Please enter a rating.');</script>";
    }
}

?>