  <?php
  require 'dbconnect.php';

                $sql3 = 'SELECT *
                FROM statuses
                WHERE numstatus = 1
                ORDER BY statuses.id ASC';

                  $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                  while ($row = mysqli_fetch_assoc($result3)) {
                      // $input_array = array($row['waterLevel']);
                      // print_r(array_chunk($input_array, 2));
                      $data_date = $row['date'];
                      $data_time = $row['time'];
                      $status = $row['numstatus'];
                      $idUsers = $row['idUser'];
                      $id_status = $row['id'];

                      $strsql = "INSERT INTO  `report`(  `idStatus`, `idPump`, `date`, `time`)
    VALUES('$id_status',1,'$data_date','$data_time')";
                      $result_test = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                  }
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
            <li class="breadcrumb-item active">ตาราง</li>
          </ol>

 <!-- DataTables Example -->
 <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          ตารางแสดงการทำงานเครื่องสูบน้ำ
     
          </div>
          
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="example" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th>คนเปิดเครื่องสูบน้ำ</th>
                  <th>ระดับน้ำในสวน(ซม.)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>คนเปิดเครื่องสูบน้ำ</th>
                  <th>ระดับน้ำในสวน(ซม.)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </tfoot>

              <tbody>                
                <?php 

                $sql3 = 'SELECT users.name,statuses.waterLevel,pumps.address,statuses.numstatus,report.date,report.time
                    FROM report
                    JOIN statuses ON report.idStatus = statuses.id 
                    JOIN pumps ON report.idPump = pumps.id 
                    JOIN users ON statuses.idUser = users.id 
                    ORDER BY report.id DESC';
                    $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                    $newtime; $datetime;
                while ($row_report = mysqli_fetch_assoc($result3)) {
                    $datetime = $row_report['date'];
                    $time = $row_report['time'];
                    $newtime = date('g:i a', strtotime($time));
                    $newdate = date('d-M-Y', strtotime($datetime));
                    $name = $row_report['name'];
                    $waterlevel = $row_report['waterLevel'];
                    $address = $row_report['address'];
                    $status = $row_report['numstatus']; ?> 
                    <tr>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $waterlevel; ?></td>
                      <td><?php echo $address; ?></td>
                      <td><?php if ($status == 1) {
                        ?> <span class="badge badge-success">เปิด</span> <?php
                    } else {
                        ?> <span class="badge badge-danger">ปิด</span> <?php
                    } ?></td>
                      <td><?php echo $newdate; ?></td>
                      <td><?php echo $newtime; ?></td>
                    </tr>                
        <?php
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated <?php echo $datetime; ?> at <?php echo $newtime; ?></div>
     
      </div>

    </div>
    <!-- /.container-fluid -->
  
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
