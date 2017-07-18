<?php


require_once("dbconnect.php");
$projectid=mysqli_real_escape_string($con,trim($_POST['projectid']));
$result = mysqli_query($con,"SELECT * from variations where PROJECTID='$projectid'");


	
            //$myArray = array();
$i=1;
        while($user= mysqli_fetch_array($result))
                        {
        //$myArray[]=$row;
         if($i%2==0)
            {
                echo "<tr class=\"info\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a class=\"vars\" data-id=\"".$user['ID']."\" href=\"#\">".$user['COMMENTS']."</a></td>";
                echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['DATEISSUED']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td></tr>";
	 }
            
            else{
	echo "<tr class=\"\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a class=\"vars\" data-id=\"".$user['ID']."\" href=\"#\">".$user['COMMENTS']."</a></td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['DATEISSUED']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td></tr>";
            }
	$i++;
	}   
        
                
   // echo json_encode($myArray);
             

                mysqli_close($con)
    
		

?>