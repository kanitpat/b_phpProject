<?php

require 'dbconnect.php';

    $status = $_GET['status'];
    if ($status == 0) {
        $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`) 
        VALUES ( '$status','ปิด',NOW(),NOW())";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    } else {
        $sql = "INSERT INTO `statuses`(`numstatus`, `detail`,`date`, `time`)
        VALUES
        ( ('$status'),'ปิด',NOW(),NOW())";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    }
