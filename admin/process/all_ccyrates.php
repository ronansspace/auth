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

$dt_today = date('Y-m-d');

$dt_first = str_replace("/", "-", strtotime($_GET['stdate']));
$dt_first = date('Y-m-d', strtotime($_GET['stdate']));

$dt_sec = str_replace("/", "-", $_GET['endate']);
$dt_sec = date('Y-m-d', strtotime($dt_sec));

$qry_type = $_GET['theid'];

if($qry_type == 2){
    $xtra_qry =  "and str_to_date( trade_date, '%d/%m/%Y') = '$dt_today'";
}else if($qry_type == 5){
    $xtra_qry =  " and (str_to_date( trade_date, '%d/%m/%Y') between '$dt_first' and '$dt_sec') ";
}

  $sql = "SELECT * FROM ccyrate where 1=1 $xtra_qry";
    
	$result = $conn->query($sql);
    
  $size = $result->num_rows;

  
  if($size <= 0){
  
    print json_encode("empty");
    exit;
    
  }                      
          
  while($fetch = $result->fetch_array()) {
        $date = $fetch['date'];
        //$date = date("d/m/Y H:i:s", strtotime($fetch['date']));
        $rate =  number_format($fetch["rate"], 5, '.', ',');
                                   
        $output[] = array (           
            $fetch["id"],$fetch["trade_date"],$fetch["ccypair"],$rate,$date
        );
        
  }
  
  echo json_encode($output);  
  exit;
?>
       