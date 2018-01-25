<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

//The session is destroyed and the user is sent back to the log in page
   include("session.php");

session_regenerate_id();

unset($_SESSION["PreAuthSess"]);
   
   if(session_destroy()) {
      header("Location: Login.php");
   }
?>
