<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <h1>Login</h1>

    <!-- Form for login -->
    <form action="app/users/login.php" method="post">

        <!-- Input for email -->
        <div class="mb-3">
            <label for="email">Email-address</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <small class="form-text">Please provide with your email address</small>
        </div>

        <!-- Input for password -->
        <div class="mb-3">
            <label for="password">Password / Passphrase</label>
            <input class="form-control" type="password" name="password" id="password" minlength="16" required>
            <small class="form-text">Please provide with your password or passphrase</small>
        </div>

        <!-- Om det skapats ett SESSION['error'], dvs att lösenordet inte matchade med den mail som finns i databasen, så skall ett errormeddelande
        skrivas ut på sidan. Därefter unsetas $_SESSION error för att jag kan använda session för andra felmeddelanden.-->
        <div>
            <p class="error">
                <?php if (isset($_SESSION['error'])) :
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                endif;
                ?>
            </p>
        </div>

        <!-- Knapp för att logga in -->
        <button type="submit" class="btn btn-dark">Login</button>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
