<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
        integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
        crossorigin="">
    </script>
    <script type="text/javascript" src="../js/map.js"></script> 
</head>
<body onload="searchResult()">
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>        
    <?php include '../php/menu.php'; ?>
    <br>

    <div class="content">
        <!-- This script displays a table of parking results. -->
        <?php include '../php/parkingResults.php' ?>
        <br>

        <div id="mapId"></div> <br>

        <!-- <div>
            <img src="../media/parkingMap.JPG" alt="Parking Spot Map" class="image" style="max-width: 731px">    
        </div> -->
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>