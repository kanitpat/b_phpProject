<?php
require 'dbconnect.php';
$now = date('m');
$query = "SELECT  waterLevel, DATE_FORMAT(date, '%D%M%Y') AS date
FROM statuses
GROUP BY id DESC";

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
          <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>

      <!-- WEATHER-->
      <a class="weatherwidget-io" href="https://forecast7.com/en/13d76100d50/bangkok/" data-label_1="BANGKOK" data-label_2="WEATHER" data-font="Trebuchet MS" data-icons="Climacons" data-days="5" data-theme="clear" >BANGKOK WEATHER</a>
     <br/> <br/>
     
      <!-- Icon Cards-->
     <div class="row">
      <div class="col-6 col-md-4">
        <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">ระดับน้ำในสวนตอนนี้
              <?php echo $waters['waterLevel'].' เซนติเมตร';
              $waters = $waters['waterLevel'];
              if ($waters > 120) {
                  echo ' เสี่ยงน้ำท่วมสวน';
              } if ($waters < 50) {
                  echo ' เสี่ยงน้ำแห้ง';
              } if (($waters > 50) && ($waters < 120)) {
                  echo ' ระดับน้ำปกติ';
              }?></div>
      </div>
  </div>

  <div class="col-6 col-md-4">
        <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body"><div class="mr-5">ปุ่มเปิด-ปิดเครื่องสูบน้ำ</div>
        <button type="button"  data-toggle="modal" data-target="#turnonModal" class="btn btn-success" >เปิด</button>
        <button type="button" data-toggle="modal" data-target="#turnoofModal"class="btn btn-danger">ปิด </button></div>
      </div>
  </div>

  <div class="col-6 col-md-4">
        <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">.col-6 .col-md-4</div>
      </div>
  </div>
  </div>
     
         <!-- <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="mr-5">การคำนายล่วงหน้า
              </div>
            </div>
          </div>
        </div> -->
        <br/>   
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
!function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0];
  if(!d.getElementById(id)){
    js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';
  fjs.parentNode.insertBefore(js,fjs);
  }
  }
  (document,'script','weatherwidget-io-js');
</script>

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

     

   
      <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="vendor/jquery/jquery.min.js"></script>

      <script type="text/javascript" >

$(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true,
        "order": [],
        // "pageLength": 5,
        // "lengthMenu": [ 5, 25, 50, 75, 100 ],
        "oLanguage": {
                    "sProcessing":     "กำลังดำเนินการ...",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sEmptyTable":     "ไม่มีข้อมูลในตาราง",
                    "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :",
                    "oPaginate": {
                                  "sFirst":    "หน้าแรก",
                                  "sPrevious": "ก่อนหน้า",
                                  "sNext":     "ถัดไป",
                                  "sLast":     "หน้าสุดท้าย"
                    },
                    "oAria": {
                              "sSortAscending":  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                              "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
                              },
                  },

        // lengthChange: false,
        buttons:
        [
            'copy',
            'excel' ,
            'pdf',
            'print'
        ]
    } );


    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

} );


</script>
