<?php


require_once("dbconnect.php");
$result = mysqli_query($con,"SELECT * from users");

?>
<html>
<head></head>
<body>
    <table class="projects table" id="projects" border="0" cellpadding="3" cellspacing="0" style="width:100%;text-transform: uppercase;">
        <thead>
        <tr style="background-color:#50A3A2; color: white;">
        <th style="padding-right: 0.3em;">S/N </th>
        <th style="padding-right: 0.3em;">Full Name</th>
        <th style="padding-right: 0.3em;">Address</th>
        <th style="padding-right: 0.3em;">Phone</th>
        <th style="padding-right: 0.3em;">Email</th>
        <th style="padding-right: 0.3em;">Specialization</th>
       
        </tr>
        </thead>
        <tbody>
    <?php
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            if($i%2==0)      
                {

     echo "<tr class=\"info\"><td style=\"padding-right: 0.3em; \">{$i}.</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['FULLNAME']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['ADDRESS']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['PHONE']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['EMAIL']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['SPECIALISATION']."</td>";
	
        
            }
            else{
	echo "<tr class=\"\"><td style=\"padding-right: 0.3em; \">{$i}.</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['FULLNAME']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['ADDRESS']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['PHONE']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['EMAIL']."</td>";
     echo "<td style=\"padding-right: 0.3em;\" >".$user['SPECIALISATION']."</td>";
        
        
            }
	$i++;
	}
	?>
        </tbody>
    </table>
    <?php

    mysqli_close($con); 
		
?>

</body>
</html>