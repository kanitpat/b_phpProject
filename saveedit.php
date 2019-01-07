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
                 $isadmin = $row['isadmin']; 
  $valid = true;
        
        if(!empty($_POST['password']))
        {
            $password = mysqli_escape_string($connect,MD5($_POST['password']));
        }
        else $valid = false;

        if(!empty($_POST['name']))
        {
            $name = mysqli_escape_string($connect,$_POST['name']);
        }
        else $valid = false;  

        if(!empty($_POST['lastname']))
        {
            $lastname = mysqli_escape_string($connect,$_POST['lastname']);
        }
        else $valid = false;    

        if(!empty($_POST['Confirmpassword']))
        {
            if ($_POST["password"] === $_POST["Confirmpassword"])
            {
                // success!
                $conpassword = mysqli_escape_string($connect,MD5($_POST['Confirmpassword']));
            }
            else
            {
                echo "<script> 
                            alert ('ท่านใส่ Password ไม่ตรงกัน ');
                            </script>";
            }
        }
        else $valid = false;
           
        if($valid == true){
            $date = date("Y-m-d H:i:s");

            $sql2 = "UPDATE  myprojectphp.users SET           
                    password = '$conpassword' ,                  
                    name = '$name',
                    lastname = '$lastname',
                    created_at = '$date',
                    updated_at ='$date',
                    WHERE users.id = '$_id' ";
echo $sql2;

            $result2 = mysqli_query($connect, $sql2,MYSQLI_STORE_RESULT) or die ("Query error");      
            mysqli_close($connect);    
            if($result2)
            {
                  echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>" ;
              }     
            else           
            {
                  echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้');</script>";
            }

        }
?>