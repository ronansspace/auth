<?php
session_start();
require_once('../inc/def.php');
include('Classes/PHPExcel.php');

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
} 

if(!tdrLoggedIn()){	

}
else{


        $fl_attach = 0;        
        $id_trades = $_GET['id_trades'];
        
        
        $filename = "Curve_RBS_CSV_" . date("Ymd_His") . ".csv";  
    
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        
        $sql = "SELECT * FROM contract where id_contract in($id_trades) order by id_contract desc";
      	$result = $conn->query($sql);
        
        
        echo "source_system".",". "client_trade_id".",".	"report_date".",". "value_date".",". "trade_date".",". "ccy_pair".",".	"buy_sell_indicator".",".	"notional".",".	
                        "counter_amount".",". "price".",". "fixing_date".",".	"fixing_source".",".	"account".",".	"contract_type_code".",".	"far_leg_amount".",".
                        "far_leg_rate".",".	"far_leg_value_date".",".	"far_fixing_date".",". "far_fixing_source".",".	"option_put_call_ind".",".	"option_payment_ccy".",". 
                        "option_settlement_date".",".	"option_expiry_date".",".	"option_premium_amount".",". "option_premium_date".",".	"option_style".",".	
                        "option_price".",". "platform_indicator".",".	"platform_trade_id".",".	"counter_party".",". "deleted_trade_flag".",". "amended_trade_flag".",".
                        "parent_trade_id".",".	"trade_type".",". "traded_ccy".",".	"option_exercise".",".	"option_cut_code".",".	"second_fixing_source".",".	"advice_status_id".",".	
                        "exotic_option_type".",".	"exotic_option_barrier_type".",".	"exotic_option_upper_barrier".",".	"exotic_option_lower_barrier".",".	
                        "exotic_option_knock_in_out".",". "exotic_option_touch_up_down".",".	"exotic_option_cash_at".",". 
                        "exotic_option_rebate_ccy".",".	"exotic_option_rebate_amount".",".	"exotic_option_barrier_startdate".",".	
                        "exotic_option_barrier_enddate".",".	"exotic_option_monitor_window_cutoff".",".	"exotic_option_monitor_window_cutoffcity".",". "exotic_option_monitoring_window".",".	
                        "exotic_option_distribution_fallback1".",".	"exotic_option_distribution_fallback2".",".	"exotic_option_distribution_fallback3".",".	
                        "exotic_option_distribution_fallback4".",".	"trade_event_type".",".	"exotic_option_lower_barrier_startdate".",".	"exotic_option_lower_barrier_enddate".",".	
                        //"exotic_option_upper_barrier_startdate".",".	"exotic_option_upper_barrier_enddate".",".	"original_file_name".",".	"is_novation	deliverability".",".
                        "exotic_option_upper_barrier_startdate".",".	"exotic_option_upper_barrier_enddate".",".	"original_file_name".",".	"is_novation".","."deliverability".",".	
                        "option_pricing_premium_ccy".",".	"far_leg_counter_amount".",".	"is_swap".",".	"option_pricing_premium_conversion_rate".",".	"option_pricing_premium".",".	
                        "ignore_duplicate_check".",".	"is_fast_track".",".	"mid_price".",".	"mid_points".",".	"dealer_code"."\r\n";                                                                                            
        
        $report_date = date('d/m/Y');      
        
        while($fetch = $result->fetch_assoc())
        {
                     
                        if($fetch["Notional"] <> "" || $fetch["Notional"] <> 0){
                               $deci = strlen(substr(strrchr($fetch["Notional"], "."), 1));
                               $notional =  number_format($fetch["Notional"], $deci, '.', '');
                        }else{
                               $notional = 0;
                        }
                        
                        if($fetch["counter_amt"] <> "" || $fetch["counter_amt"] <> 0){
                               $deci = strlen(substr(strrchr($fetch["counter_amt"], "."), 1));
                               $counter_amts =  number_format($fetch["counter_amt"], $deci, '.', '');
                        }else{
                               $counter_amts = 0;
                        }
                        
                        if($fetch["price"] <> "" || $fetch["price"] <> 0){
                               $deci = strlen(substr(strrchr($fetch["price"], "."), 1));
                               $price =  number_format($fetch["price"], $deci, '.', '');
                        }else{
                               $price = "0.00";
                        }
                        
                        if($fetch["rate"] <> "" || $fetch["rate"] <> 0){
                               $deci = strlen(substr(strrchr($fetch["rate"], "."), 1));
                               $rate =  number_format($fetch["rate"], $deci, '.', '');
                        }else{
                               $rate = "0.00";
                        }
                        
                        if($fetch["premium_amount"] <> "" || $fetch["premium_amount"] <> 0){
                               $deci = strlen(substr(strrchr($fetch["premium_amount"], "."), 1));
                               $premium_amount=  number_format($fetch["premium_amount"], $deci, '.', '');
                        }else{
                               $premium_amount = "0.00";
                        }
                        
                        if($fetch["deleted_trade_flag"] <> "" || $fetch["deleted_trade_flag"] == 1){ 
                            $deleted_trade_flag  = 'Y';
                        }else{
                            $deleted_trade_flag  = '';
                        }
                        
                        if($fetch["amended_trade_flag"] <> "" || $fetch["amended_trade_flag"] == 1){ 
                            $amended_trade_flag  = 'Y';
                        }else{
                            $amended_trade_flag  = '';
                        }
                        
                        if($fetch["mid_price"] <> "" || $fetch["mid_price"] <> 0){
                              $deci = strlen(substr(strrchr($fetch["mid_price"], "."), 1));
                              $mid_price =  number_format($fetch["mid_price"], $deci, '.', '');
                        }else{
                              $mid_price = "0.00";
                        }
                        
                        
                        // Unknown Variables
                        $fixing_source = "";
                        $far_leg_amount = "";
                        $far_leg_rate = "";
                        $far_leg_value_date = "";
                        $far_fixing_date = "";
                        $far_fixing_source = "";
                        
                        $option_premium_date = "";
                        $option_price = ""; 
                        $platform_indicator = ""; 
                        $platform_trade_id = ""; 
                        $parent_trade_id = ""; 
                        $trade_type = "";
                        $traded_ccy = ""; 
                        $option_exercise = "";
                        //$option_cut_code = ""; 
                        $second_fixing_source = "";
                        $advice_status_id = "";  
                        $exotic_option_type = ""; 
                        $exotic_option_barrier_start_date = "";
                        $exotic_option_barrier_enddate = "";
                        $exotic_option_monitor_window_cutoff = ""; 
                        $exotic_option_monitor_window_cutoffcity = "";    
                        $exotic_option_monitoring_window = "";   
                        $exotic_option_distribution_fallback1 = "";  
                        $exotic_option_distribution_fallback2 = "";  
                        $exotic_option_distribution_fallback3 = ""; 
                        $exotic_option_distribution_fallback4 = "";
                        $trade_event_type = "";
                        $original_file_name = "";
                        $is_novation = "";
                        $option_pricing_premium_ccy = "";
                        $far_leg_counter_amount = "";
                        $is_swap = "";
                        $option_pricing_premium_conversion_rate = "";
                        $option_pricing_premium ="";
                        $ignore_duplicate_check = "";
                        $is_fast_track = "";
                        $mid_points = "";
                        $dealer_code = "";  
                      
                     
                      //$tmparray = array();
          
                      //$serialnumber = $serialnumber + 1;
                      
                      $sql2 = "select * from clients where id = '".$fetch["client"]."'";
                      $result2 = $conn->query($sql2);                       
                      $fetch2 = $result2->fetch_array();
                      $client_name = "";
                      if($fetch2['name'] <> ""){  
                        $client_name = $fetch2['name'];
                      }
                      
                      if($fetch["contract"] == "FXNDF"){
                            $contract_all = "FXFW";
                      } else {
                            $contract_all = $fetch["contract"];
                      }
                      
                      if($fetch["contract"] == "FXOPT"){
                            $option_cut_code = $fetch["spcut"]; 
                            $option_put_call_ind = $fetch["spcut_cp"];   
                            $option_payment_ccy = $fetch["payout_ccy"]; 
                            
                            //$option_premium_date = $fetch["settle_date"];
                            $option_premium_date = $fetch["value_date"]; 
                            
                            if($fetch["strike"] <> "" || $fetch["strike"] <> 0){
                                   $deci = strlen(substr(strrchr($fetch["strike"], "."), 1));
                                   $rate =  number_format($fetch["strike"], $deci, '.', '');
                            }else{
                                   $rate = "0.00";
                            }
                                                                              
                      } else {
                            $option_cut_code = ""; 
                            $option_put_call_ind = "";   
                            $option_payment_ccy = "";
                            $option_premium_date = "";  
                      }
                      
                      
                      $account = "CURVE_MP";
                      
                      $pasajeros2 = "CURVE".",". $fetch["trade_entry_type"].$fetch["id_contract"].",". $report_date.",". $fetch["value_date"].",". $fetch["trade_date"].",". $fetch["ccy_pair"].",". $fetch["buy_sell"].",".
                                        $notional.",". $counter_amts.",". $rate.",". $fetch["fixing_date"].",". $fixing_source.",". $account.",". $contract_all.",". $far_leg_amount.",". $far_leg_rate.",".
                                        $far_leg_value_date.",". $far_fixing_date.",". $far_fixing_source.",". $option_put_call_ind.",". $option_payment_ccy.",". $fetch["settle_date"].",". $fetch["expiry_date"].",".
                                        $premium_amount.",". $option_premium_date.",". $fetch["option_style"].",". $option_price.",". $platform_indicator.",". $platform_trade_id.",". $client_name.",". $deleted_trade_flag.",".
                                        $amended_trade_flag.",". $parent_trade_id.",". $trade_type.",". $traded_ccy.",". $option_exercise.",". $option_cut_code.",". $second_fixing_source.",". $advice_status_id.",". $exotic_option_type.",".
                                        $fetch["barrier_type"].",". $fetch["u_barrier"].",". $fetch["l_barrier"].",". $fetch["knock_in_out"].",". $fetch["touch_up_down"].",". $fetch["cash_at"].",". $fetch["rebate_ccy"].",".
                                        $fetch["rebate_amt"].",". $exotic_option_barrier_start_date.",". $exotic_option_barrier_enddate.",". $exotic_option_monitor_window_cutoff.",". $exotic_option_monitor_window_cutoffcity.",". 
                                        $exotic_option_monitoring_window.",". $exotic_option_distribution_fallback1.",". $exotic_option_distribution_fallback2.",". $exotic_option_distribution_fallback3.",". $exotic_option_distribution_fallback4.",".
                                        $trade_event_type.",". $fetch["lw_barrier_sd"].",". $fetch["lw_barrier_ed"].",". $fetch["up_barrier_sd"].",". $fetch["up_barrier_ed"].",". $original_file_name.",". $is_novation.",". $fetch["deliverablity"].",".
                                        $option_pricing_premium_ccy.",". $far_leg_counter_amount.",". $is_swap.",".  $option_pricing_premium_conversion_rate.",". $option_pricing_premium.",". $ignore_duplicate_check.",". $is_fast_track.",".
                                        $mid_price.",". $mid_points.",". $dealer_code."\r\n";             
                      
                                       
                      echo  $pasajeros2;
                      
        }
               
        exit(); 
        
        
}
?>   
  