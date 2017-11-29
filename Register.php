<?php
   include("config.php");    
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    

        
    if (isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query1 = mysqli_query($db,"SELECT Name FROM user WHERE Name='$username'");

        if (mysqli_num_rows($query1) != 0)
        {
        echo "Username already exists";
        }
        elseif((!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)))
        {
        echo "Password too simple!";
        }
        else
        {
        $passwordBHash = $password;
        $iterations = 1000;

        // Generate a random IV using openssl_random_pseudo_bytes()
        // random_bytes() or another suitable source of randomness
        $salt = openssl_random_pseudo_bytes(16);
        $hash = hash_pbkdf2("sha256", $passwordBHash, $salt, $iterations, 20);
        $query = "INSERT INTO user (Name, Password, Salt) VALUES         ('$username', '$hash', '$salt')";
        mysqli_query($db,$query);
        header("location:Login.php");
        }
	}
   }
?>
<html>
   
   <head>
      <title>Register User</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
