<?php

require_once("dbconnect.php");


                $password1=mysql_real_escape_string(trim($_POST['password1']));
                $password2=  md5($password1);
                //retrieve the token and email saved to session
                session_start();
                $token=$_SESSION['token'];
                $email=$_SESSION['email'];
                //now update the password
		
       $result=mysqli_query($con, "update users set PASSWORD='$password2' where EMAIL='$email'");
       $rowcount=mysqli_affected_rows($con);
       if($rowcount>0)
       {
           echo "Password successfully changed. Please login.";
       }
                    
                    
	
                        
                        
                        
                        ?>
		
