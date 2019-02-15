<?php


  $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/forecast?id=1606588&APPID=74a0529397f187dc4b6c0086aed3e3a1');
$result = curl_exec($ch);
curl_close($ch);

$obj = json_decode($result, true);

// $json = '{"1":"a","2":"b","3":"c","4":"d","5":"e"}';
//  $obj = json_decode($json, true);

// foreach ($obj as $key => $value) {
//     echo 'Your key is: '.$key.' and the value of the key is:'.$value;
// }

// foreach ($obj as $key => $value) {
//     $i = 0;
//     if (in_array($key, array('list'))) {
        // echo $key.['$i'].$obj['rain'];
        // ++$i;
  // /  }

    // foreach ($row as $row2) {
    //     foreach ($row2 as $row3) {
    //         foreach ($row3 as $key => $value) {
    //             echo 'Your key is: '.$key.' and the value of the key is:'.$value;
    //         }
    //     }
    // }
// }
    //  foreach ($row as $obj['list'] => $value) {

    // foreach ($row3 as $key => $value) {
        //     echo 'Your key is: '.$key.' and the value of the key is:'.$value;
        // }

//var_dump($obj);
// echo $obj->{'cod'}; // 200

    //echo $obj['cod'].','.

  //  print_r($obj);        // Dump all data of the Array
  //echo $obj['list'][0]['dt'];

  //echo var_dump(count($obj['list'][0]['rain']));

  for ($i = 0; $i < count($obj['list']); ++$i) {
      // if ($obj['list'][$i]['rain'] == 0) {

      //     echo 'NULLShow';
      // } else {
      $information = array();

      $information[] = '"'.$obj['list'][$i]['rain'].'"';

      $string = var_dump($obj['list'][$i]['rain']);
      $information = implode(',', $information);
      echo implode(' ', $information);

      // echo implode(' ', $string);

      // }
  }

    //  $obj['city']['name'].', '.
    //  $obj['list']['17']['rain']['3h'].', '.

    //   $obj['city']['id'].', ---- ';

    //             // // echo $obj['list'][$i]['rain']['3h'];
    //             // $rain = $obj['list'][18]['rain']['3h'];
    //             $date = $obj['list'][17]['dt_txt'];

    //             //     echo $rain;
    //                 echo $date;
    //                 if (array_key_exists('rain', $obj)) {
    //                     echo 'ee';
    //                 }
//}

// echo $obj['name']; echo "<br>";
// echo $DATA['FNAME']; echo "<br>";
//echo $obj->['city'][0]['name']; // 200
