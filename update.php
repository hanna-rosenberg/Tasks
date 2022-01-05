<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<!-- Hittar den aktuella listan baserat på listans ID och hämtar den från databasen och lägger den i en variabel som heter $list -->
<?php
if (isset($_POST['id'])) {
    $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $sql = $database->prepare('SELECT * FROM lists WHERE id = :id');
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $list = $sql->fetch(PDO::FETCH_ASSOC);
}
?>

<!-- Formet där du uppdaterar namnet på din lista och tar med dig list-id:t för att veta vilken lista som skall uppdateras i databasen -->

<h1>Rename your list</h1>
<div class="update-form">

    <form action="/app/lists/update.php" method="post">
        <div class="mb-3">
            <label for="rename">Enter a new name and press the save-button</label>

            <input type="hidden" value="<?= $id ?>" name="id">
            <input type="form-control" value="<?= $list['title'] ?>" name="title" class="form-control" />

            <button type="submit" class="btn btn-dark">Save</button>
        </div>

    </form>