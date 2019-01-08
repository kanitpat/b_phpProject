<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">กราฟ</li>
          </ol>
<?php 
require 'dbconnect.php';

$query = "
SELECT  waterLevel, DATE_FORMAT(date, '%D%M%Y') AS date
FROM waters 
GROUP BY DATE_FORMAT(date, '%D%M%Y')
";
$result = mysqli_query($connect, $query);
$resultchart = mysqli_query($connect, $query);  
 
//for chart
$date = array();
$waterLevel = array();
 
while($rs = mysqli_fetch_array($resultchart)){ 
  $date[] = "\"".$rs['date']."\""; 
  $waterLevel[] = "\"".$rs['waterLevel']."\""; 
}
$date = implode(",", $date); 
$waterLevel = implode(",", $waterLevel); 
 mysqli_close($connect);

?>

  <canvas id="myChart" ></canvas>
   <!-- charts -->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    
    
    <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php echo $date;?>
        
            ],
            datasets: [{
                label: 'ระดับน้ำในสวน',
                data: [<?php echo $waterLevel;?>
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