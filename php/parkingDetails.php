<?php
$parkingName = $_GET['name'];
if (isset($_GET['name'])) {
    $parkingName = $_GET['name'];
} else {
    $parkingName = $_SESSION['parkingName'];
}
require_once("dbConnect.php");
try {
    // get details of parking from parkingSpace table
    $query = $conn->prepare(
        'SELECT * FROM parkingSpace
        WHERE `name` = :parkingName'
    );

    $query->bindValue(':parkingName', $parkingName);
    $query->execute();

    // since name is unique, only one record is found
    $result = $query->fetch();
    $parkingID = $result['id'];
    $description = $result['description'];
    $rate = $result['hourlyRate'];
    $spots = $result['numberOfSpots'];
    $latitude = $result['latitude'];
    $longitude = $result['longitude'];
    $website = $result['website'];
    $imageName = $result['imageName'];
    $paymentOptions = $result['paymentOptions'];

    $payment = getPaymentString($paymentOptions);

    $imageURL = "";
    if (!is_null($imageName) || $imageName !== "") {
        $imageURL = "https://s3.amazonaws.com/gadriwau/" . $imageName;
    }

    // storing parkingID as session variable to facilitate adding reviews later
    $_SESSION['parkingID'] = $parkingID;
    $_SESSION['parkingName'] = $parkingName;

    // get parking reviews from review table
    $query = $conn->prepare(
        'SELECT reviewsWithNames.review, reviewsWithNames.rating, reviewsWithNames.username FROM 
            (SELECT review.parkingID, review.review, review.rating, user.username
             FROM review, user
             WHERE review.userID = user.id
            ) reviewsWithNames
        WHERE
        reviewsWithNames.parkingID = :parkingID'
    );

    $query->bindValue(':parkingID', $parkingID);
    $query->execute();
    $result = $query->fetchAll();

} catch (PDOException $error) {
    echo "Error: ", $error->getMessage();
}

function getPaymentString($paymentOptions) {
    $payment = "";
    $length = strlen( $paymentOptions );
    for( $i = 0; $i <= $length; $i++ ) {
        $char = substr( $paymentOptions, $i, 1 );
        switch ($char) {
            case "1":
                $payment .= "Visa ";
                break;
            case "2":
                $payment .= "Cash ";
                break;
            case "3":
                $payment .= "Debit ";
                break;
            default:
                break;
        }
    }

    return $payment;
}

function displayReviewTable($result) {
    foreach ($result as $review) {
        $description = $review['review'];
        $rating = intval($review['rating'], 10);
        $username = $review['username'];

        echo "<tr>
                <td>$username</td>
                <td>";

        for ($i = 0; $i < 5; $i++) {
            if ($rating != 0) {
                echo "<span class='fa fa-star checked'></span>";
                $rating--;
            } else {
                echo "<span class='fa fa-star'></span>";
            }
        }
        
        echo "<p class='review'>$description</p>
                </td>
            </tr>";
    }
}

function displayMap($parkingName, $latitude, $longitude, $website) {
    $arr = ["name" => $parkingName,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "website" => $website];

    echo "'parkingResult(",json_encode($arr),")'";
}
?>