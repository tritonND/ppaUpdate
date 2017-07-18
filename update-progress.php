<?php
include 'php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
    $priv=$_SESSION['privileges'];
    if((strpos($priv,"updateprogress")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
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

    <title>EDPMS | Update Project Progress</title>
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
<!--    slider css-->

      <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
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
                <form>  
            <legend style="padding-bottom: 1.0em" class=" offset-sm-4 col-sm-8" > Update Project Progress</legend>               

<div class=" offset-sm-3 col-sm-6">  




 <div class="form-group row">     
  <label for="example-text-input" class="col-3 col-form-label">Project ID</label>
  <div class="col-9">
    <input class="form-control" type="text" placeholder="Project ID" id="projID" disabled>
  </div>
</div>






<div class="form-group row">
  <label for="example-tel-input" class="col-3 col-form-label">Update Description</label>
  <div class="col-9">
      <textarea style="width:100%;" rows="4" class="col-12" required placeholder="Description of Update"></textarea>
   </div>
</div>




<div class="form-group row">
  <label for="example-tel-input" class="col-3 col-form-label">Select a file to upload</label>
  <div class="col-9">
      <input type="file" name="fileupload" id="fileupload"> 
   </div>
</div>






<div class="form-group row range-slider">
  <label for="example-tel-input" class="col-3 col-form-label">Drag to get project Progress</label>
  
  <div class="col-9">
    
     <input  class="irs-bar" type="text" id="range" value="" name="range" />
   </div>


</div>



<div class="form-group row" style="padding-top: 2.0em">
      <div class="offset-sm-9 col-sm-6">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</div>

  
    </form>
                
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
    
     <script src="js/ion.rangeSlider.js"></script>

       <script>

    $(function () {

        $("#range").ionRangeSlider({
            from_shadow : true,
            min: 0,
            max: 100,
            from: 0,
            step: 1,
            postfix: "%",
            grid: true
        });

    });
</script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<!--  slider js-->

   

  </body>
</html>