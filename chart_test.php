<head>    
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">กราฟ</li>
           test
          </ol>
<?php 
require 'dbconnect.php';

$query = "
SELECT  waterLevel, DATE_FORMAT(date, '%D%M%Y') AS date
FROM waters 
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
 mysqli_close($connect);

?>

<div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          กราฟแสดงระดับน้ำในสวน</div>
        <div class="card-body">
        <div id="update-nav">
  <div id="range-selector">
    <input type="button" id="1m" class="period ui-button" value="1m" />
    <input type="button" id="3m" class="period ui-button" value="3m"/>
    <input type="button" id="6m" class="period ui-button" value="6m"/>
    <input type="button" id="1y" class="period ui-button" value="1y"/>
    <input type="button" id="all" class="period ui-button" value="All"/>
  </div>
  <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />

  <!-- <div id="date-selector">
      From:<input type="text" id="fromDate" class="ui-widget">
      To:<input type="text" id="toDate" class="ui-widget">
  </div> -->


  </div>
  <canvas id="myChart" ></canvas>
   <!-- charts -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   <!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></script>
   <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

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

    $(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});

// $.getJSON("https://api.myjson.com/bins/i62nr", function(chartData) {
// 	for(var i = 0; i < chartData.GetStockTimeSeriesResult.TimeSeriesItems.length; i++){  	
// 		var timeStamp = chartData.GetStockTimeSeriesResult.TimeSeriesItems[i].TimeStamp.match(/\.*[0-9]+/);
//     var timeZone = chartData.GetStockTimeSeriesResult.TimeSeriesItems[i].TimeStamp.match(/\.*-[0-9]+/);    
//   	dps.push({ x: new Date(parseInt(timeStamp[0]) + parseInt(timeZone[0])), y: parseFloat(chartData.GetStockTimeSeriesResult.TimeSeriesItems[i].Price)});
//   }
//   chart.render();
    
//   var axisXMin = chart.axisX[0].get("minimum");
//   var axisXMax = chart.axisX[0].get("maximum");

//   $( function() {
//     $("#fromDate").val(CanvasJS.formatDate(axisXMin, "D MMM YYYY"));
//     $("#toDate").val(CanvasJS.formatDate(axisXMax, "D MMM YYYY"));
//     $("#fromDate").datepicker({dateFormat: "d M yy"});
//     $("#toDate").datepicker({dateFormat: "d M yy"});
//   });

//   $("#date-selector").change(function() {
//     var minValue = $("#fromDate").val();
//     var maxValue = $("#toDate").val();

//     if(new Date(minValue).getTime() < new Date(maxValue).getTime()) {  
//       chart.axisX[0].set("minimum", new Date(minValue));
//       chart.axisX[0].set("maximum", new Date(maxValue));
//     }  
//   });

//   $(".period").click(function() {
//     var period = this.id;  
//     var minValue;
//     minValue = new Date(axisXMax);

//     switch(period) {
//       case "1m":
//         minValue.setMonth(minValue.getMonth() - 1);
//         break;
//       case "3m":
//         minValue.setMonth(minValue.getMonth() - 3);
//         break;
//       case "6m":
//         minValue.setMonth(minValue.getMonth() - 6);
//         break;
//       case "1y":
//         minValue.setYear(minValue.getFullYear() - 1);
//         break;
//       default:
//         minValue = axisXMin;
//     }

//     chart.axisX[0].set("minimum", new Date(minValue));  
//     chart.axisX[0].set("maximum", new Date(axisXMax));
//   });
// });
    </script>  
    </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>