<?php
include './php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
    $priv=$_SESSION['privileges'];
    if((strpos($priv,"reporting")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has reporting privilege
    {

        //header("Location: create-project.php");
    }

    else{//ignore, this is a landing page
       // echo "<script>alert('You do not have the privilege to access this page');location.href='create-project.php';</script>";
    }
}
else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<?php

//include './php/dbconnect.php';
//or die ("Error in Connection");
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Report</title>

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
    
    <!-- Custom styling plus plugins -->
 <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
    <link href="build/css/custom.min.css" rel="stylesheet">

      <link href="dt/datatables.min.css" rel="stylesheet">
      <!--
 <link href="css/jquery.dataTables.min.css" rel="stylesheet">
  
 <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"> -->
  
    
    <style>
    .card1 {
  border-radius: 6px;
  box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
  background-color: #FFFFFF;
  color: #252422;
  margin-bottom: 20px;
  position: relative;
  z-index: 1;
  font-family: 'Ubuntu', sans-serif;
  height : 100%;
}
        
.card {
  border-radius: 6px;
  box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
  background-color: #FFFFFF;
  color: #252422;
  margin-bottom: 20px;
  position: relative;
  z-index: 1;
  font-family: 'Ubuntu', sans-serif;
  height : 100%;
}
.card .content {
  padding: 15px 15px 10px 15px;
}
.card .header {
  padding: 20px 20px 0;
}
.card .description {
  font-size: 16px;
  color: #66615b;
}
.card h6 {
  font-size: 12px;
  margin: 0;
}
.card .category,
.card label {
  font-size: 14px;
  font-weight: 400;
  color: #9A9A9A;
  margin-bottom: 0px;
}
.card .category i,
.card label i {
  font-size: 16px;
}
.card label {
  font-size: 15px;
  margin-bottom: 5px;
}
.card .title {
  margin: 0;
  color: #252422;
  font-weight: 300;
}
.card .avatar {
  width: 50px;
  height: 50px;
  overflow: hidden;
  border-radius: 50%;
  margin-right: 5px;
}
.card .footer {
  padding: 0;
  line-height: 30px;
}
.card .footer .legend {
  padding: 5px 0;
}
.card .footer hr {
  margin-top: 5px;
  margin-bottom: 5px;
}
.card .stats {
  color: #a9a9a9;
  font-weight: 300;
}
.card .stats i {
  margin-right: 2px;
  min-width: 15px;
  display: inline-block;
}
.card .footer div {
  display: inline-block;
}
.card .author {
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
}
.card .author i {
  font-size: 14px;
}
.card.card-separator:after {
  height: 100%;
  right: -15px;
  top: 0;
  width: 1px;
  background-color: #DDDDDD;
  content: "";
  position: absolute;
}
.card .ct-chart {
  margin: 30px 0 30px;
  height: auto;
}
.card .table tbody td:first-child,
.card .table thead th:first-child {
  padding-left: 15px;
}
.card .table tbody td:last-child,
.card .table thead th:last-child {
  padding-right: 15px;
}
    </style>
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
            <div class="page-title">
              <div class="title_left">
                <h3>All Projects Reports </h3>
              </div>

       <!--       <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>
              </div>  -->
            </div>

            <div class="clearfix"></div>

            <div style="" class="col-sm-12">
           
               
                <div class="row">
            <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Projects By MDA</h4>
                                <p class="category">All MDAs Projects categorized by MDA</p>
                            </div>
    <div class="content table-responsive">
    <div id="chartActivity" class="ct-chart">
                                    
    <table id="myTable" class="table table-condensed table-striped table-bordered table-hover">
        <thead class="bg-primary">
            <tr >
           
         
            <th>MDA</th>  
            <th>Number of Projects</th>
           
             
        </tr>
      </thead>
    <?php

   //  require_once 'dbconfig.php';           		
   //  $query = "SELECT `PROJECTID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION` FROM `projectdetails` ";
      $query = "SELECT PROCURINGENTITY, count(*) FROM projectdetails projectdetails GROUP BY PROCURINGENTITY ";
    
         //   $stmt = $con->prepare( $query );
         //   $stmt->execute();
        //    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
      // $query1 = "SELECT `PROJECTID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION`, `STATUS`, `LOCATION`, `LGA`,  `CONTRACTSUM` FROM `projectdetails` ";
    //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

    $result = mysqli_query($con, $query) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
   
   <?php  while ($row = mysqli_fetch_array($result)) {   ?>
          <tr>
            <td ><?php echo $row[0]; ?></td>
            <td ><?php echo $row[1]; ?></td>
           
            
            <!--
           <td>
     <button data-toggle="modal" data-target="#view-modal" data-id="<?php //echo $row[0]; ?>" id="getUser" class="btn btn-sm btn-info"> View</button>
     </td> -->
          
          </tr>
      <?php } ?>
    </tbody>
</table>                 



       </div>
             <div class="footer">
                            <div class="chart-legend">
                                <span>         
                                    <a href="dashboard.php"><input type="button" class="btn btn-primary" value="Back to Summary" > </a> 
                           </span>  
                            <!--     <i class="fa fa-circle text-warning"></i> MDA  -->
                            </div>
                                    <hr>
                           <div class="stats">
                              <i class="ti-check"></i> Data information certified
                           </div>
                                </div>
                            </div>
                        </div>
                    </div>


  <!-- card 2 -->
        
            </div> 
               
          <div class="clearfix"></div>                      
            </div>
            
            
            <!--  Another Row here -->
            

              <!-- end Col sm 12 -->
             <div class="clearfix"></div>
            
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




  
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; font-family: 'Ubuntu', sans-serif;">
             <div class="modal-dialog"> 
               
               
                  <div class="modal-content"> 
                  
                       <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">
                             PROJECT DETAILS
                            </h4> 
                       </div> 
                       <div class="modal-body"> 
                       <!-- <div id="forImg"> 	<img id="imagefile" style="height: 200px; width: 200px">  </div> -->

                       	   <div id="modal-loader" style="display: none; text-align: center;">
                       	 
                       	   </div>
                       
                       	   <div id="dynamic-content">
                                        
                           <div class="row"> 
                                <div class="col-md-12"> 
                            	
                            	<div class="table-responsive">
                                 
                                    
                                <table class="table table-striped table-bordered">
                           	
                             	<tr>
                            	<th>MDA</th>
                            	<td style="text-transform: uppercase" id="txt_mda"></td>
                              </tr>
                                                              
                                
                              <tr>
                            	<th>PROJECT TITLE</th>
                            	<td style="text-transform: uppercase" id="txt_title"></td>
                              </tr>
                                       		
                                <tr>
                                <th>PROJECT DESCRIPTION</th>
                                <td style="text-transform: uppercase" id="txt_descr"></td>
                                </tr>

                              	<tr>
                            	<th>LOCATION</th>
                            	<td style="text-transform: uppercase" id="txt_location"></td>
                              </tr>

                                 <tr>
                                <th>AWARDED DATE</th>
                                <td style="text-transform: uppercase" id="txt_awarded"></td>
                                </tr>

                                 <tr>
                                <th>CONTRACT SUM</th>
                                <td style="text-transform: uppercase" id="txt_csum"></td>
                                </tr>
                                       		
                                <tr>
                                <th>STATUS</th>
                                <td style="text-transform: uppercase" id="txt_status"></td>
                                </tr>
                                       		
                                <tr>
                                <th>PROJECT ID</th>
                                <td style="text-transform: uppercase" id="txt_id"></td>
                                </tr>
                                       		
                                </table>
                     
                                </div>
                                       
                                </div> 
                          </div>
                          
                          </div> 
                             
                        </div> 
              <div class="modal-footer"> 
                <button type="button" class="btn btn-danger" id="ignore" data-dismiss="modal">Close</button>
      <!-- <button type="button" class="btn btn-primary" id="treat" name="treat"   data-dismiss="modal">Treat</button>-->
              </div> 
                        
                 </div>   
              </div>
       </div><!-- /.modal -->    



 
   
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <script src="dt/datatables.min.js"></script>
    
   

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>


<script>
$(document).ready(function(){
    $('#myTable').DataTable();

});
</script>



<script>
$(document).ready(function(){
	var formdata = "" ;
	$(document).on('click', '#getUser', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id'); // get id of clicked row
		
		$('#dynamic-content').hide(); // hide dive for loader
		$('#modal-loader').show();  // load ajax loader
		
//console.log(uid);
//console.log("hiii");

		$.ajax({
			url: 'getinfo.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'json'
		})
		.done(function(data){
			//console.log(data);
			$('#dynamic-content').hide(); // hide dynamic div
			$('#dynamic-content').show(); // show dynamic div
			$('#txt_mda').html(data.PROCURINGENTITY);
			$('#txt_title').html(data.TITLE);
			$('#txt_descr').html(data.DESCRIPTION);
			$('#txt_id').html(data.PROJECTID);
      $('#txt_status').html(data.STATUS);
			$('#txt_lga').html(data.LGA);
      $('#txt_csum').html(data.CONTRACTSUM);
      $('#txt_awarded').html(data.DATEOFAWARD);
       $('#txt_location').html(data.LOCATION);
			$('#modal-loader').hide();    // hide ajax loader
    //  $('#imagefile').attr("src","../php/"+data.FilePath);
                    
                        //console.log("Completed");
      $(document).on('click', '#treat', function(e){
       //console.log("here") ; console.log(data) ;
       formdata = data;                      
                        //console.log("hii");
                        //console.log(formdata);
                        
   $.ajax({
			url: 'uduser.php',
			type: 'POST',
			data: formdata,
			dataType: 'json'
		})
       //console.log("hi22i");
          swal({
  title: "Successful !",
  text: "Successfully Treated the ticket",
  showCancelButton: false,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
  html: true
 // imageUrl: "images/thumb.png"
},
function(){
  location.href="tickets.php" ;
});
      

               });
                })
	.fail(function(){
			$('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
       
	});
        
       
	
});

</script>






 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  
  </body>
</html>