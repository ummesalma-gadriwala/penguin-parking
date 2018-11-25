<?php
// Menu include file with HTML code for menu
session_start();
if (isset($_SESSION['isLoggedIn'])) {
    echo 
    '<ul class="menu">
        <li><a href="search.php">Search</a></li>
        <li><a href="register.php">New User</a></li>
        <li><a href="submission.php">New Parking Space</a></li>
        <li><a href="logout.php">Sign out</a></li>  
    </ul>';
} else {
    echo 
    '<ul class="menu">
        <li><a href="search.php">Search</a></li>
        <li><a href="register.php">New User</a></li>
        <li><a href="submission.php">New Parking Space</a></li>
        <li><a href="index.php">Sign in</a></li>
    </ul>';
}
?>