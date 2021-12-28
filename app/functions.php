<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function whenLoggedIn()
{
    $online = isset($_SESSION['user']);
    return $online;
};
