<?php
require_once("dbconnect.php");
$email=  mysqli_real_escape_string($con,$_POST['email']);

$result=mysqli_query($con, "SELECT * FROM supervisors where EMAIL='$email' ");
      
       $row=mysqli_fetch_array($result);
       $photo=$row['PHOTO'];
       $fullname=$row['FULLNAME'];
       $cac=$row['CAC'];
       $state=$row['ACTIVE'];
      
      
       
       
      $myarr=  array("fullname"=>$fullname,"cac"=>$cac,"photo"=>$photo,"state"=>$state);
       echo json_encode($myarr);
       
     mysqli_free_result($result);
			mysqli_close($con);           

?>