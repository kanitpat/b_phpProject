<?php
    session_start();
    unset ( $_SESSION['u_username'] );
    unset ( $_SESSION['u_id'] );
    session_destroy();
    header("location:login.php");

?>