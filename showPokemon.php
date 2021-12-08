<?php
include('navbar.php');
require('connect.php');

if (isset($_GET['id'])) {

    // Build and prepare SQL String with :id placeholder parameter.
    $query = "SELECT * FROM pokemon WHERE id = :id LIMIT 1";
    $statement = $db->prepare($query);

    // Sanitize $_GET['id'] to ensure it's a number.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :id parameter in the query to the sanitized
    // $id specifying a binding-type of Integer.
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();

    // Fetch the row selected by primary key id.
    $pokemon = $statement->fetch();
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - Categories Show</title>
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
            padding: 5%;
        }

        .my-row {
            padding: 10%;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($_SESSION['accounttype'] == 0) : ?>
            <?php if (empty($pokemon['imgname'])) : ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $pokemon['name'] ?></h4>
                        <p class="card-text">
                            <?= $pokemon['notes'] ?>
                        </p>
                        <p class="card-text">
                            Typing: <?= $pokemon['typing'] ?>
                        </p>
                        <p class="card-text">
                            Ability: <?= $pokemon['ability'] ?>
                        </p>
                        <a href="editPokemon.php?id=<?= $pokemon['id'] ?>" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            <?php else : ?>
                <div class="card">
                    <img class="img-fluid" src="<?= 'images/' . $pokemon['imgname'] ?>" alt="<?= $pokemon['name'] ?>">
                    <div class="card-body">
                        <h4 class="card-title"><?= $pokemon['name'] ?></h4>
                        <p class="card-text">
                            <?= $pokemon['notes'] ?>
                        </p>
                        <p class="card-text">
                            Typing: <?= $pokemon['typing'] ?>
                        </p>
                        <p class="card-text">
                            Ability: <?= $pokemon['ability'] ?>
                        </p>
                        <a href="editPokemon.php?id=<?= $pokemon['id'] ?>" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            <?php endif ?>
        <?php else : ?>
            <?php if (empty($pokemon['imgname'])) : ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $pokemon['name'] ?></h4>
                        <p class="card-text">
                            <?= $pokemon['notes'] ?>
                        </p>
                        <p class="card-text">
                            Typing: <?= $pokemon['typing'] ?>
                        </p>
                        <p class="card-text">
                            Ability: <?= $pokemon['ability'] ?>
                        </p>
                    </div>
                </div>
            <?php else : ?>
                <div class="card">
                    <img class="img-fluid" src="<?= 'images/' . $pokemon['imgname'] ?>" alt="<?= $pokemon['name'] ?>">
                    <div class="card-body">
                        <h4 class="card-title"><?= $pokemon['name'] ?></h4>
                        <p class="card-text">
                            <?= $pokemon['notes'] ?>
                        </p>
                        <p class="card-text">
                            Typing: <?= $pokemon['typing'] ?>
                        </p>
                        <p class="card-text">
                            Ability: <?= $pokemon['ability'] ?>
                        </p>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</body>

</html>