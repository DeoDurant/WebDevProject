<?php
//Creates a new blog post.
require 'authenticate.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - New Post</title>

</head>
<body>
    <h1>Professor Oak's Pokedex - New Post</h1>
    <section>
        <section>
            <h1><a href="index.php">Home</a></h1>
        </section>

        <ul>
            <li><a href="index.php" class="active">Pokedex</a></li>
            <li><a href="discussion.php">Discussion</a></li>
            <li><a href="createPokemon.php">New Pokemon</a></li>
            <li><a href="createPost.php">New Post</a></li>
        </ul>

        <section>
            <form action="process.php" method="post">
                <fieldset>
                    <legend>New Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input id="title" name="title">
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea rows="16" name="content" id="content" ></textarea>
                    </p>
                    <p>
                        <input type="submit" id="post" value="Post" name="post">
                    </p>
                </fieldset>
            </form>
        </section>
        
        <section>
            <?php date('d,m,y'); ?>
        </section>
    </section>
</body>
</html>