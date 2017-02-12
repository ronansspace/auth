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
    
  $sql = "SELECT * FROM profit_loss where 1=1 $xtra_qry order by trade_id desc, str_to_date( trade_date, '%d/%m/%Y') desc";
    
	$result = $conn->query($sql);
          
  $size = $result->num_rows;
  
  if($size <= 0){           
    print json_encode("empty");
    exit;         
  }                      
          
  while($fetch = $result->fetch_array()) {
  
  
        if($fetch["notational"] <> "" || $fetch["notational"] <> 0){
              $notation =  number_format($fetch["notational"], 2, '.', ',');
        }else{
               $notation = 0;
        }              
        
        if($fetch["profit"] <> "" || $fetch["profit"] <> 0){
               $profit = number_format($fetch["profit"], 2, '.', ',');
        }else{
               $profit = "0.00";
        }
        
        if($fetch["grosprofit"] <> "" || $fetch["grosprofit"] <> 0){
               $grosprofit = number_format($fetch["grosprofit"], 2, '.', ',');
        }else{
               $grosprofit = "0.00";
        }
        
        if($fetch["pbcost"] <> "" || $fetch["pbcost"] <> 0){
               $pbcost = number_format($fetch["pbcost"], 2, '.', ',');
        }else{
               $pbcost = "0.00";
        }
        
        if($fetch["venuecost"] <> "" || $fetch["venuecost"] <> 0){
               $venuecost = number_format($fetch["venuecost"], 2, '.', ',');
        }else{
               $venuecost = "0.00";
        }
        
        if($fetch["totalcost"] <> "" || $fetch["totalcost"] <> 0){
               $totalcost = number_format($fetch["totalcost"], 2, '.', ',');
        }else{
               $totalcost = "0.00";
        }
        
        $client_name = "";
               
        $sql2 = "select * from clients where id = '".$fetch["client"]."'";
        $result2 = $conn->query($sql2);                       
        $fetch2 = $result2->fetch_array();
        
        $sql3 = "select * from traders where pid = '".$fetch["trader_id"]."'";
        $result3 = $conn->query($sql3);                       
        $fetch3 = $result3->fetch_array();
        
        $trader_name =  $fetch3['tdrID'];
        
        if($fetch2['name'] <> ""){  
          $client_name = $fetch2['name'];
        }
        
        $fx_pair_id = "TLink_".$fetch["master_trade_id"];
                                       
        $output[] = array (           
        
            $fetch["id"],$fetch["trade_id"],$fx_pair_id,$fetch["contract"],$client_name,$trader_name,$notation,$fetch["ccy_pair"],
            $fetch["trade_date"], $fetch["value_date"], $profit, $grosprofit, $pbcost, $venuecost, $totalcost
        
        );
  }
  
  echo json_encode($output);  
  exit;
?>
       