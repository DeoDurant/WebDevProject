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
    $query = "SELECT * FROM accounts WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the SELECT and fetch the single row returned.
    $statement->execute();
    $accounts = $statement->fetch();
} else {
    $id = false; // False if we are not UPDATING or SELECTING.
}

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
</head>

<body>
    <br>
    <?php if ($id) : ?>
        <div class="container">
            <!-- Content here -->
            <form action="processUsers.php" method="post">
                <legend>Update Users</legend>
                <div class="form-group row">
                    <p>
                        <input type="hidden" name="id" value="<?= $accounts['id'] ?>">
                    </p>
                    <label for="username" class="col-2 col-form-label">Username</label>
                    <div class="col-10">
                        <input name="username" id="username" class="form-control" value="<?= $accounts['username'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input name="email" id="email" class="form-control" value="<?= $accounts['email'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <select name="accounttype" class="custom-select">
                        <option selected>Account Type</option>
                        <option value=0>Administrator</option>
                        <option value=1>Regular User</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" id="update" name="Update" value="Update">
                    <input type="submit" id="delete" name="Delete" value="Delete" onclick="return confirm('Delete user?')">
                </div>
            </form>
        </div>
    <?php else : ?>
        <p>Select a post to edit.</p>
    <?php endif ?>
</body>

</html>