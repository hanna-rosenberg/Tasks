<?php

require __DIR__ . '/../autoload.php';

// Om knappen "Mark all tasks as done" är tryckt

// Get list ID
$listID = $_GET['id'];

$completed = true;

$statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE list_id = :list_id');
$statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
$statement->bindParam(':list_id', $listID, PDO::PARAM_INT);
$statement->execute();

redirect('/lists.php');
