<?php

session_start();

require 'dbconnect.php';
$userid = $_SESSION['userid'];

if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 0) {
        $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
        VALUES ( '$status','ปิด',NOW(),NOW(),'$userid')";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    } else {
        $sql = "INSERT INTO `statuses`(`numstatus`, `detail`,`date`, `time`, `idUser`)
        VALUES
        ( ('$status'),'ปิด',NOW(),NOW(),'$userid')";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    }
}
