<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php

// Kallar på funktionen som definierats i functions, så att den körs.  XXX
$allLists = fetchAllLists($database);
?>

<article>

    <h1>My Lists</h1>

    <!-- Form för att skapa en lista -->
    <form action="app/users/lists.php" method="post">
        <div class="name-form">
            <div class="mb-3 tasks">

                <label for="listTitle">Create a list!</label>
                <input class="form-control" type="listTitle" name="listTitle" id="listTitle" placeholder="List-title" required>

            </div>

            <button type="submit" class="btn btn-dark">Add</button>

        </div>
    </form>

    <!-- Tabell  -->
    <table class="table table-dark">

        <tbody>

            <tr>
                <!-- En foreach-loop som gör det möjligt att plocka ut de enskilda delarna i $allLists, som är det som returnas från funktionen fetchAllLists 
                (Allt från lists som är kopplat till den inloggade användarens id) -->
                <?php foreach ($allLists as $listItem) :

                    // XXX
                    $tasksById = getTaskByListId($database, $listItem['id']);
                ?>

                    <!-- Loopar ut titeln på listan -->
                    <td class="title line">
                        <ul>
                            <li class="listNameInColumn"><?= $listItem['title']; ?></li>
                        </ul>

                        <!-- XXX -->
                        <?php $tasksBylistId = fetchTasks($database, $listItem['id']); ?>

                        <!-- Om det storlekn av $$tasksBylistId är större än 0 visas bara "show tasks". Annars visas den ej.  -->
                        <?php if (sizeof($tasksBylistId) > 0) { ?>

                            <details>
                                <summary>Show tasks</summary>

                                <!-- Klickar man på summary visas tabellen nedan. -->
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="tableNames">Done</th>
                                            <th scope="col" class="tableNames">Title</th>
                                            <th scope="col" class="tableNames">Description</th>
                                            <th scope="col" class="tableNames">Deadline</th>
                                            <th scope="col" class="tableNames">Edit</th>
                                            <th scope="col" class="tableNameDelete">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <!-- En foreach-loop som skriver ut alla tasks tillhörande den inloggade användaren -->
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
                                                        <li> <a href="#"><img src="/assets/images/EDITFIGMA.png"></a></li>
                                                    </ul>
                                                </td>

                                                <td class="delete">
                                                    <ul>
                                                        <li><a href="#"><img src="/assets/images/DELETE.png"></a></li>
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

                            <!-- Klickar man på Create task visas formsen nedan. -->
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

                                            <button type="submit" class="btn btn-light">Add</button>
                                        </div>

                            </form>
                        </details>
                    </td>


                    <td class="edit line">
                        <ul>
                            <li> <a href="#"><img src="/assets/images/EDITFIGMA.png"></a></li>
                        </ul>
                    </td>


                    <td class="delete line">
                        <ul>
                            <li><a href="#"><img src="/assets/images/DELETE.png"></a></li>
                        </ul>
                    </td>

            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>