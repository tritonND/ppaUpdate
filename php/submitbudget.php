<?php
 require_once("dbconnect.php");

session_start();
$today=date("Y-m-d");
   
//pick parameters from budget section
$sector=  mysqli_real_escape_string($con,$_POST['sector']);
$subsector=  mysqli_real_escape_string($con,$_POST['subsector']);
$budgethead=  mysqli_real_escape_string($con,$_POST['budgethead']);
$budgetsubhead=  mysqli_real_escape_string($con,$_POST['budgetsubhead']);
$budgetcomment=  mysqli_real_escape_string($con,$_POST['budgetcomment']);
        
//pick parameters from appropriation
$approvedappropriation=  mysqli_real_escape_string($con,$_POST['approvedappropriation']);
$supplementaryprovision=  mysqli_real_escape_string($con,$_POST['supplementaryprovision']);
$subsectorallocation=  mysqli_real_escape_string($con,$_POST['subsectorallocation']);
$percentagesubsectorallocation=  mysqli_real_escape_string($con,$_POST['percentagesubsectorallocation']);
$aayear=  mysqli_real_escape_string($con,$_POST['approvedappropriationyear']);
$spyear=  mysqli_real_escape_string($con,$_POST['supplementaryprovisionyear']);
//    

    //insert into budget table
    mysqli_query($con, "insert into budget(PROJECTID,SECTOR,SUBSECTOR,BUDGETHEAD,BUDGETSUBHEAD,COMMENT,APPROPRIATION,SUBSECTORALLOCATION,SUPPLEMENTARYPROVISION,SUBSECTORPERCENTAGE,AAYEAR,SPYEAR) "
            . "values ('$projectid','$sector','$subsector','$budgethead','$budgetsubhead','$budgetcomment',$approvedappropriation,$subsectorallocation,$supplementaryprovision,$percentagesubsectorallocation,'$aayear','$spyear') ");
    if(mysqli_affected_rows($con)<1)
    {
        echo mysqli_error($con);
    }
    echo "successful";

