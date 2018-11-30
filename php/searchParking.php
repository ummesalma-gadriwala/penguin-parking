<?php
require_once("dbConnect.php");
session_start();
if (isset($_POST['searchParking'])) {
    // get parameters
    $name = $_POST["name"];
    $rate = $_POST["rate"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $radius = $_POST["radius"];
    $rating = $_POST["rating"];
    echo "got parameters";
    // validate input
    if ((isset($_POST['name']) && $_POST['name'] != "") ||
        (isset($_POST['rate']) && $_POST['rate'] != "") ||
        (isset($_POST['latitude']) && $_POST['latitude'] != "" &&
         isset($_POST['longitude']) && $_POST['longitude'] != "" &&
         isset($_POST['radius']) && $_POST['radius'] != "") ||
        (isset($_POST['rating']) && $_POST['rating'] != "")) {
            echo '<script type="text/javascript">window.alert("Enter at least one parameter to search.");</script>';
            exit();
        }

    $addName = false;
    $addRate = false;
    $addLocation = false;
    $addRating = false;

    try {
        // valid input, run search
        $searchQuery = "SELECT * FROM parkingSpace pS WHERE ";
        if (isset($_POST['name']) && $_POST['name'] != "") {
            $searchQuery .= "`name` LIKE :name AND ";
            $addName = true;
        }

        if (isset($_POST['rate']) && $_POST['rate'] != "") {
            $searchQuery .= "`hourlyRate` = :rate AND ";
            $addRate = true;
        }

        if (isset($_POST['latitude']) && $_POST['latitude'] != "" &&
            isset($_POST['longitude']) && $_POST['longitude'] != "" &&
            isset($_POST['radius']) && $_POST['radius'] != "" ) {
            $searchQuery .= "(ABS(`latitude` - :latitude) <= :radius AND ABS(`longitude` - :longitude) <= :radius) AND ";
            $addLocation = true;
        }

        if (isset($_POST['rating']) && $_POST['rating'] != "") {
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
            $query->bindValue(':rate', $hourlyRate);
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
        
        echo "search completed.";
        $_SESSION['parkingResult'] = $result;
        // foreach ($result as $parking) {
        //     $name = $parking['name'];
        //     $hourlyRate = $parking['hourlyRate'];
        //     $numberOfSpots = $parking['numberOfSpots'];
        //     echo "$name";
        // }
        
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/results.php");
        exit();
    } catch (PDOException $error) {
        echo "Error: ", $error->getMessage();
    }
}
?>