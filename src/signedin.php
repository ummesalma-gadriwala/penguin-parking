<!DOCTYPE html>
<?php 
session_start();
include('../php/logout.php');
if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    exit();
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Penguin Parking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
</head>
<body>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>
    <?php include '../php/menu.php'; ?>
    
    <div class="signout">
    <form action="index.php" method="POST" class="forms">
        <input type="submit" value="Sign Out" name="signout"> <br>
    </form>
    </div>
    <p>
    Welcome!
    </p>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>