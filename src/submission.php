<!DOCTYPE html>
<?php 
// This page is only accessible if used is signed in
session_start();
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    exit();
}
include '../php/newParking.php';
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Parking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <script type="text/javascript" src="../js/location.js"></script>
</head>
<body>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    <br>

    <div class="content">
        <form action="submission.php" method="POST" class="forms" enctype="multipart/form-data">
            <p>
            <label>Name*:</label>
                <!-- Name must be a upper or lowercase alphabet 
                    followed by a series of alphabets or spaces -->
                <input type="text" name="name" required="required" pattern="[A-Za-z][A-Za-z ]*" value="<?php echo $nameValue; ?>">
            </p>
            <p>
            <label>Description:</label>
                <!-- Maxlength specifies a maximum of 250 characters in the description -->
                <textarea name="description" rows="3" cols="30" maxlength="250" value="<?php echo $descriptionValue; ?>"></textarea>
            </p>
            <p>
            <label>Hourly Rate (CAD)*:</label>
                <!-- Default value of $50 -->
                <input type="number" name="rate" min="1" max="50" required="required" value="<?php echo $rateValue; ?>">
            </p>
            <p>
            <label>Number of spots*:</label>
                <!-- Default value of 100 spots -->
                <input type="number" name="spots" min="1" max="100" value="<?php echo $spotsValue; ?>">
            </p>
            <p>
            <label>Location:</label>
                <!-- Autodetect location and populate input box or manually enter a numeric value in the range -->
                <input type="button" value="Auto Detect Location" id="geoLocate" onclick="getLocation()"> <br>
                Latitude*:
                    <input type="number" name="latitude" id="latCoord" min="-90" max="90" step="0.001" required="required" value="<?php echo $latitudeValue; ?>"> <br>
                Longitude*:
                    <input type="number" name="longitude" id="longCoord" min="-180" max="180" step="0.001" required="required" value="<?php echo $longitudeValue; ?>">
            </p>
            <p>
            <label>Website*:</label>
                <!-- Specifying the type as URL automatically ensures the input is a well-formatted url 
                The https:// value hints the user about the required URL format. -->
                <input type="url" name="website" placeholder="https://" required="required" value="<?php echo $websiteValue; ?>">
            </p>
            <p>
            <label>Payment Options*:</label>
                <input type="checkbox" name="payment_list[]" value="Visa">Visa
                <input type="checkbox" name="payment_list[]" value="Cash" checked="checked">Cash
                <input type="checkbox" name="payment_list[]" value="Debit">Debit
            </p>
            <p>
            <label>Image*:</label>
                <!-- Only accepts jpeg images files. -->
                <input type="file" name="spotImage" accept="image/jpeg" required="required">
            </p>

            <br>
            <div class="submitButton">
                <input type="submit" name="submitParking" value="Submit">
            </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>