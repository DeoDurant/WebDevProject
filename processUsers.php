<?php
//Processes the blog posts.
require('connect.php');

//Insert a new user into the site.
if(isset($_POST['Create']))
{
    if ($_POST && isset($_POST['username']) && isset($_POST['email']) 
            && isset($_POST['password']) && isset($_POST['accounttype'])) 
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confpassword = filter_input(INPUT_POST, 'confpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $accounttype = filter_input(INPUT_POST, 'accounttype', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($password != $confpassword){
            header("Location: createUser.php?error=Passwords do not match.");
            exit();
        }

        $query = "INSERT INTO accounts(id, accounttype, username, email, password) VALUES (NULL, :accounttype, :username, :email, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':accounttype', $accounttype);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $passwordHash);

        $statement->execute();
        $statement->fetch();

        header("Location: users.php");
        exit();
    }
}

// UPDATE accounts if username, content and id are present in POST.
if (isset($_POST['Update'])) {
    if ($_POST && isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['accounttype'])){
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $accounttype = filter_input(INPUT_POST, 'accounttype', FILTER_SANITIZE_NUMBER_INT);
        
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "UPDATE accounts SET accounttype = :accounttype, username = :username, email = :email WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':accounttype', $accounttype);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
    
        // Execute the UPDATE.
        $statement->execute();
    
        // Redirect after update.
        header("Location: users.php");
        exit;
    }   
    else if (isset($_GET['id'])) { // Retrieve account to be edited, if id GET parameter is in URL.
        // Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM accounts WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $discussion = $statement->fetch();
    } 
    else {
        $id = false; // False if we are not UPDATING or SELECTING.
        echo 'something went wrong';
    }
}

// DELETE a user
if (isset($_POST['Delete'])){
    if ($_POST && isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email'])){
    
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  
        $query = "DELETE FROM accounts WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
  
        $statement->execute();
        $statement->fetch();

        header("Location: users.php");
        exit;
  }
}

?>