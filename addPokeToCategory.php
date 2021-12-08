<?php
include('navbar.php');
require('connect.php');

if (!isset($_SESSION) || $_SESSION['accounttype'] != 0) {
    header("Location: index.php");
}
if (isset($_GET['id'])) {
    $query = "SELECT * FROM pokemon WHERE category_id = 0 ORDER BY id";
    $statement = $db->prepare($query);
    $statement->execute();


    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $catQuery = "SELECT * FROM categories WHERE id = '$id'";
    $catStatement = $db->prepare($catQuery);

    $catStatement->execute();
    $catRow = $catStatement->fetch();
}
?>

<!DOCTYPE html>
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
    <br>
    <div class="container shadow-lg">
        <form action="processCategories.php" method="post">
            <legend>Add a Pokemon to the <?= $catRow['name'] ?> Category</legend>

            <div class="form-group row">
                <label for="assign" class="col-2 col-form-label">Pokemon to Add</label>
                <select name="assign" class="custom-select col-4">
                    <?php while ($row = $statement->fetch()) : ?>
                        <option name="rowid" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile ?>
                </select>
            </div>

            <div class="form-group">
                <input type="hidden" name="catid" value="<?= $id ?>">
                <input class="btn btn-primary" type="submit" id="update" name="update" value="Add new Pokemon">
            </div>
        </form>
    </div>

</body>

</html>