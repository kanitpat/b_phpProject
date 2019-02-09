<?php

require 'dbconnect.php';

$sql3 = 'SELECT waterLevel
FROM waters
ORDER BY waters.id DESC';
$data1 = null;
$data2 = null;
$data_show = 1;
$result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
while ($row = mysqli_fetch_assoc($result3)) {
    // $input_array = array($row['waterLevel']);
    // print_r(array_chunk($input_array, 2));
    $data1 = $row['waterLevel'];
    if ($data2 == null) {
        $data2 = $data1;
        $data_show = 1;
    } else {
        if ($data1 == $data2) {
            $data_show = 0;
            $data2 = $data1;
        } else {
            $data2 = $data1;
            $data_show = 1;
        }
    }
}
