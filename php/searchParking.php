<?php
require_once("dbConnect.php");
session_start();
if (isset($_POST['searchParking'])) {
    // get parameters
    $name = htmlspecialchars($_POST["name"]);
    $rate = htmlspecialchars($_POST["rate"]);
    $latitude = htmlspecialchars($_POST["latitude"]);
    $longitude = htmlspecialchars($_POST["longitude"]);
    $radius = htmlspecialchars($_POST["radius"]);
    $rating = htmlspecialchars($_POST["rating"]);
    
    // validate input
    // The parameters must be set and not empty
    if ((isset($_POST['name']) && !empty($_POST['name'])) ||
        (isset($_POST['rate']) && !empty($_POST['rate'])) ||
        (isset($_POST['latitude']) && !empty($_POST['latitude']) &&
         isset($_POST['longitude']) && !empty($_POST['longitude']) &&
         isset($_POST['radius']) && !empty($_POST['radius'])) ||
        (isset($_POST['rating']) && !empty($_POST['rating']))) {
            $addName = false;
            $addRate = false;
            $addLocation = false;
            $addRating = false;

            $_SESSION["latitude"] = $latitude;
            $_SESSION["longitude"] = $longitude;
        
            try {
                // valid input, run search
                $searchQuery = "SELECT * FROM parkingSpace pS WHERE ";

                // Add search paramaters to the query if they are set and not empty
                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    $searchQuery .= "`name` LIKE :name AND ";
                    $addName = true;
                }
        
                if (isset($_POST['rate']) && !empty($_POST['rate'])) {
                    $searchQuery .= "`hourlyRate` <= :rate AND ";
                    $addRate = true;
                }
        
                if (isset($_POST['latitude']) && !empty($_POST['latitude']) &&
                    isset($_POST['longitude']) && !empty($_POST['longitude']) &&
                    isset($_POST['radius']) && !empty($_POST['radius'])) {
                    $searchQuery .= "(ABS(`latitude` - :latitude) <= :radius AND ABS(`longitude` - :longitude) <= :radius) AND ";
                    $addLocation = true;
                }
        
                if (isset($_POST['rating']) && !empty($_POST['rating'])) {
                    $searchQuery .= "( SELECT AVG(`rating`) FROM review WHERE pS.id = parkingID GROUP BY parkingID) >= :rating AND ";
                    $addRating = true;
                }
        
                // remove the last `AND ` from search string
                $searchQuery = substr_replace($searchQuery,"",-4);
        
                $query = $conn->prepare($searchQuery);
        
                if ($addName) {
                    $query->bindValue(':name', $name);
                }
                if ($addRate) {
                    $query->bindValue(':rate', $rate);
                }
                
                if ($addLocation) {
                    $query->bindValue(':latitude', $latitude);
                    $query->bindValue(':longitude', $longitude);
                    $query->bindValue(':radius', $radius);
                }
                
                if ($addRating) {
                    $query->bindValue(':rating', $rating);
                }
                
        
                $query->execute();
                $result = $query->fetchAll();
                
                // echo "search completed.";
                if (empty($result)) {
                    // no result found
                    // Display alert on screen
                    echo '<script type="text/javascript">window.alert("No parking spaces found.");</script>';
                    echo '<script type="text/javascript">window.history.back();</script>';
                } else {
                    // Redirect to results page
                    $_SESSION['parkingResult'] = $result;
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/results.php");
                }
                
                exit();
            } catch (PDOException $error) {}            
        } else {
            echo '<script type="text/javascript">window.alert("Enter at least one parameter to search.");</script>';
            echo '<script type="text/javascript">window.history.back();</script>';
            exit();
        }

}
?>