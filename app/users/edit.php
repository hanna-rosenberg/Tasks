<?php


require __DIR__ . '/../autoload.php';

//Om man lagt något i 'avatar' så..
if (isset($_FILES['avatar'])) {
    //$_FILES är en array. I raden nedan tar jag 'name' från 'avatar' och "rengör" den och sparar det "rengjorda" i en variabel.
    $avatarImage = trim(filter_var($_FILES['avatar']['name'], FILTER_SANITIZE_STRING));

    //Lägger till datum och tid till det "rengjorda" namnet för att det skall bli mer unikt. Datum och tid + "rengjorda namnet" = $filename.
    $filename = date("y-m-d H-i-s") . $avatarImage;

    //Raden under "förberer" för att flytta filen från där den tillfälligt hamnar och flyttar den till $destination som är uploadsmappen.
    $destination =  __DIR__ . '/../../uploads/' . $filename;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);

    //Här börjar en databasquary som uppdaterar profilbilden till en användare. ID:t är med för att bilden sedan skall kopplas till rätt användare (rad 31)
    $insertSQL = ("UPDATE users SET profile_picture = :filename WHERE id = :id");

    //Här förbereder man för att lägga in bilden i databasen.
    $sql = $database->prepare($insertSQL);

    //Här binder man samman "placeholdern" med $filename, för att det skall vara mer säkert.
    $sql->bindParam(':filename', $filename, PDO::PARAM_STR);

    //Binder samman placeholder id med den inloggades id från databasen.
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    //Här körs det.
    $sql->execute();

    //Här förbereds allting för att sedan hämtas, eftersom något kanske har ändrats.
    $sql = $database->prepare('SELECT id, name, email, profile_picture, username FROM users WHERE id = :id');

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    //Hämtar de nya uppgifterna från user arrayen och lägger dom i SESSION. När jag skriver ut $_SESSION user avatar på sidan nu, så är det den uppdaterade bilden som hamnat i SESSION.
    $_SESSION['user'] = $sql->fetch(PDO::FETCH_ASSOC);

    //Ett meddelande som skrivs ut i den andra edit.php ifall man har laddat upp en fil, om SESSION message isset.
    $_SESSION['message'] = "Profile-picture is sucessfully uploaded";
}

//Här kommer kod för att byta e-post! Om det ligger något i POST från forumläret som heter email så...
if (isset($_POST['email'])) {
    //Hämtar, "rengör" det man skrivit in i formuläret, ser till att det är en email, och lägger den då nya e-post-adressen i en variabel som heter $new.
    $new = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    //Databas-query som uppdaterar den inloggade användarens email i databasen.
    $insertSQL = ("UPDATE users SET email = :new WHERE id = :id");

    $sql = $database->prepare($insertSQL);

    $sql->bindParam(':new', $new, PDO::PARAM_STR);

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    //Här hämtas allting ut på nytt från databasen, eftersom något kanske har ändrats. Binds ihop och körs.
    $sql = $database->prepare('SELECT id, name, email, profile_picture, username FROM users WHERE id = :id');

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    //Hämtar de nya uppgifterna från user arrayen och lägger dom i SESSION.
    $_SESSION['user'] = $sql->fetch(PDO::FETCH_ASSOC);

    //Ett meddelande som skrivs ut i den andra edit.php ifall man har bytt e-post, om SESSION emailMessage isset.
    $_SESSION['emailMessage'] = "Your email has changed to: " . $_SESSION['user']['email'];
}
?>

<!-- Här kommer kod för att byta lösenord. Om något fyllts i i formuläret 'password' så.. -->
<?php if (isset($_POST['password'])) :
    if (strlen($_POST['password']) < 16) {
        $_SESSION['error'] = 'Password needs to be at least 16 characters';
        redirect('/edit.php');
    }

    //Hämtar,"hashar" det man skrivit in i formuläret och lägger det nya lösenordet i en variabel som heter $newPassword.
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Query som uppdaterar den inloggade användarens lösenord i databasen. Förbereder, binder, kör.
    $insertSQL = ("UPDATE users SET password = :newPassword WHERE id = :id");

    $sql = $database->prepare($insertSQL);

    $sql->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    //Ett meddelande som skrivs ut i den andra edit.php ifall man har bytt lösenord, om SESSION passwordMessage isset.
    $_SESSION['passwordMessage'] = "Your password has changed";
endif;

redirect('/edit.php')
?>
