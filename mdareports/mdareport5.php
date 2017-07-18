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
        echo "<script>alert('You do not have the privilege to access this page');location.href='create-project.php';</script>";
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

    <title>EDPMS | All Project Sum by LGA</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
 <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
    <link href="build/css/custom.min.css" rel="stylesheet">

 <link href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
   
    
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
                <h3>All Projects Sum by LGA</h3>
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
                                <h4 class="title">Project Sum By LGA</h4>
                                <p class="category">All MDAs Projects Contract Sum categorized by LGA</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    
    <table id="myTable" class="table table-condensed table-striped table-bordered table-hover">
        <thead class="bg-primary">
            <tr >
                <th  style="text-transform: uppercase;">LGA</th>
                <th style="text-transform: uppercase;">Project Sum</th>
                <th style="text-transform: uppercase;">Certificates Paid</th>
                <th style="text-transform: uppercase;">Outstanding Payments</th>
        </tr>
      </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
   //    $query1 = "SELECT `PROJECTID`, `PROCURINGENTITY`, `TITLE`, `DESCRIPTION`, `STATUS`, `LOCATION`, `LGA`, `DATEOFAWARD`, `DURATIONOFCONTRACT`,  `CONTRACTSUM` FROM `projectdetails` ";

    //   $query1 = "SELECT lga, sum(contractsum) FROM projectdetails GROUP BY lga";
    //  $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());

    $conn = mysqli_connect("localhost", "root", "", "edpms");
    $query1 = "CALL myProc1()";
    // $query1 = "CALL myProc3('".$yr."')";
    $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());



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
            
                <div class="col-sm-12">
           
               
                <div class="row">
            <div class="col-sm-6">
                        <div style="background-color: #DDEEAA;" class="card ">
                            <div class="header">
                                <h4 class="title">Projects By LGA</h4>
                                <p class="category">LGA Projects Summary</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                <table class="table table-striped table-bordered table-hover">
    <thead class="bg-warning">
        <tr>
            <th>Title</th>
            <th>LGA</th>  
            <th>Award Date</th>  
        </tr>
    </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
       $query1 = "SELECT title, lga, dateofaward FROM projectdetails ORDER BY DATEOFAWARD DESC LIMIT 5";
            
      $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
           
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
                                          <input type="button" class="btn btn-warning" value="View All" > 
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
          <div class="col-sm-6">
                        <div style="background-color: #DDEEDC;" class="card ">
                            <div class="header">
                                <h4 class="title">Projects By MDA</h4>
                                <p class="category">All MDAs Projects</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart">
                                    
                                    
                                     <table class="table table-striped table-bordered table-hover">
    <thead class="bg-success">
        <tr>
            <th>Title</th>
            <th>MDA</th>  
            <th>Contract Sum</th>  
        </tr>
    </thead>
    <?php
    //  $conn = mysqli_connect('localhost', 'user', 'password', 'db', 'port');
       $query1 = "SELECT title, procuringentity, contractsum FROM projectdetails ORDER BY DATEOFAWARD DESC LIMIT 5";
            
      $result = mysqli_query($con, $query1) or die('Query fail: ' . mysqli_error());
    ?>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td class="currency-format"><?php echo $row[2]; ?></td>
           
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
                                          <input type="button" class="btn btn-success" value="View All" > 
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

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    
    <script src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
     <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>


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
		console.log(kendo.toString(kendo.parseFloat($(element).text().trim()), 'n2'));
	});
	
	</script>

	
	

<script>
$(document).ready(function(){
    $('#myTable').DataTable();

});
</script>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>

    <?php
    audit_traii("viewed Project Sum By LGA");
    ?>
  
  </body>
</html>