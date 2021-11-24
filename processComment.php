<?php
session_start();
require("connect.php");
$currentUser = $_SESSION['username'];
$datetime = date("Y-m-d H:i:s");

if (isset($_POST['submit'])) {
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $commentPostID = $_POST['post_id'];
    $queryComment = "INSERT INTO comments (user, comment, post_id, datetime) VALUES ('$currentUser', '$comment', '$commentPostID', '$datetime')";
    $commentStatement = $db->prepare($queryComment);
    $commentStatement->execute();
    header("Location: showPost.php?id=" . $_POST['post_id'] . "");
} 
elseif (isset($_POST['Delete'])) {
    $hiddenPostId = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $commentID = $_POST['id'];
    $commentDelete = "DELETE FROM comments WHERE id = " . $commentID;
    $deleteStatement = $db->prepare($commentDelete);
    $deleteStatement->execute();
    header('Location: showPost.php?id=' . $hiddenPostId);
}
