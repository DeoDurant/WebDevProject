<?php
    require('connect.php');
    include('navbar.php');

    if (!isset($_SESSION) || $_SESSION['username'] == "guest") {
        header("Location: index.php");
    }
    
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM discussion WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $discussion = $statement->fetch();
    } 
    else {
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
    <?php if ($id):?>
    <form action="process.php" method="post">
        <fieldset>
            <legend>Edit Post</legend>
                <p>
                <input type="hidden" name="id" value="<?= $discussion['id']?>">
                </p>
                <p>
                    <label for="title">Title</label>
                    <input name="title" id="title" style="height:5vh;width:100%" value="<?=$discussion['title']?>">
                </p>
                <p>
                    <label for="postContent">Content</label>
                    <textarea rows="16" style="width: 100%" name="content" id="content"><?=$discussion['content']?></textarea>
                </p>
                <p id="button">
                    <input type="submit" id="update" name="Update" value="Update">
                    <input type="submit" id="delete" name="Delete" value="Delete" onclick="return confirm('Delete post?')">
                </p>
        </fieldset>
    </form>
    <?php else: ?>
        <p>Select a post to edit.</p>
    <?php endif ?>
</body>
</html>