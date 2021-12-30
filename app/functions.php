<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

// function showList($database)
// {
//     $sql = $database->prepare("SELECT * FROM lists WHERE user_id = :id");
//     $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
//     $sql->execute();
//     $myList = $sql->fetch(PDO::FETCH_ASSOC);
//     return $myList;
// };
