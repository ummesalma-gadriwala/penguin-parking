<?php
require_once("dbConnect.php"); // connect to database

if (isset($_POST['submitParking'])) {
    // paramaters are set
    if (isset($_POST['name']) &&
        isset($_POST['rate']) &&
        isset($_POST['spots']) &&
        isset($_POST['latitude']) &&
        isset($_POST['longitude']) &&
        isset($_POST['payment_list']) &&
        isset($_POST['website'])) {
    // get parameters
    $name = $_POST["name"];
    $description = $_POST["description"];
    $rate = $_POST["rate"];
    $spots = $_POST["spots"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $paymentList = [];
    foreach ($_POST['payment_list'] as $payment) {
        switch ($payment) {
            case "Visa":
                $paymentList["Visa"] = 1;
                break;
            case "Cash":
                $paymentList["Cash"] = 2;
                break;
            case "Debit":
                $paymentList["Debit"] = 3;
                break;
            default:
                break;
        }
    }
    
    $website = $_POST["website"];
    
    // validate user registration form input
    if (validateName($name) &&
        validateFloat($rate, 1, 50) &&
        validateInteger($spots, 1, 100) &&
        validateFloat($latitude, -90, 90) &&
        validateFloat($longitude, -180, 180) &&
        count($paymentList) !== 0 &&
        validateURL($website)) {

        try {
            // valid user information, add to database
            $stmt = $conn->prepare(
                'INSERT INTO parkingSpace(name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
                VALUES
                (:name, :description, :rate, :spots, :latitude, :longitude, :website, :payment)'
            );

            $payment = getPayment($paymentList);

            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':rate', $rate);
            $stmt->bindValue(':spots', $spots);
            $stmt->bindValue(':latitude', $latitude);
            $stmt->bindValue(':longitude', $longitude);
            $stmt->bindValue(':website', $website);
            $stmt->bindValue(':payment', $payment);
            
            $stmt->execute();
            
            echo "New parking added!";
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/search.php");
            exit();
        } catch (PDOException $error) {
            echo "Error: ", $error->getMessage();
        }
    } else {
        echo "Invalid input data.";
    }
}
}

function getPayment($paymentList) {
    $str = "";
    foreach ($paymentList as $payment) {
        $str .= $payment;
    }

    return $str;
}

function validateName($name) {
    $pattern = '/^[A-Za-z]+[ ][A-Za-z]+$/';

    return preg_match($pattern, $name) === 1;
}

function validateInteger($i, $min, $max) {
    $number = intval($i, 10);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateFloat($f, $min, $max) {
    $number = floatval($i, 10);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateURL($url) {
    $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

    return preg_match($pattern, $url) === 1;
}
?>