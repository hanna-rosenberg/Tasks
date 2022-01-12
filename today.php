<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php
$taskByDate = getTasksByDate($database);
?>



<?php if (count($taskByDate) > 0) { ?>
    <h1>What's up for Today?</h1>
    <div class="todayContainer">

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
                <tr>
                    <!-- En foreach-loop som skriver ut alla tasks tillhörande den inloggade användaren, som har deadline idag-->
                    <?php foreach ($taskByDate as $taskItemByDate) : ?>
                        <td class="done">
                            <ul>
                                <li>
                                    <form class="deadlineToday" method="post" action="/app/users/lists.php">
                                        <input type="checkbox" class="checkboxClass" name="checkbox" id="checkbox" <?= $taskItemByDate['completed'] ? 'checked' : '' ?>>
                                        <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                        <input type="hidden" value="true" name="today" />
                                        <label for="checkbox"></label>
                                        <button type="submit" class="hiddenSubmit"></button>
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
                                        <img src="/assets/images/darkedit.png" alt="pen for edit">
                                    </button>
                                </form>
                            </ul>
                        </td>

                        <td class="delete">
                            <ul>
                                <form action="/app/tasks/today.php" method="post">
                                    <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                    <button type="submit">
                                        <img src="/assets/images/darkdelete.png" alt="cross for delete">
                                    </button>
                                </form>
                            </ul>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php } else { ?>
                <div class="free"><img src="/assets/images/bird.png" class="freeImg" alt="Linedrawing of bird">
                    <h1>Free!</h1>
                </div>
            <?php } ?>

    </div>

    <?php require __DIR__ . '/views/footer.php'; ?>
