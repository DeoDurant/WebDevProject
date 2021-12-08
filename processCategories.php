<?php
require('connect.php');


if (isset($_POST['create'])) {
    if ($_POST && isset($_POST['category'])) {
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "INSERT INTO categories(id, name) VALUES (NULL, :name)";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $category);

        $statement->execute();
        header("Location: categories.php");
        exit;
    }
}

// Add a Pokemon to a specific category
if (isset($_POST['update'])) {

    $rowid = filter_input(INPUT_POST, 'assign', FILTER_SANITIZE_NUMBER_INT);
    $catid = filter_input(INPUT_POST, 'catid', FILTER_SANITIZE_NUMBER_INT);

    if ($_POST && isset($_POST['assign']) && isset($_POST['catid'])) {

        $pokequery     = "UPDATE pokemon SET category_id = :category_id WHERE id = '$rowid'";
        $pokeStatement = $db->prepare($pokequery);
        // $pokeStatement->bindValue(':id', $rowid, PDO::PARAM_INT);
        $pokeStatement->bindValue(':category_id', $catid);

        // Execute the UPDATE.
        $pokeStatement->execute();

        header("Location: categories.php");
        exit;
    }
}

// Update a category
if ($_POST['command'] === 'Edit') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_NUMBER_INT);

    $query     = "UPDATE categories SET name = :name WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the INSERT.
    $statement->execute();

    // Redirect after update.
    header("Location: categoies.php");
    exit;
}


// Delete a category.
if ($_POST['command'] === 'Delete') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $pokeid = filter_input(INPUT_POST, 'pokeid', FILTER_SANITIZE_NUMBER_INT);

    $query = "DELETE FROM categories WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $statement->execute();

    $queryTwo = "UPDATE pokemon set category_id = 0 WHERE id = $pokeid";
    $statementTwo = $db->prepare($queryTwo);
    $statementTwo->execute();

    header("Location: categories.php");
    exit;
}
