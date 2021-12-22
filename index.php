<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <!-- om man är inloggad visas ditt användarnamn efter Welcome -->
    <?php if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
        <?php

        // om du är inloggad och har en profilbild visas även din profilbild
        if (isset($_SESSION['user']['profile_picture'])) :
        ?>
            <img src="uploads/<?php echo $_SESSION['user']['profile_picture'] ?>">

    <?php endif;
    endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>