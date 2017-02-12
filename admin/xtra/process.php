<?php
session_start();
require_once('../inc/def.php');
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
  
  $dt_today = date('Y-m-d');
  
  //Last 10 days
  $dt_today_ten = date('Y-m-d', strtotime("-10 days"));
  
  
  $dt_first = str_replace("/", "-", strtotime($_GET['stdate']));
  $dt_first = date('Y-m-d', strtotime($_GET['stdate']));
  
  $dt_sec = str_replace("/", "-", $_GET['endate']);
  $dt_sec = date('Y-m-d', strtotime($dt_sec));
  
  
  if($qry_type == 1){
  
  }else if($qry_type == 2){
      $xtra_qry =  "and str_to_date( trade_date, '%d/%m/%Y') = '$dt_today'";
  }else if($qry_type == 3){
      
  }else if($qry_type == 4){
      $xtra_qry =  " and (str_to_date( trade_date, '%d/%m/%Y') between '$dt_today_ten' and '$dt_today') ";
  }else if($qry_type == 5){
      $xtra_qry =  " and (str_to_date( trade_date, '%d/%m/%Y') between '$dt_first' and '$dt_sec') ";
  }
    
  //$sql = "SELECT * FROM contract where tdrID = $tdrID $xtra_qry order by id_contract desc, str_to_date( trade_date, '%d/%m/%Y') desc";
  
  $sql = "SELECT * FROM contract where 1=1 $xtra_qry order by id_contract desc, str_to_date( trade_date, '%d/%m/%Y') desc";
    
	$result = $conn->query($sql);
          
  /*
  id_contract, tdrID, client, ccy_pair, buy_sell, Notional, Inverted_price, rate, counter_amt, calc, trade_date, 
  value_date, traded_as, prime_broker, order_entry_time, expiry, spcut, cut_time, settlement, fx_pair_id, matching_date, 
  contract, filesent, mid_price, deliverablity, fixing_date, expiry_date, cparty, p_c, optcut, price, prem_amt, type, 
  barrier_type, l_barrier, u_barrier, knock_in_out, touch_up_down, cash_at, rebate_ccy, rebate_amt, payout_ccy, barrier_start_date, 
  barrier_end_date, platform, indicator, platform_trade_id, status, settle_date, account, copy, premium_ccy, spcut_cp, 
  price_percentage, option_style, calculations, premium_amount, strike, opt_type, lower_barrier, cashat, up_barrier_sd, 
  up_barrier_ed, lw_barrier_sd, lw_barrier_ed, up_barrier, barrier_style, mid_barrier   
  id_contract,filesent,contract,client,cparty,buy_sell,Notional,ccy_pair,strike,p_c,
  */
  
  $size = $result->num_rows;
  
  //print json_encode($dt_sec. " " .$dt_first);
  //exit;
  
  if($size <= 0){
  
    print json_encode("empty");
    exit;
    
  }                      
          
  while($fetch = $result->fetch_array()) {
  
  
        if($fetch["Notional"] <> "" || $fetch["Notional"] <> 0){
              
              $deci = strlen(substr(strrchr($fetch["Notional"], "."), 1));
              $notation =  number_format($fetch["Notional"], $deci, '.', ',');
              
        }else{
               $notation = 0;
        }              
        
        if($fetch["counter_amt"] <> "" || $fetch["counter_amt"] <> 0){
               $deci = strlen(substr(strrchr($fetch["counter_amt"], "."), 1));
               $counter_amts =  number_format($fetch["counter_amt"], $deci, '.', ',');
        }else{
               $counter_amts = 0;
        }
        
        
        if($fetch["strike"] <> "" || $fetch["strike"] <> 0){
               $deci = strlen(substr(strrchr($fetch["strike"], "."), 1));
               $strikes =  number_format($fetch["strike"], $deci, '.', ',');
        }else{
               $strikes = "0.00";
        }
        
        if($fetch["price"] <> "" || $fetch["price"] <> 0){
               $deci = strlen(substr(strrchr($fetch["price"], "."), 1));
               $prices =  number_format($fetch["price"], $deci, '.', ',');
        }else{
               $prices = "0.00";
        }
        
        if($fetch["rate"] <> "" || $fetch["rate"] <> 0){
               $deci = strlen(substr(strrchr($fetch["rate"], "."), 1));
               $rates =  number_format($fetch["rate"], $deci, '.', ',');
        }else{
               $rates = "0.00";
        }
        
        if($fetch["prem_amt"] <> "" || $fetch["prem_amt"] <> 0){
               $deci = strlen(substr(strrchr($fetch["prem_amt"], "."), 1)); 
               $prem_amts =  number_format($fetch["prem_amt"], $deci, '.', ',');
        }else{
               $prem_amts = "0.00";
        }
        
        if($fetch["l_barrier"] <> "" || $fetch["l_barrier"] <> 0){
               $deci = strlen(substr(strrchr($fetch["l_barrier"], "."), 1));
               $l_barriers =  number_format($fetch["l_barrier"], $deci, '.', ',');
        }else{
               $l_barriers = "0.00";
        }
        
        if($fetch["u_barrier"] <> "" || $fetch["u_barrier"] <> 0){
               $deci = strlen(substr(strrchr($fetch["u_barrier"], "."), 1));
               $u_barriers =  number_format($fetch["u_barrier"], $deci, '.', ',');
        }else{
               $u_barriers = "0.00";
        }
        
        if($fetch["rebate_amt"] <> "" || $fetch["rebate_amt"] <> 0){
               $deci = strlen(substr(strrchr($fetch["rebate_amt"], "."), 1));
               $rebate_amts =  number_format($fetch["rebate_amt"], $deci, '.', ',');
        }else{
               $rebate_amts = "0.00";
        }
        
        if($fetch["filesent"] <> "" || $fetch["filesent"] <> 0){
               $filesent =  "SENT";
        }else{
               $filesent =  "NOT SENT";
        } 
        
        
        
        if($fetch["pb_email"] == 0 || $fetch["pb_email"] == ""){
               
               $filesent_pb =  "NOT SENT";
               $pb_class = "cls_pink";
                
        }else if($fetch["pb_email"] == 1){
              
               $filesent_pb =  "SENT";
               $pb_class = "cls_green";
               
        }else{
               
               $filesent_pb =  "NOT SENT";
               $pb_class = "cls_amber";
        }
        
        if($fetch["client_email"] == 0 || $fetch["client_email"] == ""){
               
               $filesent_client =  "NOT SENT";
               $client_class = "cls_pink";
                
        }else if($fetch["client_email"] == 1){
              
               $filesent_client =  "SENT";
               $client_class = "cls_green";
               
        }else{
               
               $filesent_client =  "NOT SENT";
               $client_class = "cls_amber";
        }
        
               
        
        /*
        if($fetch["pb_email"] <> "" || $fetch["pb_email"] <> 0){
               $filesent_pb =  "SENT";
               $pb_class = "cls_green";
        }else{
               $filesent_pb =  "NOT SENT";
               $pb_class = "cls_pink";
        }        
        if($fetch["client_email"] <> "" || $fetch["client_email"] <> 0){
               $filesent_client =  "SENT";
               $client_class = "cls_green";
        }else{
               $filesent_client =  "NOT SENT";
               $client_class = "cls_pink";
        }           
        */
        
        $client_name = "";
               
        $sql2 = "select * from clients where id = '".$fetch["client"]."'";
        $result2 = $conn->query($sql2);                       
        $fetch2 = $result2->fetch_array();
        
        $sql3 = "select * from traders where pid = '".$fetch["tdrID"]."'";
        $result3 = $conn->query($sql3);                       
        $fetch3 = $result3->fetch_array();
        
        $trader_name =  $fetch3['tdrID'];
        
        if($fetch2['name'] <> ""){  
          $client_name = $fetch2['name'];
        }
        
        $id_contract_type = $fetch["trade_entry_type"];
                               
        $output[] = array (           
        
            $fetch["id_contract"],$filesent,$fetch["contract"],$client_name,$fetch["cparty"],$fetch["buy_sell"],
            $notation,$fetch["ccy_pair"],$strikes,$fetch["p_c"],$counter_amts,$fetch["expiry_date"],$fetch["optcut"],
            $fetch["settle_date"],$prices,$rates,$prem_amts,$fetch["rebate_ccy"],$fetch["type"],$fetch["barrier_type"],$l_barriers,        
            $u_barriers,$fetch["knock_in_out"],$fetch["touch_up_down"],$fetch["cash_at"],$fetch["rebate_ccy"],$fetch["trade_date"],
            $fetch["value_date"],$fetch["expiry"],$rebate_amts,$fetch["payout_ccy"],$fetch["barrier_start_date"],$fetch["barrier_end_date"],
            $fetch["spcut"],$fetch["settlement"],$fetch["fx_pair_id"],$fetch["platform"],$fetch["indicator"],$fetch["platform_trade_id"],$fetch["status"],
            $filesent_pb, $filesent_client, $pb_class, $client_class, $trader_name, $id_contract_type
        
        );
  }
  
  echo json_encode($output);  
  exit;
?>
       