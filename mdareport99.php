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
    <link href="css/card1.css" rel="stylesheet"
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/kendo.core.min.js"></script>
    <link rel="stylesheet" href="dt/datatables.min.css">

    <!--
    <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
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
                                    <h4 class="title">Projects Sum By Contractors</h4>
                                    <p class="category">All Contractors Projects Sum</p>
                                </div>


                                <div id="daterange"  style="background: #fff; margin-left: 2%; cursor: pointer; padding: 5px 10px; border: 1px solid #0b97c4;  width: 30%">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>

                                <div class="content table-responsive">
                                    <div id="chartActivity" class="ct-chart">

                                        <div class="row">
                                            <div class="col-sm-5"> </div>
                                            <div class=" col-md-5 col-md-offset-5">
                                                <a href="mdareport8.php" type="button" class="btn  btn-primary">View Registered Contractors </a>

                                                <!--<button class="btn  btn-primary">View Contractors Financials</button> -->
                                            </div>

                                        </div>

                                        <table id="myTable" class="table table-condensed table-striped table-bordered table-hover">
                                            <thead class="bg-primary">
                                            <tr >
                                                <th  style="text-transform: uppercase;">Contractor</th>
                                                <th style="text-transform: uppercase;">Project Sum</th>
                                                <th style="text-transform: uppercase;">Certificates Paid</th>
                                                <th style="text-transform: uppercase;">Outstanding Payments</th>
                                                <th style="text-transform: uppercase;">View</th>
                                            </tr>
                                            </thead>
                                            <?php


                                            $conn = mysqli_connect("localhost", "root", "minowss", "edpms");
                                            $query1 = "CALL myProc4()";
                                            // $query1 = "CALL myProc3('".$yr."')";
                                            $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());



                                            ?>
                                            <tbody>
                                            <?php while ($row = mysqli_fetch_array($result)) {

                                                ?>
                                                <tr>
                                                    <td  style="text-transform: uppercase;"><?php echo $row[0]; ?></td>
                                                    <td  class="currency-format" style="text-transform: uppercase;"><?php
                                                        if (is_null($row[3]))
                                                            echo $row[1];
                                                        else { echo ($row[1] + $row[3]);}
                                                        ?></td>
                                                    <td  class="currency-format" style="text-transform: uppercase;"><?php echo $row[2]; ?></td>
                                                    <td  class="currency-format" style="text-transform: uppercase;"><?php
                                                        if (is_null($row[3])){
                                                            echo ($row[1] - $row[2]);
                                                        }
                                                        else{  echo (($row[1] + $row[3])  - $row[2]);  }
                                                        ?></td>

                                                    <td>
                                                        <button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row[0]; ?>" id="getUser" class="btn btn-sm btn-info"> View</button>
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
    <div class="modal-dialog">
        <form name="modform" id="modform">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">
                       CONTRACTOR PROJECT DETAILS
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
-->

<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>
<script src="js/searchtable.js"></script>
<script src="js/autofilter.js"></script>


<script src="js/daterangepicker.js"></script>
<script src="js/myjs.js"></script>

<script src="js/kendo.core.min.js"></script>



<script>
    var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
    $('#projfund').text(pf);
    //console.log(pf

    $('.currency-format').each(function(index, element) {
        $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
       // console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
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

           // console.log(uid);
           // console.log("hiiiss");

            $.ajax({
                url: 'getinfoc.php',
                type: 'POST',
                data: 'id='+uid,
                dataType: 'json'
            })
                .done(function(data){

                  //  console.log("noow3");
                   // console.log(data.length);
                  //  var tbl=$("<table/>").attr("id","mytable");
                    //$("#div1").append(tbl);

                    $('#myMod1').html("");
                    $('#cname').html("");
                    $('#tcs').html("");
                    $('#tc').html("");
                    $('#tv').html("");
                    $('#outs').html("");

                    $('#cname').append(uid);

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


                  //  console.log("Completed");

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