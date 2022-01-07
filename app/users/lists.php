
<?php

require __DIR__ . '/../autoload.php';

// Om formuläret har fyllts i..
if (isset($_POST['listTitle'])) {
    // ID:t på den inloggade användaren hämtas från SESSSION
    $currentUser = $_SESSION['user']['id'];

    // Det som skrivits i titleList formulären trimmas osv och sparas i en variabel.
    $listTitle = trim(filter_var($_POST['listTitle'], FILTER_SANITIZE_STRING));

    // Förbereder för att lägga in i databasen och för att koppla med rätt ID. 
    $statement = $database->prepare('INSERT INTO lists VALUES (:id, :user_id, :title)');

    // Binder ihop lists-tabellens 'user_id' med den inloggade personens konto-id.
    $statement->bindParam(':user_id', $currentUser, PDO::PARAM_INT);

    // Binder ihop lists-tabellens 'title' med texten/innehållet vi fick från list-formuläret.
    $statement->bindParam(':title', $listTitle, PDO::PARAM_STR);

    // Kör. 
    $statement->execute();
};

//om checkbox finns sätter jag is completed.
$isCompleted = isset($_POST['checkbox']);


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if ($isCompleted) {

        $insertSQL = ("UPDATE tasks SET completed = true WHERE id = :id");

        $sql = $database->prepare($insertSQL);

        $sql->bindParam(':id', $id, PDO::PARAM_INT);

        $sql->execute();
    }
}


// // Checkbox values wont appear in the $_POST request if it isn't checked.
// $isCompleted = isset($_POST['checkbox']);

// if (isset($_POST['id'])) {
//     $id = $_POST['id'];

//     if ($isCompleted) {
//         echo "The task $id is completed.";
//     } else {
//         echo "The task $id is not completed.";
//     }

//     // This is where you update the database.
// }


redirect('/lists.php');
