<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>



<article>
    <h1>Sign up</h1>

    <form action="app/users/register.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="full-name">Full name</label>
            <input class="form-control" type="full-name" name="full-name" id="full-name" placeholder="Hanna Rosenberg" required>
            <small class="form-text">Please provide with your fullname</small>
        </div>

        <div class="mb-3">
            <label for="email">E-mail</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="hanna.rosenberg@hotmail.com" required>
            <small class="form-text">Please provide with your email address</small>
        </div>

        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" id="username" placeholder="HannaRos" required>
            <small class="form-text">Please provide a desired username</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide with password </small>
        </div>


        <button type="submit" class="btn btn-primary">Sign up</button>

    </form>
    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>