<?php
require_once("dbconnect.php");
//get parameters sent
$firstname=  mysqli_real_escape_string($con,$_POST['firstname']);
$othernames=  mysqli_real_escape_string($con,$_POST['othernames']);
$password=  mysqli_real_escape_string($con,$_POST['password']);
$usertype=  mysqli_real_escape_string($con,$_POST['usertype']);
$email=  mysqli_real_escape_string($con,$_POST['username']);
$code=  md5($email);
$safe_password=  md5($password);


$result=mysqli_query($con,"select * from users where USERNAME='$email'");//checks if account already exist
$new_user_query="INSERT INTO users(FIRSTNAME,OTHERNAMES,USERNAME,PASSWORD,USERTYPE,CODE) VALUES('$firstname', '$othernames','$email','$safe_password', '$usertype','$code')";
		
                 if(mysqli_num_rows($result)>0)
                {
                echo "existing";
                }
                
              
                else if(!mysqli_query($con,$new_user_query))
                {
                   echo "Error!".  mysqli_error($con);
                   exit();
                }
                else{
                    
                    //now pull the users table and display it
                    $result = mysqli_query($con,"SELECT * FROM users");


                        
                    echo "<tr style=\"background-color:#50A3A2; color: white;\">";
        echo "<th style=\"padding-right: 0.3em;\">S/N </th>";
        echo "<th style=\"padding-right: 0.3em;\">First Name</th>";
    echo "<th style=\"padding-right: 0.3em;\">User&nbspType</th>";
     echo "<th style=\"padding-right: 0.3em;\"></th>";
     echo "<th>&nbsp;&nbsp;</th>";
     echo "</tr>";
    

	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            if($i%2==0)
            {
                echo "<tr class=\"\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FIRSTNAME']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['USERTYPE']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn\" data-id=\"{$user['USERNAME']}\" style=\"color:blue;\" >delete</button></td></tr>";
            }
            
            else{
	echo "<tr class=\"active\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FIRSTNAME']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['USERTYPE']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn\" data-id=\"{$user['USERNAME']}\" style=\"color:blue;\" >delete</button></td></tr>";
         
            }
	$i++;
	}
	
        
        
                    //
                    
                    
                }

?>