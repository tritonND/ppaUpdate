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
    if((strpos($priv,"dashboard")!==FALSE)||(strpos($priv,"sysadmin")!==FALSE))//check if he has dashboard privilege
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
//include 'php/dbconnect.php';
?>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EDPMS | All Reports - Dashboard</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet">

    <link href="css/daterangepicker.css" rel="stylesheet">
    <link href="css/cards.css" rel="stylesheet">
 


	 <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="js/kendo.core.min.js"></script>



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

<?php 
$yr = date('Y');
// $query1 = "SELECT count(PROJECTID), count(STATUS), sum(CONTRACTSUM)  FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' ";
$query = "SELECT COUNT(ID) FROM supervisors";
$query1 = " SELECT COUNT(projectdetails.PROJECTID), count(STATUS), SUM(projectdetails.CONTRACTSUM),
(SELECT SUM(AMOUNT) from certificates where YEAR(DATEISSUED) ='".$yr."') as cAmount,
(SELECT SUM(AMOUNT) from variations where YEAR(DATEISSUED) ='".$yr."' ) as vAmount
FROM projectdetails  where YEAR(projectdetails.DATEOFAWARD) = '".$yr."' ";

$myq = "CALL mp()";
$conn1 = mysqli_connect("localhost", "root", "minowss", "edpms");
$rest1 = mysqli_query($conn1, $myq);
$row11 = mysqli_fetch_array($rest1);
$cc = $row11[0];

$results = mysqli_query($con, $query);
$result = mysqli_query($con, $query1);



       if(  mysqli_num_rows($result) >0)
         {

    while($user=mysqli_fetch_array($result))
        {
        $result1 = mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($result1);

       }
    }


if(  mysqli_num_rows($results) >0)
{

    while($users=mysqli_fetch_array($results))
    {
        $result2 = mysqli_query($con, $query);
        $rows = mysqli_fetch_array($result2);

    }
}

 ?>
            <div class="row tile_count" style="font-family: 'Montserrat', sans-serif;">

                <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Choose Year Range </span>
                    <span>
                    <div id="daterange"  style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #0b97c4;  width: 90%">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span></span> <b class="caret"></b>
                    </div>
                    </span>
                </div>


                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Projects</span>
                    <div id="projtotal" style="font-size: xx-large"  class="count"><?php echo  $row1[0];  ?></div>
                    <span class="count_bottom"><i class="green"> </i> </span>
                </div>



                <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> All Project Sum </span>
                    <div id="projfund" style="font-size: xx-large" class="count green"> <?php echo  $row1[2] + $row1[4]; ?> </div>
                </div>


                <div class="col-md-2 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Projects Contractors </span>
                    <div  class="count green" style="font-size: xx-large"> <?php echo  $row11[0]; ?> </div>
                </div>





                <!--

                 <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Consultants and Contractors </span>
                    <div  class="count green" style="font-size: xx-large"> <?php //  echo  $rows[0]; ?> </div>
                </div>


                       <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                         <span class="count_top"><i class="fa fa-user"></i> Total Contractors</span>
                         <div class="count">131</div>

                       </div>
                       <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                         <span class="count_top"><i class="fa fa-user"></i> Total Consultants</span>
                         <div class="count">55</div>
                       </div>  -->
  </div>


            <div class="row tile_count" style="font-family: 'Montserrat', sans-serif;">


                <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Total Funds Disbursed </span>
                    <div id="projfund2" style="font-size: xx-large" class="count green currency-format"> <?php echo  $row1[3]; ?> </div>
                </div>


                <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Outstanding Payment </span>
                    <div id="projfund3"  class="count green currency-format" style="font-size: xx-large"> <?php echo  $row1[2] + $row1[4] - $row1[3] ; ?> </div>
                </div>

     <!--
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> Percentage Payments</span>
                    <div id="projtotal" style="font-size: xx-large"  class="count currency-format"><?php// echo (($row1[3] / ($row1[2] + $row1[4])) * 100 );?></div>
                    <span class="count_bottom"><i class="green"> </i> </span>
                </div>  -->


                <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i>Percentage Payment(%) </span>
                    <div id="projfund4" class="count green currency-format" style="font-size: xx-large">
                        <?php
                        echo  (($row1[3] / ($row1[2] + $row1[4])) * 100 );
                        ?> </div>
                </div>


            </div>





            <div class="">
            <div class="page-title">
              <div class="title_left" style="font-family: 'Montserrat', sans-serif;">
               <h3>All Projects Summary <a href="mdareport.php"> <input type="button" class="btn btn-primary" value="View All Project Data" > </a>
    </h3>  
              </div>
             

<!--
 <div class="">
            <div class="page-title">
              <div class="title_left">
   
  <span > <a href="mdareport.php"> <input type="button" class="btn btn-primary" value="View All Project Data" > </a>
     </span> 
             </div>

             -->


            </div>

            <div class="clearfix"></div>
            
              
            <!--  Another Row here -->
            
                <div class="col-sm-12 col-lg-12">
           
               
                <div class="row">
            <div class="col-lg-6 col-sm-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Projects Summary By Local Government Area &nbsp;</h4>
                                <p class="category">All MDAs Projects Summary Categorized By LGA </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                     <div id="years"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
        <table id="table1" class="table table-striped table-bordered table-hover">
        <thead class="bg-primary">
            <tr>
            <th  style="text-transform: uppercase;">Local Government Area</th>  
            <th  style="text-transform: uppercase;">Number of Projects</th>    
        </tr>
      </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
   // $yr = date('Y');
    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
    $query1 = "SELECT lga, count(*) FROM projectdetails WHERE (DATEOFAWARD) BETWEEN '".$yr1."' AND '".$yr."' GROUP BY LGA LIMIT 5";

    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td style="text-transform: uppercase;"><?php echo $row[0]; ?></td>
            <td  style="text-transform: uppercase;"><?php echo $row[1]; ?></td>
           
          </tr>
      <?php } ?>
    </tbody>
</table>     
                                    
                                </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series  -->
                                        <a href="mdareport1.php"> <input type="button" class="btn btn-primary" value="View All" > </a>
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
          <div class="col-lg-6 col-sm-6">
                        <div style="background-color: #DDEEDC;" class="card ">
                            <div class="header">
                                <h4 class="title">Projects By Location</h4>
                                <p class="category">Summary of Projects with their Geographical Locations  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
      <style>
      #map {
        height: 100%;  width: 100%;
      }
      html, body {
        height: 100%;
       
        margin: 3;
        padding: 2;
      }
    </style>                               
    
                                    
    <?php 
    $sql = "select * from polylines";
    $result = mysqli_query($con, $sql) or die("Error in Selecting " . mysqli_error($con));

    //create an array
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

    $sqlQ = "select lat, lng from geodata";
    $result2 = mysqli_query($con, $sqlQ) or die("Error in Selecting " . mysqli_error($con));

    //create an array
    $emparray1 = array();
    while($row = mysqli_fetch_assoc($result2))
    {
        $emparray1[] = $row;
    }
    ?>
  
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(6.3238155, 5.6247455),
          zoom: 7,
           mapTypeId: 'terrain'
        });

        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('echoXML.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('projname');
              var address = markerElem.getAttribute('contractor');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);

              


              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });

        
        // Create the border outline of the map area
        var flightPlanCoordinates =  <?php echo json_encode($emparray, JSON_NUMERIC_CHECK) ?>
        
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 4.0,
          strokeWeight: 4,
          fillColor: '#EFF000'
        });

        flightPath.setMap(map);

        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    
    </script>
                           
                                    
                                    
                                </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                        -->
                                <a href="mdareport3.php"> <input type="button" class="btn btn-success" value="View All" >  </a>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>                
           
                </div>  <!-- end Col sm 12 -->
				
				<!-- adding new row data here -->
				
				
				    <div class="clearfix"></div>

            <div style="" class="col-lg-12 col-sm-12">
           
               
                <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div style="background-color: #E3EAF9 " class="card ">
                            <div class="header">
                                <h4 class="title">Funds Disbursed on Projects</h4>
                                <p class="category">All MDAs Project and Funds Disbursed &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                     <div id="years1"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
                <table id="table7" class="table table-striped table-bordered table-hover">
    <thead class="bg-blue-sky">
        <tr>
            <th  style="text-transform: uppercase;">Project ID</th>
			<th  style="text-transform: uppercase;">Total Project Sum</th>
            <th style="text-transform: uppercase;">Certificates Paid</th>
            <th style="text-transform: uppercase;">Outstanding Payment</th>
        </tr>
    </thead>
    <?php

   // $yr = date('Y');
    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
//$query1 = "SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM, (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount, (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount FROM projectdetails   JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = \"aa111\" JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID GROUP BY projectdetails.PROJECTID LIMIT 5";
  //  $query1 = " SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM,
//(SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID AND YEAR(DATEISSUED) = '".$yr."'  GROUP BY certificates.PROJECTID) as cAmount,
//(SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID AND YEAR(DATEISSUED) = '".$yr."'  GROUP BY variations.PROJECTID ) as vAmount
//FROM projectdetails  where YEAR(projectdetails.DATEOFAWARD) = '".$yr."' LIMIT 4";

    $query1 = " SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM,
(SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID AND YEAR(DATEISSUED) = '".$yr."'  GROUP BY certificates.PROJECTID) as cAmount,
(SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID AND YEAR(DATEISSUED) = '".$yr."'  GROUP BY variations.PROJECTID ) as vAmount
FROM projectdetails  where (projectdetails.DATEOFAWARD) BETWEEN '".$yr1."'  AND '".$yr."' LIMIT 4";

    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td  style="text-transform: uppercase;"><?php echo $row[0]; ?></td>
            <td class="currency-format" style="text-transform: uppercase;">
                <?php
                if(is_null($row[3]))
                   {  echo $row[1]; }
                else {  echo $row[1] + $row[3]; }

                ?></td>
             <td class="currency-format" style="text-transform: uppercase;"><?php echo $row[2]; ?></td>
              <td class="currency-format" style="text-transform: uppercase;"><?php
                  if(is_null($row[3]))
                  {  echo ($row[1] - $row[2]); }
                  else {  echo ($row[1] + $row[3]) - $row[2]; }

                  ?></td>
          </tr>
      <?php } ?>
    </tbody>
</table>                               
       </div>
                        <div class="footer">
                            <div class="chart-legend">
                                <span>         
                        <a href="mdareport7.php"><input type="button" class="btn btn-warning" value="View All" > </a> 
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
          <div class="col-lg-6 col-sm-6">
                        <div style="background-color: #BEC4D1;" class="card ">
                            <div class="header">
                                <h4 class="title">Contractor and Consultants Directory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                                <p class="category">All Contractors and Consultants&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">

   <table id="table8" class="table table-striped table-bordered table-hover">
        <thead class="bg-info">
            <tr >
            <th  style="text-transform: uppercase;">Contractor</th>
            <th  style="text-transform: uppercase;">Contractor Address</th>  
              
        </tr>
      </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
    $yr = date('Y');
      // $query1 = "SELECT  FULLNAME, COMPANYNAME FROM supervisors WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY procuringentity LIMIT 4";
         $query1 = "SELECT COMPANYNAME, ADDRESS FROM supervisors  LIMIT 3";
            
      $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td  style="text-transform: uppercase;"><?php echo $row[0]; ?></td>
            <td  style="text-transform: uppercase;"><?php echo $row[1]; ?></td>  
          
           
          </tr>
      <?php } ?>
    </tbody>
</table>                                  
               </div>
                       <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                        -->
                                <a href="mdareport8.php"> <input type="button" class="btn btn-info" value="View All" > </a>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> 
            </div>
				
				
				
				
				<!-- end adding new row data here -->
            
                <div class="clearfix"></div>

            <div style="" class="col-lg-12 col-sm-12">
           
               
                <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div style="background-color: #E3EAF9 " class="card ">
                            <div class="header">
                                <h4 class="title">Projects Sum by MDA</h4>
                                <p class="category">All MDAs Project Appropriation Fee &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    <div id="years2"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
                <table id="table2" class="table table-striped table-bordered table-hover">
    <thead class="bg-orange">
        <tr>
            <th  style="text-transform: uppercase;">MDA</th>
            <th style="text-transform: uppercase;">Project Sum</th>
            <th style="text-transform: uppercase;">Certificates Paid</th>
            <th style="text-transform: uppercase;">Outstanding Payments</th>
        </tr>
    </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');

    //$yr = date('Y');
    //  $query1 = "SELECT procuringentity, sum(contractsum) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY procuringentity LIMIT 5";
    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
    $conn = mysqli_connect("localhost", "root", "minowss", "edpms");
    //$query1 = "CALL myProc()";
    //$query1 = "CALL myProc3('".$yr."')";
    $query1 = "CALL myProc3('".$yr1."', '".$yr."')";
    $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());
  //  $yr = date('Y');
     //  $query1 = "SELECT procuringentity, sum(contractsum) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY procuringentity LIMIT 5";
    //  $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
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
        </tr>
    <?php } $conn->close() ?>
    </tbody>
</table>                               
       </div>
                        <div class="footer">
                            <div class="chart-legend">
                                <span>         
                        <a href="mdareport4.php"><input type="button" class="btn btn-warning" value="View All" > </a> 
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
          <div class="col-lg-6 col-sm-6">
                        <div style="background-color: #BEC4D1;" class="card ">
                            <div class="header">
                                <h4 class="title">Projects By Ministries, Dept. and Agencies&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                                <p class="category">All MDAs Projects Summary &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    <div id="years3"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
   <table id="table3" class="table table-striped table-bordered table-hover">
        <thead class="bg-info">
            <tr >
            <th  style="text-transform: uppercase;">MDA</th>
            <th  style="text-transform: uppercase;">Number of Projects</th>  
             
        </tr>
      </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
    //$yr = date('Y');
      // $query1 = "SELECT  procuringentity, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY procuringentity LIMIT 4";

    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');

    $query1 = "SELECT  procuringentity, count(*) FROM projectdetails WHERE (DATEOFAWARD) BETWEEN '".$yr1."' AND '".$yr."' GROUP BY procuringentity LIMIT 4";

    $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td  style="text-transform: uppercase;"><?php echo $row[0]; ?></td>
            <td  style="text-transform: uppercase;"><?php echo $row[1]; ?></td>
          
           
          </tr>
      <?php } ?>
    </tbody>
</table>                                  
               </div>
                       <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                        -->
                                <a href="mdareport2.php"> <input type="button" class="btn btn-info" value="View All" > </a>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> 
               

            </div>
            
            
            <!--  Another Row here -->
            
                <div class="col-sm-12 col-lg-12">
           
               
                <div class="row">
            <div class="col-lg-6 col-sm-6">
                        <div style="background-color: #D3E7FF;" class="card ">
                            <div class="header">
                                <h4 class="title">Project Sum By LGA</h4>
                                <p class="category">All MDAs Projects Appropriation Sum categorized by LGA &nbsp;&nbsp;&nbsp; </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    <div id="years4"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
    <table id="table4" class="table table-striped table-bordered table-hover">
    <thead class="bg-blue">
        <tr>
            <th  style="text-transform: uppercase;">LGA</th>
            <th style="text-transform: uppercase;">Project Sum</th>
            <th style="text-transform: uppercase;">Certificates Paid</th>
            <th style="text-transform: uppercase;">Outstanding Payments</th>
        </tr>
    </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
    //$yr = date('Y');
   // $conn = mysqli_connect("localhost", "root", "minowss", "edpms");
   // $query1 = "CALL myProc2('".$yr."')";

    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');

    $conn = mysqli_connect("localhost", "root", "minowss", "edpms");
    $query1 = "CALL myProc2('".$yr1."','".$yr."')";

    $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());
     //  $query1 = "SELECT lga, sum(contractsum) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' GROUP BY lga LIMIT 5";
     // $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
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
          </tr>
      <?php } $conn->close(); ?>
    </tbody>
</table>      
                                </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series  -->
                                        <a href="mdareport5.php"> <input type="button" class="btn btn-dark" value="View All" > </a>
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
          <div class="col-lg-6 col-sm-6">
                        <div style="background-color: #DFEEDC;" class="card ">
                            <div class="header">
                                <h4 class="title">Projects Status</h4>
                                <p class="category">Projects Summary with their Current Status </p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    <div id="years5"><?php echo "Data retrieved for "; echo date('Y');   ?></div>
       <table id="table5" class="table table-striped table-bordered table-hover">
    <thead class="bg-blue-sky">
        <tr>
            <!-- <th  style="text-transform: uppercase;">ProjectID</th>  -->
            <th  style="text-transform: uppercase;">Project Name</th>  
            <th  style="text-transform: uppercase;">Project Status</th> 
        </tr>
    </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
    //$yr = date('Y');

    $yr1 = date('Y')."-01-01";
    $yr = date('Y-m-d');
       $query1 = "SELECT projectid, title, status FROM projectdetails WHERE (DATEOFAWARD) BETWEEN '".$yr1."' AND '".$yr."' order BY lga LIMIT 3";
            
      $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());  
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <!-- <td  style="text-transform: uppercase;"><?php echo $row[0]; ?></td>-->
            <td style="text-transform: uppercase;"><?php echo $row[1]; ?></td>
           <td style="text-transform: uppercase;"><?php echo $row[2]; ?></td>
          </tr>
      <?php } ?>
    </tbody>
</table>
                                </div>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <!--
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-warning"></i> BMW 5 Series
                                        -->
                                <a href="mdareport6.php"> <input type="button" class="btn btn-success" value="View All" >  </a>
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>                
           
                </div>  <!-- end Col sm 12 -->
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

  
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
    <script src="js/searchtable.js"></script>
    <script src="js/autofilter.js"></script>
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
     <!-- Latest compiled and minified JavaScript -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script> -->

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>  -->


     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJ0w067KDql_zWI3tur698n-UE3eaQMk&callback=initMap">
    </script>


        <script src="js/daterangepicker.js"></script>
        <script src="js/myjs.js"></script>
	
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
 $(document).on("change", "#yearoption", function(event)
    {
      var yr = $('#yearoption').val();
        document.getElementById("years").innerHTML = "Data retrieved for " + yr;
        document.getElementById("years1").innerHTML = "Data retrieved for " + yr;
        document.getElementById("years2").innerHTML = "Data retrieved for " + yr;
        document.getElementById("years3").innerHTML = "Data retrieved for " + yr;
        document.getElementById("years4").innerHTML = "Data retrieved for " + yr;
        document.getElementById("years5").innerHTML = "Data retrieved for " + yr;
     // console.log(yr);
 var x = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr5.php',
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
                  $('#table5').html(serverResponse.trim());
				  
				   
	var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
				  
               }
     });

      x.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });



        var xff = $.ajax({
            type: "POST",
            url: 'php/oth/reportScr6.php',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            data: "yr=" + encodeURIComponent(yr),
            dataType: "text"
        });

        xff.done(function(serverResponse)
        {
            var servervalue=serverResponse.trim();
            if(servervalue=='error')
            {
                //swal("Error!", "An error occured, please try again later ", "error");
            }

            else
            {
                $('#table7').html(serverResponse.trim());

                var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
                $('#projfund').text(pf);
                //console.log(pf

                $('.currency-format').each(function(index, element) {
                    $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                  //  console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
                });

            }
        });

        xff.fail(function(){
            // swal("Server Error!", "Server could not process this request, please try again later!", "error");
        });

//next table

var x4 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr4.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x4.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#table4').html(serverResponse.trim());
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});

               }
     });

      x4.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });


     //next table

var x3 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr3.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x3.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#table3').html(serverResponse.trim());
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});

               }
     });

      x3.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });


     //next table

var x2 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr2.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x2.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#table2').html(serverResponse.trim());
				  
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});

               }
     });

      x2.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });


     //next table

var x1 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr1.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x1.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#table1').html(serverResponse.trim());
				  
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});

               }
     });

      x1.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });

var x01 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr01.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x01.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                  $('#projtotal').html(serverResponse.trim());
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
               }
     });

      x01.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });

     var x02 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr02.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x02.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                   $('#projstatus').html(serverResponse.trim());
				   var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
                 
               }
     });

      x02.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });

  var x03 = $.ajax({
  type: "POST",
  url: 'php/oth/reportScr03.php',
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  data: "yr=" + encodeURIComponent(yr),
  dataType: "text"
});

  x03.done(function(serverResponse)
     {
           var servervalue=serverResponse.trim();
               if(servervalue=='error')
               {
                  //swal("Error!", "An error occured, please try again later ", "error");
               }

               else
               {
                 
                  $('#projfund').html(serverResponse.trim());
				  var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
	$('#projfund').text(pf);
	//console.log(pf
	
	$('.currency-format').each(function(index, element) {
		  $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
		//console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});

               }
     });

      x03.fail(function(){
       // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });



     var x04 = $.ajax({
         type: "POST",
         url: 'php/oth/reportScr04.php',
         contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
         data: "yr=" + encodeURIComponent(yr),
         dataType: "text"
     });

     x04.done(function(serverResponse)
     {
         var servervalue=serverResponse.trim();
         if(servervalue=='error')
         {
             //swal("Error!", "An error occured, please try again later ", "error");
         }

         else
         {
             $('#projfund2').html(serverResponse.trim());
             var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
             $('#projfund').text(pf);
             //console.log(pf

             $('.currency-format').each(function(index, element) {
                 $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
               //  console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
             });
         }
     });

     x04.fail(function(){
         // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });


     var x05 = $.ajax({
         type: "POST",
         url: 'php/oth/reportScr05.php',
         contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
         data: "yr=" + encodeURIComponent(yr),
         dataType: "text"
     });

     x05.done(function(serverResponse)
     {
         var servervalue=serverResponse.trim();
         if(servervalue=='error')
         {
             //swal("Error!", "An error occured, please try again later ", "error");
         }

         else
         {
             $('#projfund3').html(serverResponse.trim());
             var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
             $('#projfund').text(pf);
             //console.log(pf

             $('.currency-format').each(function(index, element) {
                 $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
               //  console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
             });
         }
     });

     x05.fail(function(){
         // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });


     var x06 = $.ajax({
         type: "POST",
         url: 'php/oth/reportSrc06.php',
         contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
         data: "yr=" + encodeURIComponent(yr),
         dataType: "text"
     });

     x06.done(function(serverResponse)
     {
         var servervalue=serverResponse.trim();
         if(servervalue=='error')
         {
             //swal("Error!", "An error occured, please try again later ", "error");
         }

         else
         {
             $('#projfund4').html(serverResponse.trim());
             var pf = kendo.toString(kendo.parseFloat($('#projfund').text().trim()), 'n2');
             $('#projfund').text(pf);
             //console.log(pf

             $('.currency-format').each(function(index, element) {
                 $(element).text(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
              //   console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
             });
         }
     });

     x06.fail(function(){
         // swal("Server Error!", "Server could not process this request, please try again later!", "error");
     });



 });



 // adding more scripts

function myfunc() {
    var x = document.getElementById("yearoption").value;
   // document.getElementById("demo").innerHTML = "You selected: " + x;
  // console.log(x);
}
</script>

<script>
//$('.selectpicker').selectpicker({ "style" : 'btn-primary', "size" : 5, "data-width" :'fit'});
</script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

        <?php

    audit_traii("Viewed Dashboard.");
        ?>
  
  </body>
</html>