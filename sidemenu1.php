
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">

</head>

<body style="font-family: 'Montserrat', sans-serif;">
<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="#" class="site_title"> <span>Edo State PPA</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
        <div class="profile_pic">
            <img src="images/user.png" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2><span><?php //echo $username ?></span></h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h2><span><?php //echo $_SESSION['usertype']; ?></span></h2>

            <ul class="nav side-menu">

                <li><a href="dashboard.php"><i class="fa fa-tasks"></i>Dashboard  <span class="fa fa-chevron-down"></span></a>

                </li>
                <li><a><i class="fa fa-tasks"></i>PROJECTS  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <li><a href="create-project.php">Create A Project</a></li>
                        <li><a href="update-project.php">Update Project</a></li>
                        <li><a href="update-progress.php">Update Project Progress</a></li>

                    </ul>
                </li>
                <li><a><i class="fa fa-building-o"></i>CONTRACTORS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="contractors-consultants.php">Add Contractors</a></li>
                        <li><a href="contractors-directory.php">Contractors Directory</a></li>

                    </ul>
                </li>
                <li><a><i class="fa fa-paper-plane-o"></i>CONSULTANTS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="contractors-consultants.php">Add Consultants</a></li>
                        <li><a href="consultants-directory.php">Consultants Directory</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i>REPORTS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="mdareport.php">All Projects</a></li>
                        <li><a href="mdareport1.php">Reports per LGA</a></li>
                        <li><a href="mdareport4.php">Projects Sum Per MDA</a></li>
                        <li><a href="mdareport2.php">Projects per MDA</a></li>
                        <li><a href="mdareport5.php">Projects Sum Per LGA</a></li>
                        <li><a href="mdareport6.php"> Projects Status</a></li>
                        <li><a href="mdareport3.php"> Projects By Maps</a></li>
                        <li><a href="mdareport8.php"> All Contractors</a></li>
                        <li><a href="mdareport7.php"> Project Financials</a></li>


                    </ul>
                </li>
                <li><a><i class="fa fa-money"></i>Budget <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Upload Budget</a></li>
                        <li><a href="#">Budget Chart</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="menu_section">
            <h3 style="display : none;">Users</h3>
            <ul class="nav side-menu">
                <li style="display : none;"><a><i class="fa fa-user"></i> User Privileges <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li style="display : none;"><a href="users.php">Create Users</a></li>
                        <li style="display : none;"><a href="users.php">Edit User Privileges</a></li>

                    </ul>
                </li>

            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->



    <!-- /menu footer buttons -->
</div>



</body>
</html>