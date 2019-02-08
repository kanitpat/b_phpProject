<?php

require 'dbconnect.php';

    $userid = $_SESSION['userid'];
    // echo $userid;

    if (!empty($_GET['status']) && !empty($_GET['iduser'])) {
        $status = $_GET['status'];
        $iduser = $_GET['iduser'];

        if (($status == 1) && ($iduser == 5)) {
            // echo 'เข้า';
            // $newiduser = 0;
            $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
        VALUES ( '$status','เปิด',NOW(),NOW(),'$newiduser')";
            $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
            // echo  $result_page;
        }
        if (($status == 2) && ($iduser == 5)) {//ปิด
            // echo 'เข้า';
            // $status = 0;
            $status = 0;
            $newiduser = 0;
            $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','ปิด',NOW(),NOW(),'$newiduser')";
            $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
            // echo  $result_page;
        }
        if (($status == 1) && ($iduser == 8)) {//ปิด
            // echo 'เข้า';
            // $status = 0;
            $sql = "INSERT INTO `statuses`( `numstatus`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','เปิด',NOW(),NOW(),'$userid')";
            $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
            // echo  $result_page;
        }
        //to process
        // $sql_stautus = 'SELECT * DISTINCT
        // FROM `process_statuses`';
        // $result_sql_stautus = mysqli_query($connect, $sql_stautus, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    }
    $sql2 = 'SELECT *
    FROM process_statuses
     JOIN users ON process_statuses.idUsers = users.id
     JOIN pumps ON process_statuses.idPumps = pumps.id 
     JOIN statuses ON process_statuses.idStatus = statuses.id 
     JOIN waters ON process_statuses.idWaters = waters.id ORDER BY process_statuses.id DESC';
