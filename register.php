<?php
// include('connect.php');

// if (isset($_POST['submit'])) {
//     if ($_POST && isset($_POST['username']) && isset($_POST['email'])
//         && isset($_POST['password']) && isset($_POST['confpassword'])
//     ) {
//         $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
//         $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $confpassword = filter_input(INPUT_POST, 'confpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         if ($password != $confpassword){
//             exit("Passwords do not match!"); 
//         }
//         $passwordHash = password_hash($password, PASSWORD_DEFAULT);
//         $query = "INSERT INTO accounts(id, username, email, password) VALUES (NULL, :username, :email, :password)";
//         $statement = $db->prepare($query);
//         $statement->bindValue(':username', $username);
//         $statement->bindValue(':email', $email);
//         $statement->bindValue(':password', $passwordHash);

//         $statement->execute();
//         $statement->fetch();

//         header("Location: login.php");
//         exit;
//     }
// }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Oak's Pokedex - Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="loginstyles.css">
    
</head>

<body>
    <div class="container">
        <form action="processLogin.php" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="confpassword" required>
            </div>
            <?php if (isset($_GET['error'])):?>
                <div class="input-group error"><?php echo $_GET['error']?></div>
            <?php endif ?>
            <p></p>
            <div class="input-group">
                <button name="submit" value="register" class="btn">Register</button>
            </div>
            <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
            <p class="login-register-text">Want to sign in as a guest? <a href="guestlogin.php">Guest Login</a></p>
        </form>
    </div>
</body>

</html>