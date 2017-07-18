<?php
 require_once("dbconnect.php");

session_start();
$today=date("Y-m-d");
   
//pick parameters from budget section
$sector=  mysqli_real_escape_string($con,$_POST['sector']);
$subsector=  mysqli_real_escape_string($con,$_POST['subsector']);
  

//pick parameters from project details section
$projectid=  mysqli_real_escape_string($con,$_POST['projectid']);
$mda=  mysqli_real_escape_string($con,$_POST['mda']);
$projecttitle=  mysqli_real_escape_string($con,$_POST['projecttitle']);
$projectdescription=  mysqli_real_escape_string($con,$_POST['projectdescription']);
$dateofaward=  mysqli_real_escape_string($con,$_POST['dateofaward']);
$projectstatus=  mysqli_real_escape_string($con,$_POST['projectstatus']);
$remarks=  mysqli_real_escape_string($con,$_POST['remarks']);
$projectlocation=  mysqli_real_escape_string($con,$_POST['projectlocation']);
$lga=  mysqli_real_escape_string($con,$_POST['lga']);
$durationofcontract=  mysqli_real_escape_string($con,$_POST['durationofcontract']);
$expecteddateofcompletion=  mysqli_real_escape_string($con,$_POST['expecteddateofcompletion']);

//pick contractor and consultant
$contractor=  mysqli_real_escape_string($con,$_POST['contractor']);
$consultant=  mysqli_real_escape_string($con,$_POST['consultant']);
//pick financials
$contractsum=  mysqli_real_escape_string($con,$_POST['contractsum']);

$mobilisationpaid=  mysqli_real_escape_string($con,$_POST['mobilisationpaid']);

$result=mysqli_query($con, "select * from projectdetails where PROJECTID='$projectid' ");
if(mysqli_num_rows($result)<=0)
{
    echo "no exist";
}
else 
{
    $trans=0;
    mysqli_autocommit($con,false);
    //insert into projectdetails table
    mysqli_query($con, "update projectdetails set PROCURINGENTITY='$mda',TITLE='$projecttitle',DESCRIPTION='$projectdescription',STATUS='$projectstatus',REMARKS='$remarks',LOCATION='$projectlocation',LGA='$lga',DATEOFAWARD='$dateofaward',DURATIONOFCONTRACT='$durationofcontract',EXPECTEDCOMPLETIONDATE='$expecteddateofcompletion',CONTRACTSUM='$contractsum',AGREEDMOBILIZATION='$mobilisationpaid',CONTRACTOR='$contractor',CONSULTANT='$consultant',SECTOR='$sector',SUBSECTOR='$subsector' where PROJECTID='$projectid' ");
                                                                                                                                
    
    if(mysqli_affected_rows($con)>=0)
    {
        $trans++;
    }
    else{
    echo "first error".mysqli_error($con);
    }
    //insert into CERTIFICATES TABLE
$certno=$projectid."-MOBILISATION";
  mysqli_query($con, "update certificates set AMOUNT=$mobilisationpaid where PROJECTID='$projectid' ");
if(mysqli_affected_rows($con)>=0)
    {
        $trans++;
    } else{
   echo "second error".mysqli_error($con);
    }
    if($trans>1)
{
         mysqli_commit($con);
    echo "successful";
    
}
else
{
   mysqli_rollback($con);
    echo "error". mysqli_error($con)."trans is ".$trans;
}


    
    
}

audit_traii("Edited a Project");

mysqli_close($con);
   
?>