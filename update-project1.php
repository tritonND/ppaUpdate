<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['firstname']))
{
//$username=$_SESSION['firstname'];
}
else{
   // header("Location: index.php");
}
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Update Project</title>

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
        <link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="css/jquery-ui.structure.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    
    <script src="js/jquery-ui.min.js"></script>
    <style>
        .ui-widget-content .ui-icon {
    background-image: url("images/ui-icons_444444_256x240.png")      
    !important;}
    .ui-widget-header .ui-icon {
    background-image: url("images/ui-icons_444444_256x240.png")   
    !important;}
    </style>
      
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
            

            

            <div class="col-sm-12">
                
                 <?php 
require_once("./php/projects.php");
?>  
</div>
                
            </div>
              
            
     </div>
        </div>
        <!-- /page content -->
        
<!--        modals starts here-->

<div class="container">

  <!-- certificates Modal -->
  <div class="modal fade" id="certificatesmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background-color: #044;color: white; text-align:center;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Certificates</h3>
        </div>
        <div class="modal-body">
            <h4>Project ID:<span id="certificateprojectid"></span></h4>
            <h3 id="back" class="certphotosection" style="font-weight:bold;color:green;display:none;cursor:pointer;text-decoration: underline;">Back</h3>
            <img style="display:none;" class="certphotosection" id="certphoto" width="200" height="200">
            <table class="table">
    <thead>
      <tr>
        <th>Certificates Id</th>
        <!-- <th>Purpose</th> -->
        <th>Date Issued</th>
        <th>Amount</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="certtable">
    
      
    </tbody>
  </table>
        </div>
        <div class="modal-footer">
            <a id="addcertbutton"  style="float:left;" class="btn btn-info">Add New Certificate</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
<!--  variations modal-->
<div class="modal fade" id="variationsmodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background-color: #044;color: white; text-align:center;">
              <button style="color:white;" type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Variations</h3>
        </div>
        <div class="modal-body">
            <h4 style="text-align:center;">Project ID:<span id="variationsprojectid"></span></h4>
            <div id="covphotopreview" style="display:none;">
            <h3 id="covback" style="font-weight:bold;color:green;cursor:pointer;text-decoration: underline;">Back</h3>
            <img id="covphoto" width="200" height="200">
            </div>
            
            <form role="form" id="variationsform" method="post">
                <div class="form-group" style="display:none;">
    <label  for="projectidtextinput">Project ID:</label>
    <div >
        <input type="text" class="form-control" id="projectidtextinput" name="projectidtextinput">
    </div>
  </div>
 <div class="form-group">
    <label  for="amount">Amount:</label>
    <div >
        <input type="text" class="form-control" id="amount" name="amount">
    </div>
  </div>
             
  <div class="form-group">
    <label  for="dateofcreation">Date Of Creation:</label>
    <div >
        <input placeholder="YYYY/MM/DD" type="text" class="form-control mydatepicker" name="dateofcreation" id="dateofcreation" >
    </div>
  </div>
             
 <div class="form-group">
    <label  for="comments">Comments:</label>
    <div >
        <input type="text" class="form-control" id="comments" name="comments" >
    </div>
  </div>
<div class="form-group">
                  
    <label  for="cov">Upload Certificate Of Variation:</label>
    <div >
        <input type="file" class="form-control" id="cov" name="cov" onchange="document.getElementById('covphoto').src = window.URL.createObjectURL(this.files[0]);document.getElementById('covphotopreview').style.display = 'block';" >
    </div>
  </div>
             
<div class="form-group">
    <label  for="addvariation"></label>
    <div >
        <button type="button" id="addvariation" class="btn btn-lg btn-success">Add</button>
    </div>
  </div>

             
</form>
            
            
            <h3 style="text-align:center;">Existing Variations</h3>
            <table class="table" >
    <thead>
      <tr>
        <th>Variations Id</th>
        <th>Purpose</th>
        <th>Date Added</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody id="variationstable">
      
   
      
    </tbody>
  </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>



<!--modals ends here-->
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
    

    <!-- jQuery -->
    
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
   
    
<!--    my own scripts-->
    <script src="myjs/update.js"></script>
<!--    **********-->
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
<!--      ***********-->
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

</script>
<script>
     $( ".mydatepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
    
});
  </script>

  
  </body>
</html>