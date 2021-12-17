<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


// if (isset($_FILES['avatar'])) {
//     $avatar = $_FILES['avatar'];
//     $destination =  __DIR__ . '/../../assets/uploaded-images/' . date("y-m-d") . $avatar['name'];
//     move_uploaded_file($avatar['tmp_name'], $destination);
//     $message = 'The file was successfully uploaded!';
// }

if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['full-name'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $fullname = $_POST['full-name'];

    $query = sprintf("INSERT INTO users (nickname, email, name, password) VALUES ('$username', '$email', '$fullname', '$password')");
    $statement = $database->query($query);
}

redirect('/');
