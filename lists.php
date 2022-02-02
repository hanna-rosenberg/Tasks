<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php

// Tar emot innehållet i arrayen och sparar det i en variabel som jag döper till $allLists.
$allLists = fetchAllLists($database);
$taskByDate = getTasksByDate($database);

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
            <tr class="edit line">
                <!-- En foreach-loop som gör det möjligt att plocka ut de enskilda delarna i $allLists, som är det som returnas från funktionen fetchAllLists
                (Allt från lists som är kopplat till den inloggade användarens id) -->
                <?php foreach ($allLists as $listItem) :
                    // Här sparar jag det jag får från funktionen getTaskByListId (allt från tasks med visst list-id) och lägger det i variabeln $tasksById.
                    $tasksById = getTaskByListId($database, $listItem['id']); ?>

                    <!-- Loopar ut titeln på listan -->
                    <td class="edit line">
                        <div class="testdiv">
                            <ul>
                                <li class="listNameInColumn"><?= $listItem['title']; ?></li>
                                <div class="buttonDiv">
                                    <form action="/update.php" method="post">
                                        <input type="hidden" value="<?= $listItem['id'] ?>" name="id" />
                                        <button type="submit">
                                            <img src="/assets/images/darkedit.png">
                                        </button>
                                    </form>

                                    <!-- Delete-knappen är i form av ett form som får med sig dold informaion. Den dolda informationen är id-numret
                                    på listan som knappen hör till. Detta är bra för att man skall veta vilken lista man skall radera sedan.-->
                                    <form action="/app/lists/delete.php" method="post">
                                        <input type="hidden" value="<?= $listItem['id'] ?>" name="id" />
                                        <button type="submit">
                                            <img src="/assets/images/darkdelete.png" alt="Cross for delete">
                                        </button>
                                    </form>

                                </div>
                            </ul>
                        </div>
                        <?php $tasksBylistId = fetchTasks($database, $listItem['id']); ?>
                        <!-- Om storleken av $tasksBylistId är större än 0 visas bara " show tasks". Annars visas den ej. -->
                        <?php if (count($tasksBylistId) > 0) : ?>
                            <details>
                                <summary>Show tasks</summary>

                                <!-- Klickar man på summary visas tabellen nedan. -->
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="tableNames">Completed</th>
                                            <th scope="col" class="tableNames">Title</th>
                                            <th scope="col" class="tableNames">Description</th>
                                            <th scope="col" class="tableNames">Deadline</th>
                                            <th scope="col" class="tableNames">Edit</th>
                                            <th scope="col" class="tableNameDelete">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- En foreach-loop som skriver ut alla tasks tillhörande den inloggade användaren -->
                                        <?php foreach ($tasksBylistId as $taskItem) : ?>
                                            <tr>
                                                <td class="done">
                                                    <ul>
                                                        <li>

                                                            <form class="tasksForm" method="post" action="/app/users/lists.php">
                                                                <label for="checkbox"></label>
                                                                <input type="checkbox" class="checkboxClass" name="checkbox" <?= $taskItem['completed'] ? 'checked' : '' ?>>
                                                                <input type="hidden" value="<?= $taskItem['id'] ?>" name="id" />
                                                                <button type="submit" class="hiddenSubmit"></button>
                                                            </form>

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
                                                        <form action="/updateTask.php" method="post">
                                                            <input type="hidden" value="<?= $taskItem['id'] ?>" name="id" />
                                                            <button type="submit">
                                                                <img src="/assets/images/darkedit.png">
                                                            </button>
                                                        </form>
                                                    </ul>
                                                </td>

                                                <td class="delete">
                                                    <ul>

                                                        <form action="/app/tasks/delete.php" method="post">
                                                            <input type="hidden" value="<?= $taskItem['id'] ?>" name="id" />
                                                            <button type="submit">
                                                                <img src="/assets/images/darkdelete.png" alt="Cross for delete">
                                                            </button>
                                                        </form>

                                                    </ul>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if ($taskItem['completed'] == 0) : ?>
                                    <a href="/app/tasks/all-tasks-done.php?id=<?= $listItem['id'] ?>" class="btn btn-light-done" name="all-done" id="all-done">Mark all tasks as done</a>
                                <?php else : ?>
                                    <a href="/app/tasks/all-tasks-undone.php?id=<?= $listItem['id'] ?>" class="btn btn-light-done" name="all-done" id="all-done">Mark all tasks as undone</a>
                                <?php endif; ?>
                            </details>
                        <?php endif; ?>


                        <details>
                            <summary>Create task</summary>

                            <!-- Klickar man på Create task visas formsen nedan. -->

                            <form action=" app/users/tasks.php" method="post">
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


                <?php endforeach; ?>



        </tbody>
    </table>

    <?php if (count($taskByDate) > 0) : ?>
        <div class="urgentContainer">
            <details>

                <summary><img src="/assets/images/today.png" class="urgent" alt="Today!-text"></summary>

                <!-- Här skall det som har deadline idag loopas ut! -->
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col" class="tableNames left">Completed</th>
                            <th scope="col" class="tableNames">Title</th>
                            <th scope="col" class="tableNames">Description</th>
                            <th scope="col" class="tableNames">Deadline</th>
                            <th scope="col" class="tableNames">Edit</th>
                            <th scope="col" class="tableNameDelete">Delete</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- En foreach-loop som skriver ut alla tasks tillhörande den inloggade användaren, som har deadline idag-->

                        <?php foreach ($taskByDate as $taskItemByDate) : ?>
                            <tr>
                                <td class="done">

                                    <ul>

                                        <li>

                                            <form class="checkboxForm" action="/app/users/lists.php" method="post">
                                                <label for="checkbox"></label>
                                                <!-- // Frågetecknet är en fortkortad if-sats som kollar om $taskItemByDate är completeted, och i så fall blir den "checked" -->
                                                <input type="checkbox" class="checkboxClass" id="checkbox" name="checkbox" <?= $taskItemByDate['completed'] ? 'checked' : '' ?>>
                                                <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                                <button type="submit" class="hiddenSubmit"></button>


                                            </form>
                                        </li>
                                    </ul>
                                </td>

                                <td class="title">
                                    <ul>
                                        <li><?= $taskItemByDate['title']; ?></li>
                                    </ul>
                                </td>

                                <td class="description">
                                    <ul>
                                        <li><?= $taskItemByDate['description']; ?></li>
                                    </ul>
                                </td>

                                <td class="deadline">
                                    <ul>
                                        <li><?= $taskItemByDate['deadline']; ?></li>
                                    </ul>
                                </td>

                                <td class="edit">
                                    <ul>


                                        <form action="/updateTask.php" method="post">
                                            <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                            <button type="submit">
                                                <img src="/assets/images/darkedit.png" alt="Pen for edit">
                                            </button>
                                        </form>
                                    </ul>
                                </td>

                                <td class="delete">
                                    <ul>

                                        <form action="/app/tasks/delete.php" method="post">
                                            <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                            <button type="submit">
                                                <img src="/assets/images/darkdelete.png" alt="Cross for delete">
                                            </button>
                                        </form>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; ?>
            </details>


        </div>
    <?php endif; ?>
</article>
<?php require __DIR__ . '/views/footer.php'; ?>
