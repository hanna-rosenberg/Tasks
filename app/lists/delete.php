<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Om man tryckt på formlär-knappen så får man med ett list-id. Med hjälp av detta id tas bort från databasen.
if (isset($_POST['id'])) {
    $listId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $sql = $database->prepare('DELETE FROM lists WHERE id = :id;');
    $sql->bindParam(':id', $listId, PDO::PARAM_INT);
    $sql->execute();

    $sql = $database->prepare('DELETE FROM tasks WHERE list_id = :id;');
    $sql->bindParam(':id', $listId, PDO::PARAM_INT);
    $sql->execute();
}

redirect('/lists.php');
