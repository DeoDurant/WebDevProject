<?php

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$queryPoke = "SELECT * FROM pokemon ORDER BY id LIMIT 5";
$statementOne = $db->prepare($queryPoke);
$statementOne->execute();

$queryPost = "SELECT * FROM discussion ORDER BY id DESC LIMIT 5";
$statementTwo = $db->prepare($queryPost);
$statementTwo->execute();

$queryCategories = "SELECT * FROM categories ORDER BY id LIMIT 5";
$statementThree = $db->prepare($queryCategories);
$statementThree->execute();
?>

<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - New Category</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .container {
            padding: 5%
        }
    </style>
</head>

<body> -->
<div style="text-align: right" class="col-2 ">
    <nav class="nav flex-column navbar-dark">
        <ul class="list-unstyled">
            <h3 class="text-dark">Pokemon</h3>
            <?php while ($rowOne = $statementOne->fetch()) : ?>
                <li>
                    <a class="text-dark" href="showPokemon.php?id=<?= $rowOne['id'] ?>"><?= $rowOne['name'] ?></a>
                </li>
            <?php endwhile ?>
        </ul>
        <ul class="list-unstyled">
            <h3 class="text-dark">Forum Posts</h3>
            <?php while ($rowTwo = $statementTwo->fetch()) : ?>
                <li>
                    <a class="text-dark" href="showPost.php?id=<?= $rowTwo['id'] ?>"><?= $rowTwo['title'] ?></a>
                </li>
            <?php endwhile ?>
        </ul>
        <ul class="list-unstyled">
            <h3 class="text-dark">Categories</h3>
            <?php while ($rowThree = $statementThree->fetch()) : ?>
                <li>
                    <a class="text-dark" href="showCategories.php?id=<?= $rowThree['id'] ?>"><?= $rowThree['name'] ?></a>
                </li>
            <?php endwhile ?>
        </ul>
    </nav>
</div>
<!-- </body>

</html> -->