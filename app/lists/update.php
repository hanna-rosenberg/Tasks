<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Fältet i formluläret som heter 'title' är i fyllt och id:t som kommit med sedan tidigare är fortfarande med.
if (isset($_POST['title'], $_POST['id'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $listId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $sql = $database->prepare('UPDATE lists SET title = :title WHERE id = :id');
    $sql->bindParam(':title', $title, PDO::PARAM_STR);
    $sql->bindParam(':id', $listId, PDO::PARAM_INT);
    $sql->execute();
}

redirect('/lists.php');
