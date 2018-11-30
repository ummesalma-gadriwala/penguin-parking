<?php
require 'searchParking.php';
session_start();

function displayTable() {
    $result = $_SESSION['parkingResult'];
    if (!empty($result)) {
        echo '<table class="resultsTable">
        <tr>
            <th>Name</th>
            <th>Available Spots</th>
            <th> Hourly Rate (C$)</th>
        </tr>';    
    }
    
    foreach ($result as $parking) {
        $name = $parking['name'];
        $hourlyRate = $parking['hourlyRate'];
        $numberOfSpots = $parking['numberOfSpots'];
    
        echo "<tr>
            <td><a href='parking.php?name=$name'>$name</a></td>
            <td>$numberOfSpots</td>
            <td>$hourlyRate</td>
            </tr>";
    }

    if (!empty($result)) {
        echo '</table>';
    }
}

function displayMap() {
    $result = $_SESSION['parkingResult'];
    $latitude = $_SESSION["latitude"];
    $longitude = $_SESSION["longitude"];

    // create an array of [latitude, longitude]
    // first element of array is current location
    // followed by locations of all parking results
    $arr = [[floatval($latitude), floatval($longitude)]];
    foreach ($result as $parking) {
        $name = $parking['name'];
        $latitude = $parking['latitude'];
        $longitude = $parking['longitude'];
        
        array_push($arr, [$name, floatval($latitude), floatval($longitude)]);
    }
    
    // pass this array to searchResult() in javascript
    echo "'searchResult(",json_encode($arr),")'";
}

?>