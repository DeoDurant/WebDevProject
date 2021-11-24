<?php
require('connect.php');
include('navbar.php');

if (!isset($_POST['search'])) {
    header("Location: index.php");
}

if (isset($_POST['search'])) {
    $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $pokeQuery = "SELECT * FROM pokemon WHERE (name LIKE '%$search%') 
                                        OR (typing LIKE '%$search%')
                                        OR (ability LIKE '%$search%')
                                        OR (notes LIKE '%$search%')";

    $statementOne = $db->prepare($pokeQuery);
    $statementOne->execute();

    $discussionQuery = "SELECT * FROM discussion WHERE (title LIKE '%$search%') 
                                        OR (content LIKE '%$search%')";

    $statementTwo = $db->prepare($discussionQuery);
    $statementTwo->execute();
}
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
    <br></br>
    <div class="container">
        <!-- Searches returned within the Index page. -->

        <?php if ($statementOne->rowCount() == 0) : ?>
            <h3>There are no Forum Post that contain the word <?= $_POST['search'] ?></h3>
        <?php else : ?>
            <h1>Pokedex Entries that contain the word <?= $_POST['search'] ?></h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Dex Entry</th>
                        <th>Pokemon Name</th>
                        <th>Typing</th>
                        <th>Ability</th>
                        <th>Notes</th>
                        <th>Date Found</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rowPokemon = $statementOne->fetch()) : ?>
                        <tr>
                            <th scope="row"><?= $rowPokemon['id'] ?></th>
                            <td><?= $rowPokemon['name'] ?></td>
                            <td><?= $rowPokemon['typing'] ?></td>
                            <td><?= $rowPokemon['ability'] ?></td>
                            <td><?= $rowPokemon['notes'] ?></td>
                            <td><?= $rowPokemon['datetime'] ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        <?php endif ?>

        <br></br>

        <!-- Searches returned within the Forums page. -->
        <?php if ($statementTwo->rowCount() == 0) : ?>
            <h3>There are no Forum Post that contain the word <?= $_POST['search'] ?></h3>
        <?php else : ?>
            <h1>Forum Posts that contain the word <?= $_POST['search'] ?></h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rowForum = $statementTwo->fetch()) : ?>
                        <tr>
                            <th scope="row"><a href="showPost.php?id=<?= $rowForum['id'] ?>"><?= $rowForum['title'] ?></a></th>
                            <td>
                                <?php if (strlen($rowForum['content']) > 150) : ?>
                                    <div class="col"><?= substr($rowForum['content'], 0, 150); ?><a href="showPost.php?id=<?= $rowForum['id'] ?>"> ... Read Full Post</a></div>
                                <?php else : ?>
                                    <div class="col"><?= $rowForum['content'] ?></div>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($_SESSION['username'] == "guest") : ?>
                                    <div class="col"><?= $rowForum['datetime'] ?></div>
                                <?php else : ?>
                                    <div class="col"><?= $rowForum['datetime'] ?> - <a href="editPost.php?id=<?= $rowForum['id'] ?>">Edit</a></div>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</body>

</html>