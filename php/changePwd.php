<?php 
 
 require_once("dbconnect.php");
 
 session_start();
 $username = $_SESSION['username'];
 
 
    $opass = trim(strip_tags($_POST['opass']));     
    $npass = trim(strip_tags($_POST['npass']));
	
	$spo = md5($opass);
	$spn = md5($npass);
	
	
	$sql = 'UPDATE users set password = "'.$spn.'" where username = "'.$username.'" and password = "'.$spo.'" ';
	
	$results = mysqli_query($con, $sql );
	
	if(!mysqli_query($con, $sql)) 
	{
		echo "Not successful";
	}
	else
	{
		echo "success";
	}


audit_traii("Changed Password");

	
   