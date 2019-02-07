<?php

session_start();
require 'dbconnect.php';
//     $userid = $_SESSION['userid'];

// if (!empty($_GET['status'])) {
//     $status = $_GET['status'];
//     if ($status == 0) {
//         $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`)
//         VALUES ( '$status','ปิด',NOW(),NOW(),'$userid')";
//         $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
//     } else {
//         $sql = "INSERT INTO `statuses`(`numstatus`, `detail`,`date`, `time`, `idUser`)
//         VALUES
//         ( ('$status'),'เปิด',NOW(),NOW(),'$userid')";
//         $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
//     }
// }
if (!empty($_GET['status']) && !empty($_GET['iduser'])) {
    $status = $_GET['status'];
    $iduser = $_GET['iduser'];

    if (($status == 1) && ($iduser == 5)) {
        // echo 'เข้า';
        // $newiduser = 0;
        $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
        VALUES ( '$status','เปิด',NOW(),NOW(),'$newiduser')";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
        echo  $result_page;
    }
    if (($status == 2) && ($iduser == 5)) {//ปิด
        // echo 'เข้า';
        // $status = 0;
        $newiduser = 0;
        $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','ปิด',NOW(),NOW(),'$newiduser')";
        $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
        echo  $result_page;
    }
}
