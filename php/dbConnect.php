<?php
// Connect to MySQL database using PDO
// Using PDO allows me to connect to any database (yayy!)
$serverName = "localhost";
$username = "";
$password = "";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=dbname",
                     $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<script type="text/javascript">window.alert("Error occurred. Please try again.");</script>';
}
?>