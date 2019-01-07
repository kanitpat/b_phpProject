<?php 
require 'dbconnect.php';
$_id = $_SESSION['userid'];
                 $sql = "SELECT *
                 FROM users
                 where users.id = '$_id'";
                $result = mysqli_query($connect,$sql,MYSQLI_STORE_RESULT) or die ("Query error");             
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                
                 $email = $row['email']; 
                 $name = $row['name']; 
                 $lastname = $row['lastname']; 
?>  
              
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="http://localhost/b_phpProject/index.php?cont=Home">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">แก้ไขข้อมูลผู้ใช้งาน</li>
          </ol>

          <div class="card mb-3">
  <div class="card-header">ข้อมูลผู้ใช้งาน</div>
  <div class="card-body">
    <form method="POST" >
    <!-- <form method="POST" action="#"> -->
    <div class="card border-dark">       
          <div class="card-body text-dark">
              <div class="form-group">
                <label for="email">Email address</label>
                <input class="form-control" id="email" name="email" type="email" value="<?php echo $email ?>" aria-describedby="emailHelp" placeholder="Enter email" disabled>
               
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="password">New Password</label>
                    <input class="form-control" id="password" name="password" type="password" placeholder="New Password">                   
                  </div>

                  <div class="col-md-6">
                    <label for="confirm_password">Confirm password</label>
                    <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password">               
                  </div>
                </div>
              </div>
          </div>
    </div>
    <br />
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <label for="name">First name</label>
            <input class="form-control" id="name" name="name"  value="<?php echo $name ?>" type="text" aria-describedby="nameHelp" placeholder="Enter first name">                

          </div>
          <div class="col-md-6">
            <label for="surname">Last name</label>
            <input class="form-control" id="surname" name="lastname" value="<?php echo $lastname ?>" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
                    
          </div>
        </div>
      </div> 
     
      <input type="hidden" name="_method" value="PUT"> 
      <input type="submit" value="Submit" class="btn btn-primary">&nbsp;
      <input type="reset" value="Reset" class="btn btn-danger">

    </form>
  </div>
  </div>

  <?php    

  $valid = true;
        if(!empty($_POST['password']))
            $password = mysqli_escape_string($connect,MD5($_POST['password']));
        else 
            $valid = false;

        if(!empty($_POST['Confirmpassword']))
        {
            if ($_POST["password"] === $_POST["Confirmpassword"])
            {
                // success!
                $conpassword = mysqli_escape_string($connect,$_POST['Confirmpassword']);
            }
        else
        {
            echo "<script> 
                        alert ('ท่านใส่ Password ไม่ตรงกัน ');
                        </script>";
            }
        }   
        else 
            $valid = false;

        if($valid)
        {
            $sql = "SELECT * FROM users
                      WHERE email = '$email'
                      AND   password = '$password'";
            //echo $sql;
                
            $result = mysqli_query($connect, $sql, MYSQLI_STORE_RESULT) or die('DIE');
             $row = mysqli_fetch_assoc($result);
          if( $row ){      
            if($row["isadmin"]==1){
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['Status'] = $row['isadmin'];

                    //echo $_SESSION['u_username'];
                  header("location:http://localhost/phpproject/index.php?cont=Home");

            }      
            elseif($row["isadmin"]==0){
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['Status'] = $row['isadmin'];

                    //echo $_SESSION['u_username'];
                    header("location:http://localhost/phpproject/index.php?cont=Home");

                  }            
                }
        else
                {
                  echo  " <script>   alert('กรอก Email หรือ Password ผิด'); </script>";
                }
        }






?>