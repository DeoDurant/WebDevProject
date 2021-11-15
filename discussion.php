<?php

require('connect.php');

$query = "SELECT * FROM discussion ORDER BY id DESC LIMIT 10";
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
    <?php include('navbar.php') ?>
    
    <div class="container">
    <h1>Forum Posts</h1>
        <?php if ($statement->rowCount() == 0) : ?>
            <col><?= "No posts here"; ?></col>
        <?php endif ?>
        <?php while ($row = $statement->fetch()) : ?>
            <div class="row">
                <div class="col"><a href="showPost.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></div>

                <?php if (strlen($row['content']) > 200) : ?>
                    <div class="col"><?= substr($row['content'], 0, 200); ?>Read Full Post</div>
                <?php else : ?>
                    <div class="col"><?= $row['content'] ?></div>
                <?php endif ?>

                <div class="col"><?= $row['datetime'] ?> - <a href="editPost.php?id=<?= $row['id'] ?>">Edit</a></div>
            </div>
        <?php endwhile ?>
    </div>
    </div>
</body>

</html>