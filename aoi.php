<?php


  $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/forecast?id=1606588&APPID=74a0529397f187dc4b6c0086aed3e3a1');
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result, true);

$i = 0;
$datetoday = date('Y-m-d');
// echo $datetoday;
foreach ($obj['list'] as $key) {
    foreach ($key as $keys => $val) {
        switch ($keys) {
                                        case 'dt_txt':
                                                                                $datesub = substr($val, 0, -9);
                                                                                // echo 	$datesub;
                    if ($datesub == $datetoday) {
                        //   echo 'd';

                        if ($keys == 'rain') {
                            if (empty($val)) {
                                //if ($keys as $kk => $vl){
                                echo "$val empty  <br/>";
                            } else {
                                foreach ($val as $val2) {
                                    echo 'Show '.$val2.'<br/>';
                                }
                            }
                        } else {
                            echo 'rain no';
                        }
                    } else {
                        echo 'no';
                    }

break;
//         case 'rain':

//         //$val = trim($val);
// if (empty($val)) {
//     //if ($keys as $kk => $vl){
//     echo "$val empty  <br/>";
// } else {
//     foreach ($val as $val2) {
//         echo 'Show '.$val2.'<br/>';
//     }
// }

//                 break;
    }
    }
}
