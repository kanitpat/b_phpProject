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

 <div class="card mb-3">
  <div class="card-header">แก้ไขการตั้งค่าระยะเซนเซอร์</div>
    <div class="card-body">
      <form method="POST" name = "edituser" onSubmit="return edit()" >
      <!-- <form method="POST" action="#"> -->
      <div class="card border-dark">       
            <div class="card-body text-dark">
                
                <div class="form-group">
                  <div class="form-row">                
                    <div class="col-md-3">
                      <label for="text">ระยะเซนเซอร์ปัจจุบัน</label>
                      <input class="form-control" id="text" name="text" value="<?php echo $value ." เซนติเมตร"?>" type="text" disabled>                   
                    </div>

                    <div class="col-md-3">
                      <label for="confirm_password">ระยะเซนเซอร์ที่ต้องการเปลี่ยน</label>
                      <input class="form-control" id="text2" name="text2" type="text" placeholder="ระยะเซนเซอร์">               
                    </div>

                    <div class="col-md-3">
                      <label for="name">ระดับน้ำในสวนเมื่อตั้งค่าระยะเซนเซอร์</label>
                      <input class="form-control" id="text3" name="text3"   type="text"  placeholder="ระดับน้ำในสวน" disabled>                

                  </div>
                 
                  </div>
                </div>
            </div>
      </div>
      <br />
        
      
        <!-- <input type="hidden" name="_method" value="PUT">  -->
        <input type="submit" value="บันทึก" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-danger">

      </form>
    </div>
  </div>