<?php
require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

$startyr =  mysqli_real_escape_string($con, $_POST['yr']);
$endyr = mysqli_real_escape_string($con, $_POST['yr2']);



echo " <table id=\"table1\" class=\"table table-striped table-bordered table-hover\">";
echo "<thead class=\"bg-primary\">";
echo "<tr>";
echo "<th>LOCAL GOVERNMENT AREA</th>";
echo "<th>NUMBER OF PROJECTS</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

// $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' order BY lga LIMIT 5";
// $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY LGA LIMIT 5";

$query1 = "SELECT lga, count(*) FROM projectdetails WHERE DATEOFAWARD BETWEEN '".$startyr."' AND '".$endyr."' GROUP BY LGA LIMIT 4";


$result = mysqli_query($con, $query1);

if(  mysqli_num_rows($result) >0)
{
    //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

    while($user=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td style=\"text-transform: uppercase\">".$user[0]."</td>";
        echo "<td style=\"text-transform: uppercase\">".$user[1]."</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

}

else echo "No data";

?>