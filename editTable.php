<?php
require 'dbconnect.php';
$_id = $_GET['edit'];
$sql = "SELECT *
                 FROM users
                 where users.id = '$_id'";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$isadmin = $row['isadmin'];
$email = $row['email'];
$name = $row['name'];
$lastname = $row['lastname'];
$isadmin = $row['isadmin'];
?>
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">แก้ไขข้อมูลผู้ใช้งานddd</li>
          </ol>

<div class="card mb-3">
  <div class="card-header">ข้อมูลผู้ใช้งาน</div>
  <div class="card-body">
    <form method="POST" name = "edituser" onSubmit="return edit()" >
    <!-- <form method="POST" action="#"> -->
    <div class="card border-dark">
          <div class="card-body text-dark">
              <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control " id="email" name="email" type="email" value="<?php echo $email; ?>" aria-describedby="emailHelp" placeholder="Enter email" disabled>
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="name">ชื่อ</label>
                    <input class="form-control" id="name" name="name"  value="<?php echo $name; ?>" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
                </div>
                <div class="col-md-6">
                    <label for="surname">นามสกุล</label>
                    <input class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>" type="text" aria-describedby="nameHelp" placeholder="Enter last name">

                </div>
                <div class="col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">สิทธิ์การใช้งาน</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"  name="texauth">
                <?php 
                // if ($isadmin == 1) {
                //     echo 'Admin';
                // } else {
                //     echo 'ผู้ใช้งานทั่วไป';
                // }
                 ?>
                    <option selected><?php  if ($isadmin == 1) {
                     echo 'Admin';
                 } else {
                     echo 'ผู้ใช้งานทั่วไป';
                 } ?></option>                 
                    <option value="1">Admin</option>
                    <option value="2">ผู้ใช้งานทั่วไป</option>
                </select> <br />
                </div>

                </div>
              </div>
      <!-- <input type="hidden" name="_method" value="PUT">  -->
      <input type="submit" value="บันทึก" class="btn btn-primary">
      <input type="reset" value="Reset" class="btn btn-danger">

    </form>

          </div>
    </div>
    <br />
    
  </div>
  </div>

  <?php
$valid = true;
if (!empty($_POST['name'])) {
    $name = mysqli_escape_string($connect, $_POST['name']);
} else {
    $valid = false;
}

if (!empty($_POST['lastname'])) {
    $lastname = mysqli_escape_string($connect, $_POST['lastname']);
} else {
    $valid = false;
}
if (!empty($_POST['texauth'])) {
    $auth = mysqli_escape_string($connect, $_POST['texauth']);
} else {
    $valid = false;
}

if ($valid == true) {
    $date = date('Y-m-d H:i:s');

    $sql2 = "UPDATE  users SET               
                    name = '$name',
                    lastname = '$lastname',
                    isadmin = '$auth',
                    created_at = NOW(),
                    updated_at = NOW()
                    WHERE users.id = '$_id' ";
    $result2 = mysqli_query($connect, $sql2) or die(mysqli_error($connect));
    mysqli_close($connect);
    if ($result2) {
        echo "<script> alert('แก้ไขข้อมูลเรียบร้อย');
                  location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    } else {
        echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้');
                  location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    }
}
$validpass = true;
if (!empty($_POST['password'])) {
    $password = mysqli_escape_string($connect, ($_POST['password']));
} else {
    $validpass = false;
}
if (!empty($_POST['Confirmpassword'])) {
    if ($_POST['password'] === $_POST['Confirmpassword']) {
        // success!
        $conpassword = mysqli_escape_string($connect, ($_POST['Confirmpassword']));
    } else {
        echo "<script>
                            alert ('ท่านใส่ Password ไม่ตรงกัน ');
                            location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    }
} else {
    $validpass = false;
}
if ($validpass == true) {
    $trnfer_password = base64_encode($conpassword);
    $date = date('Y-m-d H:i:s');
    $sqlpass = "UPDATE  users SET
                    password = '$trnfer_password' ,              
                    created_at = NOW(),
                    updated_at = NOW()
                    WHERE users.id = '$_id' ";

    $result_pass = mysqli_query($connect, $sqlpass) or die(mysqli_error($connect));
    mysqli_close($connect);
    if ($result_pass) {
        echo "<script> alert('แก้ไขข้อมูลเรียบร้อย');
                  location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    } else {
        echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้');
                  location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก')</script>";
    }
}
?>
<script>
                function edit()
    {
        var name = document.forms['edituser']['name'].value;
        var lastname = document.forms['edituser']['lastname'].value;
        var auth = document.forms['edituser']['texauth'].value;

        var message = "ยังกรอกข้อมูลไม่ครบ \n";
        var valid = true;

       if(name == null || name=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก First Name !!\n";
       }
       if(auth == null || auth=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก สิทธิ์การใช้งาน !!\n";
       }
       if(lastname == null || lastname=='')
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก Last name !!\n");
       }
       if(valid == false)
            alert(message);

       return valid;
    }

    function pass()
    {
        var password = document.forms['editpass']['password'].value;
        var Confirmpassword = document.forms['editpass']['Confirmpassword'].value;

       var message = "ยังกรอกข้อมูลไม่ครบ \n";
       var valid = true;
        if(( password=='') && (Confirmpassword !=''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก Password !!\n");
       }
        if(( Confirmpassword=='') && (password !=''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก Confirm password !!\n");
       }
       if((password == null || password=='') && (Confirmpassword == null || Confirmpassword ==''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก Password และ Confirm password!!\n");
       }
       if(valid == false)
            alert(message);

       return valid;
    }
    </script>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>