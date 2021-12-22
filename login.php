<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/users/login.php" method="post">
        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text">Please provide the your email address.</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide the your password (passphrase).</small>
        </div>


        <!-- Om det fastnat ett error i sessionen = användaren skrev in fel lösenord eller email, så skall ett errormeddelande skrivas ut på sidan. 
     Därefter unsetas $_SESSION error för att jag kan använda session för andra felmeddelanden. Funkar bara om man skiver in 
    fel lösenord på en användare vars epost finns i databasen.-->

        <?php if (isset($_SESSION['error'])) :
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        endif;
        ?>



        <button type="submit" class="btn btn-dark">Login</button>


    </form>
    <br>
    <!-- creates button that takes you to the sign-up page -->
    <form method="get" action="/signup.php">
        <button type="submit" class="btn btn-dark">Sign up</button>
    </form>




    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>