<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>My tasks</h1>
    <p>This is the tasks page.</p>


    <form action="app/users/tasks.php" method="post">
        <div class="name-form">
            <div class="mb-3 tasks">
                <label for="title">Task-name</label>
                <input class="form-control" type="title" name="title" id="title" required>

            </div>

            <div class="task-form">
                <div class="mb-3 tasks">
                    <label for="task">Description</label>
                    <input class="form-control" type="task" name="task" id="task" required>
                </div>

                <div class="deadline-form">
                    <div class="mb-3 tasks">
                        <label for="deadline">Deadline</label>
                        <input class="form-control" type="date" name="deadline" id="deadline" placeholder="write ">
                    </div>





                    <button type="submit" class="submitTask">Add</button>
                </div>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>