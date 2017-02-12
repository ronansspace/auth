<?php
session_start();
require_once('../inc/def.php');
if(tdrLoggedIn()){
	
  // Create connection
	//$conn = new mysqli($servername, $username, $password, $dbname);
  $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$tdrID = $_SESSION['auth_id'];
	$sql = "SELECT * FROM contract where tdrID = $tdrID";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<tr class="record_row" data-did="'.$row['id_contract'].'"><td><input type="checkbox"></td>';
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['id_contract'])) . "</td>";
		echo "<td></td>"; //Match
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['filesent'])) . "</td>";
		echo "<td></td>"; //dept
		echo "<td></td>"; //TNAME
		echo "<td></td>"; // TSWAP
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['contract'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['client'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['cparty'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['buy_sell'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['Notional'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['ccy_pair'])) . "</td>";
		echo "<td></td>"; // strike
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['p_c'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['counter_amt'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['expiry_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['optcut'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['settle_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['price'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['rate'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['prem_amt'])) . "</td>";     
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['prem_ccy'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['type'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['barrier_type'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['l_barrier'])) . "</td>";     
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['u_barrier'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['knock_in_out'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['touch_up_down'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['cash_at'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['rebate_ccy'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['trade_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['value_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['expiry'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['rebate_amt'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['payout_ccy'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['barrier_start_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['barrier_end_date'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['spcut'])) . "</td>";
		echo "<td></td>"; // settlement
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['fx_pair_id'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['platform'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['indicator'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['platform_trade_id'])) . "</td>";
		echo "<td>" . str_replace(' ','&nbsp;',htmlentities($row['status'])) . "</td></tr>";
    }
} else {
   // echo "0 results";
}

$conn->close();
}
?>
       