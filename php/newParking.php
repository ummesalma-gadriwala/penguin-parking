<?php
require_once("dbConnect.php"); // connect to database
include("validate.php"); // validation functions
require("S3.php"); // connecting to S3 bucket

$awsAccessKey = "";
$awsSecretKey = "";
$bucketName = "";
$s3 = new S3($awsAccessKey, $awsSecretKey);

if (isset($_POST['submitParking'])) {
    // paramaters are set

    // error check to see if file was correctly uploaded
    if (!isset($_FILES['spotImage']['error']) ||
        ($_FILES["spotImage"]["error"] != UPLOAD_ERR_OK)) {
        // echo "Error uploading file.";
        echo '<script type="text/javascript">window.alert("Error uploading file. Please try again.");</script>';
        $imageName = "";
        exit();
    }

    // check to see if user has uploaded file of type image/jpeg
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if ($finfo->file($_FILES["spotImage"]["tmp_name"]) === "image/jpeg") {
        $imageExtension = "jpg";
    } else {
        $imageName = "";
        echo '<script type="text/javascript">window.alert("Uploaded file was not a valid image. Please try again.");</script>';
        // echo "Uploaded file was not a valid image";
        exit();
    }

    // If the paramaters are set and not empty
    if (isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['rate']) && !empty($_POST['rate']) &&
        isset($_POST['spots']) && !empty($_POST['spots']) &&
        isset($_POST['latitude']) && !empty($_POST['latitude']) &&
        isset($_POST['longitude']) && !empty($_POST['longitude']) &&
        isset($_POST['payment_list']) && !empty($_POST['payment_list']) &&
        isset($_POST['website']) &&  !empty($_POST['website'])) {
            
    // get parameters with htmlspecialchars to avoid xxs attacks
    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $rate = htmlspecialchars($_POST["rate"]);
    $spots = htmlspecialchars($_POST["spots"]);
    $latitude = htmlspecialchars($_POST["latitude"]);
    $longitude = htmlspecialchars($_POST["longitude"]);
    $website = htmlspecialchars($_POST["website"]);
    $paymentList = [];

    // Store these values to reload them into form in case of error.
    $nameValue = $name;
    $descriptionValue = $description;
    $rateValue = $rate;
    $spotsValue = $spots;
    $latitudeValue = $latitude;
    $longitudeValue = $longitude;
    $websiteValue = $website;

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
    
    // validate user registration form input
    if (validateParkingName($name, $nameValue) &&
        validateInteger($rate, 1, 50, $rateValue) &&
        validateInteger($spots, 1, 100, $spotsValue) &&
        validateFloat($latitude, -90, 90, $latitudeValue) &&
        validateFloat($longitude, -180, 180, $longitudeValue) &&
        count($paymentList) !== 0 &&
        validateURL($website, $websiteValue)) {

        try {
            // test if parkingname already exists in database
            $query = $conn->prepare(
                'SELECT name
                FROM parkingSpace
                WHERE `name` = :name'
            );

            $query->bindValue(':name', $name);
            $query->execute();
            if ($query->rowCount() !== 0) {
                echo '<script type="text/javascript">window.alert("Parking already exists.");</script>';
                exit();
            }

            // uploading image to S3 bucket
            // generate unique filename
            $imageHash = sha1_file($_FILES["spotImage"]["tmp_name"]);
            $imageName = $imageHash . "." . $imageExtension;

            // upload the file to s3
            $ok = $s3->putObjectFile($_FILES["spotImage"]["tmp_name"],
                                     $bucketName,
                                     $imageName,
                                     S3::ACL_PUBLIC_READ);

            // file successfully uploaded to the bucket
            if ($ok) {
                $url = 'https://s3.amazonaws.com/' . $bucketName . '/' . $imageName;
            } else {
                // file upload failed, set imageName to empty
                $imageName = "";
            }

            // valid user information, add to database
            $stmt = $conn->prepare(
                'INSERT INTO parkingSpace(name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions, imageName)
                VALUES
                (:name, :description, :rate, :spots, :latitude, :longitude, :website, :payment, :imageName)'
            );

            // Convert payment from Cash, Debit, Visa to numeric form for storing in db
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
            
            // echo "New parking added!";
            // Redirect to search page
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/search.php");
            exit();
        } catch (PDOException $error) {
            echo '<script type="text/javascript">window.alert("Error occurred. Please try again.");</script>';
            // echo "Error: ", $error->getMessage();
        }
    } else {
        echo '<script type="text/javascript">window.alert("Invalid parking submission. Please try again.");</script>';
        // echo "Invalid input data.";
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
?>