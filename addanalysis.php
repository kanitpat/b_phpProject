<?php

$strsql11 = 'SELECT *
FROM analysis
WHERE start_date = start_date';
            $result_strsql = mysqli_query($connect, $strsql11, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
            if ((mysqli_num_rows($result_strsql) >= 1)) {
                // echo '<br>'.'----------------ซ้ำ----------------';

                $sql3 = 'TRUNCATE analysis';
                $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
                $sql3 = 'SELECT *
                FROM waters
                ORDER BY waters.id ASC';
                $data1 = null;
                $data2 = null;
                $data_date1 = null;
                $data_date2 = null;
                $data_time1 = null;
                $data_time2 = null;
                $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
                while ($row = mysqli_fetch_assoc($result3)) {
                    // $input_array = array($row['waterLevel']);
                    // print_r(array_chunk($input_array, 2));
                    $data1 = $row['waterLevel'];
                    $data_date1 = $row['date'];
                    $data_time1 = $row['time'];

                    if ($data2 == null) {
                        $data2 = $data1;
                        $data_date2 = $data_date1;
                        $data_time2 = $data_time1;

                    // echo ' if ($data2 == null) คือ ';
                        // echo '<br>'.'$data2 = '.$data2;
                        // echo '<br>'.'$data1 = '.$data1;
                        // echo '<br>'.'$data_date2 = '.$data_date2;
                        // echo '<br>'.'$data_date1 = '.$data_date1;
                        // echo '<br>'.'$data_time2 = '.$data_time2;
                        // echo '<br>'.'$data_time1 = '.$data_time1;
                    // $data_show = 1;
                    } else {
                        //data2 คอลัมก่อนหน้า data1 คอลัมถัดไป
                        $total = $data2 - $data1;

                        // echo '<br>'.'********$data1 = '.$data1;
                        // echo '<br>'.'********$data2 = '.$data2;

                        // echo '<br>'.'********$data_date1 = '.$data_date1;
                        // echo '<br>'.'********$data_date2 = '.$data_date2;
                        // echo '<br>'.'********$data_time1 = '.$data_time1;
                        // echo '<br>'.'********$data_time2 = '.$data_time2;
                        // echo '<br>'.'------///$total = '.$total;
                        $data2 = $data1;
                        $data_date2 = $data_date1;
                        $data_time2 = $data_time1;

                        // echo '<br>'.'****^^^^^^^****new$data1 = '.$data1;
                        // echo '<br>'.'****^^^^^^^****new$data2 = '.$data2;
                        // echo '<br>'.'****^^^^^^^****new$data_date1 = '.$data_time1;
                        // echo '<br>'.'****^^^^^^^****new$data_date2 = '.$data_time2;
                        // echo '<br>'.'****^^^^^^^****new$data_time1 = '.$data_time1;
                        // echo '<br>'.'****^^^^^^^****new$data_time2 = '.$data_time2;
                        if ($total >= 40) {
                            // echo mysqli_num_rows($result_strsql);
                            // echo '    yes     ';
                            $strsql = "INSERT INTO  `analysis`( `total`,`misstake`, `start_date`,`end_date`,`start_time`, `end_time`)
                VALUES
                ('$total','ระดับน้ำผิดปกติ','$data_date2','$data_date1','$data_time2','$data_time1')";

                            $result_test = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                        }
                    }
                }
            } else {
                $sql3 = 'SELECT *
                FROM waters
                ORDER BY waters.id ASC';
                $data1 = null;
                $data2 = null;
                $data_date1 = null;
                $data_date2 = null;
                $data_time1 = null;
                $data_time2 = null;
                $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
                while ($row = mysqli_fetch_assoc($result3)) {
                    // $input_array = array($row['waterLevel']);
                    // print_r(array_chunk($input_array, 2));
                    $data1 = $row['waterLevel'];
                    $data_date1 = $row['date'];
                    $data_time1 = $row['time'];

                    if ($data2 == null) {
                        $data2 = $data1;
                        $data_date2 = $data_date1;
                        $data_time2 = $data_time1;

                    // echo ' if ($data2 == null) คือ ';
                        // echo '<br>'.'$data2 = '.$data2;
                        // echo '<br>'.'$data1 = '.$data1;
                        // echo '<br>'.'$data_date2 = '.$data_date2;
                        // echo '<br>'.'$data_date1 = '.$data_date1;
                        // echo '<br>'.'$data_time2 = '.$data_time2;
                        // echo '<br>'.'$data_time1 = '.$data_time1;
                    // $data_show = 1;
                    } else {
                        //data2 คอลัมก่อนหน้า data1 คอลัมถัดไป
                        $total = $data2 - $data1;

                        // echo '<br>'.'********$data1 = '.$data1;
                        // echo '<br>'.'********$data2 = '.$data2;

                        // echo '<br>'.'********$data_date1 = '.$data_date1;
                        // echo '<br>'.'********$data_date2 = '.$data_date2;
                        // echo '<br>'.'********$data_time1 = '.$data_time1;
                        // echo '<br>'.'********$data_time2 = '.$data_time2;
                        // echo '<br>'.'------///$total = '.$total;
                        $data2 = $data1;
                        $data_date2 = $data_date1;
                        $data_time2 = $data_time1;

                        // echo '<br>'.'****^^^^^^^****new$data1 = '.$data1;
                        // echo '<br>'.'****^^^^^^^****new$data2 = '.$data2;
                        // echo '<br>'.'****^^^^^^^****new$data_date1 = '.$data_time1;
                        // echo '<br>'.'****^^^^^^^****new$data_date2 = '.$data_time2;
                        // echo '<br>'.'****^^^^^^^****new$data_time1 = '.$data_time1;
                        // echo '<br>'.'****^^^^^^^****new$data_time2 = '.$data_time2;
                        if ($total >= 40) {
                            // echo '<br>'.'<br>'.'ผิดปกติ ';

                            // $strsql11 = 'SELECT *
                            // FROM analysis
                            // WHERE start_date = start_date';

                            // "INSERT INTO  `analysis`( `misstake`, `start_date`, `end_date`,`start_time`, `end_time`)
                            // VALUES
                            // ('$total','ระดับน้ำผิดปกติ','$data_date2','$data_date1','$data_time2','$data_time1')";

                            // $result_strsql = mysqli_query($connect, $strsql11, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                            // while ($row = mysqli_fetch_assoc($result_strsql)) {
                            // echo $row['total'];
                            // if ((mysqli_num_rows($result_strsql) >= 1)) {
                            //     echo '     no     ';
                            // } else {
                            // echo mysqli_num_rows($result_strsql);
                            // echo '    yes     ';
                            $strsql = "INSERT INTO  `analysis`( `total`,`misstake`, `start_date`,`end_date`,`start_time`, `end_time`)
                VALUES
                ('$total','ระดับน้ำผิดปกติ','$data_date2','$data_date1','$data_time2','$data_time1')";

                            $result_test = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                        // }
            // }

            //     $data2 = $data1;
        //     echo '$data2 = '.$data2;
        //     echo '$data1 = '.$data1;
                        } else {
                        }
                    }
                }
            }
