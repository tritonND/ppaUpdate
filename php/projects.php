<?php


require_once("dbconnect.php");
@session_start();

$usertype=$_SESSION['usertype'];
if($usertype=="ALL"){
$result = mysqli_query($con,"SELECT PROJECTID,TITLE,DESCRIPTION,LGA FROM projectdetails");
}
 else {
    $result=mysqli_query($con, "select SUBSECTOR from sectors where CODE='$usertype' ");
    $row=  mysqli_fetch_array($result);
    $mda=$row[0];
$result = mysqli_query($con,"SELECT PROJECTID,TITLE,DESCRIPTION,LGA FROM projectdetails where PROCURINGENTITY='$mda' ");
}
?>
<html>
<head></head>
<body>
    <table class="projects table" id="projects" border="0" cellpadding="3" cellspacing="0" style="width:100%;text-transform: uppercase; font-size : 1.0em">
        <thead>
        <tr style="background-color:#50A3A2; color: white;">
        <th style="padding-right: 0.3em;">S/N </th>
        <th style="padding-right: 0.3em;">PROJECT_ID</th>
        <th style="padding-right: 0.3em;">TITLE</th>
        <th style="padding-right: 0.3em;">DESCRIPTION</th>
        <th style="padding-right: 0.3em;">LGA'S</th>
        <th style="padding-right: 0.3em;">ACTION</th>
        <th style="padding-right: 0.3em;"></th>
        <th style="padding-right: 0.3em;"></th>
        
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
     echo "<td style=\"padding-right: 0.3em;\" >".$user['PROJECTID']."</td>";
	echo "<td style=\"padding-right: 0.3em;\" ><a href=\"#\" data-id=\"".$user['PROJECTID']."\" class=\"cert\">".$user['TITLE']."</a></td>";
	echo "<td style=\"padding-right: 0.3em;\" >".$user['DESCRIPTION']."</td>";
        echo "<td style=\"padding-right: 0.3em;\" >".$user['LGA']."</td>";
        echo "<td style=\"padding-right: 0.3em;\" ><select id=\"sel1\" class=\"chooseaction\" style=\"width:100px;height:30px;\"><option>Choose</option><option class=\"delete\" data-id=\"".$user['PROJECTID']."\">Delete</option><option class=\"edit\" data-id=\"".$user['PROJECTID']."\">Edit</option></select></td>";
        echo "<td style=\"padding-right: 0.3em;\" ><a class=\"btn btn-default cert\" data-id=\"".$user['PROJECTID']."\">Certificates</a></td>";
        echo "<td style=\"padding-right: 0.3em;\" ><a class=\"btn btn-warning variations\" data-id=\"".$user['PROJECTID']."\">Variations</a></td>";
      
        
            }
            else{
	echo "<tr class=\"\"><td style=\"padding-right: 0.3em; \">{$i}.</td>";
       echo "<td style=\"padding-right: 0.3em;\" >".$user['PROJECTID']."</td>";
	echo "<td style=\"padding-right: 0.3em;\" ><a href=\"#\" data-id=\"".$user['PROJECTID']."\" class=\"cert\">".$user['TITLE']."</a></td>";
	echo "<td style=\"padding-right: 0.3em;\" >".$user['DESCRIPTION']."</td>";
        echo "<td style=\"padding-right: 0.3em;\" >".$user['LGA']."</td>";
          echo "<td style=\"padding-right: 0.3em;\" ><select id=\"sel1\" class=\"chooseaction\" style=\"width:100px;height:30px;\"><option>Choose</option><option class=\"delete\" data-id=\"".$user['PROJECTID']."\">Delete</option><option class=\"edit\" data-id=\"".$user['PROJECTID']."\">Edit</option></select></td>";
        echo "<td style=\"padding-right: 0.3em;\" ><a class=\"btn btn-default cert\" data-id=\"".$user['PROJECTID']."\">Certificates</a></td>";
        echo "<td style=\"padding-right: 0.3em;\" ><a class=\"btn btn-warning variations\" data-id=\"".$user['PROJECTID']."\">Variations</a></td>";
      
        
        
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