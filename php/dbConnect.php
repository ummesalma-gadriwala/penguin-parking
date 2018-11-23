<?php
// Connect to MySQL database using PDO
// Using PDO allows me to connect to any database (yayy!)
$serverName = "localhost";
$username = "gadriwau";
$password = "password";

try {
    $conn = new PDO("mysql:host=$serverName;dbName=gadriwau",
                     $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Connected successfully</p>";
} catch (PDOException $e) {
    echo "<p>Connection failed: ", $e->getMessage(), "</p>";
}
?>