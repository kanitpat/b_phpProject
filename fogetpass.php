<?php
ob_start();
session_start();
error_reporting(-1);
ini_set('display_errors', 'true');
?>
<?php
require 'dbconnect.php';
$valid = true;

if (!empty($_POST['texemail'])) {
    $email = mysqli_escape_string($connect, $_POST['texemail']);
} else {
    $valid = false;
}
if (!empty($_POST['texemail'])) {
    $email = mysqli_escape_string($connect, $_POST['texemail']);
} else {
    $valid = false;
}

if ($valid) {
    if (isset($_POST['submit'])) {
        $sql_forget = "SELECT * FROM users WHERE email = '$email' ";
        $query = mysqli_query($connect, $sql_forget, MYSQLI_STORE_RESULT) or die(mysqli_error($connect));
        $row = mysqli_fetch_assoc($query);
        // echo $sql_remember;
        //เจอ
        if ($row) {
            $to = 'demo@localhost.com'; /// email ที่จะส่งหาแต่ละคน
            $to_user = 'ผู้ใช้ Demo';
            $subject = 'ข้อมูลผู้ใช้งาน';
            $from_user = 'wattana@localhost.com';
            // ให้รองรับการแสดงภาษาไทยในโปรแกรม อ่านอีเมล
            $to_user = '=?UTF-8?B?'.base64_encode($to_user).'?=';
            $from_user = '=?UTF-8?B?'.base64_encode($from_user).'?=';
            $subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
            $body = 'รายละเอียดข้อมูลผู้ใช้งาน <br>';
            $body .= 'Email : '.$row['email'].'<br>';
            $body .= 'Password : '.$row['password'].'<br>';

            $headers   = array();
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = "To: $to_user <$to>";
            $headers[] = "From: $from_user <postmaster@localhost.com>";
            //$headers[] = "Cc: Name CC <postmaster@localhost.com>";
            //$headers[] = "Bcc: Name BCC <postmaster@localhost.com>";
            //$headers[] = "Reply-To: Postmaster <postmaster@localhost.com>";
            $headers[] = "Subject: $subject";
            $headers[] = 'X-Mailer: PHP/'.phpversion();
            if (mail($to, $subject, $body, implode("\r\n", $headers))) {
                // echo 'ส่งอีเมลเรียบร้อยแล้ว!';
                echo "<script> alert('ส่งอีเมลเรียบร้อยแล้ว!');
                location.replace('http://localhost/b_phpProject/fogetpass.php');
                </script>";
            } else {
                // echo 'เกิดข้อผิดพลาด...';
                echo "<script> alert('เกิดข้อผิดพลาด...!');
                location.replace('http://localhost/b_phpProject/fogetpass.php');
                </script>";
            }
            // $strTo = $row['email'];
            // $strSubject = 'ข้อมูลรหัสผ่านของคุณ';
            // $strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
            // $strHeader .= "From: wattana@hotmail.com\nReply-To: wattana@hotmail.com";
            // $strMessage = '';
            // $strMessage .= 'Welcome : '.$row['name'].'<br>';
            // $strMessage .= 'Email : '.$row['email'].'<br>';
            // $strMessage .= 'Password : '.$row['password'].'<br>';
            // $strMessage .= '=================================<br>';
            // $strMessage .= 'wattana.Com<br>';
            // $flgSend = mail($strTo, $strSubject, $strMessage, $strHeader);
        } else {//ไม่เจอข้อมูล
            echo "<script> alert('ไม่เจอ Email ผู้ใช้งาน');
            location.replace('http://localhost/b_phpProject/fogetpass.php');
            </script>";
            // mysqli_close();
        }
    }
}
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
              <h2 class="text-center">ลืมรหัสผ่าน</h2>
              <form class="login-form" name='forget' id='forget' method="POST"  >

                  <div class="form-group" >
                    <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                    <input  type="text" class="form-control" placeholder="กรอก Email"  id="texemail"  name="texemail" required autofocus>
                    </div>               
                    <div class="form-check">              
                    <button type="submit" name = "submit" class="btn btn-login float-right">ส่งรหัสผ่าน</button>
                    </div>
                    </form>
                    <h1><div class="copy-text"> <a href="http://localhost/b_phpProject/login.php">เข้าสู่ระบบ</a></div><h1>

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
</body>
</html>

