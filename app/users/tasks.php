<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
if (isset($_POST['task'])) {
    $task = trim(filter_var($_POST['task'], FILTER_SANITIZE_STRING));


    // här läggs det inskriva in i databasen på ett säkrare sätt med hjälp av tomma "placeholders". BEHÖVS DENNA?
    // $sql = "INSERT INTO users (nickname, email, name, password) VALUES (':username', ':email', ':fullname', ':password')";

    $statement = $database->prepare("INSERT INTO tasks (description) VALUES (:placeholderTask)");
    $statement->bindParam(':placeholderTask', $task, PDO::PARAM_STR);


    // det hela körs. 
    $statement->execute();
}

redirect('/tasks.php');
