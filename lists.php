<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php

// $statement = $database->query("SELECT * FROM tasks");
// $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

// Kallar på funktionen som definierats nedan, så att den körs.
$allLists = fetchAllLists($database);
?>

<?php

// Alla funktioner ska egentligen ligga i functions.php, får flytta det sen.

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
        <thead>

            <tr>
                <th scope="col" class="tableNames">List-title</th>
                <th scope="col" class="tableNames">Edit</th>
                <th scope="col" class="tableNames">Delete</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <?php foreach ($allLists as $listItem) :
                    $tasksById = getTaskByListId($database, $listItem['id']);
                ?>

                    <td class="title">
                        <ul>
                            <li><?= $listItem['title']; ?></li>
                            <?php foreach ($tasksById as $taskById) :
                            ?><li class="items"><?php echo $taskById['title']; ?></li><?php
                                                                                    endforeach; ?>

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



</article>

<?php require __DIR__ . '/views/footer.php'; ?>