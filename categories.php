<?php
include('navbar.php');
require('connect.php');

$query = "SELECT * FROM categories ORDER BY id";
$statement = $db->prepare($query);
$statement->execute();

$pokemonId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// $pokemon = "SELECT * FROM pokemon WHERE category_id = '$pokemonId' ORDER BY id desc LIMIT 10";
// $pokemonStatement = $db->prepare($pokemon);
// $pokemonStatement->execute();
// $pokemons = $pokemonStatement->fetchAll();
// $pokemonCount = $pokemonStatement->rowCount();

?>

<!DOCTYPE html>
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


<body>
    <div class="container">
        <div class="row">
            <h1>Categories</h1>
            <?php if ($statement->rowCount() == 0) : ?>
                <h3>No posts here</h3>
            <?php else : ?>
                <?php if ($_SESSION['accounttype'] == 0) : ?>
                    <h4><a href="createCategories.php">Create new Category</a></h4>
                    <table class="table table-hover col-10">
                        <?php while ($rowCategory = $statement->fetch()) : ?>
                            <thead>
                                <tr>
                                    <th>
                                        <h3>
                                            <a href="showCategories.php?id=<?= $rowCategory['id'] ?>"><?= $rowCategory['name'] ?></a>
                                        </h3>
                                        <input type="hidden" id="category_id" name="category_id" value="<?php echo $pokemonId ?>"></input>
                                        <a href="editCategories.php?id=<?= $rowCategory['id'] ?>">Manage category</a>
                                        <!-- <form action="editCategories.php" method="post">
                                            <input class="btn btn-danger" type="submit" id="Delete" name="Delete" value="Delete Category" onclick="return confirm('Delete post?')"></input>
                                            <br></br>
                                        </form> -->
                                    </th>
                                </tr>
                            </thead>
                        <?php endwhile ?>
                    </table>
                <?php else : ?>
                    <table class="table table-hover col-10">
                        <?php while ($rowCategory = $statement->fetch()) : ?>
                            <thead>
                                <tr>
                                    <th>
                                        <h3>
                                            <a href="showCategories.php?id=<?= $rowCategory['id'] ?>"><?= $rowCategory['name'] ?></a>
                                        </h3>
                                    </th>
                                </tr>
                            </thead>
                        <?php endwhile ?>
                    </table>

                <?php endif ?>

            <?php endif ?>
            <?php include('sidebar.php') ?>
        </div>
    </div>
</body>

</html>