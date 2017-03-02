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

    $conn1 = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    // Check connection
    if ($conn1->connect_error) {
        die("Connection failed: " . $conn1->connect_error);
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
      $mktDate = $dt_today;
  }else if($qry_type == 3){
      $startDate = '01/01/1970';
      $endDate = $dt_today;
      $mktDate = $dt_today;
  }else if($qry_type == 4){
      $startDate = $dt_today_ten;
      $endDate = $dt_today;
      $mktDate = $dt_today;
  }else if($qry_type == 5){
      $startDate = $dt_first;
      $endDate = $dt_sec;
      $mktDate = $dt_first;
  }

$bits = explode('/',$mktDate);
$mktDate = $bits[2].$bits[1].$bits[0];

$sql1 = "SELECT * from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
$result1 = $conn->query($sql1);
$size = $result1->num_rows;

$sql = "call get_usdpl('$startDate','$endDate')";
$result = $conn->query($sql);
$size = $result->num_rows;
if($size <= 0){
    print json_encode("empty");
    exit;
}

$sql2 = "SELECT * from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
$result2 = $conn1->query($sql1);
$size = $result2->num_rows;


while($fetch = $result->fetch_array()) {
    $new_array[] = $fetch;
}

foreach ($new_array as $record) {
    $ccyPair = $record["Pair"];
    $usdFX = "1";
    $tradeDate = $record["TradeDate"];
    $pair = $record["Pair"];
    $plccy = $record["PLCcy"];
    $plnative = $record["PLNative"];
    $plusd = $record["PLUSD"];

    if($plccy == "USD") {
        $usdFX = 1;
    } else {
        $ccyPair = "USD" . $plccy;
        $sql1 = "SELECT * from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
        $result1 = $conn->query($sql1);
        $size = $result1->num_rows;
        if($size != 0){
            while($fetch1 = $result1->fetch_array()) {
                $usdFX = 1 / $fetch1["rate"];
            }
        } else {
            $ccyPair = $plccy . "USD";
            $sql2 = "SELECT rate from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
            $result2 = $conn->query($sql2);
            $size = $result2->num_rows;
            if($size != 0){
                while($fetch2 = $result2->fetch_array()) {
                    $usdFX = $fetch2["rate"];
                }
            }
        }
    }

    $output[] = array (
        $tradeDate,$pair,$plccy,$usdFX,$plnative,$plusd
    );

}
  
  echo json_encode($output);  
  exit;
?>
       