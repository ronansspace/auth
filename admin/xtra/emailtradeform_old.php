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
    
        if((isset($_FILES['uploaded_file']['tmp_name'])) && ($_FILES['uploaded_file']['tmp_name'] != ""))
        {        
            //print_r(json_encode($_FILES));
            $file_size_1 = $_FILES['uploaded_file']['size'];  
            $file_type = $_FILES['uploaded_file']['type'];        
            
            if (($file_size_1 > 1048577)){      
              //print "Error: Attchament 1 (File too large, must be less than 1 MB)";
              print "fl_size";
              exit;
            }
            
            $fl_attach = 1;
        }
        
        $id_trades = $_POST['id_trades'];
        
        $objPHPExcel = new PHPExcel();
        
        $sql_mark_trade = "update contract set filesent = 1 where id_contract in($id_trades) order by id_contract";
      	$result_mark_trade = $conn->query($sql_mark_trade);
        
        
        $sql = "SELECT * FROM contract where id_contract in($id_trades) order by id_contract";
      	$result = $conn->query($sql);
        
        //$exec1 = mysql_query($query1) or die ("Error in Query1".mysql_error());
        $serialnumber=0;
        //Set header with temp array
        $tmparray = array("Sr.Number","ID","Filesent","Contract","Client","Cparty","B/S","Notional","CCY","Strike","P/C",
                        "Counter Amount","Expiry Date","OptCut","Sett Date",
                        
                        "Price","Rate","Prem Amount","Type","Barrier Type","Lower Barrier","Upper Barrier",
                                                
                        "Knock in out","Touch up down","Cash at","Rebate CCY","Trade Date","Value Date","Expiry","Rebate Amount","Payout CCY",
                        "Barrier StartDate","Barrier EndDate","SPCUT","Settlement","FX Pair ID","platform","indicator","platform_trade_id","Status");
                        
                        
                        /*
                        "source_system", "client_trade_id",	"report_date", "value_date", "trade_date", "ccy_pair",	"buy_sell_indicator",	"notional",	
                        "counter_amount", "price", "fixing_date",	"fixing_source",	"account",	"contract_type_code",	"far_leg_amount",
                        "far_leg_rate",	"far_leg_value_date",	"far_fixing_date", "far_fixing_source",	"option_put_call_ind",	"option_payment_ccy", 
                        "option_settlement_date",	"option_expiry_date",	"option_premium_amount", "option_premium_date",	"option_style",	
                        "option_price", "platform_indicator",	"platform_trade_id",	"counter_party", "deleted_trade_flag", "amended_trade_flag",
                        "parent_trade_id",	"trade_type", "traded_ccy",	"option_exercise",	"option_cut_code",	"second_fixing_source",	"advice_status_id"	
                        "exotic_option_type",	"exotic_option_barrier_type",	"exotic_option_upper_barrier",	"exotic_option_lower_barrier",	
                        "exotic_option_knock_in_out", "exotic_option_touch_up_down",	"exotic_option_cash_at", 
                        "exotic_option_rebate_ccy",	"exotic_option_rebate_amount",	"exotic_option_barrier_startdate",	
                        "exotic_option_barrier_enddate",	"exotic_option_monitor_window_cutoff",	"exotic_option_monitor_window_cutoffcity", "exotic_option_monitoring_window",	
                        "exotic_option_distribution_fallback1",	"exotic_option_distribution_fallback2",	"exotic_option_distribution_fallback3",	
                        "exotic_option_distribution_fallback4",	"trade_event_type",	"exotic_option_lower_barrier_startdate",	"exotic_option_lower_barrier_enddate",	
                        "exotic_option_upper_barrier_startdate",	"exotic_option_upper_barrier_enddate",	"original_file_name",	"is_novation	deliverability",	
                        "option_pricing_premium_ccy",	"far_leg_counter_amount",	"is_swap",	"option_pricing_premium_conversion_rate",	"option_pricing_premium",	
                        "ignore_duplicate_check",	"is_fast_track",	"mid_price",	"mid_points",	"dealer_code"
                        75 Column
                        
                        
                        $report_date = date('d/m/Y');
                        
                        
                        if($fetch["Notional"] <> "" || $fetch["Notional"] <> 0){
                               $notional =  number_format($fetch["Notional"], 2, '.', ',');
                        }else{
                               $notional = 0;
                        }
                        
                        if($fetch["counter_amt"] <> "" || $fetch["counter_amt"] <> 0){
                               $counter_amts =  number_format($fetch["counter_amt"], 2, '.', ',');
                        }else{
                               $counter_amts = 0;
                        }
                        
                        if($fetch["price"] <> "" || $fetch["price"] <> 0){
                               $price =  number_format($fetch["price"], 2, '.', ',');
                        }else{
                               $price = "0.00";
                        }
                        
                        if($fetch["premium_amount"] <> "" || $fetch["premium_amount"] <> 0){
                               $premium_amount=  number_format($fetch["premium_amount"], 2, '.', ',');
                        }else{
                               $premium_amount = "0.00";
                        }
                        
                        if($fetch["deleted_trade_flag"] <> "" || $fetch["deleted_trade_flag"] == 1){ 
                            $deleted_trade_flag  = 'Y';
                        }else{
                            $deleted_trade_flag  = 'N';
                        }
                        
                        if($fetch["amended_trade_flag"] <> "" || $fetch["amended_trade_flag"] == 1){ 
                            $amended_trade_flag  = 'Y';
                        }else{
                            $amended_trade_flag  = 'N';
                        }
                        
                        if($fetch["mid_price"] <> "" || $fetch["mid_price"] <> 0){
                              $mid_price =  number_format($fetch["mid_price"], 2, '.', ',');
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
                        $option_put_call_ind = "";   
                        $option_payment_ccy = "";  
                        $option_premium_date = "";
                        $option_price = ""; 
                        $platform_indicator = ""; 
                        $platform_trade_id = ""; 
                        $parent_trade_id = ""; 
                        $trade_type = "";
                        $traded_ccy = ""; 
                        $option_exercise = "";
                        $option_cut_code = ""; 
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
                        
                        
       "ignore_duplicate_check",	"is_fast_track",	"mid_price",	"mid_points",	"dealer_code"
      
                            
      "CURVE", $fetch["id_contract"], $report_date, fetch["value_date"], fetch["trade_date"], $fetch["ccy_pair"], $fetch["buy_sell"], $notional,
      $counter_amts, $price, $fetch["fixing_date"], $fetch["fixing_date"], $fixing_source,  $fetch["account"], $fetch["account"], $fetch["contract"], $far_leg_amount,
      $far_leg_rate, $far_leg_value_date, $far_fixing_date, $far_fixing_source, $option_put_call_ind,  $option_payment_ccy,
      $fetch["settlement_date"], $fetch["expiry_date"], $premium_amount, $option_premium_date, $fetch["option_style"],    
      $option_price, $platform_indicator, $platform_trade_id, $fetch["client"], $deleted_trade_flag, $amended_trade_flag,
      $parent_trade_id, $trade_type, $traded_ccy, $option_exercise, $option_cut_code,  $second_fixing_source, $advice_status_id,
      $exotic_option_type, $fetch["barrier_type"], $fetch["u_barrier"], $fetch["l_barrier"], 
      $fetch["knock_in_out"], $fetch["touch_up_down"], $fetch["cash_at"], 
      $fetch["rebate_ccy"], $fetch["rebate_amt"], $exotic_option_barrier_start_date,                  
      $exotic_option_barrier_enddate, $exotic_option_monitor_window_cutoff, $exotic_option_monitor_window_cutoffcity,  $exotic_option_monitoring_window,
      $exotic_option_distribution_fallback1,  $exotic_option_distribution_fallback2,  $exotic_option_distribution_fallback3,
      $exotic_option_distribution_fallback4, $trade_event_type,  $fetch["lw_barrier_sd"], $fetch["lw_barrier_ed"],          
      $fetch["up_barrier_sd"], $fetch["up_barrier_ed"], $original_file_name,  $is_novation, $fetch["deliverability"],
      $option_pricing_premium_ccy, $far_leg_counter_amount, $is_swap, $option_pricing_premium_conversion_rate,  $option_pricing_premium,
      $ignore_duplicate_check, $is_fast_track, $mid_price, $mid_points, $dealer_code;
                        
                        
                        
                        
       */
                        
                        
                        
        
        //take new main array and set header array in it.
        $sheet =array($tmparray);
      
        while($fetch = $result->fetch_assoc())
        {
                     
                      $notation =  number_format($fetch["Notional"], 2, '.', ',');
        
                      if($fetch["counter_amt"] <> "" || $fetch["counter_amt"] <> 0){
                             $counter_amts =  number_format($fetch["counter_amt"], 2, '.', ',');
                      }else{
                             $counter_amts = 0;
                      }
                      
                      if($fetch["strike"] <> "" || $fetch["strike"] <> 0){
                             $strikes =  number_format($fetch["strike"], 2, '.', ',');
                      }else{
                             $strikes = "0.00";
                      }
                      
                      if($fetch["price"] <> "" || $fetch["price"] <> 0){
                             $prices =  number_format($fetch["price"], 2, '.', ',');
                      }else{
                             $prices = "0.00";
                      }
                      
                      if($fetch["rate"] <> "" || $fetch["rate"] <> 0){
                             $rates =  number_format($fetch["rate"], 2, '.', ',');
                      }else{
                             $rates = "0.00";
                      }
                      
                      if($fetch["prem_amt"] <> "" || $fetch["prem_amt"] <> 0){
                             $prem_amts =  number_format($fetch["prem_amt"], 2, '.', ',');
                      }else{
                             $prem_amts = "0.00";
                      }
                      
                      if($fetch["l_barrier"] <> "" || $fetch["l_barrier"] <> 0){
                             $l_barriers =  number_format($fetch["l_barrier"], 2, '.', ',');
                      }else{
                             $l_barriers = "0.00";
                      }
                      
                      if($fetch["u_barrier"] <> "" || $fetch["u_barrier"] <> 0){
                             $u_barriers =  number_format($fetch["u_barrier"], 2, '.', ',');
                      }else{
                             $u_barriers = "0.00";
                      }
                      
                      if($fetch["rebate_amt"] <> "" || $fetch["rebate_amt"] <> 0){
                             $rebate_amts =  number_format($fetch["rebate_amt"], 2, '.', ',');
                      }else{
                             $rebate_amts = "0.00";
                      }
                      
                      if($fetch["filesent"] <> "" || $fetch["filesent"] <> 0){
                             $filesent =  "SENT";
                      }else{
                             $filesent =  "NOT SENT";
                      }   
                      
                      if($fetch["type"] <> "" || $fetch["type"] <> 0){
                             $mtype =  $fetch["type"];
                      }else{
                             $mtype =  " ";
                      }   
                      
                                       
                     
                      $tmparray =array();
          
                      $serialnumber = $serialnumber + 1;
                      array_push($tmparray,$serialnumber);
          
                      array_push($tmparray,$fetch["id_contract"]);
                      array_push($tmparray,$filesent);
                      array_push($tmparray,$fetch["contract"]);
                      array_push($tmparray,$fetch["client"]);
                      array_push($tmparray,$fetch["cparty"]);
                      array_push($tmparray,$fetch["buy_sell"]);
                      array_push($tmparray,$notation);
                      array_push($tmparray,$fetch["ccy_pair"]);
                      array_push($tmparray,$strikes);
                      array_push($tmparray,$fetch["p_c"]);
                      array_push($tmparray,$counter_amts);
                      array_push($tmparray,$fetch["expiry_date"]);
                      array_push($tmparray,$fetch["optcut"]);
                      array_push($tmparray,$fetch["settle_date"]);
                      
                      array_push($tmparray,$prices);
                      array_push($tmparray,$rates);
                      array_push($tmparray,$prem_amts);
                      array_push($tmparray,$mtype);
                      //array_push($tmparray,$fetch["rebate_ccy"]);
                      array_push($tmparray,$fetch["barrier_type"]);
                      
                      array_push($tmparray,$l_barriers);        
                      array_push($tmparray,$u_barriers);
                      
                      array_push($tmparray,$fetch["knock_in_out"]);
                      array_push($tmparray,$fetch["touch_up_down"]);
                      array_push($tmparray,$fetch["cash_at"]);
                      array_push($tmparray,$fetch["rebate_ccy"]);
                      array_push($tmparray,$fetch["trade_date"]);
                      array_push($tmparray,$fetch["value_date"]);
                      array_push($tmparray,$fetch["expiry"]);
                      array_push($tmparray,$rebate_amts);
                      array_push($tmparray,$fetch["payout_ccy"]);
                      array_push($tmparray,$fetch["barrier_start_date"]);
                      array_push($tmparray,$fetch["barrier_end_date"]);
                      array_push($tmparray,$fetch["spcut"]);
                      array_push($tmparray,$fetch["settlement"]);
                      array_push($tmparray,$fetch["fx_pair_id"]);
                      array_push($tmparray,$fetch["platform"]);
                      array_push($tmparray,$fetch["indicator"]);
                      array_push($tmparray,$fetch["platform_trade_id"]);
                      array_push($tmparray,$fetch["status"]);   
          
          
                      array_push($sheet,$tmparray);
        }
         
         header('Content-type: application/vnd.ms-excel');
         header('Content-Disposition: attachment; filename="name.xlsx"');
         
        $worksheet = $objPHPExcel->getActiveSheet();
        foreach($sheet as $row => $columns) {
          foreach($columns as $column => $data) {
              $worksheet->setCellValueByColumnAndRow($column, $row + 1, $data);
          }
        }
        
        $rand_file = "file_".date('m-d-Y_hia');
      
        //make first row bold
        $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('excel_files/'.$rand_file.'.xlsx');
        
                                                                
        $name = $_POST['name'];         
        $email_to = $_POST['emailTo'];
        $email_cc = $_POST['emailCc'];            
        $message = $_POST['message'];
        
       
        $fileatt = $_FILES['uploaded_file']['tmp_name']; // Path to the file
        
        $fileatt_type = $file_type; // File Type
        $fileatt_name = $_FILES["uploaded_file"]["name"]; // Filename that will be used for the file as the attachment
    
        $email_from = "fxconfirmations@curvemarkets.com"; // Who the email is from
        $email_subject = "Curvemarkets Trades"; // The Subject of the email
        $email_message = nl2br($message);
        $email_message .= "<br><br><br>Thanks for visiting.<br><br>"; // Message that the email has in it
        $email_message .= "Webmaster <br>";
        $email_message .= "Curvemarkets";
    
        $email_to = $_POST['emailTo']; // Who the email is to
    
        $headers = "From: ".$email_from;
        
        if($email_cc != ""){
            $headers .= "\nCc: ".$email_cc;
        }
    
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";          
    
        $headers .= "\nMIME-Version: 1.0\n" .
        "Content-Type: multipart/mixed;\n" .
        " boundary=\"{$mime_boundary}\"";           
        
        $email_message .= "This is a multi-part message in MIME format.\n\n" .
        "--{$mime_boundary}\n" .
        "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" .
        $email_message .= "\n\n";
              
        
         if($fl_attach == 1){      
                  
                  $email_message .= "--{$mime_boundary}\n";
                  
                  $file = fopen($fileatt,'rb');
                  $data = fread($file,filesize($fileatt));
                  fclose($file);
                  
                  $data = chunk_split(base64_encode($data));   
              
                  
                  $email_message .= "Content-Type: {$fileatt_type};\n" .
                  " name=\"{$fileatt_name}\"\n" .
                  //"Content-Disposition: attachment;\n" .
                  //" filename=\"{$fileatt_name}\"\n" .
                  "Content-Transfer-Encoding: base64\n\n" .
                  $data .= "\n\n";
                  //"--{$mime_boundary}--\n";
          
          }
                                              
       
          $fileatt_name_xl =  'excel_files/'.$rand_file.'.xlsx';
          $file_name_xl = $rand_file.'.xlsx';
          
          $email_message .= "--{$mime_boundary}\n";
          
          $file_xl = fopen($fileatt_name_xl,'rb');
          $data_xl = fread($file_xl,filesize($fileatt_name_xl));
          
          //$fileatt_type_xl = filetype($fileatt_name_xl);
          fclose($file_xl);
          $data_xl = chunk_split(base64_encode($data_xl));   
          
          
          $email_message .= "Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;\n" .
          " name=\"{$file_name_xl}\"\n" .
          //"Content-Disposition: attachment;\n" .
          //" filename=\"{$file_name_xl}\"\n" .
          "Content-Transfer-Encoding: base64\n\n" . 
          $data_xl .= "\n\n" .                      
          "--{$mime_boundary}--\n";
                         
          unlink($fileatt_name_xl);
    
    
          $ok = @mail($email_to, $email_subject, $email_message, $headers);
       
       
          // now we just send the message
          if($ok) {
          
            echo "sent";
          
          } else {
          
            echo "error";
          
          }
    
          exit;
      
}
?>   
  