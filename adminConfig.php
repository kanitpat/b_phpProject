<?php 
require 'dbconnect.php';
$_id = $_SESSION['userid'];
                 $sql = "SELECT *
                 FROM user_activities
                 ORDER BY user_activities.id DESC";
                $result = mysqli_query($connect,$sql)or die (mysqli_error($connect));            
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);              
                  $value = $row['value']; 
                  $date = $row['date']; 
                  $time = $row['time']; 
?>  
<!-- Breadcrumbs-->
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://localhost/b_phpProject/index.php?cont=Home">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">ตั้งค่าระยะเซนเซอร์</li>
      </ol>

<!-- Icon Cards-->
       <div class="row justify-content-center">
        <div class="col-4">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
              </div>
              <div class="mr-5">ระดับน้ำในสวนตอนนี้ 
              <?php echo $value ?></div>
            </div>          
          </div>
        </div>
