<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

include("session.php");

?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
    <div align = "center">
		<div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Welcome</b></div>
				<h1 align = "center">Welcome <?php echo $login_session; ?></h1>
				<h1 align = "center"><button type="button" onclick="window.location.href='http://localhost/secureapp1/ChangePassword.php'">Password Change</button></h1>			
				<h1 align = "center"><button type="button" onclick="window.location.href='http://localhost/secureapp1/Logout.php'">Sign Out</button></h1>
				<p> </p>
			</div>	
        </div>
     </div>
   </body>
   
</html>