     
<?php

require 'dbconnect.php';

$deleteid = $_GET['delete'];
// echo
// $deleteid;

if ($deleteid) {
    // echo 'เข้า';
    $sql = "DELETE FROM users
    		WHERE users.id = '".$deleteid."' ";
    $query = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
    if ($query) {
        echo "<script> alert('ลบข้อมูลเรียบร้อยแล้ว');
    location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    }
} else {
    // echo 'ไม่เข้า';
}
?>
 <script type="text/javascript">
$(document).ready(function(){
   $("#DeleteModal").modal();
});
</script>