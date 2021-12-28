<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_POST['title'], $_POST['task'], $_POST['deadline'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $task = trim(filter_var($_POST['task'], FILTER_SANITIZE_STRING));
    $date = trim(filter_var($_POST['deadline'], FILTER_SANITIZE_STRING));

    // här läggs det inskriva in i databasen på ett säkrare sätt med hjälp av tomma "placeholders". BEHÖVS DENNA?
    // $sql = "INSERT INTO users (nickname, email, name, password) VALUES (':username', ':email', ':fullname', ':password')";

    $statement = $database->prepare("INSERT INTO tasks (title, description, deadline) VALUES (:placeholderTitle, :placeholderTask, :placeholderDeadline)");
    $statement->bindParam(':placeholderTitle', $title, PDO::PARAM_STR);
    $statement->bindParam(':placeholderTask', $task, PDO::PARAM_STR);
    $statement->bindParam(':placeholderDeadline', $date, PDO::PARAM_STR);

    // det hela körs. 
    $statement->execute();

    $_SESSION['user'] = $statement->fetch(PDO::FETCH_ASSOC);

    //skriver ut title på din task med hjälp av session men skall nog inte vara så sen. testade bara. 
    $_SESSION['taskMessage'] =  $_POST['title'];
}

redirect('/tasks.php');
