<?php  
require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

 $yr =  mysqli_real_escape_string($con, $_POST['yr']);

$query1 = "SELECT sum(CONTRACTSUM)  FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' "; 


  $result = mysqli_query($con, $query1);
 
  if(  mysqli_num_rows($result) >0)
    {

while($user=mysqli_fetch_array($result))
  {
    echo "<div id=\"projfund\" class=\"count currency-format\">".($user[0] + 0)."</div>";
  } 
}

else echo "No data";

?>

 
