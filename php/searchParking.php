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
    // TODO: validate input

    try {
        // valid input, run search
        $searchQuery = "SELECT * FROM parkingSpace pS WHERE ";
        if (isset($_POST['name']) && $_POST['name'] != "") {
            $searchQuery .= "`name` = :name AND ";
        }

        if (isset($_POST['rate']) && $_POST['rate'] != "") {
            $searchQuery .= "`hourlyRate` = :rate AND ";
        }

        if (isset($_POST['latitude']) && $_POST['latitude'] != "" &&
            isset($_POST['longitude']) && $_POST['longitude'] != "" &&
            isset($_POST['radius']) && $_POST['radius'] != "" ) {
            $searchQuery .= "(ABS(`latitude` - :latitude) <= :radius AND ABS(`longitude` - :longitude) <= :radius) AND ";
        }

        if (isset($_POST['rating']) && $_POST['rating'] != "") {
            $searchQuery .= "( SELECT AVG(`rating`) FROM review WHERE pS.id = parkingID GROUP BY parkingID) >= :rating AND ";
        }

        // remove the last `AND ` from search string
        $searchQuery = substr_replace($searchQuery,"",-4);

        $query = $conn->prepare($searchQuery);

        $query->bindValue(':name', $name);
        $query->bindValue(':rate', $hourlyRate);
        $query->bindValue(':latitude', $latitude);
        $query->bindValue(':longitude', $longitude);
        $query->bindValue(':rating', $rating);
        $query->bindValue(':radius', $radius);

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