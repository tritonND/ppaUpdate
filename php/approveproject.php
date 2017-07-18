<?php
require_once("dbconnect.php");
$id=  mysqli_real_escape_string($con,$_GET['id']);

mysqli_query($con, "update projectdetails set ACTIVE=1 where PROJECTID='$id' ");
      
if(mysqli_affected_rows($con)>0)
{
    echo "successful";
}
 else {
echo "error"    ;
}
      
			mysqli_close($con);           



?>