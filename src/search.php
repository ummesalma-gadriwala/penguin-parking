<!DOCTYPE html>
<?php include '../php/searchParking.php'; ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parking Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="../js/location.js"></script> 
    <script type="text/javascript" src="../js/validate.js"></script> 
</head>
<body>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    
    <div class="content">
        <br>
        <form action="search.php" method="POST" class="forms" onsubmit="return validateSearchForm(this);">
            <p>
            <label>Name</label>
                <input type="text" name="name" id="name">
            </p>
            <p>
            <label>Maximum Hourly Rate:</label>
                <input type="number" name="rate" id="rate" min="0" max="50" value="0">
            </p>
            <p>
            <label>Location:</label>
                <input type="button" value="Auto Detect Location" id="geoLocate" onclick="getLocation()"> <br>
                Latitude:
                    <input type="number" name="latitude" id="latCoord" min="-90" max="90" step="0.001"> <br>
                Longitude:
                    <input type="number" name="longitude" id="longCoord" min="-180" max="180" step="0.001" >
            </p>
            <p>
            <label>Radius:</label>
                <input type="number" name="radius" min="0" max="50" value="0">
            </p>
            <p>
            <label>Minimum Rating:</label>
                <select name="rating">
                    <option value="" selected>Rating...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select> 
            </p>
            <!-- <p>
            <label>Payment Method:</label>
                <input type="radio" name="payment" value="Visa">Visa
                <input type="radio" name="payment" value="Cash" checked="checked">Cash
                <input type="radio" name="payment" value="Debit">Debit
            </p> -->
            <br>
            <div class="submitButton">
                <input type="submit" name="searchParking" value="Search">
            </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>