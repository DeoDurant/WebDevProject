<?php
session_start();
?>

<div class="header">
    <div class="menu-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">Professor Oak's Pokedex</a>
            <form class="form-inline" action="search.php" method="post">
                <input name="search" id="search" class="form-control" required></input>
                <button type="submit" class="btn btn-danger">Submit</button>
                <!-- <input class="btn btn-danger" type="submit" id="search" name="search" value="Search"></input> -->
            </form>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php if ($_SESSION['username'] == "guest") : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="discussion.php">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome <?= $_SESSION['username'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php elseif ($_SESSION['accounttype'] == 0) : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="discussion.php">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createPokemon.php">New Pokemon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createPost.php">New Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createCategories.php">New Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome <?= $_SESSION['username'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="discussion.php">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createPost.php">New Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createCategories.php">New Category</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome <?= $_SESSION['username'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </div>
</div>