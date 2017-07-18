<?php
require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

$yr =  mysqli_real_escape_string($con, $_POST['yr']);
$yr2 =  mysqli_real_escape_string($con, $_POST['yr2']);


echo " <table id=\"table7\" class=\"table table-striped table-bordered table-hover\">";
echo "<thead class=\"bg-blue-sky\">";
echo "<tr>";
echo "<th>PROJECT ID</th>";
echo "<th>TOTAL PROJECT SUM</th>";
echo "<th>FUNDS DISBURSED</th>";
echo "<th>OUTSTANDING PAYMENTS</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$query1 = " SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM,
(SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID AND (DATEISSUED) BETWEEN '".$yr."' AND '".$yr2."'  GROUP BY certificates.PROJECTID) as cAmount,
(SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID AND (DATEISSUED) BETWEEN '".$yr."' AND '".$yr2."'  GROUP BY variations.PROJECTID ) as vAmount
FROM projectdetails  where (projectdetails.DATEOFAWARD) BETWEEN '".$yr."' AND '".$yr2."' LIMIT 4";


$result = mysqli_query($con, $query1);

if(  mysqli_num_rows($result) >0)
{
    //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

    while($user=mysqli_fetch_array($result))
    {
        if(is_null($user[2])){
            $temp = 0.0;
        }

        if(is_null($user[3])){
            $temp1 = 0.0;
        }


        echo "<tr>";
        echo "<td style=\"text-transform: uppercase\">".$user[0]."</td>";
        echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".($user[1] + $temp1 )."</td>";
        echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$temp."</td>";
        echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".(($user[1] + $temp1) - $temp)."</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

}

else echo "No data";

?>