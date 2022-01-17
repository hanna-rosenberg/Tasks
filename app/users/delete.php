<?php

require __DIR__ . '/../autoload.php';

// If user enters password to delete profile
if (isset($_POST['delete'])) {
    // Step 1. Fetch user info
    $userID = $_SESSION['user']['id'];

    $statement = $database->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $userID, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Step 2 Check if password is correct
    if (password_verify($_POST['delete'], $user['password'])) {
        // If password checks out, we can now delete the profile

        // Step 2.1 We want to delete all tasks related to user
        $statement = $database->prepare('DELETE FROM tasks WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $statement->execute();

        // Step 2.2 We want to delete all lists related to user
        $statement = $database->prepare('DELETE FROM lists WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $userID, PDO::PARAM_INT);
        $statement->execute();

        // Step 2.3 Lastly, delete user from users table
        $statement = $database->prepare('DELETE FROM users WHERE id = :id');
        $statement->bindParam(':id', $userID, PDO::PARAM_INT);
        $statement->execute();

        unset($_SESSION['user']);

        redirect('/');
    } else {
        // If password doesn't checks out, throw out an error
        $_SESSION['warning'] = 'Seems like you entered the wrong password. Please try again.';
        redirect('/edit.php');
    }
}
