<!DOCTYPE html>
<?php
//session_start();
//if(isset($_SESSION['firstname']))
//{
//$username=$_SESSION['firstname'];
//}
//else{
//    header("Location: index.php");
//}
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Report Portal | Accounts </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Edo State ICTA!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><span><?php echo $username ?></span></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                  <h2><span><?php echo $_SESSION['usertype'] ?></span></h2>

                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dashboard.php">Dashboard</a></li>
                      <li><a href="alldata.php">All Data</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Admin. & Asset  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      
                      <li><a href="admin.php">Admin</a></li>
                      <li><a href="staff.php">Staff and Personnel</a></li>
                      <li><a href="memo.php">Memo Minutes & Correspondence</a></li>
                      <li><a href="asset.php"></a>Asset Mangement</li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Software <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="opendata.php">Open Data,Website & Social Media</a></li>
                      <li><a href="sdu.php">SDU & Other Apps</a></li>
                      <li><a href="microsoft.php">Microsoft Apps</a></li>
                      <li><a href="erp.php">Oracle ERP</a></li>
                      <li><a href="erpfin.php">ERP-Financial</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Training, Exams,Customer Services <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="training.php">Training</a></li>
                      <li><a href="exams.php">Exams</a></li>
                      <li><a href="customers.php">Customer Service</a></li>
                      <li><a href="callcenter.php">Call Centre</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i>Biometrics And Verification <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="staffver.php">Staff Verification</a></li>
                      <li><a href="pensionver.php">Pension Verification</a></li>
                      <li><a href="subebver.php">LGA/SUBEB Verification</a></li>
                      <li><a href="archive.php">Archive</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Networking And Data Center <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="datacenter.php">Data Center</a></li>
                      <li><a href="networking.php">Networking</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Finance & Accounts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="accounts.php">Accounts</a></li>
                      <li><a href="payroll.php">Payroll</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Users</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> User Privileges <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="users.php">Create Users</a></li>
                        <li><a href="users.php">Edit User Privileges</a></li>
                      
                    </ul>
                  </li>
                 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="glyphicon glyphicon-user"></span> &nbsp;<span><?php echo $username ?></span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
<!--                    <li><a href="javascript:;"> Profile</a></li>-->
                    
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Finance and Accounts <small> Accounts</small> </h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accounts Department Task Report <small></small></h2>
                    <!--
To implement the searchtable.js, simply give your table a class and assign this class name 
to the data-table attribute of the search input field;also, give the search input field a class name 
 'light-table-filter'. To implement the autofilter.js,simply give your table an id and call the function setFilterGrid(x)
 where x is your table id. The script implementation is found
at the bottom of this file. 
                    -->
                    <input type="text" placeholder="Filter By Whatever You Type" class="light-table-filter" data-table="opendatatasktable" id="searchoopendatatask" name="searchoopendatatask" style="width: 50%;height: 30px;">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                         
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<!--main content-->
<?php
require_once("php/dbconnect.php");
$result = mysqli_query($con,"SELECT * FROM alltab WHERE designation LIKE 'Account%'");
?>
<table class="opendatatasktable table" id="opendatatasktable" border="0" cellpadding="3" cellspacing="0" style="width:100%;text-transform: uppercase;">
      
        <tr style="background-color:#2A3F54; color: white;">
        <th style="padding-right: 0.3em;">S/N </th>
        <th style="padding-right: 0.3em;">First Task</th>
        <th style="padding-right: 0.3em;">Second Task</th>
        <th style="padding-right: 0.3em;">Third Task</th>
        <th style="padding-right: 0.3em;">Fourth Task</th>
        <th style="padding-right: 0.3em;">Fifth Task</th>
        <th style="padding-right: 0.3em;">Date Submitted</th>
        <th style="padding-right: 0.3em;">Week</th>
        <th style="padding-right: 0.3em;">Submitted By</th>
      
        </tr>
    <?php
    
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            
            if($i%2==0)      //data-toggle="modal" data-target="#registermodal
                {
                echo "<tr class=\"\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task1desc']."'>".$user['task1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task2desc']."'>".$user['task2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task3desc']."'>".$user['task3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task4desc']."'>".$user['task4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task5desc']."'>".$user['task5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
            else{
	echo "<tr class=\"active\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task1desc']."'>".$user['task1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task2desc']."'>".$user['task2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task3desc']."'>".$user['task3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task4desc']."'>".$user['task4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['task5desc']."'>".$user['task5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
	$i++;
	}
	?>
    </table>

<!--main content ends here-->
        </div>
                </div>
              </div>
            </div>
            
<!--            opendata plans-->
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accounts Department Plans Report <small></small></h2>
    
                    <input type="text" placeholder="Filter By Whatever You Type" class="light-table-filter" data-table="opendataplanstable" id="searchoopendatatask" name="searchoopendatatask" style="width: 50%;height: 30px;">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings</a>
                          </li>
                         
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<!--main content-->
<?php

$result = mysqli_query($con,"SELECT * FROM alltab WHERE designation LIKE 'Account%'");
?>
<table class="opendataplanstable table" id="opendataplanstable" border="0" cellpadding="3" cellspacing="0" style="width:100%;text-transform: uppercase;">
      
        <tr style="background-color:#2A3F54; color: white;">
        <th style="padding-right: 0.3em;">S/N </th>
        <th style="padding-right: 0.3em;">First Plan</th>
        <th style="padding-right: 0.3em;">Second Plan</th>
        <th style="padding-right: 0.3em;">Third Plan</th>
        <th style="padding-right: 0.3em;">Fourth Plan</th>
        <th style="padding-right: 0.3em;">Fifth Plan</th>
        <th style="padding-right: 0.3em;">Submitted Date</th>
        <th style="padding-right: 0.3em;">Week</th>
        <th style="padding-right: 0.3em;">Submitted By</th>
      
        </tr>
    <?php
    
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            
            if($i%2==0)      //data-toggle="modal" data-target="#registermodal
                {
                echo "<tr class=\"\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan1desc']."'>".$user['plan1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan2desc']."'>".$user['plan2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan3desc']."'>".$user['plan3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan4desc']."'>".$user['plan4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan5desc']."'>".$user['plan5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
            else{
	echo "<tr class=\"active\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan1desc']."'>".$user['plan1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan2desc']."'>".$user['plan2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan3desc']."'>".$user['plan3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan4desc']."'>".$user['plan4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['plan5desc']."'>".$user['plan5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
	$i++;
	}
	?>
    </table>

<!--main content ends here-->
        </div>
                </div>
              </div>
            </div>
<!--         *************-->

<!--opendata suggestions-->
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accounts Department Suggestions <small></small></h2>
    
                    <input type="text" placeholder="Filter By Whatever You Type" class="light-table-filter" data-table="opendatasuggestiontable" id="searchoopendatatask" name="searchoopendatatask" style="width: 50%;height: 30px;">
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings</a>
                          </li>
                         
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<!--main content-->
<?php
require_once("php/dbconnect.php");
$result = mysqli_query($con,"SELECT * FROM alltab WHERE designation LIKE 'Account%'");
?>
<table class="opendatasuggestiontable table" id="opendatasuggestiontable" border="0" cellpadding="3" cellspacing="0" style="width:100%;text-transform: uppercase;">
      
        <tr style="background-color:#2A3F54; color: white;">
        <th style="padding-right: 0.3em;">S/N </th>
        <th style="padding-right: 0.3em;">First Suggestion</th>
        <th style="padding-right: 0.3em;">Second Suggestion</th>
        <th style="padding-right: 0.3em;">Third Suggestion</th>
        <th style="padding-right: 0.3em;">Fourth Suggestion</th>
        <th style="padding-right: 0.3em;">Fifth Suggestion</th>
        <th style="padding-right: 0.3em;">Submitted Date</th>
        <th style="padding-right: 0.3em;">Week</th>
        <th style="padding-right: 0.3em;">Submitted By</th>
      
        </tr>
    <?php
    
	$i=1;
	while($user=mysqli_fetch_array($result))
                {
            
            if($i%2==0)      
                {
                echo "<tr class=\"\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg1desc']."'>".$user['sugg1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg2desc']."'>".$user['sugg2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg3desc']."'>".$user['sugg3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg4desc']."'>".$user['sugg4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg5desc']."'>".$user['sugg5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
            else{
	echo "<tr class=\"active\"><td>{$i}.</td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg1desc']."'>".$user['sugg1']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg2desc']."'>".$user['sugg2']."</a></td>";
	echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg3desc']."'>".$user['sugg3']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg4desc']."'>".$user['sugg4']."</a></td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['sugg5desc']."'>".$user['sugg5']."</a></td>";
        echo "<td>".$user['submittime']."</td>";
        echo "<td>".$user['weekNumber']."</td>";
        echo "<td><a href=\"#\" data-toggle=\"tooltip\" title='".$user['submittedby']."'>".$user['userType']."</a></td></tr>";
       
            }
	$i++;
	}
	?>
    </table>

<!--main content ends here-->
        </div>
                </div>
              </div>
            </div>
<!--****************-->
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Report Portal Edo State ICT Agency
          </div>
          <div class="clearfix">
              
</div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>
  <script>
      //pages the open data task table
       var opendatatask = { 
            grid:false,
         paging: true,
         paging_length: 15,
         loader: true,
	loader_text: "Filtering data..."
    
          };
    setFilterGrid("opendatatasktable",opendatatask,-1);
    //pages the open data plans table
       var opendatatask = { 
            grid:false,
         paging: true,
         paging_length: 15,
         loader: true,
	loader_text: "Filtering data..."
    
          };
    setFilterGrid("opendataplanstable",opendatatask,-1);
    //pages the open data suggestion table
       var opendatatask = { 
            grid:false,
         paging: true,
         paging_length: 15,
         loader: true,
	loader_text: "Filtering data..."
    
          };
    setFilterGrid("opendatasuggestiontable",opendatatask,-1);
  </script>
  <script>
 //initialise the tool tips for bootstrap
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  
  </body>
</html>