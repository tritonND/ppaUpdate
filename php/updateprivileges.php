<?php
require_once("dbconnect.php");
//get parameters sent
$priv=  mysqli_real_escape_string($con,$_POST['priv']);
$email=  mysqli_real_escape_string($con,$_POST['dataid']);

mysqli_query($con, "update users set PRIVILEGES='$priv' where USERNAME='$email' ");
if(mysqli_affected_rows($con)>=0)
{
    echo "successful";
}
 else 
    
 {
     echo "error";
 }

 mysqli_close($con);

?>