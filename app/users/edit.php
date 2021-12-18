<?php

//Om man lägger upp en profilbild skall den sparas i assets/uploaded-images. 

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    // $destination =  __DIR__ . '/../../assets/uploaded-images/' . date("y-m-d") . $avatar['name'];
    $destination =  __DIR__ . '/../../uploads/' . date("y-m-d") . $avatar['name'];
    move_uploaded_file($avatar['tmp_name'], $destination);
    $message = 'The file was successfully uploaded!';
}
