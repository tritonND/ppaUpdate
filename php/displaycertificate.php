<?php


require_once("dbconnect.php");

$id=mysqli_real_escape_string($con,trim($_POST['id']));

$result=mysqli_query($con, "select URL,ORACLENUMBER from certificates where ID='$id'");
$row=mysqli_fetch_array($result);
  $url=$row['URL'];
  $oracle=$row['ORACLENUMBER'];
       
      $myarr=  array("url"=>$url,"oracle"=>$oracle);
       echo json_encode($myarr);
       

 mysqli_close($con);
    
		

?>