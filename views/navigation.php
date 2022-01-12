<nav class="navbar navbar-expand-lg navbar navbar-dark">

    <?php if (isset($_SESSION['user']['profile_picture'])) : ?>
        <div class="first-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>

    <?php endif; ?>

    <!-- <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a> -->
    <div class="logo">
        <h1>o</h1>
        <p>rganize me</p>
    </div>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/edit.php">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/today.php' ? 'active' : ''; ?>" href="/today.php">Today</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/lists.php' ? 'active' : ''; ?>" href="/lists.php">Lists</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/app/users/logout.php">Logout</a>
            </li>

        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/login.php">Login</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign up</a>
            </li>
        <?php endif; ?>
    </ul>

    <?php if (isset($_SESSION['user']['profile_picture'])) : ?>
        <div class="nav-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>

    <?php endif; ?>


</nav>
