<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// if (isset($_FILES['avatar'])) {
//     $avatar = $_FILES['avatar'];
//     $destination =  __DIR__ . '/../../assets/uploaded-images/' . date("y-m-d") . $avatar['name'];
//     move_uploaded_file($avatar['tmp_name'], $destination);
//     $message = 'The file was successfully uploaded!';
// }


// om man fyller i användarnamn, email, lösenord och fullname filtreras, sanitizas, trimmas (och lösenordet hashas) 
// det du skrivit in och sparas i variabler. 
if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['full-name'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fullname = trim(filter_var($_POST['full-name'], FILTER_SANITIZE_STRING));

    // här läggs det inskriva in i databasen på ett säkrare sätt med hjälp av tomma "placeholders". BEHÖVS DENNA?
    // $sql = "INSERT INTO users (nickname, email, name, password) VALUES (':username', ':email', ':fullname', ':password')";

    $statement = $database->prepare("INSERT INTO users (username, email, name, password) VALUES (:username, :email, :fullname, :password)");
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);

    // det hela körs. 
    $statement->execute();
}

redirect('/login.php');
