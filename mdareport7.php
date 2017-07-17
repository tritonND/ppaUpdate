<?php
include './php/dbconnect.php';

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

<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | All Projects Financial Report</title>

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
 <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="/css/jquery.dataTables.min.css" rel="stylesheet">

      <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"  rel="stylesheet">
      <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css"  rel="stylesheet">
-->

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
                <h3>All Projects Financial Report</h3>
              </div>

          <!--    <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div style="" class="col-sm-12">
           
               
                <div class="row">
            <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Projects Financials</h4>
                                <p class="category">All MDAs Projects Showing Financial Details </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    
    <table id="myTable" class="table table-condensed table-striped table-bordered table-hover">
        <thead class="bg-primary">
         <tr>
            <th>PROJECTID</th>
            <th>PROJECT SUM</th>
            <th>TOTAL CERTIFICATES PAID</th>
            <th>TOTAL VARIATIONS</th>
             <th>Action</th>
        </tr>
      </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
   //    $query1 = "SELECT `PROJECTID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION`, `STATUS`, `LOCATION`, `LGA`, `DATEOFAWARD`, `DURATIONOFCONTRACT`,  `CONTRACTSUM` FROM `projectdetails` ";


    $query1 = "SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM, 
               (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount, 
               (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount FROM projectdetails 
               LEFT JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID
               LEFT JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID GROUP BY projectdetails.PROJECTID ";

    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td style="text-transform: uppercase"><?php echo $row[0]; ?></td>
            <td class="currency-format" style="text-transform: uppercase"><?php echo $row[1]; ?></td>
              <td class="currency-format" style="text-transform: uppercase"><?php
                  if(  is_null($row[2]) )
                  {
                      $row[2] = 0.00;
                      echo $row[2];
                  }
                  else {
                      echo $row[2];
                  }
                  ?></td>
              <td class="currency-format" style="text-transform: uppercase"><?php
                  if(  is_null($row[3]) )
                  {
                      $row[3] = 0.00;
                      echo $row[3];
                  }
                  else {
                          echo $row[3];
                       }

                  ?></td>
              <td>
                  <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row[0]; ?>" id="getUser" class="btn btn-sm btn-info"> View</button>
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
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

        <div class="modal-dialog">
            <form name="modform" id="modform">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">
                            PROJECT FINANCIAL DETAILS
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
                                                <th>PROJECT ID</th>
                                                <td style="text-transform: uppercase" id="txt_id"></td>
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
                                                <th>PROJECT CONTRACTOR</th>
                                                <td style="text-transform: uppercase" id="txt_contr"></td>
                                            </tr>


                                            <!--


                                             <tr>
                                                <th>PROJECT DURATION</th>
                                                <td style="text-transform: uppercase" id="txt_dur"></td>
                                            </tr>



                                            <tr>
                                                <th>PROJECT DESCRIPTION</th>
                                                <td style="text-transform: uppercase" id="txt_descr"></td>
                                            </tr>

                                            <tr>
                                                <th>PROJECT AWARDED ON</th>
                                                <td style="text-transform: uppercase" id="txt_awarded"></td>
                                            </tr>
                                            -->

                                            <tr>
                                                <th>CONTRACT SUM</th>
                                                <td class="currency-format" style="text-transform: uppercase" id="txt_csum"></td>
                                            </tr>

                                            <tr>
                                                <th>TOTAL CERTIFICATES PAID</th>
                                                <td class="currency-format" style="text-transform: uppercase" id="txt_lga"></td>
                                            </tr>

                                            <tr>
                                                <th>TOTAL VARIATIONS</th>
                                                <td class="currency-format" style="text-transform: uppercase" id="txt_status"></td>
                                            </tr>


                                            <tr>
                                                <th>OUTSTANDING PAYMENT</th>
                                                <td class="currency-format" style="text-transform: uppercase" id="txt_bal"></td>
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


        <!--   making pdf here  -->

        <!--  endpdf here-->
    </div><!-- /.modal -->









    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>

    <script src="dt/datatables.min.js"></script>

    <!--

    <script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
     <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>

-->


    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>

	<script src="js/kendo.core.min.js"></script>





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
            var formdata = "" ;
            $(document).on('click', '#getUser', function(e){

                e.preventDefault();

                var uid = $(this).data('id'); // get id of clicked row

                $('#dynamic-content').hide(); // hide dive for loader
                $('#modal-loader').show();  // load ajax loader

                //console.log(uid);
                //console.log("hiii");

                $.ajax({
                    url: 'getinf.php',
                    type: 'POST',
                    data: 'id='+uid,
                    dataType: 'json'
                })
                    .done(function(data){
                       // //console.log(data);
                        //console.log("here");

                        //console.log(data.r1['CONTRACTSUM']);
                        //console.log(data.r3['vAmount']);
                        //console.log(data.r2['cAmount']);
                        //console.log("here");

                        var val1 = data.r1['CONTRACTSUM'];
                        var val2 = data.r2['cAmount'];
                        var val3 = data.r3['vAmount'];

                       // var res11 = parseInt(val1) + parseInt(val3) - parseInt(val2);

                        var res11 = Number(val1) + Number(val3) - Number(val2);
                        ////console.log(val1 + val3);
                        //console.log(res11);

                        //console.log("here");

                        var temp;

                        if(val2 == null)
                        {
                            temp = 0.0;
                        }
                        else { temp = Number(val2); }


                        $('#dynamic-content').hide(); // hide dynamic div
                        $('#dynamic-content').show(); // show dynamic div
                        $('#txt_mda').html(data.r1['PROCURINGENTITY']);
                        $('#txt_title').html(data.r1['TITLE']);
                        $('#txt_bal').html(res11);
                        $('#txt_id').html(data.r1['PROJECTID']);
                        $('#txt_status').html(val3);
                        $('#txt_lga').html(temp);
                        $('#txt_csum').html(data.r1['CONTRACTSUM']);
                        $('#txt_contr').html(data.r1['CONTRACTOR']);
                        $('#txt_location').html(data.r1['LOCATION']);

                      //  document.getElementById()

                        $('.currency-format').each(function(index, element) {
                            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                            //console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                        });

                        $('#modal-loader').hide();    // hide ajax loader
                        //  $('#imagefile').attr("src","../php/"+data.FilePath);

                        //console.log("Completed");

                    })
                    .fail(function(){
                        $('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    });

            });



        });

    </script>






    <script>
$(document).ready(function(){
    $('#myTable').DataTable(
        {
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    );

    $('#modal-dialog').DataTable(
        {
            dom: 'Bfrtip',
            lengthChange: true,
            pageLength: 10,
            lengthMenu: [ 10, 15, 20, 50, 100 ],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    );

});
</script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

    <?php
    audit_traii("viewed All Projects financial Records");
    ?>
  
  </body>
</html>