<?php
    session_start();
    unset($_SESSION['isLoggedIn']);
    unset($_SESSION['username']);
    session_destroy();
    // echo "Logout successful.";
    echo '<script type="text/javascript">window.alert("Logout successful.");</script>';
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/index.php");
    exit();
?>