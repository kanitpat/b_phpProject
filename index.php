<?php
require "dbconnect.php";
session_start();

if (!$_SESSION["userid"]){  //check session
 
  Header("Location: login.php"); 

}else{
  $sql = "SELECT *
  FROM waters
  ORDER BY id DESC";
  $result = mysqli_query($connect,$sql,MYSQLI_STORE_RESULT) or die ("Query error");
  $waters = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ระบบช่วยสนับสนุนเครื่องสูบน้ำสวนวัฒนาเพาะพันธุ์มะพร้าว</title>
    
      <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/switchonoff.css">
    <!-- styles for dowload-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=19472395a2969da78c8a4c707e72123a">
      
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"> 
    
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
              if(!empty($_GET['cont'])&&  $_SESSION['Status'] == 0){                 
                  $page = mysqli_escape_string($connect,$_GET['cont']);
                   
                    if ($page=="Home")
                              require 'dashboard.php';                              
                    if ($page=="Dashboard")
                              require 'dashboard.php';
                    if($page == "กราฟ")
                              require "charts.php";            
                    if ($page=="ตาราง")
                              require "tables.php";  
                    if ($page=="edit")
                              require "edituser.php";              
          }
        //login admin
             else{                 
                  $page = mysqli_escape_string($connect,$_GET['cont']);                  
                    if ($page=="Home")
                              require 'dashboard.php';                              
                    if ($page=="Dashboard")
                              require 'dashboard.php';
                    if($page == "กราฟ")
                              require "charts.php";            
                    if ($page=="ตาราง")
                              require "tables.php";  
                    if ($page=="edit")
                              require "edituser.php";  
                    if ($page=="ตั้งค่า")
                              require "adminConfig.php";         
          }
      ?>
      <?php require 'footer.php'; ?>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">ต้องการ Logout หรือไม่</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

     <!-- Bootstrap core JavaScript-->
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
   <script src="vendor/datatables/jquery.dataTables.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Demo scripts for this page-->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <!-- scripts for dowload this page-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <script type="text/javascript" src="/media/js/site.js?_=5e8f232afab336abc1a1b65046a73460"></script>
    <script type="text/javascript" src="/media/js/dynamic.php?comments-page=extensions%2Fbuttons%2Fexamples%2Fstyling%2Fbootstrap4.html" async></script>
    <script type="text/javascript" language="javascript" src="../../../../examples/resources/demo.js"></script>
    <!-- <script src="js/vfs_fonts.js"></script> -->
    <script type="text/javascript" language="่json" src="//cdn.datatables.net/plug-ins/1.10.19/i18n/Thai.json"></script>

  

  </div>
</body>

<script type="text/javascript" >

// pdfMake.fonts = {
  //  THSarabun: {
  //    normal: 'THSarabun.ttf',
  //    bold: 'THSarabun-Bold.ttf',
  //    italics: 'THSarabun-Italic.ttf',
  //    bolditalics: 'THSarabun-BoldItalic.ttf'
  //  }
// }
$(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true,
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
        buttons: ['copy', 
        'excel' ,    'pdf',    
    //     { // กำหนดพิเศษเฉพาะปุ่ม pdf
    //     "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
    //     "text": 'PDF', // ข้อความที่แสดง
    //     "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4            
    //     "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
    //         // กำหนด style หลัก
    //         doc.defaultStyle = {
    //             font:'THSarabun',
    //             fontSize:16                                 
    //         };
    //         // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
    //         doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
    //         doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
    //         var rowCount = doc.content[1].table.body.length; // หาจำนวนแะวทั้งหมดในตาราง
    //         // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
    //         for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
    //             doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
    //             doc.content[1].table.body[i][1].alignment = 'center';
    //             doc.content[1].table.body[i][2].alignment = 'left';
    //             doc.content[1].table.body[i][3].alignment = 'right';
    //         };                                  
    //         console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
    //     }
    // }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
        'print' 
        
        ]
    } );
   
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        
} );


</script>

</html>

<?php } ?>