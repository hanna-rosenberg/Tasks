<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php
$taskByDate = getTasksByDate($database);
?>



<?php if (sizeof($taskByDate) > 0) { ?>
    <h1>What's up for Today?</h1>
    <div class="todayContainer">


        <!-- <img src="/assets/images/today.png" class="todayImg"> -->

        <!-- Här skall det som har deadline idag loopas ut! -->
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
                <tr>
                    <!-- En foreach-loop som skriver ut alla tasks tillhörande den inloggade användaren, som har deadline idag-->

                    <?php foreach ($taskByDate as $taskItemByDate) : ?>
                        <td class="done">
                            <ul>

                                <li>
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />

                                    <label for="horns"></label>

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
                                        <img src="/assets/images/EDITFIGMA.png">
                                    </button>
                                </form>
                            </ul>
                        </td>

                        <td class="delete">
                            <ul>

                                <form action="/app/tasks/delete.php" method="post">
                                    <input type="hidden" value="<?= $taskItemByDate['id'] ?>" name="id" />
                                    <button type="submit">
                                        <img src="/assets/images/DELETE.png">
                                    </button>
                                </form>

                            </ul>
                        </td>

                </tr>

            <?php endforeach; ?>



        <?php } else { ?>
            <div class="free"><img src="/assets/images/bird.png" class="freeImg">
                <h1>Free!</h1><?php
                            } ?>
            </div>

    </div>