<?php


require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {

    // die(var_dump($_FILES['avatar']));

    // $_FILES är en array. i raden nedan tar jag 'name' från 'avatar' och "rengör" den och sparar det "rengjorda" i en variabel.
    $avatarImage = trim(filter_var($_FILES['avatar']['name'], FILTER_SANITIZE_STRING));

    // lägger till datum och tid till det "rengjorda" namnet för att det skall bli mer unikt. 
    $filename = date("y-m-d H-i-s") . $avatarImage;

    // raden under "förberer" för att flytta filen från där den tillfälligt hamnar och flyttar den till $destination som är uploadsmappen.
    $destination =  __DIR__ . '/../../uploads/' . $filename;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $destination);

    // Här börjar en quary. Uppdaterar profilbilden till en användare. 
    // SQL-quaryn är satt i en variabel för att kunna användas lättare sedan. Lite snyggare och mer lättläst. 
    // ID:t är med för att bilden sedan skall kopplas till rätt användare (rad 31)
    $insertSQL = ("UPDATE users SET profile_picture = :filename WHERE id = :id");

    // här förbereder man för att lägga in bilden i databasen.
    $sql = $database->prepare($insertSQL);

    // här binder man samman "placeholdern" med $filename, för att det skall vara mer säkert. 
    $sql->bindParam(':filename', $filename, PDO::PARAM_STR);

    // binder samman placeholder id med den inloggades id från databasen. 
    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    // här körs det. 
    $sql->execute();


    // här hämtas allting ut på nytt, eftersom något kanske har ändrats. när jag skriver ut $_SESSION user avatar på sidan så är det
    // den uppdaterade bilden som nu hamnat i SESSION. 
    $sql = $database->prepare('SELECT * FROM users WHERE id = :id');

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    // hämtar de nya uppgifterna från user arrayen och lägger dom i SESSION. 
    $_SESSION['user'] = $sql->fetch(PDO::FETCH_ASSOC);

    // ett meddelande som skrivs ut i den andra edit.php ifall man har laddat upp en fil, om SESSION message isset.
    $_SESSION['message'] = "This is your profile-picure:";
}

?>
<?php

// om det ligger något i POST från forumläret som heter email så skall koden köras. 
if (isset($_POST['email'])) {

    // hämtar, "rengör" det man skrivit in i formuläret, ser till att det är en email, och lägger den då nya e-post-adressen
    // i en variabel som heter $new.
    $new = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    // Query som uppdaterar den inloggade användarens email i databasen. 
    $insertSQL = ("UPDATE users SET email = :new WHERE id = :id");

    $sql = $database->prepare($insertSQL);

    $sql->bindParam(':new', $new, PDO::PARAM_STR);

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    // här hämtas allting ut på nytt från databasen, eftersom något kanske har ändrats.
    $sql = $database->prepare('SELECT * FROM users WHERE id = :id');

    $sql->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);

    $sql->execute();

    // hämtar de nya uppgifterna från user arrayen och lägger dom i SESSION. 
    $_SESSION['user'] = $sql->fetch(PDO::FETCH_ASSOC);

    // ett meddelande som skrivs ut i den andra edit.php ifall man har bytt e-post, om SESSION emailMessage isset.
    $_SESSION['emailMessage'] = "You just changed your email-adress to: " . $_SESSION['user']['email'];
}



?>

<?php
redirect('/edit.php')
?>





<!-- <img src="<?= $destination ?>"> -->