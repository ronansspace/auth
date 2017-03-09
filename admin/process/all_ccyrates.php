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

$dt_today = date('Ymd');

$qry_type = $_GET['theid'];

$dt_first = str_replace("/", "-", $_GET['stdate']);
$dt_first = date('Ymd', strtotime($dt_first));
$dt_sec = str_replace("/", "-", $_GET['endate']);
$dt_sec = date('Ymd', strtotime($dt_sec));

if($qry_type == 2){
    $xtra_qry =  "and trade_date = '$dt_today'";
}else if($qry_type == 5){
    $xtra_qry =  " and (trade_date >= '$dt_first' and trade_date <= '$dt_sec') ";
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
       