<?php
include('navbar.php');
require('connect.php');

if (isset($_GET['id'])) {
    $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
    $statement = $db->prepare($query);

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    $statement->execute();

    $category = $statement->fetch();

    $pokemonId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $pokemon = "SELECT * FROM pokemon WHERE category_id = '$pokemonId' ORDER BY id ASC LIMIT 10";
    $pokemonStatement = $db->prepare($pokemon);
    $pokemonStatement->execute();
    $pokemons = $pokemonStatement->fetchAll();
    $pokemonCount = $pokemonStatement->rowCount();
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
        <div class="row">
            <?php if ($statement->rowCount() == 0) : ?>
                <h3>No posts here</h3>
            <?php endif ?>

            <?php if ($row = $category) : ?>
                <h1><a class="text-dark" href="categories.php">Categories </a>/ <?= $row['name'] ?></h1>
                
                <table class="table col-10">
                    <tbody>
                    <?php if($_SESSION['accounttype'] == 0) :?>
                    <h6><a href="addPokeToCategory.php?id=<?= $row['id'] ?>">Add a pokemon to this category</a></h6>
                    <?php endif ?>
                        <tr>
                            <th scope="row">
                                <?php if ($pokemonCount > 0) : ?>
                                    <?php foreach ($pokemons as $pokemons) : ?>
                                        <div class="col">
                                            <h3>
                                                <a href="showPokemon.php?id=<?= $pokemons['id'] ?>">
                                                    <strong><?= $pokemons['name'] ?></strong>
                                                </a>
                                            </h3>
                                        </div>
                                    <?php endforeach ?>
                                <?php elseif ($pokemonCount == 0) : ?>
                                    <div class="alert alert-dark" role="alert">
                                        <strong>No Pokemon in this category yet.</strong>
                                    </div>
                                <?php endif ?>
                            </th>
                        </tr>
                    </tbody>
                </table>
            <?php endif ?>
            <?php include('sidebar.php') ?>
        </div>

    </div>
</body>

</html>