<?php
/**
 * Created by PhpStorm.
 * User: tritonND
 * Date: 7/18/2017
 * Time: 9:38 AM
 */

require_once ("../dbconnect.php");
//$conn= new mysqli_connect("localhost", "root", "minowss", "edpms");

 $yr =  mysqli_real_escape_string($con, $_POST['yr']);
$yr2 =  mysqli_real_escape_string($con, $_POST['yr2']);


 if ($yr != 0){
     echo " <table id=\"myTable\" class=\"table table-striped table-bordered table-hover\">";
     echo "<thead class=\"bg-primary\">";
     echo "<tr>";
     echo "<th>PROJECTID</th>";
     echo "<th>PROJECT SUM</th>";
     echo "<th>TOTAL CERTIFICATES PAID</th>";
     echo "<th>TOTAL VARIATIONS</th>";
     echo "<th>OUTSTANDING PAYMENT</th>";
     echo "<th>Action</th>";
     echo "</tr>";
     echo "</thead>";
     echo "<tbody>";

     // $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' order BY lga LIMIT 5";
   // $query1 = "SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM, (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount, (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount FROM projectdetails JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = \"aa111\" JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID WHERE DATEOFAWARD BETWEEN '".$yr."'  AND '".$yr2."'  GROUP BY projectdetails.PROJECTID  ";

     $query1 = "SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM, 
               (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount, 
               (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount FROM projectdetails 
               LEFT JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID
               LEFT JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID WHERE DATEOFAWARD BETWEEN '".$yr."' AND '".$yr2."' GROUP BY projectdetails.PROJECTID ";




     $result = mysqli_query($con, $query1);

     if(  mysqli_num_rows($result) >0)
     {
         //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

         while($user=mysqli_fetch_array($result))
         {
             if (is_null($user[3])) { $val = 0.00;}
             else{$val = $user[3];}


             if( is_null($user[2]) )
             {
                 $val2 = 0.00;
             }
             else {
                 $val2 = $user[2];
             }

             echo "<tr>";
             echo "<td style=\"text-transform: uppercase\">".$user[0]."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$user[1]."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$val2."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$val."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".($user[1] + $val - $user[2])."</td>";


             echo "<td> <button data-toggle=\"modal\" data-target=\"#view-modal\" data-id=".$user[0]." id=\"getUser\" class=\"btn btn-sm btn-info\"> View</button> </td>";
             echo "</tr>";
         }

         echo "</tbody>";
         echo "</table>";

     }

     else echo "No data";

 }

 else
 {

     echo " <table id=\"myTable\" class=\"table table-striped table-bordered table-hover\">";
     echo "<thead class=\"bg-primary\">";
     echo "<tr>";
     echo "<th>PROJECTID</th>";
     echo "<th>PROJECT SUM</th>";
     echo "<th>TOTAL CERTIFICATES PAID</th>";
     echo "<th>TOTAL VARIATIONS</th>";

     echo "<th>Action</th>";
     echo "</tr>";
     echo "</thead>";
     echo "<tbody>";

     // $query1 = "SELECT lga, count(*) FROM projectdetails WHERE YEAR(DATEOFAWARD)='".$yr."' order BY lga LIMIT 5";
     $query1 = "SELECT projectdetails.PROJECTID, projectdetails.CONTRACTSUM, (SELECT SUM(AMOUNT) from certificates WHERE projectdetails.PROJECTID = certificates.PROJECTID GROUP BY certificates.PROJECTID) as cAmount, (SELECT SUM(AMOUNT) from variations WHERE projectdetails.PROJECTID = variations.PROJECTID GROUP BY variations.PROJECTID ) as vAmount FROM projectdetails JOIN variations ON projectdetails.PROJECTID = variations.PROJECTID OR variations.PROJECTID = \"aa111\" JOIN certificates ON projectdetails.PROJECTID = certificates.PROJECTID  WHERE DATEOFAWARD BETWEEN '".$yr."'  AND '".$yr2."' GROUP BY projectdetails.PROJECTID ";

     $result = mysqli_query($con, $query1);

     if(  mysqli_num_rows($result) >0)
     {
         //  $result = mysqli_query($conn, $query1) or die('Query fail: ' . mysqli_error());

         while($user=mysqli_fetch_array($result))
         {
             echo "<tr>";
             echo "<td  style=\"text-transform: uppercase\">".$user[0]."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$user[1]."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$user[2]."</td>";
             echo "<td class=\"currency-format\" style=\"text-transform: uppercase\">".$user[3]."</td>";

             echo "<td> <button data-toggle=\"modal\" data-target=\"#view-modal\" data-id=".$user[0]." id=\"getUser\" class=\"btn btn-sm btn-info\"> View</button> </td>";
             echo "</tr>";
         }

         echo "</tbody>";
         echo "</table>";

     }
 }



?>

