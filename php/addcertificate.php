<?php
require_once("dbconnect.php");
//get parameters sent
$projectid=  mysqli_real_escape_string($con,$_POST['projectid']);
$certno=  mysqli_real_escape_string($con,$_POST['certno']);
$amount=  mysqli_real_escape_string($con,$_POST['amount']);
$dateissued=  mysqli_real_escape_string($con,$_POST['dateissued']);


$result2 = mysqli_query($con, "SELECT LGA, PROCURINGENTITY FROM projectdetails WHERE PROJECTID = '$projectid'");
$row2 = mysqli_fetch_array($result2);
$lga = $row2[0];
$mda = $row2[1];

//echo $lga;
//echo $mda;

$result=mysqli_query($con, "select * from certificates where CERTNUMBER='$certno' ");
if(mysqli_num_rows($result)>0)
{
    echo "exist";
}
else
{
    $target_dir = "photos/";
    $target_file = $target_dir . basename($_FILES["certphoto"]["name"]);
	//copy files to folder
	$pic_name=$_FILES["certphoto"]["name"];
	$pic_type=$_FILES["certphoto"]["type"];
	$pic_temp=$_FILES["certphoto"]["tmp_name"];
        
        if($pic_name=="")//dont upload since no new profile image is found
        {
         echo "no image";

            
        }
        else{
        
	 if (file_exists($target_file)) 
	{
    $randomnum=  uniqid().rand();
    move_uploaded_file($_FILES["certphoto"]["tmp_name"],$target_dir .$randomnum. $_FILES["certphoto"]["name"]);
	$prop_pic=mysqli_real_escape_string($con,$target_dir.$randomnum.$pic_name);
	}
	else 
	{
            $prop_pic=mysqli_real_escape_string($con,$target_dir.$pic_name);
      move_uploaded_file($_FILES["certphoto"]["tmp_name"],$target_dir.$_FILES["certphoto"]["name"]);
      
    }
    
    $result=mysqli_query($con, "insert into certificates (PROJECTID,CERTNUMBER,DATEISSUED,AMOUNT,STATUS,URL, MDA, LGA) values('$projectid','$certno','$dateissued','$amount','issued','$prop_pic', '$mda', '$lga')");
       $rowcount=mysqli_affected_rows($con);
       if($rowcount>0)
       {
           echo "successful";
       }
       else
       {
echo "error";       }
        }
    

}



    audit_traii("Added Certificate");


        mysqli_close($con);	

?>