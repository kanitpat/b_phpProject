<?php

require 'dbconnect.php';

$sql2 = 'SELECT `value`
FROM user_activities
ORDER BY `user_activities`.`date` DESC limit 1';
$query = mysqli_query($connect, $sql2, MYSQLI_STORE_RESULT) or die('Query error');
$result = mysqli_fetch_assoc($query);
$value = $result['value'];

$arr = [
    [
        'ch1' => "$value",
    ],
];
echo json_encode($arr);
