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

if (!empty($_POST['password'])) {
    $password = mysqli_escape_string($connect, md5($_POST['password']));
} else {
    $valid = false;
}
if (!empty($_POST['Confirmpassword'])) {
    if ($_POST['password'] === $_POST['Confirmpassword']) {
        // success!
        $conpassword = mysqli_escape_string($connect, $_POST['Confirmpassword']);
    } else {
        echo "<script>
		              alert ('ท่านใส่ Password ไม่ตรงกัน ');
                      location.replace('http://localhost/b_phpProject/index.php?cont=สมาชิก');
        </script>";
        // exit();
        // echo "<script>
        // location.replace('http://localhost/b_phpProject/Register.php');
        // </script>";
    }
} else {
    $valid = false;
}
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
if (!empty($_POST['auth'])) {
    $auth = mysqli_escape_string($connect, $_POST['auth']);
} else {
    $valid = false;
}
if (!empty($_POST['email'])) {
    // check if e-mail address is well-formed
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo "<script>
                        alert ('ท่านใส่อีเมล์ไม่ถูกต้อง ตัวอย่าง (somsi007@hotmail.com) ');
                        </script>";
    } else {
        $email = mysqli_escape_string($connect, $_POST['email']);
    }
}
if ($valid == true) {
    $date = date('Y-m-d H:i:s');
    // เช็คอีเมลซ้ำไหม
    $sql_chk_email = "SELECT *
        FROM users
        WHERE email = '$email' ";
    $query_email = mysqli_query($connect, $sql_chk_email);
    if ((mysqli_num_rows($query_email) >= 1)) {
        echo "<script> alert('ขออภัย Email ซ้ำ');
                      window.location='http://localhost/b_phpProject/index.php?cont=สมาชิก';</script>";
        exit();
    } else {
        $strsql = "INSERT INTO  users( `email`, `password`, `name`, `lastname`, `api_token`, `isadmin`, `created_at`, `updated_at`)
            VALUES
            ( '$email', ('$password'), '$name', '$lastname',Null,'$auth',NOW(),NOW())";

        $result = mysqli_query($connect, $strsql) or die('DIE');
        // echo $result;
        // $query_remember = mysqli_query($connect, $sql_remember, MYSQLI_STORE_RESULT) or die('DIE');
        // $row = mysqli_fetch_assoc($query_remember);
        // if ($row) {

        // เข้า login page
        if ($result) {
            echo "<script> alert('ลงทะเบียนสำเร็จ');
                      location.replace('http://localhost/b_phpProject/index.php?cont=สมาชิก');
                      </script>";
        // }
        } else {
            echo "<script> alert('ขออภัยไม่มารถเพิ่มสมาชิกได้');
                      window.location='http://localhost/b_phpProject/index.php?cont=สมาชิก';</script>";
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
                <input class="form-control " id="email" name="email" type="email"  aria-describedby="emailHelp" placeholder="กรอก email" >
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="name">รหัสผ่าน</label>
                    <input class="form-control" id="password" name="password"   type="password" aria-describedby="passHelp" placeholder="กรอกรหัสผ่าน">
                </div>
                <div class="col-md-6">
                    <label for="surname">ยืนยันรหัสผ่าน</label>
                    <input class="form-control" id="Confirmpassword" name="Confirmpassword"  type="password" aria-describedby="conpassHelp" placeholder="ยืนยันรหัสผ่าน">
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="name">ชื่อ</label>
                    <input class="form-control" id="name" name="name" type="text" aria-describedby="nameHelp" placeholder="กรอกชื่อ">
                </div>
                <div class="col-md-6">
                    <label for="surname">นามสกุล</label>
                    <input class="form-control" id="lastname" name="lastname" type="text" aria-describedby="lastnameHelp" placeholder="กรอกนามสกุล">
                </div>
                </div>
                </div>

                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">สิทธิ์การใช้งาน</label>
                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref"  name="auth">
                    <option selected>เลือก...</option>
                    <option value="1">Admin</option>
                    <option value="0">ผู้ใช้งานทั่วไป</option>
                </select> <br /> <br />


      <!-- <input type="hidden" name="_method" value="PUT">  -->
      <input type="submit" value="บันทึก" class="btn btn-primary">
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
        var va_email = document.forms['adduser']['email'].value;
        var va_Confirmpassword = document.forms['adduser']['Confirmpassword'].value;
        var va_password = document.forms['adduser']['password'].value;
        var va_lastname = document.forms['adduser']['lastname'].value;
        var va_auth = document.forms['adduser']['auth'].value;
        var va_name = document.forms['adduser']['name'].value;

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
