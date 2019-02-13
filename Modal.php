<?php require 'dbconnect.php';
?>
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
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- delete Modal
<div class="modal fade" id="DeleteModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ลบสมาชิก ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">ต้องการ ลบสมากชิก หรือไม่</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
        <a class="btn btn-danger" href="delete.php">ลบ</a>
      </div>
    </div>
  </div>
</div> -->

<!-- turn on Modal-->
<div class="modal fade" id="turnonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method = "POST" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="turnonModal">ต้องการเปิดเครื่องสูบน้ำใช่หรือไม่</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">ไม่ใช่</button>
        <button type="submit" class="btn btn-success" name="saveon">ใช่</button>
        <?php 
          $sql3 = 'SELECT waterLevel
          FROM waters       
          ORDER BY waters.id DESC';
          $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
          $row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
          $water = $row['waterLevel'];
          $userid = $_SESSION['userid'];
        if (isset($_POST['saveon'])) {
            $sqlNN = "INSERT INTO  statuses( `numstatus`,  `waterLevel`,`detail`,`date`, `time`, `idUser`) 
            VALUES ( 1,'$water','เปิด',NOW(),NOW(),'$userid')";
            $queryNN = mysqli_query($connect, $sqlNN, MYSQLI_STORE_RESULT) or die('DIE');
        }
?>

      </div>
    </div>
    </form>
  </div>
</div>
<!-- turn off Modal-->
<div class="modal fade" id="turnoofModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method = "POST" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="turnoofModal">ต้องการปิดเครื่องสูบน้ำใช่หรือไม่</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">ไม่ใช่</button>
        <button type="submit" class="btn btn-success" name="saveoff">ใช่</button>
        <?php 
         $sql3 = 'SELECT waterLevel
         FROM waters       
         ORDER BY waters.id DESC';
         $result3 = mysqli_query($connect, $sql3, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
         $row = mysqli_fetch_array($result3, MYSQLI_ASSOC);
         $water = $row['waterLevel'];
         $userid = $_SESSION['userid'];
        if (isset($_POST['saveoff'])) {
            $sqlFF = "INSERT INTO  statuses( `numstatus`,  `waterLevel`, `detail`,`date`, `time`, `idUser`) 
            VALUES ( 0,'$water','ปิด',NOW(),NOW(),'$userid')";
            $queryFF = mysqli_query($connect, $sqlFF, MYSQLI_STORE_RESULT) or die('DIE');
        }

?>
      </div>
    </div>
    </form>
  </div>
</div>
