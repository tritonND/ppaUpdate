<?php

require_once("dbconnect.php");


		$username=mysqli_real_escape_string($con,trim($_POST['username']));
                $usertype=mysqli_real_escape_string($con,trim($_POST['usertype']));
		$dept=mysqli_real_escape_string($con,trim($_POST['dept']));
                
		$new_user_query="update users set UserType='$usertype',Dept='$dept' where Username='$username'";
			
                if(!mysqli_query($con,$new_user_query))
                {
                   echo "Error!";
                   exit();
                }
                else
                {
                 
                    $result = mysqli_query($con,"SELECT * FROM users");


                        
                    echo "<tr style=\"background-color:#50A3A2; color: white;\">";
        echo "<th style=\"padding-right: 0.3em;\">S/N </th>";
        echo "<th style=\"padding-right: 0.3em;\">First Name</th>";
    echo "<th style=\"padding-right: 0.3em;\">User&nbspType</th>";
     echo "<th style=\"padding-right: 0.3em;\">Department</th>";
     echo "<th>&nbsp;&nbsp;</th>";
     echo "</tr>";
    
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
           if($i%2==0)
            {
                echo "<tr class=\"\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FirstName']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['UserType']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line3\">".$user['Dept']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn\" data-username2=\"{$user['Username']}\" style=\"color:blue;\" >Edit</button></td></tr>";
            }
            
            else{
	echo "<tr class=\"active\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FirstName']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['UserType']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line3\">".$user['Dept']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn\" data-username2=\"{$user['Username']}\" style=\"color:blue;\" >Edit</button></td></tr>";
         
            }
	$i++;                 
           
	}
	
        
        mysqli_close($con);
        
	
                }
                        
                        
 ?>
		


