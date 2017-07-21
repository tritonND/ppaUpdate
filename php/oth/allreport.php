<?php
require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

$yr =  mysqli_real_escape_string($con, $_POST['yr']);
$yr2 =  mysqli_real_escape_string($con, $_POST['yr2']);


if ($yr != 0){
    echo " <table id=\"myTable\" class=\"table table-striped table-bordered table-hover\">";
    echo "<thead class=\"bg-primary\">";
    echo "<tr>";
    echo "<th>REQUISITION ID</th>";
    echo "<th>MDA</th>";
    echo "<th>PROJECT TITLE</th>";
    echo "<th>DESCRIPTION</th>";
    echo "<th>LGA</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' order BY lga LIMIT 5";
    $query1 = "SELECT PROJECTID, REQID, PROCURINGENTITY, TITLE, DESCRIPTION, LGA FROM projectdetails WHERE (DATEOFAWARD) BETWEEN '".$yr."'  AND '".$yr2."' ";

    $result = mysqli_query($con, $query1);

    if(  mysqli_num_rows($result) >0)
    {
        //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

        while($user=mysqli_fetch_array($result))
        {
            echo "<tr>";

            if(is_null($user[1]))
            {$temp = "Nil";}
            else $temp = $user[1];


            echo "<td style=\"text-transform: uppercase\">".$temp."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[2]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[3]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[4]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[5]."</td>";
            echo "<td> <button data-toggle=\"modal\" data-target=\"#view-modal\" data-id=".$user[0]." id=\"getUser\" class=\"btn btn-sm btn-info\"> View</button> </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

    }

    else echo "No data";

}

else
{

    echo " <table id=\"myTable\" class=\"table table-striped table-bordered table-hover\">";
    echo "<thead class=\"bg-primary\">";
    echo "<tr>";
    echo "<th>PROJECT ID</th>";
    echo "<th>MDA</th>";
    echo "<th>PROJECT TITLE</th>";
    echo "<th>DESCRIPTION</th>";
    echo "<th>LGA</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' order BY lga LIMIT 5";
    $query1 = "SELECT PROJECTID, REQID, PROCURINGENTITY, TITLE, DESCRIPTION, LGA FROM projectdetails WHERE (DATEOFAWARD) BETWEEN '".$yr."'  AND '".$yr2."'";

    $result = mysqli_query($con, $query1);

    if(  mysqli_num_rows($result) >0)
    {
        //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

        while($user=mysqli_fetch_array($result))
        {
            echo "<tr>";

            echo "<td style=\"text-transform: uppercase\">".$user[1]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[2]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[3]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[4]."</td>";
            echo "<td style=\"text-transform: uppercase\">".$user[5]."</td>";
            echo "<td> <button data-toggle=\"modal\" data-target=\"#view-modal\" data-id=".$user[0]." id=\"getUser\" class=\"btn btn-sm btn-info\"> View</button> </td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

    }
}



?>