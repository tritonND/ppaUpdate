<?php


require_once("dbconnect.php");

$id=mysqli_real_escape_string($con,trim($_POST['id']));

$result=mysqli_query($con, "select URL from variations where ID='$id'");
$row=mysqli_fetch_array($result);
echo $row['URL'];

 mysqli_close($con);
    
		

?>