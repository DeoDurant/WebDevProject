<?php

require('connect.php');

$query = "SELECT * FROM pokemon ORDER BY id ASC LIMIT 5";
$statement = $db->prepare($query);
$statement->execute();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <div class="menu-bar">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Professor Oak's Pokedex</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="discussion.php">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createPokemon.php">New Pokemon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="createPost.php">New Post</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <section>
        <!-- <section>
            <h1><a href="index.php">Home</a></h1>
        </section>

        <ul>
            <li><a href="index.php" class="active">Pokedex</a></li>
            <li><a href="discussion.php">Discussion</a></li>
            <li><a href="createPokemon.php">New Pokemon</a></li>
            <li><a href="createPost.php">New Post</a></li>
        </ul> -->

        <section>
            <?php if ($statement->rowCount() == 0) : ?>
                <li><?= "No posts here"; ?></li>
            <?php endif ?>
            <?php while ($row = $statement->fetch()) : ?>
                <h1><?= $row['name'] ?></h1>
                <h3><?= $row['typing'] ?></h3>
                <h3><?= $row['ability'] ?></h3>
                <section>
                    <?php if (strlen($row['notes']) > 200) : ?>
                        <p><?= substr($row['notes'], 0, 200); ?>Read Full Post</p>
                    <?php else : ?>
                        <p><?= $row['notes'] ?></p>
                    <?php endif ?>
                </section>
                <h3>Added at: <?= $row['datetime'] ?></h3>
            <?php endwhile ?>
        </section>
        <section>
            <?php echo (date('d-m-y')); ?>
        </section>
    </section>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>