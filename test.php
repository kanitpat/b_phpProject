<?php

$url = 'http://api.openweathermap.org/data/2.5/forecast?id=524901&APPID={e57524765633f174a1bb9f7171ed0dc9}';
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $xml = curl_exec($ch);
     curl_close($ch);
     if ($xml != '') {
         $xml_return = simplexml_load_string($xml);
         $coord = $xml_return->coord;
         $weather = $xml_return->weather;
     }
     $xml_return = simplexml_load_string($xml);
     $coord = $xml_return->coord;
     $weather = $xml_return->weather;

// //  Initiate curl
// $ch = curl_init();
// // Disable SSL verification
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// // Will return the response, if false it print the response
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// // Set the url
// curl_setopt($ch, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/forecast?id=524901&APPID=e57524765633f174a1bb9f7171ed0dc9');
// // Execute
// $result = curl_exec($ch);
// // Closing
// curl_close($ch);
// // แปลงข้อมูลที่รับมาในรูป json มาเป็น array จะได้ใช้ง่าย ๆ
// $DATA = json_decode($result, true);
// // //dump ข้อมูลออกมาดู
// print_r($DATA);
// // ลองดึงออกทีล่ะค่า
// echo '<hr>';
// echo $DATA['cod']; echo '<br>';
// echo $DATA['message']; echo '<br>';
