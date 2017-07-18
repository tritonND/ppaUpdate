<?php
require_once 'php/dbconnect.php';
$rows = array();
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = ($_POST['id']);


$query2 = "SELECT projectdetails.PROJECTID,  projectdetails.TITLE , projectdetails.CONTRACTOR, projectdetails.CONTRACTSUM, certificates.AMOUNT AS cAmount, variations.AMOUNT AS vAmount
FROM projectdetails
  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = 'aa111'
  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = 'aa111'
WHERE projectdetails.CONTRACTOR = '$id'
GROUP BY projectdetails.PROJECTID;";


    // $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($con, $query2);
    //  $resarray1 = array();
    //  $resarray2 = array();
    //   while($row1 = mysqli_fetch_array(mysqli_query($conn, $query1)))
    // {$resarray1 = $row1;    }

    while($row2 =mysqli_fetch_array($result2))
    {
        $row_array['PROJECTID'] = $row2['PROJECTID'];
        $row_array['TITLE'] = $row2['TITLE'];
        $row_array['CONTRACTOR'] = $row2['CONTRACTOR'];
        $row_array['CONTRACTSUM'] = $row2['CONTRACTSUM'];
        $row_array['cAmount'] = $row2['cAmount'];
        $row_array['vAmount'] = $row2['vAmount'];

        array_push($rows,$row_array);
    }

    echo json_encode($rows);

}

