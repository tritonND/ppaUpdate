<?php
require_once("dbconnect.php");
$email=  mysqli_real_escape_string($con,$_POST['email']);

$result=mysqli_query($con, "SELECT ACTIVE FROM supervisors where EMAIL='$email' ");
      
       $row=mysqli_fetch_array($result);
       $state=$row['ACTIVE'];
      if($state==0)
      {
          echo "already";
      }
      else
      {
          mysqli_query($con, "update supervisors set ACTIVE=0 where EMAIL='$email' ");
          if(mysqli_affected_rows($con)>0)
          {
              echo "successful";
          }
          else{
              echo "error".  mysqli_error($con);
          }
      }
     
     mysqli_free_result($result);

audit_traii("Performed a Blacklist Operation");

mysqli_close($con);

?>