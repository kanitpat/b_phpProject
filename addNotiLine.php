<?php require 'dbconnect.php';
header('refresh: 10;'); ?>
<?php

$sql_count = 'SELECT  count(*)
 FROM notiline ';
$query_count = mysqli_query($connect, $sql_count, MYSQLI_STORE_RESULT) or die('DIE');
$row = mysqli_fetch_array($query_count);
$count = $row['count(*)'];
$count_old = $count;

//   for ($num = 0; $num <= 10; ++$num) {
//   }

if ((!empty($_GET['sensor'])) && (!empty($_GET['message']))) {
    $sensor = $_GET['sensor'];
    $message = $_GET['message'];

    $waterLevel = 200 - $sensor;
    $sql_page = "INSERT INTO `notiline`(`sensor`, `status_water`, `date`, `time`)
             VALUES
             ( ('$sensor'),('$message'),NOW(),NOW() )";
    $result_page = mysqli_query($connect, $sql_page, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));

    $sql_noti = 'SELECT *
FROM notiline ORDER BY notiline.id DESC limit 3';
    $query_noti = mysqli_query($connect, $sql_noti, MYSQLI_STORE_RESULT) or die('DIE');
    while ($noti = mysqli_fetch_assoc($query_noti)) {
        $sensor = $noti['sensor'];
        $status_water = $noti['status_water'];
        $date = $noti['date'];
        $time = $noti['time'];
        $time = date('g:i a', strtotime($time));
    }
}

      ?>