<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Om man tryckt på formlär-knappen så får man med ett task-id. Med hjälp av detta id tas tasken bort från databasen.
if (isset($_POST['id'])) {
    $taskId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $sql = $database->prepare('DELETE FROM tasks WHERE id = :id;');
    $sql->bindParam(':id', $taskId, PDO::PARAM_INT);
    $sql->execute();

    $sql = $database->prepare('DELETE FROM tasks WHERE list_id = :id;');
    $sql->bindParam(':id', $taskId, PDO::PARAM_INT);
    $sql->execute();
}

redirect('/lists.php');
