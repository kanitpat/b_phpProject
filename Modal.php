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
        $userid = $_SESSION['userid'];
        if (isset($_POST['saveon'])) {
            $sqlNN = "INSERT INTO  statuses( `numstatus`, `detail`,`date`, `time`, `idUser`) VALUES ( 1,'เปิด',NOW(),NOW(),'$userid')";
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
        <?php if (isset($_POST['saveoff'])) {
    $sqlFF = "INSERT INTO  statuses( `numstatus`, `detail`,`date`, `time`, `idUser`) VALUES ( 0,'ปิด',NOW(),NOW(),'$userid')";
    $queryFF = mysqli_query($connect, $sqlFF, MYSQLI_STORE_RESULT) or die('DIE');
}

?>
      </div>
    </div>
    </form>
  </div>
</div>
