<?php
require 'searchParking.php';

echo '<table class="resultsTable">
<tr>
    <th>Name</th>
    <th>Available Spots</th>
    <th>Hourly Rate (C$)</th>
</tr>';

foreach ($results as $parking) {
    $name = $parking['name'];
    $hourlyRate = $parking['hourlyRate'];
    $numberOfSpots = $parking['numberOfSpots'];

    echo '<tr>
        <td><a href="parking.php">Indigo</a></td>
        <td>$numberOfSpots</td>
        <td>$hourlyRate</td>
        </tr>';
}

echo '</table>';
?>