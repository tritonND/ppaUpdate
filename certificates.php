<!DOCTYPE html>
<?php
session_start();
include 'php/dbconnect.php';
if(isset($_SESSION['firstname']))
{
$username=$_SESSION['firstname'];
}
else{
   // header("Location: index.php");
}

if(isset($_GET['id']))
{
    $id=$_GET['id'];
}
else{
    $id="error";
}
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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
    
	
    <!-- Custom styling plus plugins -->
    <link href="build/css/custom.min.css" rel="stylesheet">
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
            

            

            <div class="col-sm-8">
                <a href="update-project.php" class="btn btn-default" style="margin-left:40%;"><i class="fa fa-arrow-left"></i> Back</a>
                <form id="certform" role="form">
  <div class="form-group">
    <label for="projectid">Project ID:</label>
    <div >
        <input type="text" value="<?php echo $id; ?>" class="form-control" id="projectid" name="projectid">
    </div>
  </div>
             
  <div class="form-group">
    <label  for="certno">Certificate Number:</label>
    <div >
        <input type="text" class="form-control" id="certno" name="certno">
    </div>
  </div>

 <div class="form-group">
    <label  for="amount">Amount:</label>
    <div >
        <input type="text" class="form-control" id="amount" name="amount">
    </div>
  </div>
             
  <div class="form-group">
    <label  for="dateissued">Date Issued:</label>
    <div >
        <input type="text" class="form-control mydatepicker" id="dateissued" name="dateissued" placeholder="YYYY/MM/DD" >
    </div>
  </div>
             
  
             
 <div class="form-group">
            
    <label  for="file">Upload File:</label>
    <div >
        <input type="file" class="form-control" id="certphoto" name="certphoto" onchange="document.getElementById('assoc_passport1').src = window.URL.createObjectURL(this.files[0])" >
    </div>
  </div>
<div class="form-group">
    <label  for="file"></label>
    <div >
        <button type="button" id="addcert" class="btn btn-success">Submit</button>
    </div>
  </div>

             
</form>
                
            </div>
              <div class="col-sm-4"><br><br><br><br><br>
                  
                  <img id="assoc_passport1" name="assoc_passport1" alt="Certificate Preview" width="200" height="200" />
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
    <script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    
<!--    my own scripts-->
<script src="myjs/update.js"></script>


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