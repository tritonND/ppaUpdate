<?php
include 'php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
$priv=$_SESSION['privileges'];
if((strpos($priv,"supervisors")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
{
   
    //header("Location: create-project.php");
}

else{//take him to general page
    echo "<script>alert('You are not permitted here');window.history.back();</script>";
}
}
else{
    header("Location: index.php");
}
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Contractors Directory</title>

      <script>
          var queryParam = document.location.search;
          queryParam = !queryParam ? "" : queryParam;
          if(queryParam.length == 0){
              document.location.href = document.location.href + "?t=" + new Date().getTime();
          }
          else if(queryParam.indexOf("t=") < 0){
              document.location.href = document.location.href + "&t=" + new Date().getTime();
          }
      </script>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
    
    
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
     <!--      datatablel files-->
     <link href="css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
        
        <link href="css/sweetalert.css" rel="stylesheet">
        
  </head>

  <body style="font-family: 'Montserrat', sans-serif;" class="nav-md">
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
            

            

             <div class="col-xs-12">
                
                 
                 <?php 
require_once("./php/allcontractors.php");
?>  
                
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
<!--        modals-->
<!-- certificates Modal -->
  <div class="modal fade" id="supervisorsmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background-color: #044;color: white; text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Contractors/Consultants</h3>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-xs-6">
                
            
            <img class="certphotosection" id="supervisorsphoto" width="200" height="200">
            
            </div>
            <div class="col-xs-6">
                <span style="font-size:1em;font-weight:700;">Email: </span><span id="supervisorsemail"></span><br><br>
                <span style="font-size:1em;font-weight:700;">C.A.C Numer: </span><span id="supervisorscac"></span><br><br>
                <span style="font-size:1em;font-weight:700;">STATUS: </span><span id="supervisorsstatus"></span>
                <br>
                <br><br>
                <br><br><br><br>
                <button id="blacklist" class="btn btn-warning">Blacklist</button>
                <button id="restore" class="btn btn-success">Restore</button>
            </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <span style="float: left; font-size:1.1em;font-weight:800;">Director In Charge: <span style="font-weight:900;font-size:1.1em;color: purple;" id="supervisorsmd"></span></span>
            <button type="button" class="btn btn-default" id="editbut">Edit</button>
        </div>
      </div>
      
    </div>
  </div>
  
        
        
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
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});


</script>
<script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="myjs/contractor.js"></script>
  </body>
</html>