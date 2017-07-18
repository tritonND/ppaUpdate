<?php

require_once 'php/dbconnect.php';

$rows = array();

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = ($_POST['id']);

    $query2 = "SELECT projectdetails.PROJECTID,  projectdetails.TITLE , projectdetails.PROCURINGENTITY, projectdetails.CONTRACTSUM, certificates.AMOUNT AS cAmount, variations.AMOUNT AS vAmount
FROM projectdetails
  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = 'aa111'
  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID OR certificates.PROJECTID = 'aa111'
WHERE projectdetails.PROCURINGENTITY = '$id'
GROUP BY projectdetails.PROJECTID;";


    $result2 = mysqli_query($con, $query2);

    while($row2 =mysqli_fetch_array($result2))
    {
        $row_array['PROJECTID'] = $row2['PROJECTID'];
        $row_array['TITLE'] = $row2['TITLE'];
        $row_array['PROCURINGENTITY'] = $row2['PROCURINGENTITY'];
        $row_array['CONTRACTSUM'] = $row2['CONTRACTSUM'];
        $row_array['cAmount'] = $row2['cAmount'];
        $row_array['vAmount'] = $row2['vAmount'];

        array_push($rows,$row_array);

    }
    echo json_encode($rows);

}


