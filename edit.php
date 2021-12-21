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

</form>

<form action="app/users/edit.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="newemail">Change your email-address</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="email@email.com" required>
        <br>
        <button type="submit" class="btn btn-secondary">Save</button>
    </div>
</form>

<?php require __DIR__ . '/views/footer.php'; ?>