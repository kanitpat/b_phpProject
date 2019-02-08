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
            <li class="breadcrumb-item active">รายชื่อสมาชิกทั้งหมด</li>
          </ol>

 <!-- DataTables Example -->
 <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          ตารางแสดงรายชื่อสมาชิก
     
          </div>
          
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="example" width="100%" cellspacing="0">
            <thead>
                <tr>
                  <th width="14%">Email</th>
                  <th width="16%">ชื่อ-นามสกุล</th>
                  <th width="18%">สิทธิ์การใช้งาน</th>
                  <th width="19%">ลบ/แก้ไข</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>Email</th>
                  <th>ชื่อ-นามสกุล</th>
                  <th>สิทธิ์การใช้งาน</th>
                  <th>ลบ/แก้ไข</th>
                </tr>
              </tfoot>

              <tbody>                
                <?php 

                $sql3 = 'SELECT *
                    FROM users
                    ORDER BY users.id DESC';
                    $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die('Query error');
                while ($row = mysqli_fetch_assoc($result3)) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $lastname = $row['lastname'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $status = $row['isadmin'];
                    $datetime = $row['created_at'];
                    $time = $row['created_at'];
                    $newtime = date('g:i a', strtotime($time));
                    $datetime = date('d-M-Y', strtotime($datetime)); ?> 
                    <tr>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $name.'-'.$lastname; ?></td>
                      <td><?php if ($status == 1) {
                        ?> Admin <?php
                    } else {
                        ?> ผู้ใช้งานทั่วไป<?php
                    } ?></td>
                      <td>                      
                        <a href="http://localhost/b_phpProject/index.php?cont=รายชื่อสมากชิก&edit=<?php echo $id; ?>">
                            <button type="button" class="btn btn-success btn-sm">แก้ไข</button>
                        </a>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DeleteModal">ลบ</button> </td>
                        
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

    <!-- delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ลบสมาชิก ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">ต้องการ ลบสมาชิก หรือไม่</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-danger" href="delete.php">ลบ</a>
      </div>
    </div>
  </div>
</div>
                                      

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
                  }

        // lengthChange: false,
       
    } );


    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );

} );


</script>
