<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<script>alert('Logged Out Successfully!!')</script>";
    header('refresh:0;url=login.php');
    die('');
?>