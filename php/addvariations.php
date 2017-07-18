<?php


require_once("dbconnect.php");

$projectid=mysqli_real_escape_string($con,trim($_POST['projectidtextinput']));
$comment=mysqli_real_escape_string($con,trim($_POST['comments']));
$amount=mysqli_real_escape_string($con,trim($_POST['amount']));
$datee=mysqli_real_escape_string($con,trim($_POST['dateofcreation']));

//pull mda and lga first
$result2 = mysqli_query($con, "SELECT LGA, PROCURINGENTITY FROM projectdetails WHERE PROJECTID = '$projectid'");
$row2 = mysqli_fetch_array($result2);
$lga = $row2[0];
$mda = $row2[1];

//upload photos first
 $target_dir = "variations/";
    $target_file = $target_dir . basename($_FILES["cov"]["name"]);
	//copy files to folder
	$pic_name=$_FILES["cov"]["name"];
	$pic_type=$_FILES["cov"]["type"];
	$pic_temp=$_FILES["cov"]["tmp_name"];
        
        if($pic_name=="")//now image found
        {
         echo "no image";

            
        }
        else{
        
	 if (file_exists($target_file)) 
	{
    $randomnum=  uniqid().rand();
    move_uploaded_file($_FILES["cov"]["tmp_name"],$target_dir .$randomnum. $_FILES["cov"]["name"]);
	$prop_pic=mysqli_real_escape_string($con,$target_dir.$randomnum.$pic_name);
	}
	else 
	{
            $prop_pic=mysqli_real_escape_string($con,$target_dir.$pic_name);
      move_uploaded_file($_FILES["cov"]["tmp_name"],$target_dir.$_FILES["cov"]["name"]);
      
    }
    
//run insert query now
mysqli_query($con, "insert into variations (PROJECTID,DATEISSUED,AMOUNT,COMMENTS,URL, MDA, LGA) values('$projectid','$datee','$amount','$comment','$prop_pic', '$mda', '$lga')");
if(mysqli_affected_rows($con)>0)
{
$result = mysqli_query($con,"SELECT * from variations where PROJECTID='$projectid'");
   
$i=1;
        while($user= mysqli_fetch_array($result))
                        {
        
          if($i%2==0)
            {
                echo "<tr class=\"info var\" data-id=\"".$user['ID']."\"><a href=\"#\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
                echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a class=\"vars\" data-id=\"".$user['ID']."\" href=\"#\">".$user['COMMENTS']."</a></td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['DATEISSUED']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td></a></tr>";
	 }
            
            else{
	echo "<tr class=\"var\" data-certid=\"".$user['ID']."\"><a href=\"#\"><td style=\"max-width:5%;padding-right: 0.3em; \" id=\"line\">{$i}.</td>";
        echo "<td style=\"max-width:15%;padding-right: 0.3em;\" ><a class=\"vars\" data-id=\"".$user['ID']."\" href=\"#\">".$user['COMMENTS']."</a></td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\" >".$user['DATEISSUED']."</td>";
	echo "<td style=\"max-width:15%;padding-right: 0.3em;\">".$user['AMOUNT']."</td></a></tr>";
            }
	$i++;
	}   
        
                
   // echo json_encode($myArray);
}
else{
    echo "error".  mysqli_error($con);
}
        }



    audit_traii("Added Variations");


mysqli_close($con)
    
		

?>