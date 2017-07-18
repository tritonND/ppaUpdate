<?php

header('Content-type: application/json; charset=UTF-8');
require_once 'dbconfig.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = ($_POST['id']);
   // $query = "SELECT * FROM projectdetails WHERE PROJECTID=:id";
   //echo $id;
   

    $query = "SELECT projectdetails.PROJECTID AS PROJECTID, projectdetails.CONTRACTSUM AS CONTRACTSUM, projectdetails.AGREEDMOBILIZATION AS AGREEDMOBILIZATION 
                  (SELECT SUM(AMOUNT) from certificates WHERE PROJECTID='".$id."' GROUP BY certificates.PROJECTID) as cAmount, 
                  (SELECT SUM(AMOUNT) from variations WHERE PROJECTID='".$id."' OR PROJECTID='aa111' GROUP BY variations.PROJECTID ) as vAmount 
                  FROM projectdetails
                  JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID 
                  JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID  WHERE PROJECTID='".$id."'
                  GROUP BY projectdetails.PROJECTID";

    //  $query = "SELECT * FROM projectdetails WHERE PROJECTID= 1";
    //	$result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());
    //	while ($row = mysqli_fetch_assoc($result)){

  
    $stmt = $DBcon->prepare( $query1 );
    $stmt->execute(array(':id'=>$id));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);



    echo json_encode($row);
    exit;
}