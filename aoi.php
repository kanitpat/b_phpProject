<?php


  $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/forecast?id=1606588&APPID=74a0529397f187dc4b6c0086aed3e3a1');
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result, true);
//echo $obj->{'cod'}; // 200

    echo $obj['cod'].','.
     $obj['city']['name'].', '.
            $obj['city']['id'].', ---- ';

//}

// echo $obj['name']; echo "<br>";
// echo $DATA['FNAME']; echo "<br>";
//echo $obj->['city'][0]['name']; // 200
