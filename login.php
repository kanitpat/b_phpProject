<?php
ob_start();
session_start();
?>
<html>
<head>

<meta charset="utf-8">
    <link rel="icon" type="image/png" href="https://sv1.picz.in.th/images/2019/01/10/9nEctk.png" />
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
<!DOCTYPE html>
<style>  @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

.login-block{
    background: #DE6262;  /* fallback for old browsers */
background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
float:left;
width:100%;
padding : 50px 0;
}
.banner-sec{background:url()  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
.carousel-inner{border-radius:0 10px 10px 0;}
.carousel-caption{text-align:left; left:5%;}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
.banner-text h2{color:#fff; font-weight:600;}
.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
.banner-text p{color:#fff;}  </style>
</head>
<body>
          <div class="login-block" >
          <div class="container">
          <div class="row">
          <div class="col-md-4 login-sec">
              <h2 class="text-center">Login</h2>
              <form class="login-form" name='login' method="POST"  onSubmit="return loginnn() chk_form()">

                  <div class="form-group" >
                    <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                    <input  type="text" class="form-control" placeholder="Enter Email"   name="email" required autofocus>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required >
                    </div>

                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <small>Remember Me</small>
                    </label>
                    <button type="submit" class="btn btn-login float-right">login</button>
                    </div>
                    </form>

                    <h1><div class="copy-text"> <a href="http://localhost/b_phpProject/register.php">Register</a></div><h1>
            </div>

            <div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img class="d-block w-100" src="https://scontent.fbkk2-7.fna.fbcdn.net/v/t1.0-9/20994067_1744260595587634_8990168459990914537_n.png?_nc_cat=106&_nc_ht=scontent.fbkk2-7.fna&oh=7168324e24379bd495b2028e27a53e84&oe=5C710793" alt="First slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="https://scontent.fbkk2-7.fna.fbcdn.net/v/t1.0-9/22310395_1787739394573087_6465279703412267286_n.jpg?_nc_cat=106&_nc_ht=scontent.fbkk2-7.fna&oh=653e4d052fcaa7f25972f65605b85d05&oe=5C7BDF63" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="https://scontent.fbkk2-7.fna.fbcdn.net/v/t1.0-9/302255_322072437806464_671318486_n.jpg?_nc_cat=111&_nc_ht=scontent.fbkk2-7.fna&oh=023056346e627670be09458db21ded54&oe=5C7488B6" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div>
          </div>
        </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

    <script>
                function loginnn()
    {
       var email = document.forms['login']['email'].value;
       var password = document.forms['login']['password'].value;


       var message = "ยังกรอกข้อมูลไม่ครบ \n";
       var valid = true;

       if(email == null || email=='')
       {
           valid = false;
           message = message + " - ไม่ได้กรอก Email !!\n";
       }

       if(password == null || password=='')
       {
           valid = false;
           message = message + (" - ไม่ได้กรอก Password !!\n");
       }

       if(valid == false)
            alert(message);

       return valid;
    }
    
    function chk_form(){
    var j_keep_login=document.form1.keep_login;
    var i_username=document.form1.username.value;
    var i_password=document.form1.password.value;
    if(j_keep_login.checked==true){
        var days=10; // กำหนดจำนวนวันที่ต้องการให้จำค่า
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
        document.cookie = "CK_username=" +i_username+ "; expires=" + expires + "; path=/";
        document.cookie = "CK_password=" +i_password+ "; expires=" + expires + "; path=/";
    }else{
        var expires="";
        document.cookie = "CK_username="+expires+";-1;path=/";
        document.cookie = "CK_password="+expires+";-1;path=/";      
    }
}
    </script>
</body>
</html>

<?php
require 'dbconnect.php';
$valid = true;

if (!empty($_POST['email'])) {
    $email = mysqli_escape_string($connect, $_POST['email']);
} else {
    $valid = false;
}
if (!empty($_POST['password'])) {
    $password = mysqli_escape_string($connect, md5($_POST['password']));
} else {
    $valid = false;
}
if ($valid) {
    $sql = "SELECT * FROM users
                      WHERE email = '$email'
                      AND   password = '$password'";
    //echo $sql;
    $result = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die('DIE');
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        if ($row['isadmin'] == 1) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['Status'] = $row['isadmin'];

            //echo $_SESSION['u_username'];
            header('location:http://localhost/b_phpProject/index.php?cont=Home');
        } elseif ($row['isadmin'] == 0) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['Status'] = $row['isadmin'];

            //echo $_SESSION['u_username'];
            header('location:http://localhost/b_phpProject/index.php?cont=Home');
        }
    } else {
        echo " <script>   alert('กรอก Email หรือ Password ผิด'); </script>";
    }
}

?>