<?php
include('navbar.php');
// Checks if there is a current session set, and if the current session is a guest.
if (!isset($_SESSION) || $_SESSION['username'] == "guest"){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professor Oak's Pokedex - New Post</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .container{
            padding:5%
        }
    </style>
</head>
<body>
<br></br>
<div class="container shadow-lg">
        <form action="process.php" method="post">
            <legend>New Blog Post</legend>
            <div class="form-group row">
                <label for="title" class="col-2 col-form-label">Title</label>
                <div class="col-10">
                    <input name="title" id="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-2 col-form-label">Content</label>
                <div class="col-10">
                    <textarea rows="16" name="content" id="content" class="form-control" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" id="post" name="post" value="Post">
            </div>
        </form>
    </div>
</body>
</html>