<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
// Hämtar allt från den inloggade personens listor 
$statement = $database->prepare("SELECT * FROM lists WHERE user_id = :id");
$statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
$statement->execute();
$inLists = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Kallar på funktionen som definierats nedan, så att den körs.
$allTasks = fetchAllTasks($database);

?>



<article>
    <h1>My Tasks</h1>


    <form action="app/users/tasks.php" method="post">
        <div class="name-form">
            <div class="mb-3 tasks">
                <label for="title">Task-title</label>
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


                    <div class="inList-form">
                        <div class="mb-3 tasks">
                            <label for="list">In list</label><br>
                            <select name="list">

                                <?php foreach ($inLists as $inList) : ?>
                                    <option value="<?php echo $inList['id']; ?>">
                                        <?php echo $inList['title']; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>


                        <button type="submit" class="submitTask" name="submit">Add</button>
                    </div>

    </form>


</article>

<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col" class="tableNames">Done</th>
            <th scope="col" class="tableNames">Title</th>
            <th scope="col" class="tableNames">List</th>
            <th scope="col" class="tableNames">Description</th>
            <th scope="col" class="tableNames">Deadline</th>
            <th scope="col" class="tableNames">Edit</th>
            <th scope="col" class="tableNames">Delete</th>

        </tr>
    </thead>

    <tbody>

        <tr>
            <?php foreach ($allTasks as $taskItem) : ?>
                <td class="done">
                    <ul>
                        <li>
                            <input type="checkbox" id="checkbox" name="checkbox">
                            <label for="horns"></label>

                        </li>
                    </ul>
                </td>

                <td class="title">
                    <ul>
                        <li><?= $taskItem['title']; ?></li>
                    </ul>
                </td>


                <td class="list">
                    <ul>
                        <li>
                            <?php echo $taskItem['listTitle']; ?>
                        </li>
                    </ul>
                </td>


                <td class="description">
                    <ul>
                        <li><?= $taskItem['description']; ?></li>
                    </ul>
                </td>


                <td class="deadline">
                    <ul>
                        <li><?= $taskItem['deadline']; ?></li>
                    </ul>
                </td>


                <td class="edit">
                    <ul>
                        <li> <a href="#"><img src="/assets/images/edit.png"></a></li>
                    </ul>
                </td>


                <td class="delete">
                    <ul>
                        <li><a href="#">x</a></li>
                    </ul>
                </td>


        </tr>
    <?php endforeach; ?>

    </tbody>
</table>



<?php require __DIR__ . '/views/footer.php'; ?>