<?php
require_once("dbconnect.php");
//get parameters sent
$option=  mysqli_real_escape_string($con,$_POST['option']);
$fullname=  mysqli_real_escape_string($con,$_POST['fullname']);
$companyname=  mysqli_real_escape_string($con,$_POST['companyname']);
$email=  mysqli_real_escape_string($con,$_POST['email']);
$phone=  mysqli_real_escape_string($con,$_POST['phone']);
$address=  mysqli_real_escape_string($con,$_POST['address']);
$spec=  mysqli_real_escape_string($con,$_POST['spec']);
$cac=  mysqli_real_escape_string($con,$_POST['cac']);


    
    
    $result=mysqli_query($con, "update supervisors set TYPE='$option',FULLNAME='$fullname',ADDRESS='$address',PHONE='$phone',SPECIALISATION='$spec',COMPANYNAME='$companyname',CAC='$cac' where EMAIL='$email' ");
       $rowcount=mysqli_affected_rows($con);
       if($rowcount>0)
       {
        echo "successful";
       }
       else
       {
echo "error";       

       }
        
    

	
        mysqli_close($con);	

?>