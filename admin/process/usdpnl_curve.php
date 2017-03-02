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
      $mktDate = date('Ymd', $dt_today);
  }else if($qry_type == 3){
      $startDate = '01/01/1970';
      $endDate = $dt_today;
      $mktDate = date('Ymd', $dt_today);
  }else if($qry_type == 4){
      $startDate = $dt_today_ten;
      $endDate = $dt_today;
      $mktDate = date('Ymd', $dt_today);
  }else if($qry_type == 5){
      $startDate = $dt_first;
      $endDate = $dt_sec;
      $mktDate = date('Ymd', $dt_first);
  }

$sql = "call get_usdpl('$startDate','$endDate')";
$result = $conn->query($sql);
$size = $result->num_rows;
if($size <= 0){
    print json_encode("empty");
    exit;
}
while($fetch = $result->fetch_array()) {
    $ccyPair = $fetch["Pair"];
    $checkCcy = substr($ccyPair, -3);
    $usdFX = "1";

    $tradeDate = $fetch["TradeDate"];
    $pair = $fetch["Pair"];
    $plnative = $fetch["PLNative"];
    $plusd = $fetch["PLUSD"];

    if($checkCcy == "USD") {
        $usdFX = 1;
    } else {
        $ccyPair = "USD" . $checkCcy;
        $sql = "SELECT rate from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
        $result1 = $conn->query($sql);
        $size = $result1->num_rows;
        if($size != 0){
            while($fetch1 = $result1->fetch_array()) {
                $usdFX = 1 / $fetch1["rate"];
            }
        } else {
            $ccyPair = $checkCcy . "USD";
            $sql = "SELECT rate from ccyrate where ccypair='$ccyPair' and trade_date='$mktDate'";
            $result2 = $conn->query($sql);
            $size = $result2->num_rows;
            if($size != 0){
                while($fetch2 = $result2->fetch_array()) {
                    $usdFX = $fetch2["rate"];
                }
            }
        }
    }

    $output[] = array (
        $tradeDate,$pair,$usdFX,$plnative,$plusd
    );

}
  
  echo json_encode($output);  
  exit;
?>
       