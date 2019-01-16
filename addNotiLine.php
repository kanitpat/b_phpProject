<?php require 'dbconnect.php';
header('refresh: 10;'); ?>
<?php

$sql_count = 'SELECT  count(*)
 FROM notiline ';
$query_count = mysqli_query($connect, $sql_count, MYSQLI_STORE_RESULT) or die('DIE');
$row = mysqli_fetch_array($query_count);
$count = $row['count(*)'];
$count_old = $count;

?>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0">
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell fa-fw"></i>
      <?php

//   for ($num = 0; $num <= 10; ++$num) {
//   }

if ((!empty($_GET['sensor'])) || (!empty($_GET['message']))) {
    $sensor = $_GET['sensor'];
    $message = $_GET['message'];
    $waterLevel = 200 - $sensor;
    $sql_page = "INSERT INTO `notiline`(`sensor`, `status_water`, `date`, `time`)
             VALUES
             ( ('$sensor'),('$message'),NOW(),NOW() )";
    $result_page = mysqli_query($connect, $sql_page, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    if ($result_page) {
        $num = 0; ?>
      <span class="badge badge-danger"><?php echo $num++; ?></span>   <?php
    }
}?>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
    <h6 class="dropdown-header">ข้อความใหม่ : </h6>
    <?php

$sql_noti = 'SELECT *
FROM notiline ORDER BY notiline.id DESC limit 3';
$query_noti = mysqli_query($connect, $sql_noti, MYSQLI_STORE_RESULT) or die('DIE');
while ($noti = mysqli_fetch_assoc($query_noti)) {
    $sensor = $noti['sensor'];
    $status_water = $noti['status_water'];
    $date = $noti['date'];
    $time = $noti['time'];
    $time = date('g:i a', strtotime($time)); ?>

        <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
            <strong>สวนวัฒนา</strong>
                <div class="dropdown-message small"><?php echo $status_water.'เหลือ '.(200 - $sensor).' ซม.'; ?></div>
                           <span class="small float-right text-muted"><?php echo $time; ?></span>

            </a>
             <?php
}?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item small" href="http://localhost/b_phpProject/index.php?cont=ตาราง">ดูเพิ่มเติม</a>
            </div>
  </li>
  <li class="nav-item dropdown no-arrow mx-1">
  </li>