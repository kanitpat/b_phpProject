<?php

require 'dbconnect.php';
if (!empty($_GET['level'])) {
    $page = $_GET['level'];
    $waterLevel = 200 - $page;
    if ($waterLevel <= 0) {
        $waterLevel = 0;
        $sql_page = "INSERT INTO `waters`(`waterLevel`, `sensor_duration`, `date`, `time`) 
             VALUES    
             ( ('$waterLevel'),('$page'),NOW(),NOW() )";

        $result_page = mysqli_query($connect, $sql_page, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    // $waters = mysqli_fetch_assoc($result_page);
    } else {
        $sql_page = "INSERT INTO `waters`(`waterLevel`, `sensor_duration`, `date`, `time`) 
        VALUES    
        ( ('$waterLevel'),('$page'),NOW(),NOW() )";

        $result_page = mysqli_query($connect, $sql_page, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
        // $waters = mysqli_fetch_assoc($result_page);
    }
}
