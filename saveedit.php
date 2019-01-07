<html>
    <body>
        <?php
        $_id = $_SESSION['userid'];
        require 'dbconnect.php';
        $strSQL = "UPDATE users SET                
                    name = '$_POST['name']'
                    lastname = '$_POST['lastname']'
                    password = 'MD5($_POST['password'])'                   
                    WHERE users.id = '$_id' ";

        $objQuery = mysqli_query($connect,$strSQL,MYSQLI_STORE_RESULT) or die ("Query error");




        ?>




    </body>



</html>