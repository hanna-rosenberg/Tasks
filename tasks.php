<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>My tasks</h1>
    <p>This is the tasks page.</p>


    <form action="app/users/tasks.php" method="post">

        <div class="mb-3">
            <label for="task">task</label>
            <input class="form-control" type="task" name="task" id="task" placeholder="write a task" required>


            <label for="date">date</label>
            <input class="date" type="date" name="date" id="date" placeholder="pick a date" required>


            <button type="submit" class="submitTask">Add</button>
        </div>
    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>