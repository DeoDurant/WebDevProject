<?php
include('navbar.php');
require('connect.php');

if (!isset($_SESSION['username']) || $_SESSION['accounttype'] != 0) {
    header('Location: index.php');
}

$query = "SELECT * FROM accounts ORDER BY id ASC LIMIT 10";
$statement = $db->prepare($query);
$statement->execute();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - Home</title>
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
    <div class="container">
        <h1>Users Registered</h1>
        <?php if ($statement->rowCount() == 0) : ?>
            <li><?= "No users here"; ?></li>
        <?php endif ?>
        <a href="createUser.php">Create a User</a>

        <form action="processUsers.php" method="post">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID #</th>
                        <th>Account Type</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $statement->fetch()) : ?>
                        <tr>
                            <th scope="row"><?= $row['id'] ?></th>
                            <td><?= $row['accounttype']?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <a href="editUser.php?id=<?=$row['id'] ?>">Manage</a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </form>
</body>

</html>