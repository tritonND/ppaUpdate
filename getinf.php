<?php

//header('Content-type: application/json; charset=UTF-8');
require_once 'php/dbconnect.php';
//require_once 'dbconfig.php';
$rows = array();

if (isset($_POST['id']) && !empty($_POST['id'])) {

   $id = ($_POST['id']);


    $query1 = "SELECT * from projectdetails where PROJECTID= '$id'";
    $query2 = "SELECT SUM(AMOUNT) AS cAmount from certificates WHERE PROJECTID='$id'";
    $query3 = "SELECT SUM(AMOUNT) AS vAmount from variations WHERE PROJECTID='$id' OR PROJECTID='aa111'";

    $query = "SELECT projectdetails.PROJECTID AS PROJECTID, projectdetails.CONTRACTSUM AS CONTRACTSUM, projectdetails.AGREEDMOBILIZATION AS AGREEDMOBILIZATION 
                  (SELECT SUM(AMOUNT) from certificates WHERE PROJECTID='".$id."' GROUP BY certificates.PROJECTID) as cAmount, 
                  (SELECT SUM(AMOUNT) from variations WHERE PROJECTID='".$id."' OR PROJECTID='aa111'  GROUP BY variations.PROJECTID ) as vAmount 
                  FROM projectdetails
                  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID 
                  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID  WHERE PROJECTID='".$id."'
                  GROUP BY projectdetails.PROJECTID";

    //  $query = "SELECT * FROM projectdetails WHERE PROJECTID= 1";
    //	$result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());
    //	while ($row = mysqli_fetch_assoc($result)){


   // $stmt = $DBcon->prepare( $query );
   // $stmt->execute(array(':id'=>$id));
   // $row=$stmt->fetch(PDO::FETCH_ASSOC);

    $result1 = mysqli_query($con, $query1);
    $result2 = mysqli_query($con, $query2);
    $result3 = mysqli_query($con, $query3);


    $resarray1 = array();
    $resarray2 = array();
    $resarray3 = array();


    while($row1 =mysqli_fetch_assoc($result1))
    {
        $resarray1 = $row1;
    }

    while($row2 =mysqli_fetch_assoc($result2))
    {
        $resarray2 = $row2;
    }


    while($row3 =mysqli_fetch_assoc($result3))
    {
        $resarray3 = $row3;
    }


    $myarray = array("r1"=>$resarray1, "r2"=>$resarray2, "r3"=>$resarray3);
    echo json_encode($myarray);


    exit;
}