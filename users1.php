<?php
include './php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
    $priv=$_SESSION['privileges'];
    if((strpos($priv,"users")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
    {

        //header("Location: create-project.php");
    }

    else{//take him to general page
        echo "<script>alert('You do not have the privilege to access this page');location.href='create-project.php';</script>";
    }
}
else{
    header("Location: index.php");
}
?>


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

    <title>EDPMS | EDPMS</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    
     <!--      datatablel files-->
     <link href="css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
        
        <link href="css/sweetalert.css" rel="stylesheet">
        
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
<!--          left side menu from top to bottom-->
<?php include './sidemenu.php'; ?>
        </div>

        <!-- top navigation -->
        <?php include './topnavigation.php'; ?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  
                  <div class="x_content">
<!--main content-->

                <div class="row" >
                    <div class="col-sm-6">
<form class="form-horizontal" role="form" id="createusersform" data-toggle="validator" method="post" onsubmit="return false;">
                      
                      <h3>Users</h3>
                      
                      <span id="createusersreponsemessage" style="font-size: 1.2em;color:blue;"></span>
                
                      <div class="form-group" >
                    <span id="messagespan" style="color:blue;font-weight:bold;font-size:1.2em;"></span>
                    <label class="col-form-label col-sm-2" for="firstname">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname"
                               placeholder="User's First Name" required>
                        
                    </div>
                    <div class="help-block with-errors"></div>
                </div>

                    <div class="form-group" >
                    <span id="messagespan" style="color:blue;font-weight:bold;font-size:1.2em;"></span>
                    <label class="col-form-label col-sm-2" for="othernames">Other Names:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="othernames" name="othernames"
                               placeholder="Other Names" required>
                        
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                    
                <div class="form-group" >
                    <label class="col-form-label col-sm-2" for="username">User Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="Email" required>
                     </div>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group" >
                    <label class="col-form-label col-sm-2" for="password1">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password1" name="password1"
                                required>
                     </div>
                    <div class="help-block with-errors"></div>
                </div>

                      
                      <div class="form-group" >

                    <label class="col-form-label col-sm-2" for="password2">Confirm Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password2" data-match="#password1" data-error="Passwords mismatch" name="password2" required>
                          
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                          
                             
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="usertype">User Type:</label>
                    <div class="col-sm-10">
                    <select name="usertype" id="usertype" style="width:200px;height:30px;">
                    <option value="select" selected>Select</option>
                  <option value="staff">MDA STAFF</option>
                  
                  <option value="director">M.D/DIRECTOR</option>
                  
                  <option value="governor">GOVERNOR</option>
                  </select>

                  </div>
                  </div>

                     
                          
                          
                          
                <div class="form-group">
                  <label class="control-label col-sm-2"></label>
                  <div class="col-sm-10">

                      <button type="submit" id="createusersbut" class="btn btn-info btn-lg">
                  <span class="glyphicon glyphicon-ok-sign"></span> Create
                </button>

                 </div>
                </div>

                          

                          
                      
              </form>

                      <!-- end of first column on the left side and beginning of next column-->
                      </div>
                      <div class="col-sm-6">
                          
                          <h3 style="font-family:segoe UI; margin-left:20%;">Registered Users</h3>
                          <span style="font-weight:bold;color:blue;font-size: 1.2em;" id="deleteusers_message"> </span>
<?php 
require_once './php/users.php';
?>
                      </div>

                  </div>
                  
                 
          
<!--main content ends here-->
        </div>
                </div>
              </div>
            </div>
            

          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Edo State Public Procurement Agency
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
<!--    validator-->
<script src="js/validator.min.js"></script>
<!--sweat alert-->
<script src="js/sweetalert.min.js"></script>
 <script src="js/validator.min.js"></script>
    
    
  <script src="js/spin.min.js"></script>
<!--  datatables-->
<!--datatable files-->
    <script src="datatable/jquery.dataTables.min.js"></script>
      <script src="datatable/dataTables.buttons.min.js"></script>
      <script src="datatable/jszip.min.js"></script>
      <script src="datatable/buttons.bootstrap.min.js"></script>
      
      <script src="datatable/buttons.flash.min.js"></script>
      <script src="datatable/buttons.print.js"></script>
      <script src="datatable/buttons.html5.min.js"></script>
      <script>
     $(document).ready(function() {
         //first table
    $('#projects').DataTable( {
        dom: 'lfrtip',
        lengthChange: true,
         pageLength: 10,
        lengthMenu: [ 10, 15, 20]
       
    } );
    
    //second table
    
} );
        </script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>
    <script src="myjs/users.js"></script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  
  </body>
</html>