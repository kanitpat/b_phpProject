  <!-- Breadcrumbs-->
<style type="text/css">
.card.mb-3 .card-body .table-responsive #example {
	text-align: center;
}
</style>

  <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Home">Dashboard</a>
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
                  <th>ระดับน้ำในสวน(เมตร)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
                  <th>คนเปิดเครื่องสูบน้ำ</th>
                  <th>ระดับน้ำในสวน(เมตร)</th>
                  <th>สถานที่เครื่องสูบน้ำ</th>
                  <th>สถานะเครื่องสูบน้ำ</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                </tr>
              </tfoot>

              <tbody>                
                <?php 
                 $sql2 = "SELECT *
                 FROM process_statuses
                  JOIN users ON process_statuses.idUsers = users.id
                  JOIN pumps ON process_statuses.idPumps = pumps.id 
                  JOIN statuses ON process_statuses.idStatus = statuses.id 
                  JOIN waters ON process_statuses.idWaters = waters.id ORDER BY process_statuses.id DESC";
                $result2 = mysqli_query($connect,$sql2,MYSQLI_STORE_RESULT) or die ("Query error");             
                while( $process_statuses = mysqli_fetch_assoc($result2))  {
                   $name = $process_statuses['name'];
                   $waterlevel = $process_statuses['waterLevel'];
                   $address = $process_statuses['address'];
                   $status = $process_statuses['numstatus'];
                   $date = $process_statuses['date'];
                   $time = $process_statuses['time'];
                ?>
                    <tr>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $waterlevel; ?></td>
                      <td><?php echo $address; ?></td>
                      <td><?php if($status==1){?> <span class="badge badge-success">เปิด</span> <?php }
                      else{ ?> <span class="badge badge-danger">ปิด</span> <?php } ?></td>
                      <td><?php echo $date; ?></td>
                      <td><?php echo $time; ?></td>
                    </tr>                
        <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

    </div>
    <!-- /.container-fluid -->