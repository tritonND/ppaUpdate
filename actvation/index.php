<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>Surebetting |Activation</title>
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


$code=mysql_real_escape_string(trim($_GET['code']));
		
$result=mysqli_query($con,"select * from users where CODE='$code' and ACTIVE=1 ");
$rowcount=mysqli_num_rows($result);

if($rowcount>0)
{
    echo "Your account is already active.";
}
else{
    $result=mysqli_query($con,"update users set ACTIVE=1 where CODE='$code'");
$rowcount=  mysqli_affected_rows($con);
if($rowcount>0)
{
echo 'Account activated successfully';
}
}     
	
      
      ?>
  </body>
</html>
