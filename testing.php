<?php
$con=@mysqli_connect("localhost","lands","Password1234","edpms") or die("Cannot connect to server now, please try again. ");

mysqli_query($con, "insert into testing(ID,NAMES) values(1,'joseph')");
if(mysqli_affected_rows($con)>0)
{
    echo "script inserted id and names into testng table";
}
else
{
    echo "lack of communication";
}

?>

