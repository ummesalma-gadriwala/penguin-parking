<?php
require_once("dbConnect.php");
session_start();

if (isset($_GET["reviewSubmit"])) {
    // This form is only accessible if user is signed in
    if (!isset($_SESSION['isLoggedIn'])) {
        echo '<script type="text/javascript">window.alert("Sign in to add a review.");</script>';
        exit();
    }
}

if (isset($_POST["addReview"])) {
    // get parameters
    if (isset($_POST["rating"])) {

        $review = $_POST["review"];
        $rating = $_POST["rating"];
        $username = $_SESSION["username"];
        $parkingID = $_SESSION["parkingID"];

        // TODO: validate form input
        if (validateInteger($rating, 0, 5)) {
            try {
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
                
                echo "Review added!";
                header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name=" . $parkingName);
                exit();
            } catch (PDOException $error) {
                echo "Error: ", $error->getMessage();
            }
        }

    
    
}
}

function displayForm() {
    echo "style='display:block;'";
}
?>