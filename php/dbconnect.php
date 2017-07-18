<?php
$con=mysqli_connect("localhost","root","minowss","edpms") or die("Cannot connect to server now, please try again. ");



function audit_traii($action)
{
    global $con;
    date_default_timezone_set("Africa/Lagos");

    $mytoday=date("Y-m-d H:i:s");
    if (!isset($_SESSION))
    {
        session_start();
    }
    $username=$_SESSION['username'];
    $fname=$_SESSION['firstname'];

    mysqli_query($con, "insert into audit_trail(FNAME,USER,ACTION,TIME_STAMP) values('$fname', '$username','$action','$mytoday') ");

}

?>