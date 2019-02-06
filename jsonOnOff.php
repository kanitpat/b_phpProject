<?php

require 'dbconnect.php';

$sql2 = 'SELECT `numstatus`
FROM statuses
ORDER BY `statuses`.`id` DESC limit 1';
$query = mysqli_query($connect, $sql2, MYSQLI_STORE_RESULT) or die('Query error');
$result = mysqli_fetch_assoc($query);
$status = $result['numstatus'];
$uersID = $result['idUser'];
$arr = [
    [
        'status_device' => "$status",
        'userid' => "$uersID",
    ],
];
echo json_encode($arr);
