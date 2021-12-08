<?php
    session_start();

    $_SESSION['username'] = "guest";
    $_SESSION['accounttype'] = 3;

    header("Location: index.php");
    exit;
?>