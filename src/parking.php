<!DOCTYPE html>
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
</head>
<body onload="indigoParkingResult()">
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    <br>

    <div class="content">
    <h3 class="parkingHeader">
        <a href="https://ca.parkindigo.com/en/car-park/32-james-street-south" target="_blank">Indigo Parking Garage</a>
    </h3>
    <p>
        <b>Description:</b> Disabled spots, no height restrictions, manned, partially lit
    </p>
    <p>
        <b>Rate:</b> C$3
    </p>
    <p>
        <b>Available spots:</b> 100
    </p>
    <p>
        <b>Location: <code>43.256056, -79.869734</code></b>
    </p>
    <p>
        <b>Payment options:</b> Cash
    </p>
    <p>
        <b>Reviews:</b>
        <form action="signin.php" class="reviewForm">
            <input type="submit" value="Write a review">
        </form>
        <table class="reviewsTable">
            <tr>
                <td>ummesalma.g</td>
                <td>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <p class="review">
                    The parking space was clean and well-maintained.
                    </p>
                </td>
            </tr>
            <tr>
                <td>tasnim</td>
                <td>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <p class="review">
                    The shuttles are very timely, the price is great, and the cold bottled water on return was great!
                    </p>
                </td>
            </tr>
            <tr>
                <td>mindy</td>
                <td>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <p class="review">
                    Quick and easy parking especially if you make reservations on their app!
                    </p>
                </td>
            </tr>
            <tr>
                <td>brad</td>
                <td>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <p class="review">
                    Don't even bother coming here. They are always full. For some reason, even when they're full, you can make a reservation online. If you make a reservation online, be sure it's at least one hour prior to your check in time.
                    </p>
                </td>
            </tr>
        </table>

    

    <h4>
        Map:
    </h4>

    <div id="mapId"></div> <br>
    <!-- <img src="../media/indigoMap.JPG" alt="Indigo Parking Map" style="max-width:600px;" class="image"> <br> -->
    <img src="../media/indigo.JPG" alt="Indigo Parking Location" style="max-width:600px;" class="image"> <br>
    </div>
    
    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>