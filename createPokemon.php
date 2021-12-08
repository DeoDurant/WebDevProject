<?php
include('navbar.php');
require('connect.php');
// Checks if there is no current session set, and if the current sessions username is not admin.
if (!isset($_SESSION) || $_SESSION['accounttype'] != 0) {
    header("Location: index.php");
}

$query = "SELECT * FROM categories ORDER BY id";
$catStatement = $db->prepare($query);
$catStatement->execute();
$categories = $catStatement->fetchAll();
$catCount = $catStatement->rowCount();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - New Pokemon</title>
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
    <br></br>
    <div class="container shadow-lg">
        <form action="process.php" method="post" enctype="multipart/form-data">
            <legend>Add New Pokemon</legend>
            <div class="form-group row">
                <label for="pokename" class="col-2 col-form-label">Name</label>
                <div class="col-10">
                    <input name="pokename" id="pokename" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="ability" class="col-2 col-form-label">Ability</label>
                <div class="col-10">
                    <input name="ability" id="ability" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="categories" class="col-2 col-form-label">Category: </label>
                <select name="categories" class="custom-select col-10">
                    <option value="0">Choose "No Category"</option>
                    <?php if ($catCount > 0) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>">
                                <?= $category['name'] ?>
                            </option>
                        <?php endforeach ?>
                    <?php elseif ($catCount == 0) : ?>
                        <option value="0">
                                No categories yet.
                            </option>
                    <?php endif ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="typing" class="col-2 col-form-label">Typing</label>
                <select name="typing1" class="custom-select col-5">
                    <option value="Normal">Normal</option>
                    <option value="Fire">Fire</option>
                    <option value="Water">Water</option>
                    <option value="Grass">Grass</option>
                    <option value="Electric">Electric</option>
                    <option value="Ice">Ice</option>
                    <option value="Fighting">Fighting</option>
                    <option value="Poison">Poison</option>
                    <option value="Ground">Ground</option>
                    <option value="Flying">Flying</option>
                    <option value="Psychic">Psychic</option>
                    <option value="Bug">Bug</option>
                    <option value="Rock">Rock</option>
                    <option value="Ghost">Ghost</option>
                    <option value="Dark">Dark</option>
                    <option value="Dragon">Dragon</option>
                    <option value="Steel">Steel</option>
                    <option value="Fairy">Fairy</option>
                </select>
                <select name="typing2" class="custom-select col-5">
                    <option>No Second Typing</option>
                    <option value="Normal">Normal</option>
                    <option value="Fire">Fire</option>
                    <option value="Water">Water</option>
                    <option value="Grass">Grass</option>
                    <option value="Electric">Electric</option>
                    <option value="Ice">Ice</option>
                    <option value="Fighting">Fighting</option>
                    <option value="Poison">Poison</option>
                    <option value="Ground">Ground</option>
                    <option value="Flying">Flying</option>
                    <option value="Psychic">Psychic</option>
                    <option value="Bug">Bug</option>
                    <option value="Rock">Rock</option>
                    <option value="Ghost">Ghost</option>
                    <option value="Dark">Dark</option>
                    <option value="Dragon">Dragon</option>
                    <option value="Steel">Steel</option>
                    <option value="Fairy">Fairy</option>
                </select>
            </div>
            <div class="form-group row">
                <label for="notes" class="col-2 col-form-label">Notes</label>
                <div class="col-10">
                    <textarea row="5" name="notes" id="notes" class="form-control" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="img" class="col-2 col-form-label">Add a Picture: </label>
                <input type='file' name='image' id='image'>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" id="create" name="create" value="Add new Pokemon">
            </div>
        </form>
    </div>
</body>

</html>