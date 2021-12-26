<nav class="navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/app/users/logout.php">Logout</a>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/edit.php' ? 'active' : ''; ?>" href="/edit.php">Edit</a>
        </li>

    <?php else : ?>
        <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Sign in</a>
    <?php endif; ?>
    </li>

    <!-- Gör så att sign upp bara syns för den som inte är inloggad -->
    <?php if (!isset($_SESSION['user'])) : ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign up</a>
        </li>

    <?php endif; ?>


    </ul>

    <?php if (isset($_SESSION['user']['profile_picture'])) :
    ?>
        <div class="nav-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>

    <?php
    endif; ?>

</nav>