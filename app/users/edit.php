<?php


require __DIR__ . '/../autoload.php';

//Om man lägger upp en profilbild skall den sparas i uploads-mappen.


// if (isset($_FILES['avatar'])) {
//     $avatar = $_FILES['avatar'];
//     $destination =  __DIR__ . '/../../uploads/' . date("y-m-d") . $avatar['name'];
//     move_uploaded_file($avatar['tmp_name'], $destination);
//     $message = 'The file is uploaded';
// }


if (isset($_FILES['avatar'])) {
    //saving image in filesystem
    $avatarImage = trim(filter_var($_FILES['avatar'], FILTER_SANITIZE_STRING));
    $avatar = $_FILES['avatar'];
    $filename = date("y-m-d H-i-s") . $avatar['name'];
    $destination =  __DIR__ . '/../../uploads/' . $filename;
    move_uploaded_file($avatar['tmp_name'], $destination);
    $message = 'The file is uploaded';

    //insert url into database
    $insertSQL = ("UPDATE users SET profile_picture = :profile_picture_location WHERE id = :id");
    //lägger in url:en till bilden och kopplar den till användarens id.

    $sql = $database->prepare($insertSQL);

    $sql->bindParam(':profile_picture_location', $filename, PDO::PARAM_STR);

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();
}

// if (isset($message)) {
//     echo $message;
// };

?>

<img src="<?= $destination ?>">