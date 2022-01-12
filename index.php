<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <div class="frontPageItems">

        <!-- Om användaren INTE är inloggad så syns "välkomstbilden"  -->
        <?php if (!isset($_SESSION['user'])) { ?>
            <div class="frontPageImg"> <img src="assets/images/idea.webp" class="homePage" alt="Linedrawing, hand with lamp"></div>
        <?php }; ?>

        <!-- Namnet på sidan visas  -->
        <h1><?php echo $config['title']; ?></h1>

    </div>

    <div class="contentFrontpage">

        <!-- Om användaren är inloggad visas kontots angivna namn efter Welcome, följt av frågan "What do you want to do och två knappar -->
        <?php if (isset($_SESSION['user'])) : ?>
            <p class="greeting">Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>

            <!-- Om användaren är inloggad och har en profilbild visas även profilbilden. -->
            <?php if (isset($_SESSION['user']['profile_picture'])) :  ?>
                <img src="uploads/<?php echo $_SESSION['user']['profile_picture'] ?>" class="home-picture" alt="Users profile-pic">
            <?php else : ?>
                <div class="frontPageImg"> <img src="assets/images/idea.webp" class="homePageSmallImg" alt="Linedrawing, hand with lamp"></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])) : ?>
                <!-- Måste man göra såhär för att skickas till en annan sida? XXX -->
                <form method="get" action="/lists.php">
                    <button type="submit" class="btn btn-dark">Create list</button>
                </form>

                <form method="get" action="/today.php">
                    <button type="submit" class="btn btn-dark">What's for today?</button>
                </form>


            <?php endif; ?>
        <?php endif;
        ?>



</article>

<?php require __DIR__ . '/views/footer.php'; ?>
