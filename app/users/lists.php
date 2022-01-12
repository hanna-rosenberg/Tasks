
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


// Om checkbox finns (är ibockad) sätter jag iscompleted. Is completed innehåller ett true/false beroende på om den är ibockad eller ej.
$isCompleted = isset($_POST['checkbox']);

// POST[id] är id-numret på tasken.
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Om checkboxen är ibockad, så uppdateras completed i databasen till true, kopplat till rätt task-id.
    if ($isCompleted) {
        $insertSQL = ("UPDATE tasks SET completed = true WHERE id = :id");
        $sql = $database->prepare($insertSQL);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    } else {
        $insertSQL = ("UPDATE tasks SET completed = false WHERE id = :id");
        $sql = $database->prepare($insertSQL);
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }
}

// Kanske inte så snyggt, men för att redirecta till today.php om man blippar i checkbox. som strukturen såg ut kom man till lists.php.
if (isset($_POST['today'])) {
    redirect('/today.php');
}

redirect('/lists.php');
