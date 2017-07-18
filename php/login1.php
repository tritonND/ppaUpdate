<?php

require_once("dbconnect.php");

session_start();


		$email=trim($_POST['email']);
		$password=trim($_POST['password']);
		$safe_password=md5($password);
	
			$login_query="SELECT * from users where USERNAME='{$email}' and PASSWORD='{$safe_password}'  ";
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
  echo "Invalid email format";
  exit();
}
		$result = mysqli_query($con,$login_query);

			if(mysqli_num_rows($result)>0)
			{
                    $row=mysqli_fetch_array($result);
                    
                    $username=$row['USERNAME'];
                    $usertype=$row['USERTYPE'];
                    $firstname=$row['FIRSTNAME'];
                    

                    $_SESSION['username']=$username;
                    $_SESSION['usertype']=$usertype;
                    $_SESSION['firstname']=$firstname;
                    
                    echo $usertype;
                        }
                        else
                        {
                            echo "Invalid username or password";
                        }
			mysqli_close($con);
			
		


?>