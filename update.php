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

<!-- Formet  -->
<form action="/app/lists/update.php" method="post">
    <input type="hidden" value="<?= $id ?>" name="id" />
    <input type="text" value="<?= $list['title'] ?>" name="title" />
    <button type="submit">Spara ändringar</button>
</form>