<?php
$parkingName = $_GET['name'];
require_once("dbConnect.php");
try {
    // get details of parking from parkingSpace table
    $query = $conn->prepare(
        'SELECT * FROM parkingSpace
        WHERE `name` = :parkingName'
    );

    $query->bindValue(':parkingName', $parkingName);
    $query->execute();
    $result = $query->fetch();
        
    // since name is unique, only one record is found
    $parkingID = $result['id'];
    $description = $result['description'];
    $hourlyRate = $result['hourlyRate'];
    $numberOfSpots = $result['numberOfSpots'];
    $latitude = $result['latitude'];
    $longitude = $result['longitude'];
    $website = $result['website'];
    $paymentOptions = $result['paymentOptions'];

    $payment = getPaymentString($paymentOptions);

    // storing parkingID as session variable to facilitate adding reviews later
    $_SESSION['parkingID'] = $parkingID;

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
    $query->execute;
    $result = $query->fetch();

    // populate page display
    // parking name in header
    echo "<h3 class='parkingHeader'>
    <a href=$website target='_blank'>$parkingName</a>
    </h3>";
    // description, rate, spots, location and payment options
    echo "<p>
    <b>Description:</b> $description
    </p>
    <p>
    <b>Rate:</b> C$$rate
    </p>
    <p>
    <b>Available spots:</b> $spots
    </p>
    <p>
    <b>Location: <code>$latitude, $longitude</code></b>
    </p>
    <p>
    <b>Payment options:</b> $payment
    </p>";

    // review
    echo "<b>Reviews:</b>";
    echo "
    <form action='parking.php' method='GET' class='reviewForm'>
    <input type='submit' name='reviewSubmit' value='Write a review'>
    </form>
    <?php include '../php/reviewForm.php'; ?>";
    echo "<table class='reviewsTable'>";
    displayReviewTable($result);
    echo "</table>";
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
        $review = $review['review'];
        $rating = intval($review['rating'], 10);
        $username = $review['username'];

        echo "<tr>
                <td>$username</td>
                <td>";

        for ($i = 0; $i <= 5; $i++) {
            if ($rating != 0) {
                echo "<span class='fa fa-star checked'></span>";
                $rating--;
            }
            echo "<span class='fa fa-star'></span>";
        }
        
        echo "<p class='review'>$review</p>
                </td>
            </tr>";
    }
}
?>