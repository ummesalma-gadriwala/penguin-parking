<?php
require_once("dbConnect.php"); // connect to database
require("S3.php");

$awsAccessKey = "AKIAJRMQ2WV7NWEKIIDA";
$awsSecretKey = "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";
$bucketName = "gadriwau";

$s3 = new S3($awsAccessKey, $awsSecretKey);

if (isset($_POST['submitParking'])) {
    // paramaters are set

    // error check to see if file was correctly uploaded
    if (!isset($_FILES['spotImage']['error']) ||
        ($_FILES["spotImage"]["error"] != UPLOAD_ERR_OK)) {
        echo "Error uploading file.";
        $imageName = "uploadError";
        exit();
    }

    // check to see if user has uploaded file of type image
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if ($finfo->file($_FILES["spotImage"]["tmp_name"]) === "image/jpeg") {
        $imageExtension = "jpg";
    } else {
        $imageName = "invalidFile";
        echo "Uploaded file was not a valid image";
        exit();
    }

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
        validateInteger($rate, 1, 50) &&
        validateInteger($spots, 1, 100) &&
        validateFloat($latitude, -90, 90) &&
        validateFloat($longitude, -180, 180) &&
        count($paymentList) !== 0 &&
        validateURL($website)) {

        try {
            // uploading image to S3 bucket
            // generate unique filename
            $imageHash = sha1_file($_FILES["spotImage"]["tmp_name"]);
            $imageName = $imageHash . "." . $imageExtension;

            $ok = $s3->putObjectFile($_FILES["spotImage"]["tmp_name"],
                                     $bucketName,
                                     $imageName,
                                     S3::ACL_PUBLIC_READ);

            if ($ok) {
                $url = 'https://s3.amazonaws.com/' . $bucketName . '/' . $imageName;
                echo "File upload successful: ", $url;
            } else {
                echo "Error uploading file to bucket.";
                $imageName = "s3UploadError";
            }

            // valid user information, add to database
            $stmt = $conn->prepare(
                'INSERT INTO parkingSpace(name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions, imageName)
                VALUES
                (:name, :description, :rate, :spots, :latitude, :longitude, :website, :payment, :imageName)'
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
            $stmt->bindValue(':imageName', $imageName);
            
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
    $pattern = '/^[A-Za-z]+$/';

    return preg_match($pattern, $name) === 1;
}

function validateInteger($i, $min, $max) {
    $number = intval($i, 10);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateFloat($f, $min, $max) {
    $number = floatval($f);
    return ($number !== 0 &&
        $number >= $min &&
        $number <= $max);
}

function validateURL($url) {
    $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

    return preg_match($pattern, $url) === 1;
}
?>