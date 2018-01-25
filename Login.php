<?php

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');


include("config.php");
session_start(); // starts a session
$error = ''; 

if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $ip = $_SERVER['REMOTE_ADDR']; // gets the ip address of the user
        $userAgent = $_SERVER['HTTP_USER_AGENT']; 

        $hashOfUser = $ip . $userAgent; 
        $iterations = 1000;  //iterations for hashing algorithm

        $salt = "salty"; // salt for the hashing of the ip+useragent.
        $hash = hash_pbkdf2("sha256", $hashOfUser, $salt, $iterations, 32); // hashes the ip + useragent

        $result = mysqli_query($db,"SELECT COUNT(hashedUserAgentIP) AS Count FROM ip WHERE hashedUserAgentIP = '$hash' AND `timestamp` > (now() - interval 5 minute) AND inActive = True"); // query to check the database for matching useragent+ip and couunts them if they are still active
        $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if($row[0]['Count'] >= 3) // locks the user when count reaches 3
            {
                echo "Your are allowed 3 attempts in 5 minutes";
            }
        else
            {
                mysqli_query($db, "INSERT INTO `ip` (`hashedUserAgentIP` ,`timestamp`, `inActiveReg`) VALUES ('$hash',CURRENT_TIMESTAMP, 'False')"); 
                $myusername = filter_var($_POST['username'],FILTER_SANITIZE_STRING); // takes the entered username and Strip tags then and assigns it to a variable
                $mypassword = mysqli_real_escape_string($db,$_POST['password']); //filters out special characters in a string and assigns to a variable

                $salt = "SELECT hashedPassword FROM users WHERE Username = '$myusername'";
                $saltReturn = mysqli_query($db,$salt); 
                $row = mysqli_fetch_all($saltReturn,MYSQLI_ASSOC); 
                    
                $arr = (array)$row; 
                if (empty($arr)) 
                    {
                        $error = "Your Username($myusername) or Password is invalid";
                    }
                else // if the array is not empty
                    {
                        $returned = $row[0]['hashedPassword']; // position 0 holds the hashed password
                        $array =  explode( '$', $returned ); // seperates the hashed password to get the salt
                    
                        $iterations = 1000; 
                        $hash = hash_pbkdf2("sha256", $mypassword, $array[1], $iterations, 32); 
                        $saltyHash = '$' . $array[1] . '$' . $hash; // Concatenating the hashed password with the salt andd dollar signs eg. $Salt$HashedPassword
                        $nameResult = mysqli_query($db,"SELECT id FROM users WHERE Username = '$myusername' and hashedPassword = '$saltyHash'");// query to select the username with the matching username and hashedpassword
                        $nameCount = mysqli_num_rows($nameResult);
                        if($nameCount == 1)
                            {
                                $result = mysqli_query($db,"SELECT id FROM users WHERE Username = '$myusername' and hashedPassword = '$saltyHash'"); 
                                $count = mysqli_num_rows($result);// counts the number of rows in the variable result
                                $query = "UPDATE ip SET inActive = False "; // query to set the inActive flag to false on successful login 
                                $result = mysqli_query($db,$query); 

                                if($count == 1) 
                                    {
                    			         $_SESSION['login_user'] = $myusername;
                    			         header("location: welcome.php"); // goes to the welcome page
                                    }
                            }
                    }
            }
    }
?>
<html>

   <head>
      <title>Login Page</title>

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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post" autocomplete = "off">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/>
                  <input type = "button" value = " Registration " onclick="window.location.href='Register.php'"/><br />
               </form>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>
