<?php
    require('authenticate.php');
    require('connect.php');

    if (isset($_GET['id'])){

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Build and prepare SQL String with :id placeholder parameter.
        $query = "SELECT * FROM discussion WHERE id = :id LIMIT 1";
        $statement = $db->prepare($query);
    
        // Sanitize $_GET['id'] to ensure it's a number.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Bind the :id parameter in the query to the sanitized
        // $id specifying a binding-type of Integer.
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    
        // Fetch the row selected by primary key id.
        $discussion = $statement->fetch();
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Show</title>
</head>
<body>
    <header>
        <h1>Post - <?php if($row = $discussion): ?><?= $discussion['id']?> <?php endif?></h1>
        <ul>
            <li><a href="index.php" class="active">Pokedex</a></li>
            <li><a href="discussion.php">Discussion</a></li>
            <li><a href="createPokemon.php">New Pokemon</a></li>
            <li><a href="createPost.php">New Post</a></li>
        </ul>
    </header>
    <!-- Checks if the row count has 0. -->
    <?php if($statement->rowCount()==0): ?>
            <li><?="No posts here"; ?></li>
    <?php endif ?>          

    <!-- Shows the specific post that was selected. -->
    <?php if($row = $discussion): ?>
        <h1><?= $row['title'] ?></h1>
        <h3><?= $row['content']?></h3>
        <p><small><?=$row['datetime'] ?> - <a href="edit.php?id=<?= $row['id'] ?>">Edit</a></small></p>
    <?php else: ?>
        <?= $row['content'] ?>
    <?php endif ?>
</body>
</html> 