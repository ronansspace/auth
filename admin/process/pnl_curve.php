<?php
session_start();
require_once('../../inc/def.php');
if(tdrLoggedIn()){  }

  // Create connection
	// $conn = new mysqli($servername, $username, $password, $dbname);
  $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
  $tdrID = $_SESSION['auth_id'];
      	  
  $qry_type = $_GET['theid']; 
  
  $xtra_qry = "";
  
  $dt_today = date('d/m/Y');
  
  //Last 10 days
  $dt_today_ten = date('d/m/Y', strtotime("-10 days"));


   $dt_first = str_replace("/", "-", $_GET['stdate']);
   $dt_first = date('d/m/Y', strtotime($dt_first));

   $dt_sec = str_replace("/", "-", $_GET['endate']);
   $dt_sec = date('d/m/Y', strtotime($dt_sec));

  if($qry_type == 1){
      $startDate = '01/01/1970';
      $endDate = $dt_today;
  }else if($qry_type == 2){
      $startDate = $dt_today;
      $endDate = $dt_today;
  }else if($qry_type == 3){
      $startDate = '01/01/1970';
      $endDate = $dt_today;
  }else if($qry_type == 4){
      $startDate = $dt_today_ten;
      $endDate = $dt_today;
  }else if($qry_type == 5){
      $startDate = $dt_first;
      $endDate = $dt_sec;
  }

$sql = "call get_pl('$startDate','$endDate')";
$result = $conn->query($sql);
$size = $result->num_rows;
if($size <= 0){
    print json_encode("empty");
    exit;
}
while($fetch = $result->fetch_array()) {
    $output[] = array (
        $fetch["Contract"],$fetch["OrderID"],$fetch["Pair"],$fetch["PayCcy"],$fetch["GrossProfit"],$fetch["BrokerCost"],$fetch["VenueCost"],$fetch["TotalCost"],$fetch["NetProfit"]
    );

}
  
  echo json_encode($output);  
  exit;
?>
       