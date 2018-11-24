<?php
// if user has pressed the submit button
if (isset($_POST['signout'])) {
    // if the username and password fields are not empty or null
    
    session_start();
                unset($_SESSION['isLoggedIn']);
                echo "Logout successful.";
                exit();
    
}
?>