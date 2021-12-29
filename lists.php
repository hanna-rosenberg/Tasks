<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php

$statement = $database->query("SELECT * FROM tasks");
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC); ?>

<article>
    <h1>My Lists</h1>


    <form action="app/users/lists.php" method="post">
        <div class="name-form">
            <div class="mb-3 tasks">
                <label for="listTitle">List-title</label>
                <input class="form-control" type="listTitle" name="listTitle" id="listTitle" required>

            </div>
            <!-- 
            <div class="task-form">
                <div class="mb-3 tasks">
                    <label for="task">Task</label>
                    <input class="form-control" type="task" name="task" id="task" required>
                </div>

                <div class="deadline-form">
                    <div class="mb-3 tasks">
                        <label for="deadline">Deadline</label>
                        <input class="form-control" type="date" name="deadline" id="deadline" placeholder="write ">
                    </div> -->

            <button type="submit" class="submitTask" name="submit">Add</button>
        </div>

    </form>




    <?php require __DIR__ . '/views/footer.php'; ?>