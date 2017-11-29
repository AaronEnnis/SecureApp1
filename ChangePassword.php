<?php
   include("config.php");  
   include("session.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        
    if (isset($_POST['password1']) && isset($_POST['password2'])){

        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $username = $login_session;
        echo $username;

        //$query1 = mysqli_query($db,"SELECT Password FROM user WHERE Name = '$username'");

        if ($login1 != $password1)
        {
        echo "Password does not match";
        }
        elseif((!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password2)))
        {
        echo "Password too simple!";
        }
        else
        {
		
		$passwordBHash = $password2;
        $iterations = 1000;

        // Generate a random IV using openssl_random_pseudo_bytes()
        // random_bytes() or another suitable source of randomness
        $salt = openssl_random_pseudo_bytes(16);

        $hash = hash_pbkdf2("sha256", $passwordBHash, $salt, $iterations, 20);
		
        $query = "UPDATE user SET Password = '$hash', Salt ='$salt' WHERE Name = '$login_session'";
        mysqli_query($db,$query);
        header("location:Logout.php");
        }
 
    }
   }
?>
<html>
   
   <head>
      <title>Change Password</title>
      
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Change Password</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Old Password  :</label><input type = "password" name = "password1" class = "box" /><br/><br />
                  <label>New Password  :</label><input type = "password" name = "password2" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
