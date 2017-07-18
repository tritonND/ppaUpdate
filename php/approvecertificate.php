<?php


require_once("dbconnect.php");

$id=mysqli_real_escape_string($con,trim($_POST['id']));
$projectid=mysqli_real_escape_string($con,trim($_POST['projectid']));

$myresult=mysqli_query($con, "select STATUS from certificates where ID='$id'");
$row=mysqli_fetch_array($myresult);

if($row['STATUS']=='paid')
{
    echo "paid";
}
else if($row['STATUS']=='approved')
{
  echo "approved";  
}
else
{


mysqli_query($con, "update certificates set STATUS='approved' where ID='$id' ");
if(mysqli_affected_rows($con)>=0)
{
$result = mysqli_query($con,"SELECT * from certificates where PROJECTID='$projectid'");
   
$i=1;
        while($user= mysqli_fetch_array($result))
                        {
        
        if($i%2==0)
            {
                echo "<tr class=\"info\">";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['CERTNUMBER']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['DATEISSUED']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['STATUS']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-warning approve\">Approve</a></td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-danger paid\">Paid</a></td>";
	 }
            
            else{
	echo "<tr class=\"\">";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['CERTNUMBER']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['DATEISSUED']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['STATUS']."</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-warning approve\">Approve</a></td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\"><a data-id=\"".$user['ID']."\" class=\"btn btn-danger paid\">Paid</a></td>";
	   }
	$i++;
	}   
        
                
   // echo json_encode($myArray);
}
else{
    echo "error";
}

}

audit_traii("Approved a Certificate");

mysqli_close($con)
    
		

?>