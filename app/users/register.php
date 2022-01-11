<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Om man fyller i användarnamn, email, lösenord och fullname filtreras, sanitizas, trimmas (och lösenordet hashas)
//det du skrivit in och sparas i variabler.

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['full-name'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    if (strlen($_POST['password']) < 16) {
        $_SESSION['error'] = 'Password needs to be at least 16 characters';
        redirect('/signup.php');
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = trim(filter_var($_POST['full-name'], FILTER_SANITIZE_STRING));

    //Här läggs det som användaren fyllt i in i databasen på ett säkrare sätt med hjälp av tomma "placeholders".

    $statement = $database->prepare("INSERT INTO users (username, email, name, password) VALUES (:username, :email, :fullname, :password)");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);

    //Det hela körs.

    $statement->execute();
}

//Användaren skickas till login-sidan.
redirect('/login.php');
