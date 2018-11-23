<!DOCTYPE html>
<?php include('../php/login.php'); ?>
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
    <br>

    <div class="content">
        <form name="userSignIn" action="index.php" method="POST" class="forms">
            <p>
            <label>Username:</label>
                <input type="text" name="username" required="required">
            </p>
            <p>
            <label>Password:</label>
                <input type="password" name="password" required="required">
            </p>
            <br>
            <div class="loginButton">
                <input type="submit" name="signin" value="Sign In">
            </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>