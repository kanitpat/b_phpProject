<?php


        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'myprojectphp';

        $connect = mysqli_connect($host, $user, $pass, $dbname) or die('connection error');

        $connect->set_charset('utf8');
