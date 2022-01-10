<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<article>

    <h1>Sign up</h1>

    <!-- Signup-form for new user -->
    <form action="app/users/register.php" method="post" enctype="multipart/form-data">

        <!-- Input for fullname -->
        <div class="mb-3">
            <label for="full-name">Full name</label>
            <input class="form-control" type="full-name" name="full-name" id="full-name" required>
            <small class="form-text">Please provide with your fullname</small>
        </div>

        <!-- Input for email -->
        <div class="mb-3">
            <label for="email">E-mail</label>
            <input class="form-control" type="email" name="email" id="email" required>
            <small class="form-text">Please provide with your email address</small>
        </div>

        <!-- Input for username -->
        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" required>
            <small class="form-text">Please provide a desired username</small>
        </div>

        <!-- Input for password -->
        <div class="mb-3">
            <label for="password">Password / Passphrase</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide with a password or passphrase. At least 16 characters required</small>
        

        <p class="error">
                <?php if (isset($_SESSION['error'])) :
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                endif;
                ?>
                </p>
                </div>

        <!-- Submitbutton -->
        <button type="submit" class="btn btn-dark">Sign up</button>

    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>