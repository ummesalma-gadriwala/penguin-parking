<?php
session_start();
if (isset($_GET["reviewSubmit"])) {
    // This form is only accessible if user is signed in
    if (!isset($_SESSION['isLoggedIn'])) {
        echo '<script type="text/javascript">window.alert("Sign in to add a review.");</script>';
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php");
        exit();
    }
    echo
    '<form action="submission.php" method="POST" class="forms">
    <p>
    <label>Review:</label>
        <!-- Maxlength specifies a maximum of 250 characters in the description -->
        <textarea name="review" rows="3" cols="30" maxlength="250"></textarea>
    </p>
    <p>
    <label>Rating:</label>
        <!-- Default value of 5 -->
        <input type="range"name="rating" min="0" max="5" value="5" class="slider" id="ratingRange" step="1">
    </p>
    <br>
    <div class="submitButton">
        <input type="submit" name="addReview" value="Submit">
    </div>
    </form>';
}

if (isset($_POST["addReview"])) {
    // get parameters
    if (isset($_POST["rating"])) {

        $review = $_POST["review"];
        $rating = $_POST["rating"];
        $username = $_SESSION["username"];
        $parkingName = $_SESSION["parkingName"];

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
        
                foreach ($result as $user) {
                    $userID = $user['id'];
                }
        
                // find parkingID from parkingName (parkingName is unique)
                $query = $conn->prepare(
                    'SELECT id FROM parkingSpace
                    WHERE
                    `name` = :parkingName'
                );
        
                $query->bindValue(':parkingName', $parkingName);
                $query->execute();
                $result = $query->fetch();
        
                foreach ($result as $parking) {
                    $parkingID = $parking['id'];
                }
        
                // insert review into db
                $stmt = $conn->prepare(
                    'INSERT INTO review(parkingID, userID, review, rating)
                    VALUES
                    (:parkingID, :userID, :review, :rating)'
                );
        
                $stmt->bindValue(':parkingID', $parkingID);
                $stmt->bindValue(':userID', $userID);
                $stmt->bindValue(':review', $review);
                $stmt->bindValue(':rating', $rating);
                
                $stmt->execute();
                
                echo "Review added!";
            } catch (PDOException $error) {
                echo "Error: ", $error->getMessage();
            }
        }

    
    
}
}
?>