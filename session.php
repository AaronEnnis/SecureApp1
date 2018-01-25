<?php


header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
   include('config.php');
   session_start();// Start new session

   $user_check = $_SESSION['login_user']; // Assigns the logged in users username to the variable %user_check

   $ses_sql = mysqli_query($db,"select Username from users where Username = '$user_check' "); 
   $ses1 = mysqli_query($db,"select hashedPassword from users where Username = '$user_check' "); 

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC); 
   $col = mysqli_fetch_array($ses1,MYSQLI_ASSOC); 

   $login_session = $row['Username']; 
   $login1 = $col['hashedPassword'];

   if(!isset($_SESSION['login_user'])){
      header("location:Login.php"); // Sends the user to the Log In page
   }
?>
