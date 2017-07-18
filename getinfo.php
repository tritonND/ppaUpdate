<?php

	 header('Content-type: application/json; charset=UTF-8');
	require_once 'dbconfig.php';
	
	if (isset($_POST['id']) && !empty($_POST['id'])) {
			
		$id = ($_POST['id']);
		$query = "SELECT * FROM projectdetails WHERE PROJECTID=:id";  
		
      //  $query = "SELECT * FROM projectdetails WHERE PROJECTID= 1";
	//	$result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());
	//	while ($row = mysqli_fetch_assoc($result)){  
		$stmt = $DBcon->prepare( $query );
		$stmt->execute(array(':id'=>$id));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);						
	

		
		  echo json_encode($row);
		exit;
	}		