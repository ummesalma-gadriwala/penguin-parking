<!DOCTYPE html>
<?php include('../php/newUser.php'); ?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../media/favicon.png">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
    <script type="text/javascript" src="../js/validate.js"></script> 
</head>
<body>
    <div class="everything">
    <div class="header">
        <?php include '../php/header.php';?>
    </div>            
    <?php include '../php/menu.php'; ?>
    <br>

    <div class="content">
        <form name="userRegistration" action="register.php" method="POST" class="forms" onsubmit="return validateUserRegistrationForm(this);">
            <p>
            <label>Full Name:</label>
                <input type="text" name="fullName" required="required" pattern="^[A-Za-z]+[ ][A-Za-z]+$" value=<?php $fullNameValue ?>>
            </p>
            <p>
            <label>Username:</label>
                <input type="text" name="username" required="required" pattern="^[A-z]+[A-z0-9.-]*$" minlength="2" maxlength="30" value=<?php $usernameValue ?>>
            </p>
            <p>
            <label>Date of Birth:</label>
                <!-- date is not supported in IE and Safari.
                    It degrades to a text field. -->
                <input type="date" name="dateOfBirth" value=<?php $dateOfBirthValue ?>>
            </p>
            <p>
            <label>E-mail:</label>
                <input type="email" name="email" required="required" value=<?php $emailValue ?>>
            </p>
            <p>
            <label>Password:</label>
                <input type="password" name="password" minlength="8" required="required">
            </p>
            <p>
            <label>Retype password:</label>
                <input type="password" name="passwordRetype" minlength="8" required="required">
            </p>
            <br>
            <div class="submitButton">
                <input type="submit" name="register" value="Register">
            </div>
        </form>
    </div>

    <div class="pageFooter">
        <?php include '../php/footer.php'; ?>
    </div>
    </div>
</body>
</html>