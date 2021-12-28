<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>My tasks</h1>
    <p>This is the tasks page.</p>


    <form action="app/users/tasks.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="task">task</label>
            <input class="form-control" type="task" name="task" id="task" placeholder="write a task" required>
            <small class="form-text">Please provide a desired task</small>
        </div>
        <button type="submit" class="btn btn-dark">Add</button>
    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>