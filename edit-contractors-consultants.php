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

<?php
$id=$_GET['id'];
$result=mysqli_query($con,"select * from supervisors where EMAIL='$id'");
$rw=mysqli_fetch_array($result);
$type=$rw['TYPE'];
$fullname=$rw['FULLNAME'];
$address=$rw['ADDRESS'];
$phone=$rw['PHONE'];
$spec=$rw['SPECIALISATION'];
$companyname=$rw['COMPANYNAME'];
$cac=$rw['CAC'];

?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Edit Consultants and Contractors</title>

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
                <div class="col-xs-8">  

      <h2 style="padding-bottom: 1.0em"> Consultant / Contractor Details</h2>               

     

<form class="form-horizontal" role="form" id="contractorsform" data-toggle="validator" method="post" onsubmit="return false;">
      
<div class="form-group row">     
  <label for="option" >Option</label>
  <div class="">
      <select class="form-control" id="option" name="option">
      <option value="select">Select One </option>
      <option value="<?php echo $type; ?>" selected><?php echo $type; ?> </option>
      <option value="Consultant">Consultant </option>
      <option value="Contractor">Contractor </option>
  </select>
  </div>
</div>




 <div class="form-group row">     
  <label for="companyname" class="col-3 col-form-label">Company Name</label>
  <div class="col-9">
      <input value="<?php echo $companyname; ?>" class="form-control" type="text" id="companyname" name="companyname" required>
  </div>
  <div class="help-block with-errors"></div>
</div>
 
<div class="form-group row">     
  <label for="fullname" class="col-3 col-form-label">M.D/CEO Full Name</label>
  <div class="col-9">
      <input value="<?php echo $fullname; ?>" class="form-control" type="text" placeholder="Name of director in charge" name="fullname" id="fullname" required>
  </div>
  <div class="help-block with-errors"></div>
</div>

<div class="form-group row">
  <label for="email" class="col-3 col-form-label">Email</label>
  <div class="col-9">
      <input value="<?php echo $id; ?>" class="form-control" type="email" placeholder="username@email.com" id="email" name="email" required disabled>
  </div>
  <div class="help-block with-errors"></div>
</div>
    

<div class="form-group row">
  <label for="phone" class="col-3 col-form-label">Phone</label>
  <div class="col-9">
      <input value="<?php echo $phone; ?>" class="form-control" type="tel" pattern="(0[1-9]{1}[0-9]{9}|\+234[1-9]{1}[0-9]{9})" placeholder="+2341234567890"  id="phone" name="phone" required>
  </div>
  <div class="help-block with-errors"></div>
</div>

<div class="form-group row">
  <label for="address" class="col-3 col-form-label">Address</label>
  <div class="col-9">
      <textarea id="address" name="address" style="width:100%;" rows="4" class="col-12" required><?php echo $address; ?></textarea>
   </div>
  <div class="help-block with-errors"></div>
</div>

    <div class="form-group row">     
  <label for="cacnumber" class="col-4 col-form-label">C.A.C Number</label>
  <div class="col-9">
      <input value="<?php echo $cac; ?>" class="form-control" type="text" placeholder="C.AC Registration Number" id="cacnumber" name="cacnumber" required>
  </div>
  <div class="help-block with-errors"></div>
</div>

<div class="form-group row">     
  <label for="specialization" class="col-4 col-form-label">Specialization</label>
  <div class="col-9">
      <input value="<?php echo $spec; ?>" class="form-control" type="text" placeholder="Specify Specialization" id="specialization" name="specialization" required>
  </div>
  <div class="help-block with-errors"></div>
</div>
    
     


<div class="form-group row">
      <div class="offset-sm-9 col-sm-6">
          <button id="editcontractorsbut" type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>


  
    </form>
</div>
                <div class="col-xs-4">
                  
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

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
     <script src="js/validator.min.js"></script>
    <!-- kendo core library -->
    
  <script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="myjs/contractor.js"></script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  
  </body>
</html>