<?php
require_once("dbConnect.php");

if(isset($_POST['searchParking'])) {
    // get parameters
    $name = $_POST["name"];
    $rate = $_POST["rate"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $radius = $_POST["radius"];
    $rating = $_POST["rating"];

    // validate input

    try {
        // valid input, run search
        $query = $conn->prepare(
            'SELECT name, hourlyRate, numberOfSpots FROM parkingSpace pS
            WHERE
                `name` = :name OR 
                `hourlyRate` <= :rate OR 
                (ABS(`latitude` - :latitude) <= :radius AND 
                ABS(`longitude` - :longitude) <= :radius) OR
                ( SELECT AVG(`rating`) FROM review
                  WHERE pS.id = parkingID
                  GROUP BY parkingID
                ) >= :rating'
        );

        $query->bindValue(':name', $name);
        $query->bindValue(':hourlyRate', $hourlyRate);
        $query->bindValue(':latitude', $latitude);
        $query->bindValue(':longitude', $longitude);
        $query->bindValue(':rating', $rating);
        $query->bindValue(':radius', $radius);

        $query->execute();
        $result = $query->fetchAll();
        
        echo "search completed.";
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/results.php");
        exit();
    } catch (PDOException $error) {
        echo "Error: ", $error->getMessage();
    }
}
?>