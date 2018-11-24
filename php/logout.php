<?php
// if user has pressed the signout button
if (isset($_POST['signout'])) {
    session_start();
    unset($_SESSION['isLoggedIn']);
    unset($_SESSION['username']);
    session_destroy();
    echo "Logout successful.";
    exit();
}
?>