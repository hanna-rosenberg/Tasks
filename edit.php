<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<!-- 
Denna sidan skall bara synas när man är inloggad och kanske inte ligga där den ligger nu. Man skall kunna byta epost, 
lägga till och byta profilbild med mera. 

Tips från V är att ha olika formlär för de olika fälten. -->
<form action="app/users/edit.php" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="avatar">Choose your profile-picture</label>
        <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="avatar" required>
        <br>
        <button type="submit" class="btn btn-secondary">Save</button>
    </div>

    <!-- här kollar jag om message är satt (se den andra edit.php) Om den är det, så echoar jag ut meddelandet "Your profile pic has changed", 
  sedan unsetar jag session message och visar den nya bilden-->
    <?php if (isset($_SESSION['message'])) :
        echo $_SESSION['message'];
        unset($_SESSION['message']);

        if (isset($_SESSION['user']['profile_picture'])) :
    ?>
            <img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>">

    <?php endif;
    endif; ?>

</form>

<form action="app/users/edit.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="email">Change your email-address</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="email@email.com" required>
        <br>
        <button type="submit" class="btn btn-secondary">Save</button>
    </div>
</form>

<!-- här kollar jag om det emailMessage är satt i SESSION. se andra edit.php. om den är satt visas meddelandet
"your mail has changed" -->
<?php if (isset($_SESSION['emailMessage'])) :
    echo $_SESSION['emailMessage'];
    unset($_SESSION['emailMessage']);
?>


<?php endif;
require __DIR__ . '/views/footer.php'; ?>