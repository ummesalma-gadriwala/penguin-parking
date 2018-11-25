<!DOCTYPE html>
<?php 
// This page is only accessible if used is signed in
session_start();
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    exit();
}
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
        <form action="submission.php" method="POST" class="forms">
            <p>
            <label>Name:</label>
                <!-- Name must be a upper or lowercase alphabet 
                    followed by a series of alphabets or spaces -->
                <input type="text" required="required" pattern="[A-Za-z][A-Za-z ]*">
            </p>
            <p>
            <label>Description:</label>
                <!-- Maxlength specifies a maximum of 250 characters in the description -->
                <textarea name="Description" rows="3" cols="30" maxlength="250"></textarea>
            </p>
            <p>
            <label>Hourly Rate (CAD):</label>
                <!-- Default value of $50 -->
                <input type="number" min="1" max="50" value="50" required="required">
            </p>
            <p>
            <label>Number of spots:</label>
                <!-- Default value of 100 spots -->
                <input type="number" min="1" max="100" value="100">
            </p>
            <p>
            <label>Location:</label>
                <!-- Autodetect location and populate input box or manually enter a numeric value in the range -->
                <input type="button" value="Auto Detect Location" id="geoLocate" onclick="getLocation()"> <br>
                Latitude:
                    <input type="number" id="latCoord" min="-90" max="90" step="0.001" required="required"> <br>
                Longitude:
                    <input type="number" id="longCoord" min="-180" max="180" step="0.001" required="required">
            </p>
            <!-- <p> -->
            <!-- <label>Rating:</label> -->
                <!-- Default value of 5 -->
                <!-- <input type="range" min="0" max="5" value="5" class="slider" id="ratingRange" step="1"> -->
            <!-- </p> -->
            <p>
            <label>Website:</label>
                <!-- Specifying the type as URL automatically ensures the input is a well-formatted url 
                The https:// value hints the user about the required URL format. -->
                <input type="url" placeholder="https://" required="required">
            </p>
            <p>
            <label>Payment Options:</label>
                <input type="checkbox" name="payment" value="Visa">Visa
                <input type="checkbox" name="payment" value="Cash" checked="checked">Cash
                <input type="checkbox" name="payment" value="Debit">Debit
            </p>
            <p>
            <label>Image:</label>
                <!-- Only accepts images files and is a required field. -->
                <input type="file" name="spotImage" accept="image/*" required="required">
            </p>

            <br>
            <div class="submitButton">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>