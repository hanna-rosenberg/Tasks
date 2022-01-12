<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Fältet i formluläret som heter 'id' är i fyllt automatiskt pga "hidden" info till Post. Man har klickat på knappen.
if (isset($_POST['id'], $_POST['title'], $_POST['task'], $_POST['deadline'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $taskId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));

    $taskTitle = trim(filter_var($_POST['task'], FILTER_SANITIZE_STRING));
    $taskId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));

    $taskDeadline = trim(filter_var($_POST['deadline'], FILTER_SANITIZE_STRING));
    $taskId = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));

    $sql = $database->prepare('UPDATE tasks SET title = :title, description = :task, deadline = :deadline  WHERE id = :id');


    $sql->bindParam(':title', $title, PDO::PARAM_STR);
    $sql->bindParam(':task', $taskTitle, PDO::PARAM_STR);
    $sql->bindParam(':deadline', $taskDeadline, PDO::PARAM_STR);


    $sql->bindParam(':id', $taskId, PDO::PARAM_INT);

    $sql->execute();
}

redirect('/lists.php');
