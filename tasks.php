<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php

$statement = $database->query("SELECT * FROM tasks");
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC); ?>

<article>
    <h1>My Tasks</h1>


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

                    <button type="submit" class="submitTask" name="submit">Add</button>
                </div>

    </form>
    <!-- 
Till för att skriva ut titeln på din task, men tror inte jag skall ha kvar detta. Testade mest. -->


</article>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">Done</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Deadline</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>

        </tr>
    </thead>

    <tbody>
        <tr>
            <td class="done">Done?</td>
            <td class="title">Title? </td>
            <td class="description">Description?</td>
            <td class="deadline">2022-01-02</td>
            <td class="edit"><a href="#"><img src="/assets/images/edit.png"></a></td>
            <td class="delete"><a href="#">x</a></td>
        </tr>
        <!-- <tr>
            <th scope="row">Yes</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>Thornton</td>
        </tr>
        <tr>
            <th scope="row">Yes</th>
            <td>Larry</td>
            <td>the Bird</td>
            <td>Thornton</td>
        </tr> -->
    </tbody>
</table>



<?php require __DIR__ . '/views/footer.php'; ?>