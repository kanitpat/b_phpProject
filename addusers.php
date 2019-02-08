<!-- Breadcrumbs-->
<ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">เพิ่มสมาชิก</li>
          </ol>
<?php
require 'dbconnect.php';
$valid = true;

if (!empty($_POST['texpassword'])) {
    $password = mysqli_escape_string($connect, ($_POST['texpassword']));
} else {
    $valid = false;
}
if (!empty($_POST['texConfirmpassword'])) {
    if ($_POST['texpassword'] === $_POST['texConfirmpassword']) {
        // success!
        $conpassword = mysqli_escape_string($connect, $_POST['texConfirmpassword']);
    } else {
        echo "<script>
		              alert ('ท่านใส่ Password ไม่ตรงกัน ');
                      location.replace('http://localhost/b_phpProject/index.php?cont=สมาชิก');
        </script>";
        exit();
        // echo "<script>
        // location.replace('http://localhost/b_phpProject/Register.php');
        // </script>";
    }
} else {
    $valid = false;
}
if (!empty($_POST['texname'])) {
    $name = mysqli_escape_string($connect, $_POST['texname']);
} else {
    $valid = false;
}
if (!empty($_POST['texlastname'])) {
    $lastname = mysqli_escape_string($connect, $_POST['texlastname']);
} else {
    $valid = false;
}

if (!empty($_POST['texemail'])) {
    // check if e-mail address is well-formed
    if (!filter_var($_POST['texemail'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo "<script>
                        alert ('ท่านใส่อีเมล์ไม่ถูกต้อง ตัวอย่าง (somsi007@hotmail.com) ');
                        </script>";
    } else {
        $email = mysqli_escape_string($connect, $_POST['texemail']);
    }
}
if (!empty($_POST['texauth'])) {
    $auth_t = mysqli_escape_string($connect, $_POST['texauth']);
} else {
    $valid = false;
}
// echo  $email; echo  $auth_t;

    if ($valid == true) {
        // echo 'เข้า';
        if (isset($_POST['submit'])) {
            $date = date('Y-m-d H:i:s');

            // เช็คอีเมลซ้ำไหม
            $sql_chk_email = "SELECT *
        FROM users
        WHERE email = '$email' ";
            $query_email = mysqli_query($connect, $sql_chk_email);
            if ((mysqli_num_rows($query_email) >= 1)) {
                echo "<script> alert('ขออภัย Email ซ้ำ');
                      window.location='http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก';</script>";
                exit();
            } else {
                $trnfer_password = base64_encode($conpassword);
                $strsql = "INSERT INTO  users( `email`, `password`, `name`, `lastname`, `api_token`, `isadmin`, `created_at`, `updated_at`)
                VALUES
                ( '$email', ('$trnfer_password'), '$name', '$lastname',Null,'$auth_t',NOW(),NOW())";

                $result = mysqli_query($connect, $strsql, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
                // echo $result;

                // เข้า login page
                if ($result) {
                    echo "<script> alert('ลงทะเบียนสำเร็จ');
                      location.replace('http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก');
                      </script>";
                } else {
                    echo "<script> alert('ขออภัยไม่มารถเพิ่มสมาชิกได้');
                      window.location='http://localhost/b_phpProject/index.php?cont=รายชื่อสมาชิก';</script>";
                }
            }
        }
    }
?>
<div class="card mb-3">
  <div class="card-header">ข้อมูลผู้ใช้งาน</div>
  <div class="card-body">
    <form method="POST" name = "adduser" onSubmit="return users()" >
    <!-- <form method="POST" action="#"> -->
    <div class="card border-dark">
          <div class="card-body text-dark">
              <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control " id="texemail" name="texemail" type="email"  aria-describedby="emailHelp" placeholder="กรอก email" >
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="name">รหัสผ่าน</label>
                    <input class="form-control" id="texpassword" name="texpassword"   type="password" aria-describedby="passHelp" placeholder="กรอกรหัสผ่าน">
                </div>
                <div class="col-md-6">
                    <label for="surname">ยืนยันรหัสผ่าน</label>
                    <input class="form-control" id="texConfirmpassword" name="texConfirmpassword"  type="password" aria-describedby="conpassHelp" placeholder="ยืนยันรหัสผ่าน">
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="name">ชื่อ</label>
                    <input class="form-control" id="texname" name="texname" type="text" aria-describedby="nameHelp" placeholder="กรอกชื่อ">
                </div>
                <div class="col-md-6">
                    <label for="surname">นามสกุล</label>
                    <input class="form-control" id="texlastname" name="texlastname" type="text" aria-describedby="lastnameHelp" placeholder="กรอกนามสกุล">
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">สิทธิ์การใช้งาน</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"  name="texauth">
                    <option selected>เลือก...</option>                 
                    <option value="1">Admin</option>
                    <option value="2">ผู้ใช้งานทั่วไป</option>

                </select> 
                </div>
                </div>
                </div>
        <input type="hidden" name="_token" >
      <input type="submit" name="submit" value="บันทึก" class="btn btn-primary">
      <input type="reset" value="Reset" class="btn btn-danger">

    </form>

          </div>
    </div>
    <br />

  </div>
  </div>

  <script>
                function users()
    {
        var va_email = document.forms['adduser']['texemail'].value;
        var va_Confirmpassword = document.forms['adduser']['texConfirmpassword'].value;
        var va_password = document.forms['adduser']['texpassword'].value;
        var va_lastname = document.forms['adduser']['texlastname'].value;
        var va_auth = document.forms['adduser']['texauth'].value;
        var va_name = document.forms['adduser']['texname'].value;

       var message = "ยังไม่ได้กรอกข้อมูล \n";
       var valid = true;

       if(va_email == null || va_email=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก Email!!\n";
       }
    
       if(va_lastname == null || va_lastname=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก นามสกุล!!\n";
       }if(va_auth == null || va_auth=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก สิทธิ์การใช้งาน!!\n";
       }
   
    if(va_name == null || va_name=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก ชื่อ!!\n";
       }

       if(( va_password=='') && (va_Confirmpassword !=''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก รหัสผ่าน !!\n");
       }
        if(( va_Confirmpassword=='') && (va_password !=''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก ยืนยันรหัสผ่าน !!\n");
       }
       if((va_password == null || va_password=='') && (va_Confirmpassword == null || va_Confirmpassword ==''))
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก รหัสผ่าน และ  ยืนยันรหัสผ่าน!!\n");
       }
       if(valid == false)
            alert(message);

       return valid;
    }
    </script>
     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script src="vendor/jquery/jquery.min.js"></script>