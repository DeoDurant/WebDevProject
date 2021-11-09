<?php
//Processes the blog posts.
require('connect.php');

// Insert a new pokemon finding into the site.
if(isset($_POST['Submit']))
{
    if ($_POST && isset($_POST['pokename']) && isset($_POST['typing']) 
            && isset($_POST['ability']) && isset($_POST['notes'])) 
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $pokename = filter_input(INPUT_POST, 'pokename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $typing = filter_input(INPUT_POST, 'typing', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ability = filter_input(INPUT_POST, 'ability', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(empty($pokename) || empty($typing) || empty($ability) || empty($notes))
        {
            $error = true;
        }
        $query = "INSERT INTO pokemon(id, name, typing, ability, notes, datetime) VALUES (NULL, :pokename, :typing, :ability, :notes, current_timestamp())";
        $statement = $db->prepare($query);
        $statement->bindValue(':pokename', $pokename);
        $statement->bindValue(':typing', $typing);
        $statement->bindValue(':ability', $ability);
        $statement->bindValue(':notes', $notes);

        $statement->execute();
        $statement->fetch();

        header("Location: index.php");
        exit;
    }
}
    // if($_POST['command'] === "Update")
    // {
    // if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])) 
    // {
    //     $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    //     $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      
    //     $query = "UPDATE blog SET content = :content, title = :title WHERE id = :id";
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':content', $content);
    //     $statement->bindValue(':title', $title);
    //     $statement->bindValue(':id', $id, PDO::PARAM_INT);
      
    //     $statement->execute();

    //     header("Location: homepage.php");
    //     exit;
    //   } 
    //   else if (isset($_GET['id'])) 
    //   {
    //     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      
    //     $query = "SELECT * FROM blog WHERE id = :id";
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':id', $id, PDO::PARAM_INT);
      
    //     $statement->execute();
    //     $blog = $statement->fetch();
    //   } 
    //   else 
    //   {
    //     $id = false;
    //   }
    // }
    //   if($_POST['command'] === "Delete")
    //   {
    //   if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])) 
    //   {
    //     $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      
    //     $query = "DELETE FROM blog WHERE id = :id";
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':id', $id);
      
    //     $statement->execute();
    //     $statement->fetch();

    //     header("Location: homepage.php");
    //     exit;
    //   }
    // }

?>