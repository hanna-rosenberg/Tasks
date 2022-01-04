<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php

// Kallar på funktionen som definierats nedan, så att den körs.
$allLists = fetchAllLists($database);
?>

<?php

// Alla funktioner ska egentligen ligga i functions.php, får flytta det sen.
// Hämtar alla listor tillhörande den inloggade personen. 

function fetchAllLists(PDO $database): array
{
    $sql = $database->prepare('SELECT * FROM lists WHERE user_id = :id');
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $sql->execute();

    $allLists = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $allLists;
}

?>

<article>
    <h1>My Lists</h1>


    <form action="app/users/lists.php" method="post">
        <div class="name-form">
            <div class="mb-3 tasks">

                <label for="listTitle">Create a list!</label>
                <input class="form-control" type="listTitle" name="listTitle" id="listTitle" placeholder="List-title" required>

            </div>
            <button type="submit" class="submitTask" name="submit">Add</button>
        </div>
    </form>


    <table class="table table-dark">


        <tbody>

            <tr>
                <?php foreach ($allLists as $listItem) :
                    $tasksById = getTaskByListId($database, $listItem['id']);
                ?>

                    <td class="title line">
                        <ul>
                            <li><?= $listItem['title']; ?></li>
                        </ul>

                        <?php $tasksBylistId = fetchTasks($database, $listItem['id']); ?>

                        <?php if (sizeof($tasksBylistId) > 0) { ?>
                            <details>
                                <summary>Show tasks</summary>

                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="tableNames">Done</th>
                                            <th scope="col" class="tableNames">Title</th>
                                            <th scope="col" class="tableNames">Description</th>
                                            <th scope="col" class="tableNames">Deadline</th>
                                            <th scope="col" class="tableNames">Edit</th>
                                            <th scope="col" class="tableNames">Delete</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <?php foreach ($tasksBylistId as $taskItem) : ?>
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
                            </details>
                        <?php
                        } ?>




                        <details>
                            <summary>Create task</summary>
                            <form action="app/users/tasks.php" method="post">
                                <input type="hidden" name="listName" value="<?php echo $listItem['id'] ?>" id="title">
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

                                            <button type="submit" class="submitTask" name="submit">Add</button>
                                        </div>

                            </form>
                        </details>
                    </td>


                    <td class="edit line">
                        <ul>
                            <li> <a href="#"><img src="/assets/images/edit.png"></a></li>
                        </ul>
                    </td>


                    <td class="delete line">
                        <ul>
                            <li><a href="#">x</a></li>
                        </ul>
                    </td>


            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>



</article>

<?php require __DIR__ . '/views/footer.php'; ?>