<?php
include('navbar.php');
// Checks if there is no current session set, and if the current sessions username is not admin.
if (!isset($_SESSION) || $_SESSION['accounttype'] != 0) {
    header("Location: index.php");
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
    <div class="container">
        <!-- Content here -->
        <form action="processUsers.php" method="post">
            <legend>Add Users</legend>
            <div class="form-group row">
                <label for="username" class="col-2 col-form-label">Username</label>
                <div class="col-10">
                    <input name="username" id="username" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input name="email" id="email" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-2 col-form-label">Password</label>
                <div class="col-10">
                    <input name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="confpassword" class="col-2 col-form-label">Confirm Password</label>
                <div class="col-10">
                    <input name="confpassword" id="confpassword" class="form-control" required>
                </div>
            </div>
            <?php if (isset($_GET['error'])) : ?>
                <div class="form-group alert alert-danger"><?php echo $_GET['error'] ?></div>
            <?php endif ?>
            <div class="form-group row">
                <select name="accounttype" class="custom-select">
                    <option value=0>Administrator</option>
                    <option value=1>Regular User</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" id="create" name="Create" value="Create">
            </div>
        </form>
    </div>
</body>

</html>