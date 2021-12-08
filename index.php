<?php
include('navbar.php');
require('connect.php');
//<?php include('sidebar.php')
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$query = "SELECT * FROM pokemon ORDER BY id";
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
    <br>
    <div class="container">
        <div class="row">
            <h1>Pokedex Showcase</h1>
            <?php if ($statement->rowCount() == 0) : ?>
                <li><?= "No posts here"; ?></li>
            <?php endif ?>
            
            <table class="table table-hover col-10">
                <thead>
                    <tr>
                        <th>Dex Entry</th>
                        <th>Picture</th>
                        <th>Pokemon Name</th>
                        <th>Typing</th>
                        <th>Ability</th>
                        <th>Notes</th>
                        <th>Date Found</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $statement->fetch()) : ?>
                        <tr>
                            <th scope="row">
                                <?= $row['id'] ?>
                            </th>
                            <td>
                                <?php if(!empty($row['imgname'])) :?>
                                    <img src="<?= 'images/' . $row['imgname'] ?>" alt="<?= $row['name'] ?>">
                                <?php else :?>
                                    No image
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="showPokemon.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
                            </td>
                            <td><?= $row['typing'] ?></td>
                            <td><?= $row['ability'] ?></td>
                            <td><?= $row['notes'] ?></td>
                            <td><?= $row['datetime'] ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php include('sidebar.php')?>
        </div>
    </div>  
</body>

</html>