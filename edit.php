<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<!-- 
Denna sidan skall bara synas när man är inloggad och kanske inte ligga där den ligger nu. Man skall kunna byta epost, 
lägga till och byta profilbild med mera. 

Tips från V är att ha olika formlär för de olika fälten. -->
<form action="app/users/edit.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="avatar">Choose your profile-picture</label>
        <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="avatar" required>
        <button type="submit">Save</button>
    </div>

</form>


<?php require __DIR__ . '/views/footer.php'; ?>