<?php


$result = mysqli_query($connect, $query);
$resultchart = mysqli_query($connect, $query);
$waters = $waters['waterLevel'];

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

?>
<div class="row">
<div class="col-6 col-md-4">
  <div class="card  o-hidden h-100">
  <div class="card-body">ทำนายปริมาณฝนกับระดับน้ำในสวน
  <?php
foreach ($obj['list'] as $key) {
    foreach ($key as $keys => $val) {
        switch ($keys) {
        case 'dt_txt':
        $timesub = substr($val, 11, 11);
        $datesub = substr($val, 0, -9);
        // echo 	$datesub;

                    if ($datesub == $datetoday) {
                        echo '<br>'.$datesub;
                        $valarrytime[] = $timesub;

                        // echo 	 $timesub;
                        foreach ($key as $keys => $val) {
                            switch ($keys) {
                                    case 'rain':
                                    if (empty($val)) {
                                        //  echo "$val empty  <br/>";
                                        // $valarry[] = $val;
                                    } else {
                                        foreach ($val as $val2) {
                                            //  echo 'Show '.$val2.'<br/>';
                                            // $valarry[] = $val2;
                                            if ($val2 <= 10.0) {
                                                echo '<br>'.'ฝนเล็กน้อย'.'ปริมาณฝนอยู่ที่ : '.$val2.' มิลลิเมตร';
                                                if ($waters <= 50) {
                                                    echo '<br>'.'ระดับน้ำในสวนตอนนี้เสี่ยงน้ำแห้ง';
                                                }
                                            }
                                            if (($val2 >= 10.1) && ($val2 <= 35.0)) {
                                                echo '<br>'.'ฝนปานกลาง'.'ปริมาณฝนอยู่ที่ : '.$val2.' มิลลิเมตร';
                                            }
                                            if (($val2 >= 35.1) && ($val2 <= 90.0)) {
                                                echo '<br>'.'ฝนหนัก'.'ปริมาณฝนอยู่ที่ : '.$val2.' มิลลิเมตร';
                                                if ($waters >= 170) {
                                                    echo '<br>'.'ระดับน้ำในสวนตอนนี้เสี่ยงน้ำท่วม';
                                                }
                                            }
                                            if ($val2 >= 90.1) {
                                                echo '<br>'.'ฝนหนักมาก'.'ปริมาณฝนอยู่ที่ : '.$val2.' มิลลิเมตร';
                                                if ($waters >= 150) {
                                                    echo '<br>'.'ระดับน้ำในสวนตอนนี้เสี่ยงน้ำท่วม';
                                                }
                                            }
                                        }
                                    }
                                    break;
                                }
                        }
                    }

    break;
        }
    }
}

?>


      </div>
</div>
</div>