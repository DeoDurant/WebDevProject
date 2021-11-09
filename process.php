<?php
//Processes the blog posts.
require('connect.php');

// Insert a new pokemon finding into the site.
if(isset($_POST['create']))
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

// Insert for discussions table.
if(isset($_POST['post'])){

    if ($_POST && isset($_POST['title']) && isset($_POST['content'])) 
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(empty($title) || empty($content))
        {
            $error = true;
        }
        $query = "INSERT INTO discussion (id, title, content, datetime) VALUES (NULL, :title, :content, current_timestamp())";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);

        $statement->execute();
        $statement->fetch();

        header("Location: discussion.php");
        exit;
    }
}

// UPDATE discussion if author, content and id are present in POST.
if (isset($_POST['Edit'])) {
    if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])){
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "UPDATE discussion SET title = :title, content = :content WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Execute the INSERT.
        $statement->execute();
    
        // Redirect after update.
        header("Location: discussion.php");
        exit;
    }   
    else if (isset($_GET['id'])) { // Retrieve quote to be edited, if id GET parameter is in URL.
        // Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM discussion WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $discussion = $statement->fetch();
    } 
    else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }
}

// DELETE a discussion post
if (isset($_POST['Delete'])){
    if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])){
    
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  
        $query = "DELETE FROM discussion WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
  
        $statement->execute();
        $statement->fetch();

        header("Location: discussion.php");
        exit;
  }

}

?>