<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">

    <?php if (isset($_SESSION['user']['profile_picture'])) :
    ?>
        <div class="first-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>

    <?php
    endif; ?>

    <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/tasks.php' ? 'active' : ''; ?>" href="/tasks.php">My tasks</a>
        </li>


        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/app/users/logout.php">Logout</a>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/edit.php">Edit profile</a>
        </li>
    <?php else : ?>
        <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/login.php">Login</a>

        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php">Sign up</a>
        </li>
    <?php endif; ?>
    </li>
    </ul>

    <?php if (isset($_SESSION['user']['profile_picture'])) :
    ?>
        <div class="nav-picture"><img src="/../uploads/<?php echo $_SESSION['user']['profile_picture'] ?>"></div>

    <?php
    endif; ?>


</nav>