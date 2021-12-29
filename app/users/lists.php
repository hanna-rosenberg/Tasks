

<?php

require __DIR__ . '/../autoload.php';

if (isset($_POST['listTitle'])) {
    $list = trim(filter_var($_POST['listTitle'], FILTER_SANITIZE_STRING));


    $sql = $database->prepare("INSERT INTO lists (title) VALUES (:list)");
    $sql->bindParam(':list', $list, PDO::PARAM_STR);

    $sql->execute();
};

redirect('/lists.php');
