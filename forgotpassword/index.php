<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>Surebetting |Password</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="../css/boot-business.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/pricetable.css">
  </head>
  <body>
    
      <?php
      require_once("../php/dbconnect.php");


$email=mysql_real_escape_string(trim($_GET['email']));
$token=mysql_real_escape_string(trim($_GET['token']));
		
$result=mysqli_query($con,"select * from users where EMAIL='$email' and TOKEN='$token' ");
$rowcount=mysqli_num_rows($result);
//START SESSION


if($rowcount>0)
{
    session_start();
$_SESSION['email']=$email;
$_SESSION['token']=$token;

        //send user to password recovery page
header('Location: http://localhost:82/surebettingtips/resetpassword.php');
}
else
{
    echo "<span style=\"font-size:1.5em;color:red; margin-left:50%;\">Invalid link</span>";
}
	
      
      ?>
  </body>
</html>
