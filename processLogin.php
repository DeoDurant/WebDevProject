<?php
require('connect.php');
session_start();

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$confpassword = filter_input(INPUT_POST, 'confpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

if (isset($_POST['submit']) == "register") {
    if ($_POST && isset($_POST['username']) && isset($_POST['email'])
        && isset($_POST['password']) && isset($_POST['confpassword'])
    ) {
        
        if ($password != $confpassword){
            header("Location: register.php?error=Passwords do not match.");
            exit();
        }
        
        $query = "INSERT INTO accounts(id, username, email, password) VALUES (NULL, :username, :email, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $passwordHash);

        $statement->execute();
        $statement->fetch();

        header("Location: login.php");
        exit();
    }
}

if (isset($_POST['submit']) == "login") {
    if ($_POST && isset($_POST['username']) && isset($_POST['password']))
    {
        $query = "SELECT * FROM accounts";
        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();

        //Determine the currently targeted user based off of the username.
        foreach($users as $user) :
            if($user['username'] == $username) {
                $selectedUser = $user;
            }
        endforeach;

        foreach($users as $user) :
            if($selectedUser['username'] == $username && password_verify($password, $selectedUser['password'])) {
                $_SESSION['username'] = $selectedUser['username'];

                //If username and password is correct send user to the index page.
                header("Location: index.php");
                exit();
            }
            else
            {
                //If username and password is incorrect send user back to login page.
                header("Location: login.php?error=Incorrect username or password.");
                exit();
            }
        endforeach;
    }
}
?>
