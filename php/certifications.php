<?php


require_once("dbconnect.php");
$projectid=mysqli_real_escape_string($con,trim($_POST['projectid']));
$result = mysqli_query($con,"SELECT * from certificates where PROJECTID='$projectid'");


$i=1;
        while($user= mysqli_fetch_array($result))
                        {
        
         if($i%2==0)
            {
                echo "<tr class=\"info\">";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a href=\"#\" class=\"certno\" data-certid=\"".$user['ID']."\">".$user['CERTNUMBER']."</a></td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['DATEISSUED']."</td>";
        echo "<td class=\"currency-format\" style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['STATUS']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-warning approve\">Approve</a></td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-danger paid\">Paid</a></td>";
	 }
            
            else{
	echo "<tr class=\"\">";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a href=\"#\" class=\"certno\" data-certid=\"".$user['ID']."\">".$user['CERTNUMBER']."</a></td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['DATEISSUED']."</td>";
        echo "<td class=\"currency-format\" style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['STATUS']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-warning approve\">Approve</a></td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-danger paid\">Paid</a></td>";
	   }
	$i++;
	}   
        

	echo "<script> formatCur(); </script>";
   // echo json_encode($myArray);
             

                mysqli_close($con)
    
		

?>