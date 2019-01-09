<?php

$sql = 'SELECT *
                 FROM process_statuses
                  JOIN users ON process_statuses.idUsers = users.id
                  JOIN pumps ON process_statuses.idPumps = pumps.id 
                  JOIN statuses ON process_statuses.idStatus = statuses.id 
                  JOIN waters ON process_statuses.idWaters = waters.id ORDER BY process_statuses.id DESC';
                $result2 = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die('Query error');
                while ($process_statuses = mysqli_fetch_assoc($result2)) {
                    $name = $process_statuses['name'];
                    $waterlevel = $process_statuses['waterLevel'];
                    $address = $process_statuses['address'];
                    $status = $process_statuses['numstatus'];
                    $date = $process_statuses['date'];
                    $time = $process_statuses['time'];
                }
