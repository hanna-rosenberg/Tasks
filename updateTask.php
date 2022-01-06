<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php

if (isset($_POST['id'])) {
    $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $sql = $database->prepare('SELECT * FROM tasks WHERE id = :id');
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    $tasks = $sql->fetch(PDO::FETCH_ASSOC);
}

// die(var_dump($tasks));

?>
<h1>Update your Task</h1>

<form action="/app/tasks/update.php" method="post">
    <div class="name-form">
        <div class="mb-3 tasks">
            <label for="title">Title</label>
            <input class="form-control" type="title" value="<?php echo $tasks['title'] ?> " name="title" id="title" required>
            <input type="hidden" value="<?= $id ?>" name="id">

        </div>

        <div class="task-form">
            <div class="mb-3 tasks">
                <label for="task">Description</label>
                <input class="form-control" type="task" value="<?php echo $tasks['description'] ?> " name="task" id="task" required>
                <input type="hidden" value="<?= $id ?>" name="id">
            </div>


            <div class="deadline-form">
                <div class="mb-3 tasks">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" name="deadline" value="<?php echo $tasks['deadline'] ?>" id="deadline">
                    <input type="hidden" value="<?= $id ?>" name="id">
                </div>



                <button type="submit" class="btn btn-dark">Save</button>
            </div>

</form>