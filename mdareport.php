<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); 
?>

<?php
include 'php/dbconnect.php';

session_start();
if(isset($_SESSION['privileges']))
{
    $priv=$_SESSION['privileges'];
    if((strpos($priv,"reporting")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
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
//include './php/dbconnect.php';
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

    <title>EDPMS | Report Summary</title>
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

  <link rel="stylesheet" href="dt/bootstrap-select.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">

      <link href="css/daterangepicker.css" rel="stylesheet">
      <link rel="stylesheet" href="dt/datatables.min.css">
      <link href="css/card1.css" rel="stylesheet">
      <!-- jQuery -->
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <script src="js/moment.min.js"></script>
      <!-- Bootstrap -->
      <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="js/kendo.core.min.js"></script>

	
	
  </head>

  <body style="font-family: 'Montserrat', sans-serif;"  class="nav-md">
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

            </div>

            <div class="clearfix"></div>

            <div style="" class="col-sm-12">
           
                <div class="title_left">
              <!--  <span> <h4>Choose Project Year to View Report</h4>
               <select class="selectpicker" data-width = "fit" data-style="btn-info" id="yearoption" >
                        <option value="0">All</option>
                        <option selected value="<?php // echo date('Y')?>"> <?php // echo date('Y')?></option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                    </select>
                 </span>    -->
              </div>

                <div class="row">
            <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Projects Summary </h4>
                                <p class="category">All MDAs Projects </p>
                            </div>

                            <div id="daterange"  style="background: #fff; margin-left: 2%; cursor: pointer; padding: 5px 10px; border: 1px solid #0b97c4;  width: 30%">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>

    <div class="content table-responsive">
    <div id="chartActivity" class="ct-chart">


    <table id="myTable" class="table table-condensed table-striped table-bordered table-hover">
        <thead class="bg-primary">
            <tr >
            <th>PROJECT ID</th>
            <th>MDA</th>  
            <th>PROJECT TITLE</th>
            <th>DESCRIPTION</th>
            <th>LGA</th>
            <th>Action</th>
        </tr>
      </thead>
    <?php

       //$yr = date('Y');
    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
            require_once 'dbconfig.php';
            $query = "SELECT `PROJECTID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION`, `LGA` FROM `projectdetails` WHERE (DATEOFAWARD) BETWEEN '".$yr1."' AND '".$yr."' ";

            $stmt = $DBcon->prepare( $query );
            $stmt->execute();

    ?>
    <tbody>
      <?php //while ($row = mysqli_fetch_array($result)) {
       while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      ?>
          <tr>
            <td style="text-transform: uppercase"><?php echo $row['PROJECTID']; ?></td>
            <td style="text-transform: uppercase"><?php echo $row['PROCURINGENTITY']; ?></td>
            <td style="text-transform: uppercase"><?php echo $row['TITLE']; ?></td>
            <td style="text-transform: uppercase"><?php echo $row['DESCRIPTION']; ?></td>
            <td style="text-transform: uppercase"> <?php echo $row['LGA']; ?></td>
           <td>
     <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['PROJECTID']; ?>" id="getUser" class="btn btn-sm btn-info"> View</button>
     </td>
          
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
                 <form name="modform" id="modform">
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
                                <th>LGA</th>
                                <td style="text-transform: uppercase" id="txt_lga"></td>
                                </tr>


                                 	<tr>
                            	<th>LOCATION</th>
                            	<td style="text-transform: uppercase" id="txt_location"></td>
                              </tr>

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
                                <th>PROJECT AWARDED ON</th>
                                <td style="text-transform: uppercase" id="txt_awarded"></td>
                                </tr>

                                 <tr>
                                <th>CONTRACT SUM</th>
                                <td class="currency-format" style="text-transform: uppercase" id="txt_csum"></td>
                                </tr>
                                       		
                                <tr>
                                <th>STATUS</th>
                                <td style="text-transform: uppercase" id="txt_status"></td>
                                </tr>

                                    <tr>
                                        <th>CONTRACTOR</th>
                                        <td style="text-transform: uppercase" id="txt_contr"></td>
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
                  <!--
                  <button type="button" id="excel" class="btn btn-primary">Export to Excel</button>
                  <button type="button" id="pdf" class="btn btn-success">Export to PDF</button>
                  <button type="button" id="prints" class="btn btn-info">Print</button>

                  -->
                <button type="button" class="btn btn-danger" id="ignore" data-dismiss="modal">Close</button>
      <!-- <button type="button" class="btn btn-primary" id="treat" name="treat"   data-dismiss="modal">Treat</button>-->
              </div>

                        
                 </div>   </form>




              </div>
       </div><!-- /.modal -->



    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <script src="dt/datatables.min.js"></script>


    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>

    <script src="js/kendo.core.min.js"></script>
    <script src="js/daterangepicker.js"></script>



    <!-- Latest compiled and minified JavaScript
<script src="dt/bootstrap-select.js"></script>
-->
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="dt/i18n/defaults-*.min.js"></script>  -->

	
    
<script>
	var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
	
	</script>


    <script>
        $(document).ready(function(){

            // create the required start and end dates
            var start = moment(new Date(new Date().getFullYear(), 0, 1));
            var end = moment(new Date());

            // initialise date range widget
            $('#daterange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')]
                },
                linkedCalendars: false,
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                }
            }, updateDateRange);

            updateDateRange(start, end);
        });

        // function used to update the the date range display
        function updateDateRange(start, end){
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }


        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log(picker.startDate.format('YYYY-MM-DD'));
            console.log(picker.endDate.format('YYYY-MM-DD'));

            var startYr = picker.startDate.format('YYYY-MM-DD');
            var endYr = picker.endDate.format('YYYY-MM-DD');

            var x = $.ajax({
                type: "POST",
                url: 'php/oth/allreport.php',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                data: "yr=" + encodeURIComponent(startYr) + "&yr2=" + encodeURIComponent(endYr),
                dataType: "text"
            });

            x.done(function(serverResponse)
            {
                var servervalue=serverResponse.trim();
                if(servervalue=='error')
                {
                    //swal("Error!", "An error occured, please try again later ", "error");
                }

                else
                {
                    $('#myTable').html(serverResponse.trim());

                    $('.currency-format').each(function(index, element) {
                        $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                        console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                    });
                }
            });

            x.fail(function(){
                // swal("Server Error!", "Server could not process this request, please try again later!", "error");
            });

        })

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

            $('#txt_contr').html(data.CONTRACTOR);
      $('#txt_awarded').html(data.DATEOFAWARD);
       $('#txt_location').html(data.LOCATION);
	   
	   
	   $('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	//	console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
	
			$('#modal-loader').hide();    // hide ajax loader
    //  $('#imagefile').attr("src","../php/"+data.FilePath);
                    
      //                  console.log("Completed");
                        $(document).on('click', '#treat', function(e){
        //                console.log("here") ; console.log(data) ;
                        formdata = data;                      
          //              console.log("hii");
            //            console.log(formdata);
						
						
                        
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
 // location.href="tickets.php" ;
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

$(document).on("change", "#yearoption", function(event)
    {

      var yr = $('#yearoption').val();
      //console.log(yr);
 // $.post("reportScr5.php", {year: yr});
 var x = $.ajax({
  type: "POST",
  url: 'allreport.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#myTable').html(serverResponse.trim());

               }
     });

      x.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });
    });

</script>




<script>
$('.selectpicker').selectpicker({style: 'btn-primary',  size: 5,});
</script>

<script>
$(document).ready(function(){
    $('#myTable').DataTable(
        {
            dom: 'Bfrtip',
            lengthChange: true,
            pageLength: 10,
            lengthMenu: [ 10, 15, 20, 50, 100 ],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    );
    //"bInfo" : false
});
</script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

    <?php
    audit_traii("Viewed All Projects Report");
    ?>



  </body>
</html>