<?php
session_start();
require_once('../inc/def.php');
if(tdrLoggedIn()){  }
	
  // Create connection
	$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	
  // Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
  $tdrID = $_SESSION['auth_id'];
  $id_contract = $_GET['id_contract'];
   
  $sql = "insert into contract( tdrID, client, ccy_pair, buy_sell, Notional, Inverted_price, rate, counter_amt, calc, trade_date, 
          value_date, traded_as, prime_broker, order_entry_time, expiry, spcut, cut_time, settlement, fx_pair_id, matching_date, 
          contract, filesent, mid_price, deliverablity, fixing_date, expiry_date, cparty, p_c, optcut, price, prem_amt, type, 
          barrier_type, l_barrier, u_barrier, knock_in_out, touch_up_down, cash_at, rebate_ccy, rebate_amt, payout_ccy, barrier_start_date, 
          barrier_end_date, platform, indicator, platform_trade_id, status, settle_date, account, copy, premium_ccy, spcut_cp, 
          price_percentage, option_style, calculations, premium_amount, strike, opt_type, lower_barrier, cashat, up_barrier_sd, 
          up_barrier_ed, lw_barrier_sd, lw_barrier_ed, up_barrier, barrier_style, mid_barrier )
           
          select tdrID, client, ccy_pair, buy_sell, Notional, Inverted_price, rate, counter_amt, calc, trade_date, 
          value_date, traded_as, prime_broker, order_entry_time, expiry, spcut, cut_time, settlement, fx_pair_id, matching_date, 
          contract, filesent, mid_price, deliverablity, fixing_date, expiry_date, cparty, p_c, optcut, price, prem_amt, type, 
          barrier_type, l_barrier, u_barrier, knock_in_out, touch_up_down, cash_at, rebate_ccy, rebate_amt, payout_ccy, barrier_start_date, 
          barrier_end_date, platform, indicator, platform_trade_id, status, settle_date, account, copy, premium_ccy, spcut_cp, 
          price_percentage, option_style, calculations, premium_amount, strike, opt_type, lower_barrier, cashat, up_barrier_sd, 
          up_barrier_ed, lw_barrier_sd, lw_barrier_ed, up_barrier, barrier_style, mid_barrier from contract where  
          tdrID = $tdrID and id_contract = $id_contract";
  
  
 	$result = $conn->query($sql);
  
  if($result){
       echo json_encode("ok");
  } else {
       echo json_encode("error");
  }
    
  //echo json_encode($output);  
  exit;
?>
       