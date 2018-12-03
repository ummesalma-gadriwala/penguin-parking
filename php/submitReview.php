<?php
session_start();

if (isset($_GET["reviewSubmit"])) {
    // This form is only accessible if user is signed in
    if (!isset($_SESSION['isLoggedIn'])) {
        echo '<script type="text/javascript">window.alert("Sign in to add a review.");</script>';
        // header("Location: http://" . $_SERVER['HTTP_HOST'] . "/parking.php?name=" . $_SESSION['parkingName']);
        exit();
    }

    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/review.php");
}
?>