<?php 
require 'dbconnect.php';
$_id = $_SESSION['userid'];
                 $sql = 'SELECT *
                 FROM user_activities
                 ORDER BY user_activities.id DESC';
                $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $value = $row['value'];
                  $date = $row['date'];
                  $time = $row['time'];
?>  
<!-- Breadcrumbs-->
<style type="text/css">
.card.mb-3 .card-body .table-responsive #example tbody tr td {
	text-align: center;
}
.card.mb-3 .card-body .table-responsive #example {
	text-align: center;
}
</style>

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">ตั้งค่าระยะเซนเซอร์</li>
      </ol>


<div class="card mb-3">
  <div class="card-header">แก้ไขการตั้งค่าระยะเซนเซอร์</div>
    <div class="card-body">
      <form class="needs-validation" novalidate method="POST" name = "editsensor" onSubmit="return sensor()" >
      <!-- <form method="POST" action="#"> -->
      <div class="card border-dark">       
            <div class="card-body text-dark">
                
                <div class="form-group">
                  <div class="form-row">                
                    <div class="col-md-3">
                      <label for="text">ระยะเซนเซอร์ปัจจุบัน(ซม.)</label>
                      <input class="form-control" id="text" name="text" value="<?php echo $value.' เซนติเมตร'; ?>" type="text" disabled>                   
                    </div>

                    <div class="col-md-3">
                      <label for="validationTooltip03">ระยะเซนเซอร์ที่ต้องการเปลี่ยน(ซม.)</label>
                      <input class="form-control is-invalid" id="validationTooltip03"  name="text2" type="number" onkeypress="return event.charCode >= 48" min="1"  placeholder="ระยะเซนเซอร์"  >                                   
                      <div class="invalid-tooltip">ตัวเลขเท่านั้น</div>
                    </div>

                  
            <?php 
            require 'dbconnect.php';
            // $cm_value = $value / 100;
            $tatol_value = 200 - $value;
            // $tatol_value_m = $tatol_value*100;
            ?>  

                    <div class="col-md-3">
                      <label for="name">ระดับน้ำในสวนโดยประมาณ(ซม.)</label>
                      <input class="form-control" id="text3" name="text3" value ="<?php echo $tatol_value.' ซม.'; ?>"  type="text"  placeholder="ระดับน้ำในสวน" disabled>                

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

<!-- DataTables Example -->
<div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
           ประวัติการแก้ไข
     
          </div>
          
        <div class="card-body">
          <div class="table-responsive">
                  <table class="table table-striped table-bordered dt-responsive nowrap" id="example" width="968" cellspacing="0">
            <thead>
                <tr >
                  <!-- <th width="101">ลำดับที่</th> -->
                  <th width="174">ระยะเซนเซอร์(ซม.)</th>
                  <th width="235">วันที่แก้ไข</th>
                  <th width="448">เวลาที่แก้ไข</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <!-- <th height="21">ลำดับที่</th> -->
                  <th>ระยะเซนเซอร์(ซม.)</th>
                  <th>วันที่แก้ไข</th>
                  <th>เวลาที่แก้ไข</th>
                </tr>
              </tfoot>

              <tbody>                
                <?php 
                 $sql2 = 'SELECT *
                 FROM user_activities
                 ORDER BY user_activities.id  DESC';
                $result2 = mysqli_query($connect, $sql2, MYSQLI_STORE_RESULT) or die('Query error');
                while ($user_activities = mysqli_fetch_assoc($result2)) {
                    $ID = $user_activities['id'];
                    $value = $user_activities['value'];
                    $date = $user_activities['date'];
                    $time = $user_activities['time'];
                    $date = date('d-M-Y', strtotime($date));
                    $time = date('g:i a', strtotime($time)); ?>
                    <tr>
                      <!-- <td bgcolor="#FFFFFF"><?php echo $ID; ?></td> -->
                      <td><?php echo $value; ?></td>
                      <td><?php echo $date; ?></td>            
                      <td><?php echo $time; ?></td>
                </tr>                
        <?php
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated <?php echo $date; ?> at <?php echo $time; ?></div>
      </div>

    </div>
    <!-- /.container-fluid -->



  <?php 
  $valid = true;

        if (!empty($_POST['text2'])) {
            $text2 = mysqli_escape_string($connect, ($_POST['text2']));
        } else {
            $valid = false;
        }

        if ($valid == true) {
            $strsql = "INSERT INTO  user_activities( `value`, `date`, `time`, `idUsers`) 
            VALUES 
            ( '$text2 ', NOW(), NOW(), 1)";
            $result = mysqli_query($connect, $strsql);
            if ($result) {
                echo "<script> alert('แก้ไขข้อมูลเรียบร้อย');
                  location.replace('http://localhost/b_phpProject/index.php?cont=ตั้งค่า')</script>";
            } else {
                echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้');
                  location.replace('http://localhost/b_phpProject/index.php?cont=ตั้งค่า')</script>";
            }
        }
?>
<script type="text/javascript">
   $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $("a").tooltip();
    $("input").tooltip();
    $("button").tooltip();

</script>
<script>

                function sensor()
    {
        var text2 = document.forms['editsensor']['text2'].value;
        // var elem = document.getElementById('text2').value;

       var message = "ยังไม่ได้กรอกข้อมูล \n";
       var valid = true;
       
    //    if(!elem.match(/^([0-9])+$/i))
		// {
		// 	alert("กรอกได้เฉพาะตัวเลขเท่านั้น");
		// 	document.getElementById('test_txt').value = "";
		// }

       if(text2 == null || text2=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก ระยะเซนเซอร์ !!\n";
       }
       
     
       
       if(valid == false)
            alert(message);
            
       return valid;
    }

 
    </script>
<!-- // script datatable -->
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
      
    } );


    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

} );


</script>