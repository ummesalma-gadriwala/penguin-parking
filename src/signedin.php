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

    Welcome <?php echo $_SESSION['username']; ?>!
    
    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>