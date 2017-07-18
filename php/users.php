
<?php
require_once("dbconnect.php");
$result = mysqli_query($con,"SELECT * FROM users");

?>
<html>
<head></head>
<body>
    <table class="table" id="deleteuserstable" border="0" cellpadding="3" cellspacing="0" style="width:100%;">
      
        <tr style="background-color:#2A3F54; color: white;">
        <th id="snohead" style="padding-right: 0.3em;">S/N </th>
        <th id="usernamehead" style="padding-right: 0.3em;">First Name</th>
        <th id="usertypehead" style="padding-right: 0.3em;">User&nbsp;Type</th>
        <th id="usertypehead" style="padding-right: 0.3em;"></th>
     
    <th>&nbsp;&nbsp;</th>
     </tr>
    <?php
    
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            if($i%2==0)
            {
                echo "<tr class=\"\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FIRSTNAME']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['USERTYPE']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn btn-warning\" data-id=\"{$user['USERNAME']}\" style=\"color:blue;\" >Action</button></td></tr>";
            }
            
            else{
	echo "<tr class=\"active\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line2\">".$user['FIRSTNAME']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" id=\"line4\">".$user['USERTYPE']."</td>";
       echo "<td colspan=\"2\" style=\"max-width:10%;padding-right: 0.3em;\" ><button class=\"myBtn btn-warning\" data-id=\"{$user['USERNAME']}\" style=\"color:blue;\" >Action</button></td></tr>";
         
            }
	$i++;
	}
	?>
    </table>
    <?php
mysqli_close($con);
     
		
?>

</body>
</html>