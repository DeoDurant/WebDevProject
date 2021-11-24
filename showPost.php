<?php
require('connect.php');
include('navbar.php');

if (isset($_GET['id'])) {

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

    $commentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $comment = "SELECT * FROM comments WHERE post_id = '$commentId' ORDER BY id desc LIMIT 10";
    $commentStatement = $db->prepare($comment);
    $commentStatement->execute();
    $comments = $commentStatement->fetchAll();
    $commentsCount = $commentStatement->rowCount();
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
    <style>
        .container {
            padding: 5%;
        }

        .my-row {
            padding: 10%;
        }
    </style>
</head>

<body>
    <div class="container shadow-lg">
        <!-- Checks if the row count has 0. -->
        <?php if ($statement->rowCount() == 0) : ?>
            <li><?= "No posts here" ?></li>
        <?php endif ?>

        <!-- Shows the specific post that was selected. -->
        <?php if ($row = $discussion) : ?>
            <div class="row my-row justify-content-center">
                <div class="col">
                    <h1>
                        <?= $row['title'] ?>
                    </h1>
                </div>
            </div>
            <div class="row my-row shadow justify-content-center">
                <div class="col">
                    <h5><?= $row['content'] ?></h5>
                </div>
            </div>
            <?php if ($_SESSION['username'] == "guest") : ?>
                <div class="row my-row">
                    <div class="col"><?= $row['datetime'] ?></div>
                </div>
            <?php else : ?>
                <div class="row my-row">
                    <div class="col"><?= $row['datetime'] ?> - <a href="editPost.php?id=<?= $row['id'] ?>">Edit</a></div>
                </div>
            <?php endif ?>
        <?php else : ?>
            <?= $row['content'] ?>
        <?php endif ?>

        <!-- Shows the specific comments within this post. -->
        <div class="container shadow-lg">
            <?php if ($_SESSION['username'] == "admin") : ?>

                <?php if ($commentsCount > 0) : ?>
                    <h3>Comments</h3>
                    <?php foreach ($comments as $comments) : ?>
                        <div class="col">
                            <p><strong><?= $comments['user'] ?></strong></p>
                            <p><?= $comments['comment'] ?></p>
                            <p>Created at: <?= $comments['datetime'] ?></p>
                            <form action="processComment.php" method="post">
                                <input type="hidden" id="post_id" name="post_id" value="<?php echo $commentId ?>"></input>
                                <input type="hidden" id="id" name="id" value="<?php echo $comments['id'] ?>"></input>
                                <input class="btn btn-danger" type="submit" id="Delete" name="Delete" value="Delete Comment" onclick="return confirm('Delete post?')"></input>
                                <br></br>
                            </form>
                        </div>
                    <?php endforeach ?>
                <?php elseif ($commentsCount == 0) : ?>
                    <div class="alert alert-dark" role="alert">
                        <strong>No comments.</strong>
                    </div>
                <?php endif ?>
            <?php elseif ($_SESSION['username'] != "admin") : ?>
                <?php if ($commentsCount > 0) : ?>
                    <h3>Comments</h3>
                    <?php foreach ($comments as $comments) : ?>
                        <div class="col">
                            <p><strong><?= $comments['user'] ?></strong></p>
                            <p><?= $comments['comment'] ?></p>
                            <p>Created at: <?= $comments['datetime'] ?></p>
                        </div>
                    <?php endforeach ?>
                <?php elseif ($commentsCount == 0) : ?>
                    <div class="alert alert-dark" role="alert">
                        <strong>No comments.</strong>
                    </div>
                <?php endif ?>
            <?php endif; ?>
        </div>
        <br></br>

        <!-- Form to add comments, if user is guest, they will not be able to comment and must login. -->
        <?php if ($_SESSION['username'] != "guest") : ?>
            <form action="processComment.php" method="post">
                <legend>Add a Comment!</legend>
                <div class="form-group row">
                    <input type="hidden" id="post_id" name="post_id" value="<?php echo $commentId ?>"></input>
                    <label for="Comment" class="col-2 col-form-label">Comment</label>
                    <div class="col-10">
                        <textarea row="5" name="comment" id="comment" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit">
                </div>
            </form>
        <?php endif ?>
        <?php if ($_SESSION['username'] == "guest") : ?>
            <form>
                <legend>You must be logged in to comment.</legend>
                <div class="form-group row">
                    <label for="Comment" class="col-2 col-form-label">Comment</label>
                    <div class="col-10">
                        <textarea row="5" name="comment" id="comment" class="form-control" disabled></textarea>
                    </div>
                </div>
            </form>
        <?php endif ?>

    </div>
</body>

</html>