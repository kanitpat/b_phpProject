<head>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="datepicker-master/css/datepicker.css">
  <link rel="stylesheet" href="datepicker-master/css/main.css">

</head>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">กราฟ</li>
           
          </ol>
<?php
require 'dbconnect.php';

$DATETIME_Z = date_default_timezone_set('Asia/Bangkok');

$self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '#';

$now = date('Y-m-d');
$today = isset($_POST['datepickerS']) ? $_POST['datepickerS'] : (new DateTime())->format('Y-m-d');
$date2 = date('Y-m-d', strtotime($today));
$formatResult = ": $date2";

?>

<div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          กราฟแสดงระดับน้ำในสวน</div>
  <!--      <div class="card-body">
        <div id="update-nav">
   <div id="range-selector">
    <input type="button" id="1m" class="period ui-button" value="1m" />
    <input type="button" id="3m" class="period ui-button" value="3m"/>
    <input type="button" id="6m" class="period ui-button" value="6m"/>
    <input type="button" id="1y" class="period ui-button" value="1y"/>
    <input type="button" id="all" class="period ui-button" value="All"/>
  </div> -->

  <!-- <div id="date-selector">
      From:<input type="text" id="fromDate" class="ui-widget">
      To:<input type="text" id="toDate" class="ui-widget">
  </div> -->

  <div class="card-body">
       <form method="POST" name = "chartinput" action="<?php $self; ?>" autocomplete="off"  onSubmit="return chart()" >
      <div class="card border-dark">
            <div class="card-body text-dark">
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-3">
                      <label for="text">วัน/เดือน/ปีเริ่มต้น:</label>
                      <div class="docs-datepicker">
          <div class="input-group">
            <input type="text" class="form-control docs-date" name="datepickerS" id="datepickerS" placeholder="เลือกวันที่" value="" >
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <div class="docs-datepicker-container"></div>
        </div>
           </div>
                    <div class="col-md-3">
                      <label for="text">วัน/เดือน/ปีสิ้นสุด:</label>
                      <div class="docs-datepicker">
          <div class="input-group">
            <input type="text" class="form-control docs-date" name="datepickerE" id="datepickerE" placeholder="เลือกวันที่">
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <div class="docs-datepicker-container"></div>
        </div>
          </div>
                  <div class="col-md-3">
                  <label for="text"></label>
                  <div class="input-group">
                                     <input type="submit" name = "submit" value="search" class="btn btn-primary">

                                      </div>
                                     </div>
                </div>
            </div>

      </div>
      <br>
      </form>
      <?php

if (isset($_POST['submit'])) {
    $today = isset($_POST['datepickerS']) ? $_POST['datepickerS'] : (new DateTime())->format('Y-m-d');
    $date2 = date('Y-m-d', strtotime($today));

    //$date_start = date('Y-m-d', strtotime($_POST['datepickerS']));
    $date_S = $_POST['datepickerS'];
    $date_E = $_POST['datepickerE'];
    $newS = date('Y-m-d', strtotime($date_S));
    $newE = date('Y-m-d', strtotime($date_E));
    // WHERE member_date BETWEEN date('YYYY-MM-DD') AND date('YYYY-MM-DD')//  DATE_FORMAT(date, '%D%M%Y') AS date
    // echo '  s '.$date_S.'  E   '.$date_E;   WHERE date BETWEEN $newS AND $newE
    echo ' ช่วงเวลาวันที่ : '.$date_S.'  ถึง   '.$date_E;

    $query =
        "SELECT DATE_FORMAT(date, '%D%M%Y')AS date,waterLevel
FROM `waters`
WHERE date BETWEEN '$newS' and '$newE' 
GROUP BY id DESC";
    $resultchart = mysqli_query($connect, $query) or die(mysqli_error($connect));
    // echo  "Q: $query";
    //for chart
    $date = array();
    $waterLevel = array();

    while ($rs = mysqli_fetch_array($resultchart)) {
        $date[] = '"'.$rs['date'].'"';
        $waterLevel[] = '"'.$rs['waterLevel'].'"';

        // echo ':-'.$rs['date'];
    }
    $date = implode(',', $date);
    $waterLevel = implode(',', $waterLevel);
    mysqli_close($connect);
}
//     echo '1'.$date_start;
else {
    $now = date('m');
    $query =
    "SELECT DATE_FORMAT(date, '%D%M%Y')AS date,waterLevel
FROM `waters`
WHERE MONTH(date) = $now 
GROUP BY id DESC";
    $resultchart = mysqli_query($connect, $query) or die(mysqli_error($connect));
    // echo  "Q: $query";
    //for chart
    $date = array();
    $waterLevel = array();

    while ($rs = mysqli_fetch_array($resultchart)) {
        $date[] = '"'.$rs['date'].'"';
        $waterLevel[] = '"'.$rs['waterLevel'].'"';

        // echo ':-'.$rs['date'];
    }
    $date = implode(',', $date);
    $waterLevel = implode(',', $waterLevel);
    mysqli_close($connect);
}
?>
  </div>

  <canvas id="myChart" ></canvas>
   <!-- charts -->

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->

   <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></script>
   <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $date; ?>

            ],
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




    $('#datepickerS').datepicker({
        dateFormat: "dd-mm-yy"

  });


  $('#datepickerE').datepicker({
        dateFormat: "dd-mm-yy"

  });

//   $('#datepickerE').datepicker({
//    format: "dd-mm-yy",
//    startDate: '-1y -1m',
//    endDate: '+2m +10d'
//   });


  </script>

    </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>



      <!-- Scripts -->
      <script src="datepicker-master/js/datepicker.js"></script>

  <script src="datepicker-master/js/main.js"></script>

  <script>
                function chart()
    {
        var va_s = document.forms['chartinput']['datepickerS'].value;
        var va_e= document.forms['chartinput']['datepickerE'].value;
      
       var message = "ยังไม่ได้กรอกข้อมูล \n";
       var valid = true;

       if(va_s == null || va_s=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก วัน/เดือน/ปีเริ่มต้น!!\n";
       }
    
       if(va_e == null || va_e=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก วัน/เดือน/ปีสิ้นสุด!!\n";
       }
       if(valid == false){
            alert(message);
       }
       return valid;
    }
    </script>