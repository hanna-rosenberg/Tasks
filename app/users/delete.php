<?php

require __DIR__ . '/../autoload.php';

// If user enters password to delete profile
if (isset($_POST['delete'])) {
    // Step 1. Fetch user info
    $userID = $_SESSION['user']['id'];

    $statement = $database->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $userID, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Step 2 Check if password is correct
    if (password_verify($_POST['delete'], $user['password'])) {
        // If password checks out, we can now delete the profile
        $_SESSION['deleteMessage'] = 'It checks out';
        redirect('/edit.php');
    } else {
        // If password doesn't checks out, throw out an error
        $_SESSION['warning'] = 'Seems like you entered the wrong password. Please try again.';
        redirect('/edit.php');
    }
}
