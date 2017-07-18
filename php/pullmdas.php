<?php


require_once("dbconnect.php");

$sector=mysqli_real_escape_string($con,trim($_POST['sector']));

$result=mysqli_query($con, "select CODE,SUBSECTOR from sectors where SECTOR='$sector'");
while($row=mysqli_fetch_array($result))
{
    echo "<OPTION value=".$row['CODE'].">".$row['SUBSECTOR']."</OPTION>";
}


 mysqli_close($con);
    
		

?>