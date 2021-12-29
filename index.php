<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="frontPageItems">
        <?php if (!isset($_SESSION['user'])) { ?>
            <div class="frontPageImg"> <img src="assets/images/idea.webp" class="homePage"></div>
        <?php
        }; ?>

        <h1><?php echo $config['title']; ?></h1>
        <!-- <p>This is the home page.</p> -->
    </div>
    <div class="contentFrontpage">
        <!-- om man är inloggad visas ditt användarnamn efter Welcome -->
        <?php if (isset($_SESSION['user'])) : ?>
            <p class="greeting">Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
            <?php

            // om du är inloggad och har en profilbild visas även din profilbild
            if (isset($_SESSION['user']['profile_picture'])) :
            ?>
                <img src="uploads/<?php echo $_SESSION['user']['profile_picture'] ?>" class="home-picture">


            <?php endif;
        endif;

        if (isset($_SESSION['user'])) : ?>

            <p class="greeting">What do you want to do?</p>
            <form method="get" action="/tasks.php">
                <button type="submit" class="btn btn-dark">Create task</button>
            </form>

            <form method="get" action="/lists.php">
                <button type="submit" class="btn btn-dark">Create list</button>
            </form>
        <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>