<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Check if both email and password exists in the POST request.
// hämtar email som man fyllt i från POST, trimmar, och ser till att det är en epost. sparas sedan i variabel.
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

    // Prepare, bind email parameter and execute the database query.
    // Förbereder, "binder" av säkerhetsskäl, och hämtar data från databasen. Hämtar för att kolla så att användaren finns, utan att skriva ut något.
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    // Fetch the user as an associative array.
    // $user blir det du hämtar från databasen. En assosiativ array med uppgifter om användaren. Här hämtas det jag fick ut ur databasen.
    // om emailen inte fanns i databasen får jag ingenting. 
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If we couldn't find the user in the database, redirect back to the login
    // page with our custom redirect function.
    // om inte emailen hittas i databasen (om du fick ingenting) så skickas du tillbaka till login-sidan. 
    if (!$user) {
        redirect('/login.php');
    }

    // If we found the user in the database, compare the given password from the
    // request with the one in the database using the password_verify function.
    // jämför lösenordet som finns i POST (det som användaren skrivit in nu ($_POST['password']) med det hashade lösenordet som finns i databasen.
    if (password_verify($_POST['password'], $user['password'])) {
        // If the password was valid we know that the user exists and provided
        // the correct password. We can now save the user in our session.
        // Remember to not save the password in the session!
        // efter du kollat i databasen om lösenordet stämmer så tar du bort det från $user-variabeln, för man vill inte spara lösenord i en session.
        unset($user['password']);

        //här läggs uppgifterna i $user-variabeln in i en session. alltså, profilbilden från databasen, nickname osv. 
        $_SESSION['user'] = $user;
        redirect('/');
    } else {

        // här skapar jag upp en error-session (se login.php). 
        $_SESSION['error'] = "Wrong password";
        redirect('/login.php');
    }
}

// We should put this redirect in the end of this file since we always want to
// redirect the user back from this file. We don't know
// redirect('/');
