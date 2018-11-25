<?php
session_start();
if (isset($_GET["reviewSubmit"])) {
    // This page is only accessible if user is signed in
    if (!isset($_SESSION['isLoggedIn'])) {
        echo '<script type="text/javascript">window.alert("Sign in to add a review.");</script>';
        exit();
    }
    echo
    '<form action="submission.php" method="POST" class="forms">
    <p>
    <label>Description:</label>
        <!-- Maxlength specifies a maximum of 250 characters in the description -->
        <textarea name="Description" rows="3" cols="30" maxlength="250"></textarea>
    </p>
    <p>
    <label>Rating:</label>
        <!-- Default value of 5 -->
        <input type="range"name="rating" min="0" max="5" value="5" class="slider" id="ratingRange" step="1">
    </p>
    <br>
    <div class="submitButton">
        <input type="submit" name="addReview" value="Submit">
    </div>
    </form>';
}
?>