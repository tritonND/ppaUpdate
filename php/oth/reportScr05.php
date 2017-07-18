<?php
require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

$yr =  mysqli_real_escape_string($con, $_POST['yr']);

//$query1 = "SELECT sum(CONTRACTSUM)  FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' ";
$query1 = "SELECT COUNT(projectdetails.PROJECTID), SUM(projectdetails.CONTRACTSUM),
(SELECT SUM(AMOUNT) from certificates where YEAR(DATEISSUED) ='".$yr."') as cAmount,
(SELECT SUM(AMOUNT) from variations where YEAR(DATEISSUED) ='".$yr."' ) as vAmount
FROM projectdetails  where YEAR(projectdetails.DATEOFAWARD) = '".$yr."' ";


$result = mysqli_query($con, $query1);

if(  mysqli_num_rows($result) >0)
{

    while($user=mysqli_fetch_array($result))
    {
        if(is_null($user[3]))
        {
            echo "<div id=\"projfund3\" class=\"count green currency-format\">".($user[1] - $user[2])."</div>";
        }

       else
           {
               echo "<div id=\"projfund3\" class=\"count green currency-format\">".($user[1] + $user[3] - $user[2])."</div>";
       }

    }
}


else echo "No data";

?>


