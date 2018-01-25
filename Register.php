<?php
include("config.php");

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (isset($_POST['username']) && isset($_POST['password']))
        {
            $username = $_POST['username']; 
            $password = $_POST['password'];
            
            $ip = $_SERVER['REMOTE_ADDR']; // gets the ip address of the user 
            $userAgent = $_SERVER['HTTP_USER_AGENT']; // gets the user agent details of the user

            $hashOfUser = $ip . $userAgent; 
            $iterations = 1000;

            $salt = "salty"; 
            $hash = hash_pbkdf2("sha256", $hashOfUser, $salt, $iterations, 32); 

            $result = mysqli_query($db,"SELECT COUNT(hashedUserAgentIP) AS Count FROM ip WHERE hashedUserAgentIP = '$hash' AND `timestamp` > (now() - interval 5 minute) AND inActiveReg = True"); 
            $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

            if($row[0]['Count'] >= 3) // if the value returned by the query is 3 or more to stop the database crashing from too many entries
                {
                    echo "Your are only allowed to create 3 accounts in a time period";
                }
            else
                {
                    mysqli_query($db, "INSERT INTO `ip` (`hashedUserAgentIP` ,`timestamp`, `inActive`) VALUES ('$hash',CURRENT_TIMESTAMP, 'True')");
                
                    if (isset($_POST['username']) && isset($_POST['password'])) 
                    {
                        $username = $_POST['username']; 
                        $password = $_POST['password']; 
                        
                        if (mysqli_num_rows(mysqli_query($db,"SELECT Username FROM users WHERE Username='$username'")) != 0) // query to check if the username already exists
                        {
                            echo "Username already exists";
                        }
                        elseif((!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password))) // query to check if the password is strong enough
                        {
                            echo "Password not complex enough";
                        }
                        else // hashes the new users details and adds them to the database
                        {	
                            $iterations = 1000; 
                            $salt = random_bytes(32); 
                            $hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 32); 
                            $saltHash = '$' . $salt . '$' . $hash; 
                            $result = mysqli_query($db,"INSERT INTO users (Username, hashedPassword) VALUES  ('$username', '$saltHash')");
                            header("location:Login.php"); 
                        }
                    }
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

               <form action = "" method = "post" autocomplete = "off">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>

            </div>

         </div>

      </div>

   </body>
</html>
