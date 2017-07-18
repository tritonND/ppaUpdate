<?php

require_once("dbconnect.php");


                $email=mysql_real_escape_string(trim($_POST['email']));
		 $result=mysqli_query($con,"select * from users where EMAIL='$email'");//checks if  account exist
                 $row=mysqli_fetch_array($result);
                 $rowcount=  mysqli_num_rows($result);
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                echo "Invalid email";
                exit();
                }
                  
                else if($rowcount<1)
                {
                  echo "This email does not exist in our database";  
                }
                    else{
                        $token=  rand(1, 10);
                        mysqli_query($con, "update users set TOKEN='$token' where EMAIL='$email'");
                    
                    $link="http://localhost:82/surebettingtips/forgotpassword?email=".$email."&token=".$token;
                    //send an activation mail
                    
$to = $email;
$subject = "Your password reset";

$message = "
<html>
<head>
<title>Activate Account</title>
</head>
<body>
<p>Please click on the link below to reset your password. <br>".$link." <br> Cheers!:"."

</p>

</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <josephdokhare@gmail.com>' . "\r\n";
$headers .= 'Cc: josephdokhare@yahoo.com' . "\r\n";

mail($to,$subject,$message,$headers);

                    
                   //
         echo "successful";
        
                }
                        
               
	
                        
                        
                        
                        ?>
		
