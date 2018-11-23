<?php
require_once("dbConnect.php"); // connect to database

// validate user registration form input


try {
    // valid user information, add to database
    $stmt = $conn->prepare(
        'INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
        VALUES
        (:fullName, :username, :dateOfBirth, :email, :passwordHash)'
        );

    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':dateOfBirth', $dateOfBirth);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':passwordHash', $passwordHash);

    $stmt->execute();

    echo "New user created!";
} catch (PDOException $error) {
    echo "Error: ", $error->getMessage();
}
?>