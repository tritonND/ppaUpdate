
    
<?php

require_once("dbconnect.php");

        $username=  mysqli_real_escape_string($con,$_POST['dataid']);
        $query="DELETE FROM users WHERE USERNAME='{$username}'";

        mysqli_query($con,$query);
        if(mysqli_affected_rows($con)>0)
        {

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
	
        }
        else
        {
            echo "error";
        }

audit_traii("Deleted a User");

mysqli_close($con);
        
	


?>
  