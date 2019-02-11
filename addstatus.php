<?php

require 'dbconnect.php';

    $userid = $_SESSION['userid'];
    // echo $userid;

    if (!empty($_GET['status']) && !empty($_GET['iduser']) && !empty($_GET['level'])) {
        $status = $_GET['status'];
        $iduser = $_GET['iduser'];
        $water_level = $_GET['level'];
        $water_level = 200 - $water_level;

        if ($water_level <= 0) {
            $water_level = 0;
            if (($status == 1) && ($iduser == 5)) {//เปิด auto
                // echo 'เข้า';
                $newiduser = 65;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
        VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$newiduser')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 2) && ($iduser == 5)) {//ปิดauto
                // echo 'เข้า';
                // $status = 0;
                $status = 0;
                $newiduser = 65;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','ปิด',NOW(),NOW(),'$newiduser')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 1) && ($iduser == 8)) {//เปิด
                // echo 'เข้า';
                // $status = 0;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$userid')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 2) && ($iduser == 8)) {//ปิด
                // echo 'เข้า';
                // $status = 0;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$userid')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            //to process
        // $sql_stautus = 'SELECT * DISTINCT
        // FROM `process_statuses`';
        // $result_sql_stautus = mysqli_query($connect, $sql_stautus, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
        } else {
            if (($status == 1) && ($iduser == 5)) {//เปิดauto
                // echo 'เข้า';
                $newiduser = 65;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
        VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$newiduser')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 2) && ($iduser == 5)) {//ปิดauto
                // echo 'เข้า';
                // $status = 0;
                $status = 0;
                $newiduser = 65;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','ปิด',NOW(),NOW(),'$newiduser')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 1) && ($iduser == 8)) {//เปิด
                // echo 'เข้า';
                // $status = 0;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$userid')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
            if (($status == 2) && ($iduser == 8)) {//ปิด
                // echo 'เข้า';
                // $status = 0;
                $sql = "INSERT INTO `statuses`( `numstatus`,`waterLevel`, `detail`,`date`, `time`, `idUser`) 
         VALUES ( '$status','$water_level','เปิด',NOW(),NOW(),'$userid')";
                $result_page = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo  $result_page;
            }
        }
    }
