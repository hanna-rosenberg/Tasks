<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//Hämtar alla listor tillhörande den inloggade personen.
function fetchAllLists(PDO $database): array
{
    $sql = $database->prepare('SELECT * FROM lists WHERE user_id = :id');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->execute();

    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function fetchAllTasks(PDO $database): array
{
    $sql = $database->prepare('SELECT tasks.* , lists.title AS listTitle FROM tasks INNER JOIN
    lists on tasks.list_id = lists.id WHERE lists.user_id = :id');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->execute();

    $allTasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $allTasks;
}

//Hämtar allt från tasks med matchande list-id.
function getTaskByListId(PDO $database, int $listId): array
{
    $sql = $database->prepare('SELECT * FROM tasks WHERE list_id = :id');
    $sql->bindParam(':id', $listId, PDO::PARAM_INT);
    $sql->execute();

    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

//Hämtar data från min task-tabell, och kopplar ihop den med rätt list_id!
function fetchTasks(PDO $database, int $listId): array
{
    $sql = $database->prepare('SELECT tasks.* , lists.title AS listTitle FROM tasks INNER JOIN
    lists on tasks.list_id = lists.id WHERE lists.user_id = :id AND list_id = :placeholderListId ORDER BY completed');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->bindParam(':placeholderListId', $listId, PDO::PARAM_INT);
    $sql->execute();

    $allTasks = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $allTasks;
}

function getTasksByDate(PDO $database): array
{
    $today = date("Y-m-d");

    $sql = $database->prepare('SELECT * FROM tasks WHERE deadline = :deadline AND user_id =:id');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->bindParam(':deadline', $today);
    $sql->execute();

    $taskByDate = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $taskByDate;
}
