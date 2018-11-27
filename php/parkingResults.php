<?php
require 'searchParking.php';
session_start();
echo '<table class="resultsTable">
<tr>
    <th>Name</th>
    <th>Available Spots</th>
    <th> Hourly Rate (C$)</th>
</tr>';

$result = $_SESSION['parkingResult'];
foreach ($result as $parking) {
    $name = $parking['name'];
    $hourlyRate = $parking['hourlyRate'];
    $numberOfSpots = $parking['numberOfSpots'];

    echo '<tr>
        <td><a href="parking.php">$name</a></td>
        <td>$numberOfSpots</td>
        <td>$hourlyRate</td>
        </tr>';
}

echo '</table>';
?>