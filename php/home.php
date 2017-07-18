<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
    header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $userRow['user_email']; ?></title>


    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>
<body style="font-family: 'Segoe UI'">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <span> <a class="navbar-brand" href="#" style="color: #ffffff;"> <b> Edo ICTA Reports Portal </b></a> </span>
        <!--    <a class="navbar-brand" href=""> </a> -->
        </div>


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" style="font-weight: bold">
                <li class="active"><a href="#"> Home </a></li>
                <li><a href="users.php"> Create Users</a></li>
                <li><a href="#">There</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <span style="font-weight: bold"> Welcome  <?php echo $userRow['user_name']; ?></span> </a></li>
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out "></span>&nbsp; Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->

    </div>
</nav>

<div class="container" style="margin-top:50px;">
    <!--
    <div class="container" style="margin-top:150px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:35px;">
    <a href="http://www.codingcage.com/">Coding Cage - Programming Blog</a><br /><br />
    <p>Tutorials on PHP, MySQL, Ajax, jQuery, Web Design and more...</p>
    -->
    <h1>View reports By departments </h1>
    <h1>View reports By HOU </h1>
    <h1>View reports By Team Leads </h1>
    <h1>View reports By Month - Dept, HOU, TL </h1>
    <h1>View reports By Week - Dept, HOU, TL </h1>


</div>

<style>

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 30px;
        background-color: #f5f5f5;
    }


</style>

<footer class="footer">
    <div class="container">
        <p align="center" class="text-muted">Edo ICTA &copy; 2016</p>
    </div>
</footer>

</body>
</html>