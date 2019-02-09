<?php

require 'dbconnect.php';

// $sql3 = 'SELECT waterLevel
// FROM waters
// ORDER BY waters.id DESC';

$sql3 = 'SELECT num
FROM test
ORDER BY test.id DESC';
$data1 = null;
$data2 = null;
$data_show = 1;
$result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
while ($row = mysqli_fetch_assoc($result3)) {
    // $input_array = array($row['waterLevel']);
    // print_r(array_chunk($input_array, 2));
    $data1 = $row['num'];
    if ($data2 == null) {
        $data2 = $data1;
        echo ' if ($data2 == null) คือ ';
        echo '<br>'.'$data2 = '.$data2;
        echo '<br>'.'$data1 = '.$data1;
    // $data_show = 1;
    } else {
        $total = $data2 - $data1;

        echo '<br>'.'********$data1 = '.$data1;
        echo '<br>'.'********$data2 = '.$data2;
        echo '<br>'.'------///$total = '.$total;
        $data2 = $data1;
        echo '<br>'.'****^^^^^^^****new$data1 = '.$data1;
        echo '<br>'.'****^^^^^^^****new$data2 = '.$data2;
        if ($total >= 40) {
            echo '<br>'.'<br>'.'ผิดปกติ ';

            $strsql = "INSERT INTO  `save`( `total`, `detail`)
            VALUES
            ('$total','ผิดปกติ')";

            $result_test = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die('Query error');
        //     $data2 = $data1;
        //     echo '$data2 = '.$data2;
        //     echo '$data1 = '.$data1;
        } else {
            echo '<br>'.'<br>'.'ปกติ ';
            $strsql = "INSERT INTO  `save`( `total`, `detail`)
            VALUES
            ('$total','ปกติ')";

            $result_test = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die('Query error');
        }
        //     // else {
    //     //     $data2 = $data1;
    //     //     echo '$data2 = '.$data2;
    //     //     echo '$data1 = '.$data1;

    //     //     // $data_show = 1;
    //     // }
    }
}
