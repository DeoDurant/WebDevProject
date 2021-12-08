<?php

require('connect.php');
include('navbar.php');

if (!isset($_SESSION) || $_SESSION['accounttype'] != 0) {
    header("Location: index.php");
}

if (isset($_GET['id'])) { // Retrieve account to be edited, if id GET parameter is in URL.
    // Sanitize the id. Like above but this time from INPUT_GET.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the parametrized SQL query using the filtered id.
    $query = "SELECT * FROM categories WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the SELECT and fetch the single row returned.
    $statement->execute();
    $category = $statement->fetch();

    $queryTwo = "SELECT * FROM pokemon WHERE category_id = $id";
    $statementTwo = $db->prepare($queryTwo);
    $statementTwo->execute();
    $pokemon = $statementTwo->fetch();
    


    
} else {
    $id = false; // False if we are not UPDATING or SELECTING.
}

?>

<!DOCTYPE html>
<html?>

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
    </head>

    <body>
        <br>
        <?php if ($id) : ?>
            <div class="container">
                <!-- Content here -->
                <form action="processCategories.php" method="post"">
                    <legend>Edit Category</legend>
                    <div class="form-group row">
                        <p>
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                        </p>
                        <p>
                            <input type="hidden" name="pokeid" value="<?= $pokemon['id'] ?>">
                        </p>
                        <label for="name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input name="name" id="name" class="form-control" value="<?= $category['name'] ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" id="update" name="command" value="Edit">
                        <input class="btn btn-danger" type="submit" id="delete" name="command" value="Delete" onclick="return confirm('Delete user?')">
                    </div>
                </form>
            </div>
        <?php else : ?>
            <p>Select a category to edit.</p>
        <?php endif ?>
    </body>

    </html>
