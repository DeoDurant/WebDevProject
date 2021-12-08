<?php
//Processes the blog posts.
require('connect.php');
require('C:\xampp\htdocs\webdev2\project\resizeimg\ImageResize.php');
require('C:\xampp\htdocs\webdev2\project\resizeimg\ImageResizeException.php');

use \Gumlet\ImageResize;

//Safely build a path String that uses slashes appropriate for our OS.
// Default upload path is an 'uploads' sub-folder in the current folder.
function file_upload_path($original_filename, $upload_subfolder_name = 'images')
{
    $current_folder = dirname(__FILE__);

    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

    return join(DIRECTORY_SEPARATOR, $path_segments);
}

//Checks the mime-type & extension of the uploaded file for "image-ness".
function file_is_an_image($temporary_path, $new_path)
{
    $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];

    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type        = mime_content_type($temporary_path);


    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);


    return $file_extension_is_valid && $mime_type_is_valid;
}

$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

//If a user uploads a image file, it will check "image-ness" and if it passes that, it will resize the image to 380x380 pixels.
if ($image_upload_detected) {
    $image_filename        = $_FILES['image']['name'];
    $temporary_image_path  = $_FILES['image']['tmp_name'];
    $new_image_path        = file_upload_path($image_filename);

    if (file_is_an_image($temporary_image_path, $new_image_path)) {
        move_uploaded_file($temporary_image_path, $new_image_path);
        $image = new ImageResize($new_image_path);
        $image->resizeToBestFit(75, 75);
        $image->save($new_image_path);
    }
}

$upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);


// Insert a new pokemon finding into the site.
if (isset($_POST['create'])) {
    if (
        $_POST && isset($_POST['categories']) && isset($_POST['pokename']) && isset($_POST['ability'])&& isset($_POST['typing1'])
        && isset($_POST['ability']) && isset($_POST['notes'])
    ) {
        $image_filename        = $_FILES['image']['name'];
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_NUMBER_INT);
        $pokename = filter_input(INPUT_POST, 'pokename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $typing1 = filter_input(INPUT_POST, 'typing1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $typing2 = filter_input(INPUT_POST, 'typing2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ability = filter_input(INPUT_POST, 'ability', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($_POST['typing2'] == "No Second Typing") {
            $query = "INSERT INTO pokemon(id, category_id, imgname, name, typing, ability, notes, datetime) VALUES (NULL, :category_id, '$image_filename', :pokename, :typing, :ability, :notes, current_timestamp())";
            $statement = $db->prepare($query);
            $statement->bindValue(':category_id', $category);
            $statement->bindValue(':pokename', $pokename);
            $statement->bindValue(':typing', $typing1);
            $statement->bindValue(':ability', $ability);
            $statement->bindValue(':notes', $notes);

            $statement->execute();
            $statement->fetch();

            header("Location: index.php");
            exit();
        } else {
            $fullTyping = $typing1 . "/" . $typing2;
            $query = "INSERT INTO pokemon(id, category_id, imgname, name, typing, ability, notes, datetime) VALUES (NULL, :category_id, '$image_filename', :pokename, :typing, :ability, :notes, current_timestamp())";
            $statement = $db->prepare($query);
            $statement->bindValue(':category_id', $category);
            $statement->bindValue(':pokename', $pokename);
            $statement->bindValue(':typing', $fullTyping);
            $statement->bindValue(':ability', $ability);
            $statement->bindValue(':notes', $notes);

            $statement->execute();
            $statement->fetch();

            header("Location: index.php");
            exit();
        }
    }
}

// Handles the edit and update of a pokemon page.
if (isset($_POST['command'])) {
    if (
        $_POST['command'] === 'Update' && isset($_POST['name']) && isset($_POST['typing1'])
        && isset($_POST['ability']) && isset($_POST['notes'])
    ) {
        $image_filename = $_FILES['image']['name'];
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $pokename = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $typing1 = filter_input(INPUT_POST, 'typing1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $typing2 = filter_input(INPUT_POST, 'typing2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ability = filter_input(INPUT_POST, 'ability', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //delete image
        if (isset($_POST['deleteImg'])) {
            $delete_imageQuery = "UPDATE pokemon SET imgname = NULL WHERE id = :id";
            $statement = $db->prepare($delete_imageQuery);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
        }

        if ($_POST['typing2'] == "No Second Typing") {
            if ($_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/png") {
                // $query = "UPDATE pokemon SET imgname = :imgname WHERE id = :id";

                $query = "UPDATE pokemon SET imgname = :imgname, name = :pokename, typing = :typing, ability = :ability, notes = :notes, datetime = current_timestamp() WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->bindValue(":imgname", $image_filename);
                $statement->bindValue(':pokename', $pokename);
                $statement->bindValue(':typing', $typing1);
                $statement->bindValue(':ability', $ability);
                $statement->bindValue(':notes', $notes);

                $statement->execute();

                header("Location: index.php");
                exit;
            }
            else{
                $query = "UPDATE pokemon SET name = :pokename, typing = :typing, ability = :ability, notes = :notes, datetime = current_timestamp() WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->bindValue(':pokename', $pokename);
                $statement->bindValue(':typing', $typing1);
                $statement->bindValue(':ability', $ability);
                $statement->bindValue(':notes', $notes);

                $statement->execute();

                header("Location: index.php");
                exit;
            }
        } else {
            if ($_FILES['image']['type'] == "image/jpg" || $_FILES['image']['type'] == "image/jpeg" || $_FILES['image']['type'] == "image/png") {
                $fullTyping = $typing1 . "/" . $typing2;
                $query = "UPDATE pokemon SET imgname = :imgname, name = :pokename, typing = :typing, ability = :ability, notes = :notes, datetime = current_timestamp() WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->bindValue(":imgname", $image_filename);
                $statement->bindValue(':pokename', $pokename);
                $statement->bindValue(':typing', $fullTyping);
                $statement->bindValue(':ability', $ability);
                $statement->bindValue(':notes', $notes);

                $statement->execute();

                header("Location: index.php");
                exit;
            }
            else{
                $fullTyping = $typing1 . "/" . $typing2;
                $query = "UPDATE pokemon SET name = :pokename, typing = :typing, ability = :ability, notes = :notes, datetime = current_timestamp() WHERE id = :id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->bindValue(':pokename', $pokename);
                $statement->bindValue(':typing', $fullTyping);
                $statement->bindValue(':ability', $ability);
                $statement->bindValue(':notes', $notes);

                $statement->execute();

                header("Location: index.php");
                exit;
            }
        }
    }

    // Deletes a pokemon.
    elseif ($_POST['command'] === "Delete") {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query = "DELETE FROM pokemon WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);

        $statement->execute();

        header("Location: index.php");
        exit;
    }
}

// Insert for discussions table.
if (isset($_POST['post'])) {

    if ($_POST && isset($_POST['title']) && isset($_POST['content'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($title) || empty($content)) {
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
if (isset($_POST['Update'])) {
    if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])) {
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
    } else if (isset($_GET['id'])) { // Retrieve quote to be edited, if id GET parameter is in URL.
        // Sanitize the id. Like above but this time from INPUT_GET.
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Build the parametrized SQL query using the filtered id.
        $query = "SELECT * FROM discussion WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        // Execute the SELECT and fetch the single row returned.
        $statement->execute();
        $discussion = $statement->fetch();
    } else {
        $id = false; // False if we are not UPDATING or SELECTING.
    }
}

// DELETE a discussion post
if (isset($_POST['Delete'])) {
    if ($_POST && isset($_POST['id']) && isset($_POST['content']) && isset($_POST['title'])) {

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
