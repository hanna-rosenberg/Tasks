<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


// Om email och lösenord är ifyllt i formuläret så trimmas, filtreras och valideras e-postadressen. Innehållet läggs i variabeln $email.
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    //Ett databasanrop som förbereder för att hämta allt från users-tabellen där email = :email. :email knyts sedan ihop med $email som
    //är det som användaren skrev in i input-fältet. Ingenting skrivs ut, utan hämtas bara.
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    //Här hämtas det som fanns i databasen och läggs i $user som blir en array med sex delar.
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //Om inte emailen hittas i databasen får du ingenting, och skickas tillbaka till login-sidan.  XXX
    if (!$user) {
        redirect('/login.php');
    }

    //Jämför lösenordet som finns i POST (det som användaren skrivit in ($_POST['password']) med det hashade lösenordet som finns i databasen ($user['password'])
    if (password_verify($_POST['password'], $user['password'])) {

        //Om lösenordet stämde - tas det bort från $user-variabeln, för man vill inte spara lösenord i en session.
        unset($user['password']);

        //Här läggs de övriga uppgifterna i $user-variabeln in i en session (profilbilden från databasen, nickname osv). Bra om jag senare vill skriva ut
        //uppgifter som den inloggade användaren fyllt i.
        $_SESSION['user'] = $user;
        redirect('/');
    } else {
        //Om inte lösenordet stämmer så skapas en error-session (se login.php) som jag kan kolla efter och skriva ut.
        $_SESSION['error'] = "Ooops, wrong password. Try again!";
        redirect('/login.php');
    }
}
