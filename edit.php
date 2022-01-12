<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<h1>Edit Profile</h1>

<div class="picture-form">


    <!-- Form för att välja profilbild -->
    <form action="app/users/edit.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="avatar">Choose your profile-picture</label>
            <input type="file" accept=".jpg, .jpeg, .png" name="avatar" id="avatar" required>
            <button type="submit" class="btn btn-dark">Save</button>

        </div>

        <!-- Om man har lagt upp en fil i fältet 'avatar' så skapas $_SESSION[message] - se den andra edit.php. Här kollar man om det finns en
        $_SESSION[message] och om det gör det så echoas meddelandet "Your profile pic has changed" ut. Session unsetas -->
        <p class="sessionMessageEdit">
            <?php
            if (isset($_SESSION['message'])) :
                echo $_SESSION['message'];
                unset($_SESSION['message']);

                // Finns det en profile_picture i users-arrayen visas den här.
                if (isset($_SESSION['user']['profile_picture'])) : ?>
        <div class="profile-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>
    <?php endif; ?>
<?php endif; ?>
</p>
    </form>
</div>


<!-- Form för att byta e-post -->
<div class="email-form">
    <form action="app/users/edit.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email">Change your email-address</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="email@email.com" required>

            <button type="submit" class="btn btn-dark">Save</button>
        </div>
    </form>

    <!-- Här kollar jag om det finns ett emailMessage i SESSION, se andra edit.php. Om den är satt visas meddelandet "your mail has changed". -->
    <p class="sessionMessageEdit">
        <?php if (isset($_SESSION['emailMessage'])) :
            echo $_SESSION['emailMessage'];
            unset($_SESSION['emailMessage']);
        endif; ?>
    </p>

</div>


<!-- Form för att byta lösenord -->
<div class="password-form">
    <form action="app/users/edit.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="password">Change your password</label>
            <input class="form-control" type="password" name="password" id="password" required>

            <button type="submit" class="btn btn-dark">Save</button>
        </div>
    </form>

    <!-- Här kollar jag om det finns ett passwordMessage i SESSION, se andra edit.php. Om den är satt visas meddelandet "your password has changed". -->
    <p class="sessionMessageEdit">
        <?php if (isset($_SESSION['passwordMessage'])) :
            echo $_SESSION['passwordMessage'];
            unset($_SESSION['passwordMessage']);
        endif; ?>
    </p>
</div>

<?php
require __DIR__ . '/views/footer.php'; ?>
