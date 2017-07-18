<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connections.php"); ?>
<?php
//User Login 2 (next to My_profile
if(isset($_POST['login'])){
		$login = trim(strip_tags($_POST['login']));
		$profile = "SELECT * FROM user_info WHERE login = '".$login."'";
		$result = mysqli_query($con,$profile)
	or die(mysqli_error($con));
		if(mysqli_num_rows($result)<1){
			header('location:index.php');
                 echo "<a href='index.php' style='color:red;'>Login delcined!" .\n." Return to Home page</a>";       
                }else{
			$row = mysqli_fetch_array($result);
			$_SESSION['log'] = $row['login'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['surname']." ".$row['othernames'];
			$_SESSION['message'] = "Login to proceed...";
		header('location:user_login.php');
                
                }}
?>