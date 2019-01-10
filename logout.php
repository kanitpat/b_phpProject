<?php
    session_start();
    unset($_SESSION['userid']);
    unset($_SESSION['email']);
    unset($_SESSION['Status']);

    session_destroy();
    header('location:login.php');
