<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// function showList($database)
// {
//     $sql = $database->prepare("SELECT * FROM lists WHERE user_id = :id");
//     $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
//     $sql->execute();
//     $myList = $sql->fetch(PDO::FETCH_ASSOC);
//     return $myList;
// };



// Alla funktioner ska egentligen ligga i functions.php, får flytta det sen.

function fetchAllTasks(PDO $database): array
{
    $sql = $database->prepare('SELECT tasks.* , lists.title AS listTitle FROM tasks INNER JOIN 
    lists on tasks.list_id = lists.id WHERE lists.user_id = :id');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->execute();

    $allTasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $allTasks;
}

// hämtar allt från tasks med matchande list-id.
function getTaskByListId(PDO $database, INT $listId): array
{
    $sql = $database->prepare('SELECT * FROM tasks WHERE list_id = :id');
    $sql->bindParam(':id', $listId, PDO::PARAM_INT);
    $sql->execute();

    $tasksById = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $tasksById;
}

// Hämtar data från min task-tabell, och kopplar ihop den med rätt list_id!
function fetchTasks(PDO $database, int $listId): array
{
    $sql = $database->prepare('SELECT tasks.* , lists.title AS listTitle FROM tasks INNER JOIN 
    lists on tasks.list_id = lists.id WHERE lists.user_id = :id AND list_id = :placeholderListId');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->bindParam(':placeholderListId', $listId, PDO::PARAM_INT);
    $sql->execute();

    $allTasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $allTasks;
}
