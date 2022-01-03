<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['title'], $_POST['task'], $_POST['deadline'], $_POST['list'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $task = trim(filter_var($_POST['task'], FILTER_SANITIZE_STRING));
    $date = trim(filter_var($_POST['deadline'], FILTER_SANITIZE_STRING));
    $listId = trim(filter_var($_POST['list'], FILTER_SANITIZE_STRING));
    $currentUser = $_SESSION['user']['id'];


    // här läggs det inskriva in i databasen på ett säkrare sätt med hjälp av tomma "placeholders".
    // $statement = $database->prepare('INSERT INTO lists VALUES (:id, :user_id, :title)');

    $statement = $database->prepare("INSERT INTO tasks (title, description, deadline, user_id, list_id) VALUES (:placeholderTitle, :placeholderTask, :placeholderDeadline, :placeholderID, :placeholderListId)");
    $statement->bindParam(':placeholderTitle', $title, PDO::PARAM_STR);
    $statement->bindParam(':placeholderTask', $task, PDO::PARAM_STR);
    $statement->bindParam(':placeholderDeadline', $date, PDO::PARAM_STR);
    $statement->bindParam(':placeholderID', $currentUser, PDO::PARAM_INT);
    $statement->bindParam(':placeholderListId', $listId, PDO::PARAM_INT);

    // det hela körs.
    $statement->execute();

    // $_SESSION['user'] = $statement->fetch(PDO::FETCH_ASSOC);

    //skriver ut title på din task med hjälp av session men skall nog inte vara så sen. testade bara.
    //$_SESSION['titleMessage'] = $_POST['title'];
}

// NYTT TEST
// if (isset($_POST['title'])) {
//     // ID:t på den inloggade användaren hämtas från SESSION
//     $currentUser = $_SESSION['user']['id'];
//     // Det som skrivits i titleList formulären trimmas osv och sparas i en variabel.
//     $taskTitle = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
//     // Förbereder för att lägga in i databasen och för att koppla med rätt ID. 
//     $sql = $database->prepare("INSERT INTO tasks (id, deadline, list_id, title, description, completed, user_id) VALUES (:id, :deadline, :list_id, :title, :description, :completed, :user_id)");

//     // $sql = $database->prepare('INSERT INTO tasks VALUES (:id, :user_id, :title)');
//     // Binder ihop lists-tabellens 'user_id' med den inloggade personens konto-id.
//     $sql->bindParam(':user_id', $currentUser, PDO::PARAM_INT);
//     // Binder ihop lists-tabellens 'title' med texten/innehållet jag fick från list-formuläret.
//     $sql->bindParam(':title', $title, PDO::PARAM_STR);
//     // Kör. 
//     $sql->execute();
// };


redirect('/tasks.php');
