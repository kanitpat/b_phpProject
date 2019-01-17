<?php
require 'dbconnect.php';

$query = "
SELECT  waterLevel, DATE_FORMAT(date, '%D%M%Y') AS date
FROM waters
GROUP BY date DESC
";
$result = mysqli_query($connect, $query);
$resultchart = mysqli_query($connect, $query);

//for chart
$date = array();
$waterLevel = array();

while ($rs = mysqli_fetch_array($resultchart)) {
    $date[] = '"'.$rs['date'].'"';
    $waterLevel[] = '"'.$rs['waterLevel'].'"';
}
$date = implode(',', $date);
$waterLevel = implode(',', $waterLevel);

?>
<!-- Breadcrumbs-->
<style type="text/css">
.card.mb-3 .card-body .table-responsive #example {
	text-align: center;
}
</style>

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://localhost/b_phpProject/index.php?cont=Home">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>

      <!-- Icon Cards-->
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              </div>
              <div class="mr-5">ระดับน้ำในสวนตอนนี้
              <?php echo $waters['waterLevel'].' เซนติเมตร'; ?></div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="mr-5">ปุ่มเปิด-ปิดเครื่องสูบน้ำ</div>
              <button type="button"  data-toggle="modal" data-target="#turnonModal" class="btn btn-success" >เปิด</button>
              <button type="button" data-toggle="modal" data-target="#turnoofModal"class="btn btn-danger">ปิด </button>
            </div>
          </div>
        </div>

         <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="mr-5">การคำนายล่วงหน้า
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="openweathermap-widget-16"></div>
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          กราฟแสดงระดับน้ำในสวน</div>
        <div class="card-body">
        <canvas id="myChart" ></canvas>
   <!-- charts -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $date; ?>],
            datasets: [{
                label: 'ระดับน้ำในสวน',
                data: [<?php echo $waterLevel; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>
        </div>
        <?php 
        $sql_water = 'SELECT *
                  FROM waters
                  ORDER BY waters.date DESC';
    $result_waters = mysqli_query($connect, $sql_water, MYSQLI_STORE_RESULT) or die('Query error');
    $row = mysqli_fetch_array($result_waters, MYSQLI_ASSOC);
    $date = $row['date'];
    $date = date('d-M-Y', strtotime($date));
    $time = $row['time'];
    $time = date('g:i a', strtotime($time));
        ?>

        <div class="card-footer small text-muted">Updated <?php echo  $date; ?> at <?php echo  $time; ?></div>
      </div>

      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          ตารางแสดงการทำงานเครื่องสูบน้ำ
          </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap"  id="example" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>คนเปิดเครื่องสูบน้ำ</th>
                  <th>ระดับน้ำในสวน(เซนติเมตร)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>คนเปิดเครื่องสูบน้ำ</th>
                  <th>ระดับน้ำในสวน(เซนติเมตร)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </tfoot>

              <tbody>
                <?php
$sql2 = 'SELECT *
                 FROM process_statuses
                  JOIN users ON process_statuses.idUsers = users.id
                  JOIN pumps ON process_statuses.idPumps = pumps.id
                  JOIN statuses ON process_statuses.idStatus = statuses.id
                  JOIN waters ON process_statuses.idWaters = waters.id ORDER BY process_statuses.id DESC';
$result2 = mysqli_query($connect, $sql2, MYSQLI_STORE_RESULT) or die('Query error');
while ($process_statuses = mysqli_fetch_assoc($result2)) {
    $name = $process_statuses['name'];
    $waterlevel = $process_statuses['waterLevel'];
    $address = $process_statuses['address'];
    $status = $process_statuses['numstatus'];
    $date = $process_statuses['date'];
    $date = date('d-M-Y', strtotime($date));
    $time = $process_statuses['time'];
    $time = date('g:i a', strtotime($time));
    $sql3 = 'SELECT *
                  FROM process_statuses
                  ORDER BY process_statuses.updated_at DESC';
    $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
    $row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
    $datetime = $row['created_at'];
    $datetime = date('d-M-Y', strtotime($datetime)); ?>
                    <tr>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $waterlevel; ?></td>
                      <td><?php echo $address; ?></td>
                      <td><?php if ($status == 1) {
        ?> <span class="badge badge-success">เปิด</span> <?php
    } else {
        ?> <span class="badge badge-danger">ปิด</span> <?php
    } ?></td>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                    </tr>
        <?php
}?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated <?php echo $datetime; ?> at <?php echo $time; ?>  </div>
      </div>

   

