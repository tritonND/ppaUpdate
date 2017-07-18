<?php
require_once("dbconnect.php");
//get parameters sent
$option=  mysqli_real_escape_string($con,$_POST['option']);
$fullname=  mysqli_real_escape_string($con,$_POST['fullname']);
$companyname=  mysqli_real_escape_string($con,$_POST['companyname']);
$email=  mysqli_real_escape_string($con,$_POST['email']);
$phone=  mysqli_real_escape_string($con,$_POST['phone']);
$address=  mysqli_real_escape_string($con,$_POST['address']);
$spec=  mysqli_real_escape_string($con,$_POST['specialization']);
$cac=  mysqli_real_escape_string($con,$_POST['cacnumber']);


    $target_dir = "passports/";
    $target_file = $target_dir . basename($_FILES["passport"]["name"]);
	//copy files to folder
	$pic_name=$_FILES["passport"]["name"];
	$pic_type=$_FILES["passport"]["type"];
	$pic_temp=$_FILES["passport"]["tmp_name"];
        
      
        
	 if (file_exists($target_file)) 
	{
    $randomnum=  uniqid().rand();
    move_uploaded_file($_FILES["passport"]["tmp_name"],$target_dir .$randomnum. $_FILES["passport"]["name"]);
	$prop_pic=mysqli_real_escape_string($con,$target_dir.$randomnum.$pic_name);
	}
	else 
	{
      $prop_pic=mysqli_real_escape_string($con,$target_dir.$pic_name);
      move_uploaded_file($_FILES["passport"]["tmp_name"],$target_dir.$_FILES["passport"]["name"]);
      
    }
    
    $result=mysqli_query($con, "insert into supervisors (TYPE,FULLNAME,ADDRESS,PHONE,EMAIL,SPECIALISATION,COMPANYNAME,PHOTO,CAC) values('$option','$fullname','$address','$phone','$email','$spec','$companyname','$prop_pic','$cac')");
       $rowcount=mysqli_affected_rows($con);
       if($rowcount>0)
       {
        echo "successful";
       }
       else
       {
echo "error";       

       }
        
    

	
        mysqli_close($con);	

?>