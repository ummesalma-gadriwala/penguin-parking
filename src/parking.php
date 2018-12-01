<!DOCTYPE html>
<?php 
include '../php/parkingDetails.php';
include '../php/submitReview.php'; 
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Indigo Parking Garage</title>

    <meta property="og:title" content="Penguin Parking Services">
    <meta property="og:description" content="Indigo Parking Garage">
    <meta property="og:image" content="../media/penguin.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
    </script>
    <script type="text/javascript" src="../js/map.js"></script> 
    <script type="text/javascript" src="../js/reviewForm.js"></script> 
</head>
<body onload=<?php displayMap($parkingName, $latitude, $longitude, $website); ?>>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    <br>

    <div class="content">
    <h3 class="parkingHeader">
        <?php
        echo "<a href=$website target='_blank'>$parkingName</a>";
        ?>
    </h3>
    <p>
        <b>Description:</b> <?php echo "$description"; ?>
    </p>
    <p>
        <b>Rate:</b> C$<?php echo "$rate"; ?>
    </p>
    <p>
        <b>Available spots:</b> <?php echo "$spots"; ?>
    </p>
    <p>
        <b>Location: <code><?php echo "$latitude, $longitude"; ?></code></b>
    </p>
    <p>
        <b>Payment options:</b> <?php echo "$payment"; ?>
    </p>
    <?php include '../php/reviewForm.php'; ?>
        <b>Reviews:</b>

        
        <form action="parking.php" method="GET" class="reviewForm">
            <input type="submit" name="reviewSubmit" value="Write a review">
        </form>

        <table class="reviewsTable">
            <?php displayReviewTable($result); ?>
        </table>

    

    <h4>
        Map:
    </h4>

    <div id="mapId"></div> <br>
    
    <?php echo $imageElement; ?>
    </div>
    
    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>