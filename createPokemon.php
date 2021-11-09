<?php
//Creates a new blog post.
require 'authenticate.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - New Pokemon</title>

</head>
<body>
    <h1>Professor Oak's Pokedex - New Pokemon</h1>
    <section>
        <section>
            <h1><a href="index.php">Home</a></h1>
        </section>

        <ul>
            <li><a href="index.php" class="active">Pokedex</a></li>
            <li><a href="createPokemon.php">New Post</a></li>
        </ul>

        <section>
            <form action="process.php" method="post">
                <fieldset>
                <p>
                    <label for="pokename">Name of the Pokemon: </label>
                    <input name="pokename" id="pokename">
                </p>
                <p>
                    <label for="typing">Projected typing: </label>
                    <input name="typing" id="typing"></input>
                </p>
                <p>
                    <label for="ability">Projected ability: </label>
                    <input name="ability" id="ability"></input>
                </p>
                <p>
                    <label for="notes">Notes: </label>
                    <textarea name="notes" id="notes"></textarea>
                </p>
                <p>
                    <input type="submit" id="submit" name="Submit" value="Submit">
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