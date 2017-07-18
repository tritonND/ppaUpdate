<?php

echo "in here";
//if (isset($_POST['id']) && !empty($_POST['id'])) {
  //  $id = ($_POST['id']);

    echo "now 1";
    echo "now 1";
    include "php/dbconnect.php";
//$yr =  mysqli_real_escape_string($con, $_POST['yr']);
   // $conn = mysqli_connect("localhost", "root", "minowss", "edpms");


    $query1 = "SELECT projectdetails.PROJECTID,  projectdetails.TITLE , projectdetails.CONTRACTOR, projectdetails.CONTRACTSUM, certificates.AMOUNT AS cAmount, variations.AMOUNT AS vAmount
FROM projectdetails
  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = 'aa111'
  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = 'aa111'
WHERE projectdetails.CONTRACTOR = 'KINETIC INFRASTRUCTION NIG LTD'
GROUP BY projectdetails.PROJECTID;";


    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());



    echo " <table id=\"myModal1\" class=\"table table-striped table-bordered table-hover\">";
    echo "<thead class=\"bg-blue\">";
    echo "<tr>";
    echo "<th>LGA</th>";
    echo "<th>PROJECT SUM</th>";
    echo "<th>CERTIFICATES PAID</th>";
    echo "<th>OUTSTANDING PAYMENTS</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";



    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());

    if (mysqli_num_rows($result) > 0) {

        while ($user = mysqli_fetch_array($result)) {
            echo "<tr>";

            echo "<td style=\"text-transform: uppercase\">" . $user[1] . "</td>";

            echo "<td class=\"currency-format \" style=\"text-transform: uppercase\">" . $user[3] . "</td>";

            echo "<td class=\"currency-format \" style=\"text-transform: uppercase\">" . $user[4] . "</td>";

            echo "<td class=\"currency-format \" style=\"text-transform: uppercase\">" . $user[5] . "</td>";

            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

    } else echo "No data";

//}

?>


