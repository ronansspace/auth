<?php
session_start();
 require_once('../inc/def.php');
if(tdrLoggedIn()){	
	echo '<pre>';
var_dump($_POST);
var_dump($_GET);
echo '</pre>';
// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$tdrID = $_SESSION['auth_id'];
	$contract = $_GET['contract'];
	$account  = $_GET['account'];
$cl = $_POST['client'];

$rate = $_POST['rate'];

$tdate = $_POST['trade_date'];

$exp = $_POST['expiry'];

$cp = $_POST['ccy_pair'];

$vd = $_POST['value_date'];

$spcut = $_POST['spcut'];

$b = $_POST['buy_sell'];

$ca = $_POST['counter_amt'];

$ta = $_POST['traded_as'];

$ct = $_POST['cut_time'];

$not = str_replace(',','',$_POST['notional']);

$calc = $_POST['calc'];

$pb = $_POST['prime_broker'];

$st = $_POST['settlement'];

$I = $_POST['inverted'];

$oet = $_POST['order_entry_time'];

$fpi = $_POST['fx_pair_id'];

$md = $_POST['match_date'];
$sql = "";
if($contract == "FXSP"){
$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,account)VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$account')";
}
if($contract == "FXFW"){
	$mid_price = $_POST['mid_price'];
	$del = $_POST['deliverablity'];
	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,dileverablity,mid_price,account)VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$del','$mid','$account')";
}
if($contract == "FXNDF"){
	$mid_price = $_POST['mid_price'];
	$del = $_POST['deliverablity'];
	$invert_price = $_POST['invertedprice'];
	$fxdate =  $_POST['fixing_date'];
	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,dileverablity,mid_price,account,fixing_date)VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$del','$mid','$account','$fxdate')";
}
if ($conn->query($sql) === TRUE) {

    echo "New record created successfully";

} else {

    echo "Error: " . $sql . "<br>" . $conn->error;

}
$conn->close();
}
?>
       