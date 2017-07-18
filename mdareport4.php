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

// "edpms") or die ("Error in Connection");
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | Project Financials By MDA</title>
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


      <link href="css/daterangepicker.css" rel="stylesheet">
      <link rel="stylesheet" href="dt/datatables.min.css">
      <link href="css/card1.css" rel="stylesheet">
      <!-- jQuery -->
      <script src="vendors/jquery/dist/jquery.min.js"></script>
      <script src="js/moment.min.js"></script>
      <!-- Bootstrap -->
      <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="js/kendo.core.min.js"></script>

      <!--
     <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="css/jquery.dataTables.min.css" rel="stylesheet">  -->
   

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



            </div>

            <div class="clearfix"></div>

            <div style="" class="col-sm-12">
           
               
                <div class="row">
            <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Projects Sum By MDA</h4>
                                <p class="category">All MDAs Projects Sum</p>
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
                <th  style="text-transform: uppercase;">MDA</th>
                <th style="text-transform: uppercase;">Project Sum</th>
                <th style="text-transform: uppercase;">Certificates Paid</th>
                <th style="text-transform: uppercase;">Outstanding Payments</th>
                <th style="text-transform: uppercase;">View</th>
        </tr>
      </thead>
    <?php

    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
     $conn = mysqli_connect("localhost", "root", "minowss", "edpms");
    $query1 = "CALL myProc('".$yr1."', '".$yr."')";
    // $query1 = "CALL myProc3('".$yr."')";
    $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());



    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { 
       //while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      ?>
          <tr>
              <td  style="text-transform: uppercase;"><?php echo $row[1]; ?></td>
              <td  class="currency-format" style="text-transform: uppercase;"><?php echo $row[2]; ?></td>
              <td  class="currency-format" style="text-transform: uppercase;"><?php
                  if(is_null($row[3]))
                  { echo 0.00; }
                  else
                  { echo $row[3];}

                  ?></td>
              <td  class="currency-format" style="text-transform: uppercase;"><?php
                  if (is_null($row[3]) && is_null($row[4])){
                      echo ($row[2]);
                  }

                  elseif (is_null($row[3]) && !is_null($row[4])){
                      echo ($row[2] + $row[4]);
                  }
                  elseif (!is_null($row[3]) && is_null($row[4])){
                      echo ($row[2] - $row[3]);
                  }

                  else{  echo (($row[2] + $row[4])  - $row[3]);  }
                  ?></td>
              <td>
                  <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row[1].'+'.$yr1.'+'.$yr; ?>" id="getUser" class="btn btn-sm btn-info"> View</button>
              </td>
          </tr>
      <?php } $conn->close(); ?>
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




  
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-lg">
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

                           <h2 id="cname"></h2>
                           <table>
                               <tr> <td> Total Contract Sum:   </td> <td>&nbsp;&nbsp; </td> <td class="currency-format" id="tcs">  </td>   </tr>
                               <tr> <td>Total Certificates:    </td> <td>&nbsp;&nbsp; </td> <td class="currency-format" id="tc">  </td>   </tr>
                               <tr> <td>Total Variations:  </td> <td> </td>&nbsp;&nbsp; <td class="currency-format" id="tv">  </td>   </tr>
                               <tr> <td>Outstanding:  </td> <td>&nbsp;&nbsp; </td> <td class="currency-format" id="outs">  </td>   </tr>
                           </table>

                           <hr/>


                           <table style="font-size: 90%" class="table table-responsive table-condensed table-striped table-bordered table-hover">
                               <thead class="bg-primary">
                               <tr >
                                   <!-- <th style="text-transform: uppercase;">ProjectID</th> -->
                                   <th style="text-transform: uppercase;">TITLE</th>
                                   <th style="text-transform: uppercase;">Project Sum</th>
                                   <th style="text-transform: uppercase;">Variations</th>
                                   <th style="text-transform: uppercase;">Certificates Paid</th>
                                   <th style="text-transform: uppercase;">Outstanding Payments</th>

                               </tr>
                               </thead>
                               <tbody  id="myMod1">

                               </tbody>
                           </table>
                       

                             
                        </div> 
              <div class="modal-footer"> 
                <button type="button" class="btn btn-danger" id="ignore" data-dismiss="modal">Close</button>
      <!-- <button type="button" class="btn btn-primary" id="treat" name="treat"   data-dismiss="modal">Treat</button>-->
              </div> 
                        
                 </div>   </form>
              </div>
       </div><!-- /.modal -->


    <!-- FastClick -->
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
                url: 'php/oth/mdafinancials.php',
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
                //console.log("hiiiss");

                var sparts = uid.split('+',3);
                var duid = sparts[0];
                var yr = sparts[1];
                var yr2 = sparts[2];
                console.log(duid);
                console.log(yr);
                console.log(yr2);
                console.log("hiiiss");

                $.ajax({
                    url: 'getinfoc2.php',
                    type: 'POST',
                    //data: 'id='+duid,
                    data: "id="+encodeURIComponent(duid)+"&yr="+encodeURIComponent(yr)+"&yr2="+encodeURIComponent(yr2),
                    dataType: 'json'
                })
                    .done(function(data){

                        console.log("noow3");
                        console.log(data.length);
                        //  var tbl=$("<table/>").attr("id","mytable");
                        //$("#div1").append(tbl);

                        $('#myMod1').html("");
                        $('#cname').html("");
                        $('#tcs').html("");
                        $('#tc').html("");
                        $('#tv').html("");
                        $('#outs').html("");

                        $('#cname').append(duid);

                        var totals1 = 0;
                        var totals2 = 0;
                        var totals3 = 0;
                        for(var i=0;i<data.length;i++)
                        {

                            var tr="<tr>";
                            // var td1="<td>"+data[i]["PROJECTID"]+"</td>";
                            //  var td2="<td>"+data[i]["CONTRACTOR"]+"</td>";
                            var td3="<td>"+data[i]["TITLE"]+"</td>";
                            var td4="<td class='currency-format'>"+Number(data[i]["CONTRACTSUM"])+"</td>";
                            var td5="<td class='currency-format'>"+Number(data[i]["vAmount"])+"</td>";
                            var td6="<td class='currency-format'>"+Number(data[i]["cAmount"])+"</td>";

                            var outstandin = Number(data[i]["CONTRACTSUM"]) + Number(data[i]["vAmount"]) - Number(data[i]["cAmount"]);
                            var td7="<td class='currency-format'>"+outstandin+"</td></tr>";

                            //   console.log(Number(data[i]["CONTRACTSUM"]));

                            $('#myMod1').append(tr+td3+td4+td5+td6+td7);

                            totals1 = totals1 +  Number(data[i]["CONTRACTSUM"]);
                            totals2 = totals2 +  Number(data[i]["vAmount"]);
                            totals3 = totals3 +  Number(data[i]["cAmount"]);

                        }

                        var outstan = totals1 + totals2 - totals3;
                        $('#tcs').append(totals1);
                        $('#tc').append(totals3);
                        $('#tv').append(totals2);
                        $('#outs').append(outstan);



                        $('.currency-format').each(function(index, element) {
                            $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                            //console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                        });


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

});
</script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  
  </body>
</html>