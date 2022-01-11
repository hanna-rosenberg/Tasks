<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Om man fyllt i formsen för tasks, så sparas det i variabler som kopplats ihop med placeholders, och läggs sedan in i databasen.
if (isset($_POST['title'], $_POST['task'], $_POST['deadline'], $_POST['listName'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $task = trim(filter_var($_POST['task'], FILTER_SANITIZE_STRING));
    $date = trim(filter_var($_POST['deadline'], FILTER_SANITIZE_STRING));
    $listId = ($_POST['listName']);
    $currentUser = $_SESSION['user']['id'];


    // här läggs det inskriva in i databasen på ett säkrare sätt med hjälp av tomma "placeholders".
    // $statement = $database->prepare('INSERT INTO lists VALUES (:id, :user_id, :title)');

    $statement = $database->prepare("INSERT INTO tasks (title, description, deadline, user_id, list_id, completed)
    VALUES (:placeholderTitle, :placeholderTask, :placeholderDeadline, :placeholderID, :placeholderListId, false)");
    $statement->bindParam(':placeholderTitle', $title, PDO::PARAM_STR);
    $statement->bindParam(':placeholderTask', $task, PDO::PARAM_STR);
    $statement->bindParam(':placeholderDeadline', $date, PDO::PARAM_STR);
    $statement->bindParam(':placeholderID', $currentUser, PDO::PARAM_INT);
    $statement->bindParam(':placeholderListId', $listId, PDO::PARAM_INT);

    // det hela körs.
    $statement->execute();

    // $_SESSION['user'] = $statement->fetch(PDO::FETCH_ASSOC);
}



redirect('/lists.php');
