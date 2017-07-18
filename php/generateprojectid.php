<?php
require_once("dbconnect.php");
$mda=  mysqli_real_escape_string($con,$_POST['mda']);
$mdatext=  mysqli_real_escape_string($con,$_POST['mdatext']);


$result=mysqli_query($con, "SELECT max(ID) FROM projectdetails ");
      
       $row=mysqli_fetch_array($result);
       $nxtid=$row[0]+1;
       $paddedid=str_pad($nxtid, 4, '0', STR_PAD_LEFT);
       $generatedid=$paddedid;
      echo $generatedid; 
      
       
     mysqli_free_result($result);
			mysqli_close($con);           



?>