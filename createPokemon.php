<?php
//Creates a new blog post.
if (!isset($_SESSION) || $_SESSION['username'] != "admin"){
    header("index.php");
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
    <?php include('navbar.php') ?>

    <section>
        <form action="process.php" method="post">
            <fieldset>
                <legend>New Pokemon</legend>
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
                    <textarea rows="8" name="notes" id="notes"></textarea>
                </p>
                <p>
                    <input type="submit" id="create" name="create" value="Create Pokemon">
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