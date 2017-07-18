<?php
include './php/dbconnect.php';

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$query = "SELECT * FROM geodata";
mysqli_query($con, $query);

$query1 = "SELECT lat, lng FROM polylines";
mysqli_query($con, $query1);

$result = mysqli_query($con, $query);
$result1 = mysqli_query($con, $query1);


if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'contractor="' . parseToXML($row['contractor']) . '" ';
  echo 'projname="' . parseToXML($row['projname']) . '" ';
  echo 'location="' . parseToXML($row['location']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  // echo 'type="' . $row['type'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';


?>