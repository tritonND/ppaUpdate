<?php
require_once("dbconnect.php");

$id=mysqli_real_escape_string($con,trim($_POST['dataid']));
$result=mysqli_query($con, "SELECT * FROM users where USERNAME='$id' ");
      
       $row=mysqli_fetch_array($result);
       $fullname=$row['FIRSTNAME']." ".$row['OTHERNAMES'];
       $priv=$row['PRIVILEGES'];
       
      $myarr=  array("fullname"=>$fullname,"priv"=>$priv);
       echo json_encode($myarr);
       
                
       
   
       

	
	

?>