<?php
    include 'class/class-autoload.class.php';
    session_start();
    $admin = new Admin();
    $admin->delete($_SESSION['reg']);
    header("Location: adminpage.php");
?>