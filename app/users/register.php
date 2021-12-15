<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $destination =  __DIR__ . '/../../assets/uploaded-images/' . date("y-m-d") . $avatar['name'];
    move_uploaded_file($avatar['tmp_name'], $destination);
    $message = 'The file was successfully uploaded!';
}

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $email = $_POST['email'];
    // $imgurl = $_FILES['avatar'];
    $password = $_POST['password'];
    $fullname = $_POST['full-name'];

    $database = new PDO('sqlite:database.db');

    $database->exec("INSERT INTO users (nickname, email, name, password) VALUES ('$username', '$email', '$fullname', '$password')");
}

redirect('/');
