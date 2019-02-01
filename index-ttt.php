<?php
require 'dbconnect.php';
session_start();

if (!$_SESSION['userid']) { //check session
    header('Location: login.php');
} else {
    $sql = 'SELECT *
  FROM waters
  ORDER BY id DESC';
    $result = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die('Query error');
    $waters = mysqli_fetch_assoc($result);

    //*** Update Last Stay in Login System
    $sqlusers = "UPDATE users SET updated_at = NOW() WHERE id = '".$_SESSION['userid']."' ";
    $queryusers = mysqli_query($connect, $sqlusers); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="icon" type="image/png" href="https://sv1.picz.in.th/images/2019/01/10/9nEctk.png" />
    <!-- <link rel="icon" href="img/favicon.ico" type="image/x-icon">  -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ระบบช่วยสนับสนุนเครื่องสูบน้ำสวนวัฒนาเพาะพันธุ์มะพร้าว</title>

   

    </head>

    <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      <?php require 'navbar.php'; ?>
    </nav>

<div id="wrapper">
    <?php require 'sliderbar.php'; ?>
  <div id="content-wrapper">
    <div class="container-fluid">
      <?php
//login user
    if (!empty($_GET['cont']) && $_SESSION['Status'] == 0) {
        $page = mysqli_escape_string($connect, $_GET['cont']);

        // if ($page == 'Home') {
        //     require 'dashboard.php';
        // }
        if ($page == 'Dashboard') {
            require 'dashboard.php';
        }
        if ($page == 'กราฟ') {
            require 'charts.php';
        }
        if ($page == 'ตาราง') {
            require 'tables.php';
        }
        if ($page == 'edit') {
            require 'edituser.php';
        }
    }
    //login admin
    else {
        $page = mysqli_escape_string($connect, $_GET['cont']);

        if ($page == 'Dashboard') {
            require 'dashboard.php';
        }
        if ($page == 'กราฟ') {
            //  require 'chart_test.php';
            require 'index2.html';
        }
        if ($page == 'ตาราง') {
            require 'tables.php';
        }
        if ($page == 'edit') {
            require 'edituser.php';
        }
        if ($page == 'ตั้งค่า') {
            require 'adminConfig.php';
        }
        if ($page == 'สมาชิก') {
            require 'addusers.php';
        }
    } ?>
      <?php require 'footer.php'; ?>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
    <!-- All Modal-->
    <?php require 'Modal.php'; ?>
     <!-- Bootstrap core JavaScript-->
    
     <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  
  </div>
</body>

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

</html>

<?php
}?>
