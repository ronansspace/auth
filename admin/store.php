<?php
session_start();
require_once('../inc/def.php');

if(tdrLoggedIn()){	

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	// Check connection
if($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 
  
$tdrID = $_SESSION['auth_id'];
$contract = $_GET['contract'];
$account  = $_GET['account'];
$status  = $_GET['status'];

$id_contract = $_POST['id_contract'];

$cl = $_POST['client'];
$rate = "";
if(isset($_POST['rate'])){
    $rate = str_replace(',','',$_POST['rate']);
}

$tdate = $_POST['trade_date'];

$exp = $_POST['expiry'];

$cp = $_POST['ccy_pair'];

$vd = $_POST['value_date'];

$spcut = "";
if(isset($_POST['spcut'])){
  $spcut = $_POST['spcut'];
}

$b = $_POST['buy_sell'];

$ca = "";
if(isset($_POST['counter_amt'])){
    $ca = str_replace(',','',$_POST['counter_amt']);
}

$ta = $_POST['traded_as'];

$ct = $_POST['cut_time'];

$not = str_replace(',','',$_POST['notional']);

$calc = $_POST['calc'];

$pb = $_POST['prime_broker'];

$st = $_POST['settlement'];

$I = $_POST['inverted'];

$oet = $_POST['order_entry_time'];

if(isset($_POST['fx_pair_id']) && $_POST['fx_pair_id'] <> "")
{
    
      $fpi = $_POST['fx_pair_id'];        
      $pnl_ccy_pair = "";
      $pnl_rate = 0;
      $pnl_counter_amt = 0;        
    
}else{

      $fpi = "";
      
      $pnl_ccy_pair = "";
      if(isset($_POST['pnl_ccy_pair'])){
          $pnl_ccy_pair = $_POST['pnl_ccy_pair'];
      }
      
      $pnl_rate = "";
      if(isset($_POST['pnl_ccy_pair'])){
          $pnl_rate = str_replace(',','',$_POST['pnl_rate']);
      }
      
      $pnl_counter_amt = "";
      if(isset($_POST['pnl_counter_amt'])){
          $pnl_counter_amt = str_replace(',','',$_POST['pnl_counter_amt']);
      }
    
}

$md = $_POST['match_date'];

$premium_ccy = "1";     
$client_trader = 0;

if($_POST['client_trader'] <> "" ) {
  $client_trader = $_POST['client_trader'];
}


$sql = "";

      if($contract == "FXSP"){
      $sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
              traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,account,status,client_trader,trade_entry_type,
              pnl_ccy_pair, pnl_rate, pnl_counter_amt)
              VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct',
              '$st','$fpi','$md','$contract','$account','$status',$client_trader,'CM', '$pnl_ccy_pair', $pnl_rate, $pnl_counter_amt)";
      }
      
      /*if($contract == "FXSP" && $id_contract <>""){
              $sql = "update contract set tdrID = $tdrID, client = '$cl', ccy_pair = '$cp', buy_sell = '$b', Notional = $not, Inverted_price = '$I',
                      rate = '$rate',counter_amt = '$ca',calc = '$calc',trade_date = '$tdate',value_date = '$vd',
                      traded_as = '$ta',prime_broker = '$pb',order_entry_time = '$oet',expiry = '$exp',
                      spcut = '$spcut',cut_time = '$ct',settlement = '$st',fx_pair_id = '$fpi',matching_date = '$md',contract ='$contract',account = '$account', status = '$status',
                      client_trader = $client_trader, pnl_ccy_pair = '$pnl_ccy_pair', pnl_rate = $pnl_rate, pnl_counter_amt = $pnl_counter_amt
                      where id_contract = $id_contract";
      
      }*/
      
      if($contract == "FXFW"){
        	$mid_price = str_replace(',','',$_POST['mid_price']);
        	$del = $_POST['deliverablity'];
        	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
                  traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,deliverablity,mid_price,account,status,client_trader,trade_entry_type)
                  VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$del','$mid_price','$account','$status',$client_trader,'CM')";
      }
      if($contract == "FXFW" && $id_contract <>""){
         $mid_price = str_replace(',','',$_POST['mid_price']);
      	 $del = $_POST['deliverablity'];
         
         $sql = "update contract set tdrID = $tdrID, client = '$cl', ccy_pair = '$cp', buy_sell = '$b', Notional = $not, Inverted_price = '$I',
                      rate = '$rate',counter_amt = '$ca',calc = '$calc',trade_date = '$tdate',value_date = '$vd',
                      traded_as = '$ta',prime_broker = '$pb',order_entry_time = '$oet',expiry = '$exp',
                      spcut = '$spcut',cut_time = '$ct',settlement = '$st',fx_pair_id = '$fpi',matching_date = '$md',contract ='$contract',
                      deliverablity = '$del', mid_price = '$mid_price', account = '$account', status = '$status',
                      client_trader = $client_trader
                      where id_contract = $id_contract";
                      
      
      }
      
      
      if($contract == "FXNDF"){
      	$mid_price = str_replace(',','',$_POST['mid_price']);
      	$del = $_POST['deliverablity'];
      	$invert_price = $_POST['invertedprice'];
      	$fxdate =  $_POST['fixing_date'];
      	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
                traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,deliverablity,mid_price,account,fixing_date,status,client_trader,trade_entry_type)
                VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$del','$mid','$account','$fxdate','$status',$client_trader,'CM')";
      }
      
      
      if($contract == "FXNDF" && $id_contract <>""){
      	$mid_price = str_replace(',','',$_POST['mid_price']);
      	$del = $_POST['deliverablity'];
      	$invert_price = $_POST['invertedprice'];    
      	$fxdate =  $_POST['fixing_date'];
        
         /*
      	 $sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
                traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,deliverablity,mid_price,account,fixing_date)
                VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md','$contract','$del','$mid','$account','$fxdate')";
         */
      
         $sql = "update contract set tdrID = $tdrID, client = '$cl', ccy_pair = '$cp', buy_sell = '$b', Notional = $not, Inverted_price = '$I',
                      rate = '$rate',counter_amt = '$ca',calc = '$calc',trade_date = '$tdate',value_date = '$vd',
                      traded_as = '$ta',prime_broker = '$pb',order_entry_time = '$oet',expiry = '$exp',
                      spcut = '$spcut',cut_time = '$ct',settlement = '$st',fx_pair_id = '$fpi',matching_date = '$md',contract ='$contract',
                      deliverablity = '$del', mid_price = '$mid_price', account = '$account', fixing_date = '$fxdate',status = '$status',
                      client_trader = $client_trader
                      where id_contract = $id_contract";
      
      }
      
      
      if($contract == "FXOPT"){
      	
        $mid_price = str_replace(',','',$_POST['mid_price']);
      	$del = $_POST['deliverablity'];
      	$invert_price = $_POST['invertedprice'];
      	$fxdate =  $_POST['fixing_date'];
        
        $delta = $_POST['delta'];
        $delta_text = $_POST['delta_text'];
        
        
        //NOT IN DB
        $premium_ccy = $_POST['premium_ccy'];
        $settle_date = $_POST['settle_date'];
        $spcut_cp = $_POST['spcut_cp'];
        $price_percentage = str_replace(',','',$_POST['price_percentage']);
        $option_style = $_POST['option_style'];  
        $calculations = $_POST['calculations'];
        $premium_amount = str_replace(',','',$_POST['premium_amount']);
        
        // IN DB
        $expiry_date = $_POST['expiry_date'];
        $payout_ccy = str_replace(',','',$_POST['payout_ccy']);
        $strike = str_replace(',','',$_POST['strike']);
        
        
      	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
                traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,deliverablity,mid_price,account,fixing_date,
                settle_date,spcut_cp,price_percentage,option_style,calculations,expiry_date,payout_ccy,premium_amount, strike, status,client_trader,trade_entry_type,premium_ccy,delta,delta_text)
                VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md',
                '$contract','$del','$mid_price','$account','$fxdate',
                '$settle_date','$spcut_cp','$price_percentage','$option_style','$calculations','$expiry_date','$payout_ccy','$premium_amount','$strike','$status',$client_trader,'CM','$premium_ccy','$delta','$delta_text')";
      
      }
      
      if($contract == "FXOPT" && $id_contract <> ""){
       
                  //NOT IN DB
                  $premium_ccy = $_POST['premium_ccy'];
                  
                  $spcut_cp = $_POST['spcut_cp'];
                  $price_percentage = str_replace(',','',$_POST['price_percentage']);
                  $option_style = $_POST['option_style'];  
                  $calculations = $_POST['calculations'];
                  $premium_amount = str_replace(',','',$_POST['premium_amount']);
                  
                  // IN DB
                  $expiry_date = $_POST['expiry_date'];
                  $payout_ccy = str_replace(',','',$_POST['payout_ccy']);
                  $settle_date = $_POST['settle_date'];
                  $strike = str_replace(',','',$_POST['strike']); 
                  
                  $delta = $_POST['delta'];
                  $delta_text = $_POST['delta_text'];
       
                  $sql = "update contract set tdrID = $tdrID, client = '$cl', ccy_pair = '$cp', buy_sell = '$b', Notional = $not, Inverted_price = '$I',
                      rate = '$rate',counter_amt = '$ca',calc = '$calc',trade_date = '$tdate',value_date = '$vd',
                      traded_as = '$ta',prime_broker = '$pb',order_entry_time = '$oet',expiry = '$exp',
                      spcut = '$spcut',cut_time = '$ct',settlement = '$st',fx_pair_id = '$fpi',matching_date = '$md',contract ='$contract',
                      deliverablity = '$del', mid_price = '$mid_price', account = '$account', fixing_date = '$fxdate',
                      settle_date  = '$settle_date',spcut_cp  = '$spcut_cp',price_percentage  = '$price_percentage',
                      option_style  = '$option_style', calculations = '$calculations',expiry_date = '$expiry_date',payout_ccy = '$payout_ccy', 
                      premium_amount = '$premium_amount', strike = '$strike', status = '$status', client_trader = $client_trader, premium_ccy = '$premium_ccy',
                      delta = '$delta', delta_text = '$delta_text'                        
                      where id_contract = $id_contract";      
       
      }
      
      if($contract == "EOPT"){
      	
        $mid_price = str_replace(',','',$_POST['mid_price']);
      	$del = $_POST['deliverablity'];
                
        
        //NOT IN DB
        $premium_ccy = $_POST['premium_ccy'];
        $settle_date = $_POST['settle_date'];
        $spcut_cp = $_POST['spcut_cp'];
        $price_percentage = str_replace(',','',$_POST['price_percentage']);
        $option_style = $_POST['option_style'];  
        $calculations = $_POST['calculations'];
        $premium_amount = str_replace(',','',$_POST['premium_amount']);
        
        // IN DB
        $expiry_date = $_POST['expiry_date'];
        $payout_ccy = str_replace(',','',$_POST['payout_ccy']);
        $strike = str_replace(',','',$_POST['strike']);
                                                                  
        $opt_type =  $_POST['opt_type'];
        $lower_barrier = $_POST['lower_barrier'];
        $cashat = $_POST['cashat'];
        $up_barrier_sd = $_POST['up_barrier_sd'];
        $up_barrier_ed = $_POST['up_barrier_ed'];
        
        $barrier_type = $_POST['barrier_type']; //
        $knock_in_out = $_POST['knock_in_out']; //
        $rebate_ccy = str_replace(',','',$_POST['rebate_ccy']);   //
        $touch_up_down = $_POST['touch_up_down'];  //
        $rebate_amt = str_replace(',','',$_POST['rebate_amt']); //
        
        $lw_barrier_sd = $_POST['lw_barrier_sd'];
        $lw_barrier_ed = $_POST['lw_barrier_ed'];
        $up_barrier = $_POST['up_barrier'];
        
        $barrier_style = $_POST['barrier_style'];
        $mid_barrier = $_POST['mid_barrier'];
        
        $mid = "";
        $fxdate = "";        
        
      	$sql = "INSERT INTO contract (tdrID, client, ccy_pair,buy_sell,Notional,Inverted_price,rate,counter_amt,calc,trade_date,value_date,
                traded_as,prime_broker,order_entry_time,expiry,spcut,cut_time,settlement,fx_pair_id,matching_date,contract,deliverablity,mid_price,account,fixing_date,
                settle_date,spcut_cp,price_percentage,option_style,calculations,expiry_date,payout_ccy,premium_amount, strike,
                opt_type, lower_barrier, cashat, up_barrier_sd, up_barrier_ed, barrier_type, knock_in_out, rebate_ccy, touch_up_down, rebate_amt, 
                lw_barrier_sd, lw_barrier_ed, up_barrier, barrier_style, mid_barrier,status,client_trader,trade_entry_type,premium_ccy)
                VALUES ($tdrID, '$cl', '$cp','$b',$not,'$I','$rate','$ca','$calc','$tdate','$vd','$ta','$pb','$oet','$exp','$spcut','$ct','$st','$fpi','$md',
                '$contract','$del','$mid','$account','$fxdate',
                '$settle_date','$spcut_cp','$price_percentage','$option_style','$calculations','$expiry_date','$payout_ccy','$premium_amount','$strike',
                '$opt_type', '$lower_barrier', '$cashat', '$up_barrier_sd', '$up_barrier_ed', '$barrier_type', '$knock_in_out', '$rebate_ccy', '$touch_up_down', '$rebate_amt', 
                '$lw_barrier_sd', '$lw_barrier_ed', '$up_barrier', '$barrier_style', '$mid_barrier','$status',$client_trader,'CM','$premium_ccy')";
      
        }
      
      if($contract == "EOPT" && $id_contract <>""){
       
               //NOT IN DB
              $premium_ccy = $_POST['premium_ccy'];
              
              $spcut_cp = $_POST['spcut_cp'];
              $price_percentage = str_replace(',','',$_POST['price_percentage']);
              $option_style = $_POST['option_style'];  
              $calculations = $_POST['calculations'];
              $premium_amount = str_replace(',','',$_POST['premium_amount']);
              
              // IN DB
              $expiry_date = $_POST['expiry_date'];
              $payout_ccy = str_replace(',','',$_POST['payout_ccy']);
              $settle_date = $_POST['settle_date'];
              $strike = str_replace(',','',$_POST['strike']); 
              
              
              $opt_type =  $_POST['opt_type'];
              $lower_barrier = $_POST['lower_barrier'];
              $cashat = $_POST['cashat'];
              $up_barrier_sd = $_POST['up_barrier_sd'];
              $up_barrier_ed = $_POST['up_barrier_ed'];
              
              $barrier_type = $_POST['barrier_type']; //
              $knock_in_out = $_POST['knock_in_out']; //
              $rebate_ccy = str_replace(',','',$_POST['rebate_ccy']);   //
              $touch_up_down = $_POST['touch_up_down'];  //
              $rebate_amt = str_replace(',','',$_POST['rebate_amt']); //
              
              $lw_barrier_sd = $_POST['lw_barrier_sd'];
              $lw_barrier_ed = $_POST['lw_barrier_ed'];
              $up_barrier = $_POST['up_barrier'];
              
              $barrier_style = $_POST['barrier_style'];
              $mid_barrier = $_POST['mid_barrier'];
              
       
                 $sql = "update contract set tdrID = $tdrID, client = '$cl', ccy_pair = '$cp', buy_sell = '$b', Notional = $not, Inverted_price = '$I',
                      rate = '$rate',counter_amt = '$ca',calc = '$calc',trade_date = '$tdate',value_date = '$vd',
                      traded_as = '$ta',prime_broker = '$pb',order_entry_time = '$oet',expiry = '$exp',
                      spcut = '$spcut',cut_time = '$ct',settlement = '$st',fx_pair_id = '$fpi',matching_date = '$md',contract ='$contract',
                      deliverablity = '$del', mid_price = '$mid_price', account = '$account', fixing_date = '$fxdate',
                      settle_date  = '$settle_date',spcut_cp  = '$spcut_cp',price_percentage  = '$price_percentage',
                      option_style  = '$option_style', calculations = '$calculations',expiry_date = '$expiry_date',payout_ccy = '$payout_ccy', 
                      premium_amount = '$premium_amount', strike = '$strike',
                      opt_type = '$opt_type', lower_barrier = '$lower_barrier', cashat = '$cashat', up_barrier_sd = '$up_barrier_sd', up_barrier_ed = '$up_barrier_ed', barrier_type = '$barrier_type', 
                      knock_in_out = '$knock_in_out', rebate_ccy = '$rebate_ccy', touch_up_down = '$touch_up_down', rebate_amt = '$rebate_amt', 
                      lw_barrier_sd = '$lw_barrier_sd', lw_barrier_ed = '$lw_barrier_ed', up_barrier = '$up_barrier', barrier_style = '$barrier_style', mid_barrier = '$mid_barrier', status = '$status',
                      client_trader = $client_trader, premium_ccy = '$premium_ccy'                                              
                      where id_contract = $id_contract";      
       
      }
      
      
      //$conn->query($sql) === TRUE
      
      $main_query = $conn->query($sql);
      $id_contract_new = $conn->insert_id;
      
      //echo  $sql;
      //exit;
      
      
      if(isset($_POST['fx_pair_id']) && $_POST['fx_pair_id'] <> "" && $contract <> "FXSP"){
      
              $trade_id = explode("_",$_POST['fx_pair_id']);
              $trade_id_id = $trade_id[1];
              
              $sql3 = "SELECT * FROM contract where id_contract = $trade_id_id";
              $result3 = $conn->query($sql3);
              $row3 = $result3->fetch_assoc(); 
              $notional = $row3["Notional"];
              
              $order_ccy = $row3["ccy_pair"];
              $convert_ccy = $row3["pnl_ccy_pair"];
              
              $order_ccy_usd =  substr($order_ccy, -3);

              $match_premium_amount = $row3["premium_amount"];

              if($order_ccy_usd = "USD"){
              
                    $ca_primary = $row3["counter_amt"];
                    $ca_secondry = $ca;
                    $ca_pnl_amount = $row3["counter_amt"];   
              
              }else if($order_ccy == $convert_ccy){
                    
                    $ca_primary = $row3["counter_amt"];
                    $ca_secondry = ($ca * $row3["rate"]);
                    $ca_pnl_amount = $row3["pnl_counter_amt"];  
              
              }else{
              
                    $ca_primary = $row3["counter_amt"];
                    $ca_secondry = ($ca * $row3["pnl_rate"]);
                    $ca_pnl_amount = $row3["pnl_counter_amt"];  
              
              }                           
              
              
              //echo $ca * $row3["pnl_rate"];
              
              //exit;
              
              /** FIND BROKER PART - STARTS **/
              
              
              $sql_broker = "SELECT * FROM brokerage";
              $result_broker = $conn->query($sql_broker); 
              
              while($fetch_broker = $result_broker->fetch_array()) {  
                    $arr[$fetch_broker["id"]] = $fetch_broker["cost"]; 
              }
              
              $prime_broker_cost = $arr[1];
              $trading_cost = $arr[2];
              
              //$prime_cost_1 = ($ca_pnl_amount / 1000000);
              //$prime_cost_2 = ($prime_broker_cost / 1000000);
              
              //$prime_cost = $prime_cost_1 * $prime_cost_2;
              $prime_cost = (($notional * 2) / 1000000) * $prime_broker_cost;
              
              //$trade_cost_1 = ($ca_pnl_amount / 1000000);
              //$trade_cost_2 = ($trading_cost / 1000000);
              
              //$trade_cost = $trade_cost_1 * $trade_cost_2;   
              $trade_cost = (($notional) / 1000000) * $trading_cost;                                
              
              $total_cost =  $prime_cost + $trade_cost;
              
              /** FIND BROKER PART - END**/
              
              if($b == "S"){
                    $gros_profit =  $premium_amount - $match_premium_amount;
              }else{              
                    $gros_profit =  $match_premium_amount - $premium_amount;
              }
              
              $cost = $total_cost;
              $profit = ($gros_profit) - $cost;
                                                            
              $sql2 = "SELECT * FROM profit_loss where trade_id = $id_contract";
              $result2 = $conn->query($sql2);
              
              if($id_contract <> ""){
                    
                    //Update
                    
                    $sql4 = "update profit_loss set contract = '$contract', 
                    trader_id = $tdrID, client = '$cl', ccy_pair = '$cp', notational = $not,
                    trade_date = '$tdate',value_date = '$vd', counter_amt = '$ca_secondry', profit = '$profit', 
                    pbcost = $prime_cost, venuecost = $trade_cost, totalcost = $total_cost, grosprofit = $gros_profit, buy_sell = '$b'
                    where trade_id = $id_contract";
                     
              }else{
              
                    //Insert                                                     
                                                                        
                    $sql4 = "insert into profit_loss(contract, trader_id, client, ccy_pair, notational, trade_date, value_date, profit, counter_amt, trade_id, master_trade_id, pbcost, venuecost, totalcost, grosprofit, buy_sell)
                             values('$contract', $tdrID, '$cl', '$cp', $not, '$tdate', '$vd', '$profit', '$ca_secondry', $id_contract_new, $trade_id_id, $prime_cost, $trade_cost, $total_cost, $gros_profit, '$b' )";
                             
                      
              }      
              
              $conn->query($sql4);
              
      
      }else{             
      
              // Maybe this trade is master ID of linked trade
              if($id_contract <> ""){   // IF we are updating a master record
              
                      
                       $sql2 = "SELECT * FROM profit_loss where master_trade_id = $id_contract";
                       $result2 = $conn->query($sql2);
                       
                       $row2 = $result2->fetch_assoc(); 
                           
                       $ca_primary = $row2["counter_amt"];

                       $notional = $row2["notational"];
                       
                       $buy_sell = $row2["buy_sell"];
                       
                        /** FIND BROKER PART - STARTS **/
                        $ca_pnl_amount = $pnl_counter_amt;  
                        
                        $sql_broker = "SELECT * FROM brokerage";
                        $result_broker = $conn->query($sql_broker); 
                        
                        while($fetch_broker = $result_broker->fetch_array()) {  
                              $arr[$fetch_broker["id"]] = $fetch_broker["cost"]; 
                        }
                        
                        $prime_broker_cost = $arr[1];
                        $trading_cost = $arr[2];
                        
                        //$prime_cost_1 = ($ca_pnl_amount / 1000000);
                        //$prime_cost_2 = ($prime_broker_cost / 1000000);
                        
                        //$prime_cost = $prime_cost_1 * $prime_cost_2;
                        
                        //prime broker cost = ((Notional x 2) /1,000,000) x (PB cost per million)
                        
                        $prime_cost = (($notional * 2) / 1000000) * $prime_broker_cost;
                        
                        //$trade_cost_1 = ($ca_pnl_amount / 1000000);
                        //$trade_cost_2 = ($trading_cost / 1000000);
                        
                        //$trade_cost = $trade_cost_1 * $trade_cost_2;   
                        
                        $trade_cost = (($notional) / 1000000) * $trading_cost;
                        
                        $total_cost =  $prime_cost + $trade_cost;
                        
                        /** FIND BROKER PART - END**/
                       
                       
                       if($buy_sell == "S"){
                            
                            $gros_profit =  $ca_pnl_amount - $ca_primary;
                       }else{ 
                            $gros_profit =  $ca_primary - $ca_pnl_amount;
                       }
                       
                       $cost = $total_cost;
                       $profit = ($gros_profit) - $cost;
                        
                       if($result2->num_rows > 0){
                        
                                $sql4 = "update profit_loss set profit = '$profit',
                                pbcost = $prime_cost, venuecost = $trade_cost, totalcost = $total_cost, grosprofit = $gros_profit
                                where master_trade_id = $id_contract";
                                
                                $result = $conn->query($sql4);
                        
                       }
              
              }
              
              // Updating/Adding new CCYRate if doesnt exist                   
              
              $date = date('Y-m-d');
              
              
              $order_ccy_usd =  substr($cp, -3);
              $ccypair = "";
              
              if(isset($_POST['pnl_ccy_pair'])){
              
                    $ccypair = $_POST['pnl_ccy_pair'];
              } 
              
              if($order_ccy_usd = "USD"){
              
                    $rate = 1;
              
              }else if($cp == $pnl_ccy_pair){
                    
                    $rate = $_POST['rate'];
                 
              }else{
              
                   $rate = $_POST['pnl_rate'];
                 
              }  
              
              
              $sql_a = "select * from ccyrate where ccypair='$ccypair'";
              $result_a = $conn->query($sql_a); 
              
              $size_a = $result_a->num_rows;
              
              
              if($size_a > 0){
              
                    $sql_ab = "select * from ccyrate where ccypair='$ccypair' and rate = $rate";
                    $result_ab = $conn->query($sql_ab); 
                    
                    $size_ab = $result_ab->num_rows;
                    
                    if($size_ab <= 0){
                    
                          $sql_d = "update ccyrate set rate = $rate, date = '$date'
                          where ccypair = '$ccypair'";
                          
                          $result_d = $conn->query($sql_d);
                    
                    } 
                     
              }else{
              
                    $sql_d = "insert into ccyrate(ccypair, rate, date)
                    values ('$ccypair', $rate, '$date')";
                    
                    $result_d = $conn->query($sql_d); 
              
              }
              
              
      }

      //if ($conn->query($sql) === TRUE) {
      if($main_query === TRUE) {
        
          if(isset($_GET['save_copy'])){
                
                if($_POST['id_contract'] <> ""){
                    echo $_POST['id_contract'];
                }else{
                    //echo $conn->insert_id;
                    echo $id_contract_new;
                } 
                
          }else{
          
                echo "New record created successfully";
          }
      
      } else {
      
          echo "Error: " . $sql . "<br>" . $conn->error;
      
      }
      
      
      $conn->close();
}
?>
       