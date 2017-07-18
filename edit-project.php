<!DOCTYPE html>
<?php
include 'php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
$priv=$_SESSION['privileges'];
if((strpos($priv,"updatetproject")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
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
$projectid=$_GET['projectid'];
require_once './php/dbconnect.php';
$result=mysqli_query($con, "select COMPANYNAME from supervisors where TYPE='contractor' and ACTIVE=1 ");
$result2=mysqli_query($con, "select COMPANYNAME from supervisors where TYPE='consultant' and ACTIVE=1 ");

$result3=mysqli_query($con, "select DISTINCT SECTOR from sectors ");

$res=  mysqli_query($con,"select * from projectdetails where PROJECTID='$projectid' ");
$rw=  mysqli_fetch_array($res);
$procurringentity=$rw['PROCURINGENTITY'];
$title=$rw['TITLE'];
$description=$rw['DESCRIPTION'];
$status=$rw['STATUS'];
$remarks=$rw['REMARKS'];
$location=$rw['LOCATION'];
$lga=$rw['LGA'];
$dateofaward=$rw['DATEOFAWARD'];
$durationofcontract=$rw['DURATIONOFCONTRACT'];
$expecteddateofcompletion=$rw['EXPECTEDCOMPLETIONDATE'];
$agreedmobilization=$rw['AGREEDMOBILIZATION'];
$contractsum=$rw['CONTRACTSUM'];
$contractor=$rw['CONTRACTOR'];
$consultant=$rw['CONSULTANT'];
$sector=$rw['SECTOR'];
$subsector=$rw['SUBSECTOR'];

$dur = intval(preg_replace('/[^0-9]+/', '', $durationofcontract), 10);
$dura=(String)$dur;
if(strlen($dura)>1)
{
    $months=substr($dura,1);
    $year=substr($dura,0,1);
}
else{
$months=$dura;
$year=0;
}
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Edit Project</title>

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
    <link href="css/jquery-ui.min.css" rel="stylesheet">
    <link href="css/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="css/jquery-ui.structure.min.css" rel="stylesheet">
<script src="vendors/jquery/dist/jquery.min.js"></script>
    
    <script src="js/jquery-ui.min.js"></script>
    <style>
        .ui-widget-content .ui-icon {
    background-image: url("images/ui-icons_444444_256x240.png")      
    !important;}
    .ui-widget-header .ui-icon {
    background-image: url("images/ui-icons_444444_256x240.png")   
    !important;}
    </style>
    <script src="project-js/create-project-validations.js"></script>
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
            
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Edit Project Form Wizard </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <form id="create-project-form" role="form" data-toggle="validator">
                    <div id="wizard" class="form_wizard wizard_horizontal">



                        <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Budget Sector
                                              
                                          </span>
                          </a>
                        </li>
                      
                        <li>
                          <a href="#step-3">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Project Details
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                         Consultants & Contractors
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-5">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                             Financials
                                          </span>
                          </a>
                        </li>
                      </ul>



                      <div id="step-1">
                          <div class="col-xs-6 col-xs-offset-2">
    <div class="row">
    <div class="col-sm-12 text-center">
      <h5 style="font-weight:800;">Budget</h5>
    </div>
    </div>

 
<div class="form-group">
<select id="sector" name="sector" class="form-control"
          data-required-error="Sector is required" required>
    <option value="">Select Sector</option>
    <option value="<?php echo $sector;?>" selected><?php echo $sector;?></option>
    <?php while($row=  mysqli_fetch_array($result3)){ 
    
    echo "<option value=\"$row[0]\">$row[0]</option>";
     } ?>           
          </select>
          <div class="help-block with-errors"></div>
  </div> 
                        


<div class="form-group">
    <select id="subsector" class="form-control datalist" name="subsector" required
    data-required-error="project sub-sector is required">
    <option value="">Sub Sector</option>
    <option value="<?php echo $subsector;?>" selected><?php echo $subsector;?></option>
  
          </select>
          <div class="help-block with-errors"></div>
</div>
                          </div>
            </div>

          <!--Start step 2 here  -->
                      



                        <!-- Start step 3 here  -->

            <div id="step-3">
<!-- Section for projects-->
            <div class="row">


                <div class="row">
                 <div class="col-sm-12 text-center">
                    <h5 style="font-weight:800;">PROJECT</h5>
                 </div>
                 </div>


                        <div class="col-sm-6">
<div class="form-group">
  <select id="mda" class="form-control datalist" name="mda" required
  data-required-error="MDA is required">
    <option value="">Select MDA</option>
    <option value="<?php echo $subsector; ?>" selected><?php echo $subsector;?></option>
                           
          </select>
          <div class="help-block with-errors"></div>
  </div>
                            
<div class="form-group">
    <label for="projectid">Project Id:</label>
    <input value="<?php echo $projectid; ?>" type="text" class="form-control" id="projectid" required
           data-required-error="project id is required" disabled>
    <div class="help-block with-errors"></div>
</div>

                           
                            <div class="form-group">
    <label for="projecttitle">Project Title:</label>
    <input value="<?php echo $title; ?>" type="text" class="form-control" id="projecttitle" name="projecttitle" required
           data-required-error="project title is required">
           <div class="help-block with-errors"></div>
    </div>

                            <div class="form-group">
<label for="projectdescription">Project Description:</label><br>
<textarea id="projectdescription" name="projectdescription" style="width:100%;" required
    data-required-error="project description is required"><?php echo $description; ?></textarea>
    <div class="help-block with-errors"></div>
    </div>
                            
    <div class="form-group">
        <label for="dateofaward">Date of Award:</label>
        <input value="<?php echo $dateofaward; ?>" type="text" class="form-control mydatepicker" id="dateofaward" name="dateofaward" required
              data-required-error="project award date is required">
              <div class="help-block with-errors"></div>
    </div>


            <div class="form-group">
                <select id="projectstatus" name="projectstatus" class="form-control"
  data-required-error="Project Status is required" >
<option  value="<?php echo $status;?>" selected><?php echo $status;?></option>
    <option value="">Project Status</option>
    <option value="Starting">Starting</option>
    <option value="Ongoing">Ongoing</option>
    <option value="Completed">Completed</option>
                          
          </select>
          <div class="help-block with-errors"></div>
  </div>
                            <div class="form-group">
    <label for="remarks">Remarks:</label>
    <input value="<?php echo $remarks;?>" type="text" class="form-control" id="remarks" name="remarks">
    <div class="help-block with-errors"></div>
    </div>
                           
                        </div>
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <label for="projectlocation">Project Location:</label><br>
<textarea id="projectlocation" name="projectlocation" style="width:100%;" required
     data-required-error="project location is required"><?php echo $location; ?></textarea>
     <div class="help-block with-errors"></div>
    </div>

                            <div class="form-group">
                                <label for="lga">LGA:</label>
                                <select multiple class="form-control" id="lga" name="lga" required
                                data-required-error="project lga is required">
                                    <option value="">Select LGA</option>
                                    <option value="<?php echo $lga; ?>" selected><?php echo $lga; ?></option>
                                    <option>Akoko-Edo</option>
                                    <option>Egor</option>
									<option>Esan Central</option>
									<option>Esan North East</option>
									<option>Esan South East</option>
									<option>Esan West</option>
									<option>Etsako Central</option>
									<option>Etsako East</option>
                                    <option>Etsako West</option>
                                    <option>Igueben</option>
                                    <option>Ikpoba Okha</option>
									<option>Oredo</option>
                                    <option>Orhionmwon</option>
                                    <option>Ovia North East</option>
                                    <option>Ovia South West</option>	
                                    <option>Owan East</option>
                                    <option>Owan West</option>	
									<option>Uhunmwonde</option>	
									<option>Others</option>	
									
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

 <div class="form-group">
     <label for="durationofcontract">Duration of Contract:</label>
     <div id="durationofcontract">
         <select id="durationyears" style="height:20px;" name="durationyears" data-required-error="Project duration is required" required>
    <option value="">Years</option>
    <option value="<?php echo $year." Years";?>" selected><?php echo $year." Years";?></option>
    <option value="0 Year">0 Year</option>
    <option value="1 Year">1 Year</option>
    <option value="2 Years">2 Years</option>
    <option value="3 Years">3 Years</option>
    <option value="4 Years">4 Years</option>
    <option value="5 Years">5 Years</option>
    <option value="6 Years">6 Years</option>
                         
          </select>
         <select id="durationmonths"  style="height:20px;" data-error="Project duration needed" name="durationmonths" required>
    <option value="">Months</option>
    <option value="<?php echo $months." Months";?>" selected><?php echo $months." Months";?></option>
    <option value="0 Month">0 Month</option>
    <option value="1 Month">1 Month</option>
    <option value="2 Months">2 Months</option>
    <option value="3 Months">3 Months</option>
    <option value="4 Months">4 Months</option>
    <option value="5 Months">5 Months</option>
     <option value="6 Months">6 Months</option>
    <option value="7 Months">7 Months</option>
    <option value="8 Months">8 Months</option>
     <option value="9 Months">9 Months</option>
    <option value="10 Months">10 Months</option>
    <option value="11 Months">11 Months</option>
                          
          </select>
     </div>
          <div class="help-block with-errors"></div>
  </div>

                           
                            <div class="form-group">
    <label for="expecteddateofcompletion">Expected Date of Completion:</label>
    <input value="<?php echo $expecteddateofcompletion; ?>" type="text" class="form-control mydatepicker" id="expecteddateofcompletion" name="expecteddateofcompletion" required
           data-required-error="project duration is required">
           <div class="help-block with-errors"></div>
    </div>
          
                        

                </div>
                </div>
                      </div>   <!-- end step 3 here -->





                     <!-- start step 4 here -->
                      <div id="step-4">
                       

                    <div class="row">
                         <div class="col-sm-12 text-center">
                    <h5 style="font-weight:800;">CONTRACTOR and CONSULTANT</h5>
                </div>
                    </div>
                     <div class="row">
                        <div class="col-xs-7 col-xs-offset-2 ">
                           <div class="form-group">
<select id="contractor" name="contractor" class="form-control"
          data-required-error="Contractor is required" required>
    <option value="">Select Contractor</option>
    <option value="<?php echo $contractor; ?>" selected><?php echo $contractor;?></option>
    <?php while($row=  mysqli_fetch_array($result)){ 
    
    echo "<option value=\"$row[0]\">$row[0]</option>";
     } ?>           
          </select>
          <div class="help-block with-errors"></div>
  </div> 
                        </div>
                            
                        

                    </div>
<div class="row">
                        <div class="col-xs-7 col-xs-offset-2 ">
                           <div class="form-group">
<select id="consultant" name="consultant" class="form-control"
          data-required-error="Consultant is required" required>
    <option value="">Select Consultant</option>
    <option value="<?php echo $consultant; ?>" selected><?php echo $consultant;?></option>
    <?php while($row=  mysqli_fetch_array($result2)){ 
    
    echo "<option value=\"$row[0]\">$row[0]</option>";
     } ?>           
          </select>
          <div class="help-block with-errors"></div>
  </div> 
                        </div>
                            
                        

                    </div>
                
                      </div>    <!-- End step 4 here -->



                        <!-- Start step 5 here-->
                        <div id="step-5">

                   <div class="row">


                  <div class="col-sm-12 text-center">
                    <h5 style="font-weight:800;">FINANCIALS</h5>
                </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
<div class="form-group">
    <label for="contractsum">Contract Sum(&#8358;):</label>
    <input value="<?php echo $contractsum;?>" type="text" class="form-control" id="contractsum" name="contractsum" required
    onblur="formatCurrency(this)"
    data-required-error="contract sum is required">
<div class="help-block with-errors"></div>
    </div> 
               
                            
                            <div class="form-group">
    <label for="mobilisationpaid">Advance Payment(&#8358;):</label>
    <input value="<?php echo $agreedmobilization; ?>" type="text" class="form-control" id="mobilisationpaid" name="mobilisationpaid" required
           onblur="formatCurrency(this)"
           data-required-error="mobilization paid is required">
           <div class="help-block with-errors"></div>
    </div> 
                     
                        </div>
                   
                    </div>

                        </div>
                    </div>   </form>
                    <!-- End SmartWizard Content form -->

                    
                    <!-- Tabs -->
                    
                    <!-- End SmartWizard Content -->
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

    
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <!-- validator script -->
    <script src="js/validator.min.js"></script>
    <!-- kendo core library -->
    <script src="js/kendo.core.min.js"></script>
  <script src="js/spin.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
   
 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<script src="myjs/editproject.js"></script>
   <script>
     $( ".mydatepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
    
});
  </script>
  </body>
</html>
<?php
mysqli_close($con);
?>