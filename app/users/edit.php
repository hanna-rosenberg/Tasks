<?php


require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    //saving image in filesystem
    $avatarImage = trim(filter_var($_FILES['avatar']['name'], FILTER_SANITIZE_STRING));
    $filename = date("y-m-d H-i-s") . $avatarImage;
    $destination =  __DIR__ . '/../../uploads/' . $filename;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);
    $message = 'The file is uploaded';


    $insertSQL = ("UPDATE users SET profile_picture = :profile_picture_location WHERE id = :id");
    // uppdaterar profilbildens namn på användaren med id:et som är satt session-variabeln. 

    $sql = $database->prepare($insertSQL);


    $sql->bindParam(':profile_picture_location', $filename, PDO::PARAM_STR);

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    $sql = $database->prepare('SELECT * FROM users WHERE id = :id');

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    $_SESSION['user'] = $sql->fetch(PDO::FETCH_ASSOC);

    // skriv rad 27-33 som en funktion sen istället, detta kommer användas när man skall byta e-post osv också. här hämtas 
    // det som är nytt in och visas istället för det som fanns i sessionen sedan tidigare. (uppdaterar session-variabeln efter vi bytt bild)
}
?>

<?php if (isset($_SESSION['user'])) : ?>
    <p>You have addad a profile picture!</p>
    <?php
    if (isset($_SESSION['user']['profile_picture'])) :
    ?>
        <img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>">

<?php endif;
endif; ?>





<!-- <img src="<?= $destination ?>"> -->