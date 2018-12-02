<!DOCTYPE html>
<?php 
// This page is only accessible if user is signed in
session_start();
$parkingName = $_GET['name'];
if (!isset($_SESSION['isLoggedIn'])) {
    if (isset($_GET['name'])) {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name" . $parkingName);
    } else {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    }
    exit();
}
include '../php/reviewForm.php';
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parking Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    
    <div class="content">
        <br>
        <form action="" method="POST" class="forms">
        <p>
        <label>Review:</label>
            <!-- Maxlength specifies a maximum of 250 characters in the description -->
            <textarea name="review" rows="3" cols="30" maxlength="250"></textarea>
        </p>
        <p>
        <label>Rating:</label>
            <!-- Default value of 5 -->
            <input type="range"name="rating" min="0" max="5" value="5" class="slider" id="ratingRange" step="1">
        </p>
        <br>
        <div class="submitButton">
            <input type="submit" name="addReview" value="Submit">
        </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>