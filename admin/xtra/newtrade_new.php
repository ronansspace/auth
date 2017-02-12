<?php

session_start();
require_once('../inc/def.php');
      
$contract_FXSP = "block";  
$contract_FXFW = "none";                             
$contract_FXNDF = "none";   
$contract_FXOPT = "none";  
$contract_EOPT = "none";
$filesent = "";
$contract = "";
$account = "";
$id_contract = "";
//$client = str_replace(' ','&nbsp;',htmlentities($row['client']));
$client = "";
$cparty = "";
$buy_sell = "";
$Notional = "";
$ccy_pair = "";
$p_c = "";
$counter_amt = "";
$expiry_date = "";
$optcut = "";
$settle_date = "";
$price = "";
$rate = "";
$prem_amt = "";
//$prem_ccy = str_replace(' ','&nbsp;',htmlentities($row['prem_ccy']));
$type = "";
$barrier_type = "";
$l_barrier = "";
$u_barrier = "";
$knock_in_out = "";
$touch_up_down = "";
$cash_at = "";
$rebate_ccy = "";
$trade_date = "";
$value_date = "";
$expiry = "";
$rebate_amt = "";
$payout_ccy = "";
$barrier_start_date = "";
$barrier_end_date = "";
$spcut = "";
$fx_pair_id = "";
$platform = "";
$indicator = "";
$platform_trade_id = "";
$status = "";
$traded_as = "";
$cut_time = "";
$calc = "";
$prime_broker = "";
$settlement = "";   
$inverted = "";
$order_entry_time = "";
$matching_date = "";
$mid_price = "";       
$deliverablity = "";
$fixing_date = "";
$invertedprice = "";
$premium_ccy = "";
$spcut_cp = "";
$premium_amount = "";
$calculations = "";
$price_percentage = "";
$strike = "";
$option_style = "";
$opt_type = "";
$lower_barrier = "";
$cashat = "";
$up_barrier_sd = "";
$up_barrier_ed = "";
//$barrier_type = "";
//$knock_in_out = "";
//$rebate_ccy = "";
$lw_barrier_sd = "";
$lw_barrier_ed = "";
$up_barrier = "";
$client_trader = "";
//$touch_up_down = "";
//$rebate_amt = "";
$barrier_style = "";
$mid_barrier = "";

$trade_date = date('d/m/Y');
$value_date = date('d/m/Y', strtotime("+2 Weekday"));
$matching_date = date('d/m/Y');

// DATES FOR JQUERY 
$value_date_1 = date('d/m/Y', strtotime("+1 Weekday"));
$value_date_2 = date('d/m/Y', strtotime("+2 Weekday"));     

$mod_date = strtotime("-2 day", strtotime("+2 Weekday"));

$fixing_date = date('d/m/Y', $mod_date); //date('d/m/Y', strtotime("0 Weekday"));

$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
} 

$pb_email_sent = "";
$client_email_sent = "";

$pnl_ccy_pair = "";
$pnl_rate = "";
$pnl_counter_amt = "";

                  
if(isset($_GET['id'])){

	  $tdrID = $_SESSION['auth_id'];
  
    $id_contract = $_GET['id'];
    $sql = "SELECT * FROM contract where id_contract = $id_contract";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();          
    
    $client_trader = $row['client_trader'];
    
    $pb_email_sent = $row['pb_email'];
    $client_email_sent = $row['client_email'];
    
		$id_contract = str_replace(' ','&nbsp;',htmlentities($row['id_contract']));
		
		$filesent = str_replace(' ','&nbsp;',htmlentities($row['filesent']));
		$contract = str_replace(' ','&nbsp;',htmlentities($row['contract']));
    $account = str_replace(' ','&nbsp;',htmlentities($row['account']));
    
    
		//$client = str_replace(' ','&nbsp;',htmlentities($row['client']));
    $client = $row['client'];
		$cparty = str_replace(' ','&nbsp;',htmlentities($row['cparty']));
		$buy_sell = str_replace(' ','&nbsp;',htmlentities($row['buy_sell']));
		
    $decinot = strlen(substr(strrchr($row["Notional"], "."), 1));
    $Notional = number_format($row['Notional'], $decinot, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['Notional']));
		
    $ccy_pair = str_replace(' ','&nbsp;',htmlentities($row['ccy_pair']));
		$p_c = str_replace(' ','&nbsp;',htmlentities($row['p_c']));
		
    if($row['counter_amt'] <> ""){ 
      $decico = strlen(substr(strrchr($row["counter_amt"], "."), 1));
      $counter_amt = number_format($row['counter_amt'], $decico, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['counter_amt']));
		}
    $expiry_date = str_replace(' ','&nbsp;',htmlentities($row['expiry_date']));
		$optcut = str_replace(' ','&nbsp;',htmlentities($row['optcut']));
		$settle_date = str_replace(' ','&nbsp;',htmlentities($row['settle_date']));
    
    $decicpr = strlen(substr(strrchr($row["price"], "."), 1));
		$price = number_format($row['price'], $decicpr, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['price']));
    
		if($row['rate'] <> ""){ 
        $decicrt = strlen(substr(strrchr($row["rate"], "."), 1));
        $rate = number_format($row['rate'], $decicrt, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['rate']));
    }
    
    $deciprm = strlen(substr(strrchr($row["prem_amt"], "."), 1));
		$prem_amt = number_format($row['prem_amt'], $deciprm, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['prem_amt']));
		//$prem_ccy = str_replace(' ','&nbsp;',htmlentities($row['prem_ccy']));
		$type = str_replace(' ','&nbsp;',htmlentities($row['type']));
		$barrier_type = str_replace(' ','&nbsp;',htmlentities($row['barrier_type']));
		$l_barrier = str_replace(' ','&nbsp;',htmlentities($row['l_barrier']));
		$u_barrier = str_replace(' ','&nbsp;',htmlentities($row['u_barrier']));
		$knock_in_out = str_replace(' ','&nbsp;',htmlentities($row['knock_in_out']));
		$touch_up_down = str_replace(' ','&nbsp;',htmlentities($row['touch_up_down']));
		$cash_at = str_replace(' ','&nbsp;',htmlentities($row['cash_at']));
    
    $decire = strlen(substr(strrchr($row["rebate_ccy"], "."), 1));
		$rebate_ccy = number_format($row['rebate_ccy'], $decire, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['rebate_ccy']));
    
		$trade_date = str_replace(' ','&nbsp;',htmlentities($row['trade_date']));
		$value_date = str_replace(' ','&nbsp;',htmlentities($row['value_date']));
		$expiry = str_replace(' ','&nbsp;',htmlentities($row['expiry']));
    if($row['rebate_amt'] <> ""){
    
          $decireb = strlen(substr(strrchr($row["rebate_amt"], "."), 1));
		      $rebate_amt = number_format($row['rebate_amt'], $decireb, '.', ','); //str_replace(' ','&nbsp;',htmlentities($row['rebate_amt']));
    }
    
		if($row['payout_ccy'] <> ""){
    
          $payout_ccy = $row['payout_ccy'];
          //$decipay_c = strlen(substr(strrchr($row["payout_ccy"], "."), 1));
          //$payout_ccy = number_format($row['payout_ccy'], $decipay_c, '.', ','); // str_replace(' ','&nbsp;',htmlentities($row['payout_ccy']));
    }
    
		$barrier_start_date = str_replace(' ','&nbsp;',htmlentities($row['barrier_start_date']));
		$barrier_end_date = str_replace(' ','&nbsp;',htmlentities($row['barrier_end_date']));
		$spcut = str_replace(' ','&nbsp;',htmlentities($row['spcut']));
		$fx_pair_id = $row['fx_pair_id'];
		$platform = str_replace(' ','&nbsp;',htmlentities($row['platform']));
		$indicator = str_replace(' ','&nbsp;',htmlentities($row['indicator']));
		$platform_trade_id = str_replace(' ','&nbsp;',htmlentities($row['platform_trade_id']));
		$status = str_replace(' ','&nbsp;',htmlentities($row['status']));
    $traded_as = $row['traded_as'];
    $cut_time = $row['cut_time'];
    $calc = $row['calc'];
    $prime_broker = $row['prime_broker'];
    $settlement = $row['settlement'];
    $inverted = $row['Inverted_price'];
    $order_entry_time = $row['order_entry_time'];
    $matching_date = $row['matching_date'];
    
    if($row['mid_price'] <> ""){ 
          $decimp = strlen(substr(strrchr($row["mid_price"], "."), 1));
          $mid_price = number_format($row['mid_price'], $decimp, '.', ','); //$row['mid_price']; 
    }   
    $deliverablity = $row['deliverablity'];
    $fixing_date = $row['fixing_date']; 
    
    if($row['premium_ccy'] <> ""){
        //$premium_ccy = number_format($row['premium_ccy'], 2, '.', ','); //$row['premium_ccy'];
        
        $premium_ccy = $row['premium_ccy']; 
    }
    
    $spcut_cp = $row['spcut_cp']; 
    if($row['premium_amount'] <> ""){
    
       $decipr_amt = strlen(substr(strrchr($row["premium_amount"], "."), 1));
       $premium_amount =  number_format($row['premium_amount'], $decipr_amt, '.', ','); //$row['premium_amount']; 
    }
    $calculations = $row['calculations']; 
    if($row['price_percentage'] <> ""){
      $deciperc = strlen(substr(strrchr($row["price_percentage"], "."), 1));
      $price_percentage = number_format($row['price_percentage'], $deciperc, '.', ','); //$row['price_percentage'];
    } 
    if($row['strike'] <> ""){
          $decistr = strlen(substr(strrchr($row["strike"], "."), 1));
          $strike =  number_format($row['strike'], $decistr, '.', ',');
    }
    $option_style = $row['option_style'];
    
    
    $pnl_ccy_pair = $row['pnl_ccy_pair'];
    
    
    if($row['pnl_rate'] <> "" || $row['pnl_rate'] <> 0){
          $decipln = strlen(substr(strrchr($row["pnl_rate"], "."), 1));
          $pnl_rate =  number_format($row['pnl_rate'], $decipln, '.', ',');
    }            
    if($row['pnl_counter_amt'] <> "" || $row['pnl_counter_amt'] <> 0){
          $decipnlam = strlen(substr(strrchr($row["pnl_counter_amt"], "."), 1));
          $pnl_counter_amt =  number_format($row['pnl_counter_amt'], $decipnlam, '.', ',');
    }
    
    $opt_type =  $row['opt_type'];
    $lower_barrier = $row['lower_barrier'];
    $cashat = $row['cashat'];
    $up_barrier_sd = $row['up_barrier_sd'];
    $up_barrier_ed = $row['up_barrier_ed'];
    //$barrier_type = $row['barrier_type'];
    //$knock_in_out = $row['knock_in_out'];
    //$rebate_ccy = $row['rebate_ccy'];
    $lw_barrier_sd = $row['lw_barrier_sd'];
    $lw_barrier_ed = $row['lw_barrier_ed'];
    $up_barrier = $row['up_barrier'];
    //$touch_up_down = $row['touch_up_down'];
    //$rebate_amt = $row['rebate_amt'];
    $barrier_style = $row['barrier_style'];
    $mid_barrier = $row['mid_barrier'];
    
           
    if($contract == "FXSP"){ 
        $contract_FXSP = "block";
    }
    if($contract == "FXFW"){ 
        $contract_FXFW = "block";
    }
    if($contract == "FXNDF"){     
        $contract_FXNDF = "block";
    }
    if($contract == "FXOPT"){       
        $contract_FXOPT = "block";
    }
    if($contract == "EOPT"){ 
        $contract_EOPT = "block";
    }
    
    
    if(isset($_GET['only_copy']) && $_GET['only_copy'] == "yes" ){
          $id_contract = ""; // We are adding new record, we can disable edit option with this //
    }
   
}
?>   
<?php
if(!tdrLoggedIn()){	
}
else{
?>
<style>		

        #FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT{ 			display:none; 		} 		
        .max-container{ 			
                background-color:#fff; 			
                padding:10px 42px; 			
                margin-top:5px; 			
                border:1px solid black;
                width: 1170px; 	
        } 		          
        #rate_date_id{padding-top: 2px; padding-left: 2px; font-size:11px;}
        div.top{background-color:#101010; padding-top:4px; padding-bottom:5px;} 		
        label.lb-left{ 			padding:3px 12px; color:#fff; background-color:#5E94DD;border-top-right-radius: 0em;border-bottom-right-radius: 0em; 		} 		
        label.lb-right{ 			background-color:#fff;padding:3px 12px; color:#101010;border-top-left-radius: 0em;border-bottom-left-radius: 0em; margin-right:20px; 		} 		
        label.lb-right select{ 			border:none; outline:none; min-width:70px; 		} 		
        td select,td input[type="text"],td input[type="date"]{ 			width:135px; 		} 		
        td input[type="text"],td input[type="date"]{ line-height:90%;} 		
        td input[type="date"]{ height:90%;} 		
        td{ white-space:nowrap;}          
        .col-md-12 {padding-right:0px;}     
        .max-container table>tbody>tr>td{       padding: 6px;       padding-left: 5px;       line-height: 1;       vertical-align: middle;       border-top: 1px solid #ddd;     }     
        .table{ margin-top: 20px; }   
            
</style>    
<div class="container form_drag max-container" style="overflow:auto;">	
  <div class="row">    	
    <div class="row">        	
      <div class="col-md-12 top">            	
        <label class="label lb-left">Trade Date
        </label>
        <label class="label lb-right">
          <?php echo date("Y-m-d"); ?>
        </label>                
        <label class="label lb-left">Trade Time
        </label>
        <label id="time" class="label lb-right">
          <?php echo date("H:i:s"); ?>
        </label>                
        <label class="label lb-left">GMT Time
        </label>
        <label id="gmtime" class="label lb-right">
          <?php echo gmdate("H:i:s"); ?>
        </label>				
        <script>
				  Number.prototype.formatMoney = function(c, d, t){
          var n = this, 
              c = isNaN(c = Math.abs(c)) ? 2 : c, 
              d = d == undefined ? "." : d, 
              t = t == undefined ? "," : t, 
              s = n < 0 ? "-" : "", 
              i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
              j = (j = i.length) > 3 ? j % 3 : 0;
             return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
           };
  				var notional = "";
  				var year =  <?php echo date("Y"); ?>;
  				var month = <?php echo date("m"); ?>;
  				var day = <?php echo date("d"); ?>;
  				var date = new Date(year,month-1,day);
					var H = <?php echo date("H"); ?>;
					var M = <?php echo date("i"); ?>;
					var S = <?php echo date("s"); ?>;
					var gH = <?php echo gmdate("H"); ?>;
					var gM = <?php echo gmdate("i"); ?>;
					var gS = <?php echo gmdate("s"); ?>;
					
					var timeupdate = window.setInterval(function(){
						if(S==60){
							S=0;
							if(M==60){
								M=0;
								if(H==24)
									H=0;
								else
									H++;
							}
							else
								M++;
						}
						else
							S++;
						if(gS==60){
							gS=0;
							if(gM==60){
								gM=0;
								if(gH==24)
									gH=0;
								else
									gH++;
							}
							else
								gM++;
						}
						else
							gS++;
					{
					var HH = (H<10)?"0"+H:H;
					var MM = (M<10)?"0"+M:M;
					var SS = (S<10)?"0"+S:S;
					var gHH = (gH<10)?"0"+gH:gH;
					var gMM = (gM<10)?"0"+gM:gM;
					var gSS = (gS<10)?"0"+gS:gS;
					$("#time").html(HH+":"+MM+":"+SS);
					$("#gmtime").html(gHH+":"+gMM+":"+gSS);
					}
					},1000);
				</script>                
        <div style="float:right;">
          <label class="label lb-left" style="background-color:#46D430;">Contract
          </label>                
          <label class="label lb-right" style="padding-right:3px;">                
            <select id="contract" onChange="ch_contract();">                        	
              <option <?php if(isset($contract) && $contract == "FXSP"){ echo "selected"; }?> value="FXSP">FXSP
              </option>                            
              <option <?php if(isset($contract) && $contract == "FXFW"){ echo "selected"; }?> value="FXFW">FXFW
              </option>                            
              <option <?php if(isset($contract) && $contract == "FXNDF"){ echo "selected"; }?> value="FXNDF">FXNDF
              </option>                            
              <option <?php if(isset($contract) && $contract == "FXOPT"){ echo "selected"; }?> value="FXOPT">FXOPT
              </option>                            
              <option <?php if(isset($contract) && $contract == "EOPT"){ echo "selected"; }?> value="EOPT">EOPT
              </option>                
            </select>                
          </label>						    
          <label class="label lb-left" style="background-color:#46D430;">Account
          </label>
          <label class="label lb-right" style="padding-right:3px;">                             
            <select id="account">                    	
              <option <?php if(isset($account) && $account == "Curve"){ echo "selected"; }?> value="Curve" selected>Curve
              </option>                      
              <option <?php if(isset($account) && $account == "Curve_MP"){ echo "selected"; }?> value="Curve_MP">Curve_MP
              </option>             		
            </select>
          </label>                 
          <label class="label lb-left">Trade Status
          </label>                 
          <label class="label lb-right" style="padding-right:3px;">                 
            <select name="status" id="status">             		    
              <option <?php if(isset($status) && $status == "Active"){ echo "selected"; }?> value="Active">Active
              </option>                    
              <option <?php if(isset($status) && $status == "Abandoned"){ echo "selected"; }?> value="Abandoned">Abandoned
              </option>                    
              <option <?php if(isset($status) && $status == "Excercise"){ echo "selected"; }?> value="Excercise">Excercise
              </option>                    
              <option <?php if(isset($status) && $status == "Triggered"){ echo "selected"; }?> value="Triggered">Triggered
              </option>                    
              <option <?php if(isset($status) && $status == "SETTELED"){ echo "selected"; }?> value="SETTELED">SETTELED
              </option>                    
              <option <?php if(isset($status) && $status == "NOVATED"){ echo "selected"; }?> value="NOVATED">NOVATED
              </option>                    
              <option <?php if(isset($status) && $status == "TEARUP"){ echo "selected"; }?> value="TEARUP">TEARUP
              </option>                
            </select>
          </label>
        </div>        	
      </div>        
    </div>        
    <div class="row" id="FXSP" style="display:<?=$contract_FXSP;?>">            	
      <div class="col-xs-12" style="background-color:#eee;">				
        <form id="FXSP_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                       
          <input type="hidden" name="id_contract" value="<?=$id_contract;?>">                           	
          <table class="table" border="0">                	
            <tbody>                    	
              <tr>                        	
                  <td>Client:</td>
                  <td>
                        <select class="client_select" name="client" tabindex="1">       
                          <option <?php if(isset($client) && $client == ""){ echo "selected"; }?> value="">Select Client</option>                          
                          <?php
                          $sql2 = "select * from clients order by name";
                        	$result2 = $conn->query($sql2);
                                  
                          while($fetch2 = $result2->fetch_array()) 
                          {
                          ?>    
                               <option <?php if(isset($client) && $client == $fetch2['id']){ echo "selected"; } ?> value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option> 
                          <?php
                          }                          
                          ?>                                             					
                        </select>
                  </td>                        	
                  <td>Rate:</td><td>
                  <input tabindex="5" id="fxsp_rate" class="fxsp_rate all_numbers_rate" type="text" name="rate" value="<?=$rate;?>"></td>                            
                  <td>Trade Date:</td><td>
                  <input tabindex="8" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"  id="fxsp_td" class="all_dates"></td>                            <td>Expiry:</td><td>		                             
                  <select tabindex="13" name="expiry">								                             
                    <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N
                    </option> 						 												    
                    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y
                    </option>   												    
                  </select></td>                        
              </tr>      
              <tr>                        	
                  <td>Client Trader:</td>
                  <td colspan="7">
                      <select class="client_trader_change" name="client_trader" tabindex="1">
                             
                        <option value="">Client Trader</option> 
                                                   
                        <?php
                        if($client <> ""){
                        
                            $sql3 = "select * from client_trader where client_id=$client order by name";
                          	$result3 = $conn->query($sql3);
                                    
                            while($fetch3 = $result3->fetch_array()) 
                            {
                            ?>    
                                 <option <?php if(isset($client_trader) && $client_trader == $fetch3['id']){ echo "selected"; }?>  value="<?=$fetch3['id'];?>"><?=$fetch3['name'];?></option> 
                            <?php
                            }   
                        }                       
                        ?>      
                      
                      </select>
                  </td>                        	
                                   
              </tr>                           
              <tr>                        	
                  <td>CCY_pair:</td><td>
                  <select tabindex="2" class="ccy_pair" name="ccy_pair">                            	           
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select></td>                        	<td></td><td></td>                            <td>Value Date:</td><td>
                  <input type="text" id="fxsp_vd" placeholder="dd/mm/yy" tabindex="9"   class="all_dates" name="value_date" value="<?=$value_date;?>"></td>                            
                  <td>SPCUT:</td><td>                                  
                  <select tabindex="14" name="spcut">                                  
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC
                    </option>
                  </select>                            </td>                        
              </tr>                        
              <tr>                        	<td>Buy/Sell:</td><td>
                  <select tabindex="3" name="buy_sell">                                
                    <option value="" selected="selected">
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S
                    </option>
                  </select></td>                        	                           <td>Counter Amount:</td><td>
                  <input tabindex="6" value="<?=$counter_amt;?>" name="counter_amt" id="fxsp_camt"  class="fxsp_camt all_numbers" type="text"></td>                            <td>Traded As:</td><td>                                  
                  <select tabindex="10" name="traded_as">                                      
                    <option value="">
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FX" || $traded_as == ""){ echo "selected"; }?> value="FX" >FX
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE
                    </option>                                  
                  </select>                                  </td>                                  <td>Cut Time:</td><td>                                      
                  <select tabindex="15" name="cut_time">                                          
                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00
                    </option>										                      
                    <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00
                    </option>                                      
                  </select>                                  </td>                        
              </tr>                        
              <tr>                        	<td>Notional:</td><td>
                  <input tabindex="4" name="notional" value="<?=$Notional;?>" id="fxsp_not" class="fxsp_not all_numbers" type="text"></td>                          
                <!--
                                        	onblur="
                                          $(this).val($(this).val().replace(/,/g,'')); 
                                          $(this).val($(this).val().replace('m','000000')); 
                                          $(this).val($(this).val().replace('M','000000')); 
                                          $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));"
                                          onfocus="
                                          $(this).val($(this).val().replace(/,/g,''));"
                                          -->                          <td>Calc:</td><td>                            
                  <select tabindex="7" name="calc">                              
                    <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply
                    </option>												      
                    <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide
                    </option>
                  </select>                                                         </td>                            <td>Prime broker:</td><td>
                  <select tabindex="11" name="prime_broker">                                    
                    <option value="">...
                    </option>                                    
                    <!--<option value="CITI" >CITI</option>-->                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS" || $prime_broker == ""){ echo "selected"; }?> value="RBS">RBS
                    </option>                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST
                    </option>
                  </select></td>                                                                 <td>Settlement:</td><td>                              
                  <select tabindex="16" name="settlement">                                
                    <option value="">
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH
                    </option>
                  </select>                                                            </td>                        
              </tr>                        
              <tr>                        	<td></td><td>
                  <select style="display:none;" tabindex="5" name="inverted">                            
                    <option value="">
                    </option>												    
                    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I
                    </option>
                  </select></td>                        	<td></td><td></td>                            <td>Order Entry time:</td><td>
                  <input tabindex="12" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>                            <td>FX_PAIR ID:</td><td>
                  <input name="fx_pair_id" readonly value="<?=$fx_pair_id;?>" type="text"></td>                        
              </tr>                        
              <tr>                        	<td></td><td></td>                        	<td></td><td></td>                            <td></td><td></td>                            <td>Matching Date:</td><td>
                  <input placeholder="dd/mm/yy" tabindex="17"  value="<?=$matching_date;?>" id="fxsp_md"  class="all_dates" name="match_date" type="text"></td>							               <td>
                  <input type="submit" name="submit" value="Submit" style="display:none;">
                  
                  </td>                        
              </tr>   
              
              <?php
               $disp_convert = "";
               if($fx_pair_id <> ""){
               
                   $disp_convert = "display:none;";
               }
              ?>
                        
              <tr class="convert_base_area" style="<?=$disp_convert;?>">                        	
                  <td colspan="8"><strong>Convert Counter Amount to USD Equivalent</strong></td><td>
              </tr>
              <tr class="convert_base_area" style="<?=$disp_convert;?>">                         	
                  <td>CCY_pair:<br>
                      <span id="rate_date_id"></span>   </td><td>
                  <select tabindex="18" class="pnl_ccy_pair" name="pnl_ccy_pair">                            	           
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($pnl_ccy_pair) && $pnl_ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select>
                      <br>
                      <span id="rate_date_id"></span>  
                  </td>                        	
                         
                              	
                  <td>Rate:
                  <br>
                      <span id="rate_date_id"></span>   
                  </td>
                  <td> 
                    <input tabindex="19" id="fxsp_pnl_rate" class="fxsp_pnl_rate all_numbers_rate pnl_rate" value="<?=$pnl_rate;?>" type="text" name="pnl_rate" value="">
                    <br>
                    <?php
                    
                    $pnl_date_date_text = "";
                    if($pnl_rate <> "" && $pnl_ccy_pair <> ""){
                            
                            $sql_pn = "SELECT * FROM ccyrate where ccypair = '$pnl_ccy_pair'";
                            $result_pn = $conn->query($sql_pn);
    
                            $size_pn = $result_pn->num_rows;
                            
                            if($size_pn > 0){
                            
                                  $fetch_pn = $result_pn->fetch_array();
                                  
                                  $date = date("d/m/Y", strtotime($fetch_pn['date']));
                                  $pnl_date_date_text = "Updated on : ".$date;
                                  
                                  $date_now = date("d/m/Y");
                                 
                                  if($date_now > $date){
                                       $text_red = "text_red"; 
                                  }else{                                          
                                       $text_red = ""; 
                                  }
                                  
                            }
                              
                    }
                    
                    ?>
                    <span id="rate_date_id" class="rate_date <?=$text_red;?>"><?=$pnl_date_date_text;?></span> 
                  </td>                        	
                                                          
                  <td>Amount:<br>
                      <span id="rate_date_id"></span>   </td>
                  <td>
                      <input tabindex="20" name="pnl_counter_amt" id="fxsp_pnl_camt" class="fxsp_pnl_camt all_numbers" value="<?=$pnl_counter_amt;?>" type="text">
                      <br>
                      <span id="rate_date_id"></span>     
                  </td>                        	
                 <td></td>                                         
              </tr>
                   
            </tbody>                
          </table>				
        </form>            
      </div>        
    </div>                 
    <!-- ***************************************************************  -->         
    <div class="row" id="FXFW" style="display:<?=$contract_FXFW;?>">        	
      <div class="col-xs-12" style="background-color:#eee;">				
        <form id="FXFW_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                       
          <input type="hidden" name="id_contract" value="<?=$id_contract;?>">                           	
          <table class="table" border="0">	                 	
            <tbody>                    	
              <!--
                                    <tr>
                                      	<td>Client:</td><td><select tabindex="1" name="client">
                                          						<option value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option><option value="BALDR-G/U RBS   ">BALDR-G/U RBS   </option><option value="Bank of America Client">Bank of America Client</option><option value="Bank of America EB">Bank of America EB</option><option value="Barclays Bank Plc Client">Barclays Bank Plc Client</option><option value="Barclays Bank Plc EB">Barclays Bank Plc EB</option><option value="BNP Paribas Client">BNP Paribas Client</option><option value="BNP Paribas EB">BNP Paribas EB</option><option value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option><option value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option><option value="CitiGroup Client">CitiGroup Client</option><option value="CitiGroup EB">CitiGroup EB</option><option value="Credit Agricole  Client">Credit Agricole  Client</option><option value="Credit Agricole  EB">Credit Agricole  EB</option><option value="Credit Suisse AG Client">Credit Suisse AG Client</option><option value="Credit Suisse AG EB">Credit Suisse AG EB</option><option value="CURVE_MP">CURVE_MP</option><option value="Goldman Sachs  Client">Goldman Sachs  Client</option><option value="Goldman Sachs  EB">Goldman Sachs  EB</option><option value="GRATICULE- G/U Client">GRATICULE- G/U Client</option><option value="GRATICULE- G/U DB">GRATICULE- G/U DB</option><option value="HSBC Plc Client">HSBC Plc Client</option><option value="HSBC Plc EB">HSBC Plc EB</option><option value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option><option value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option><option value="JP Morgan NA Client">JP Morgan NA Client</option><option value="JP Morgan NA EB">JP Morgan NA EB</option><option value="LDF- G/U JPM">LDF- G/U JPM</option><option value="LSF- G/U JPM">LSF- G/U JPM</option><option value="MKP- G/U CITI">MKP- G/U CITI</option><option value="MKP- G/U CITI Client">MKP- G/U CITI Client</option><option value="Morgan Stanley Int Client">Morgan Stanley Int Client</option><option value="Morgan Stanley Int EB">Morgan Stanley Int EB</option><option value="NAB Client">NAB Client</option><option value="NAB EB">NAB EB</option><option value="Natixis Client">Natixis Client</option><option value="Natixis EB">Natixis EB</option><option value="Nomura Client">Nomura Client</option><option value="Nomura EB">Nomura EB</option><option value="OMEGA-G/U JPM">OMEGA-G/U JPM</option><option value="OPERA- G/U DB">OPERA- G/U DB</option><option value="PERMAL- G/U JPM">PERMAL- G/U JPM</option><option value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option><option value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option><option value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option><option value="RBC  Client">RBC  Client</option><option value="RBC  EB">RBC  EB</option><option value="RBS Client">RBS Client</option><option value="RBS EB">RBS EB</option><option value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option><option value="SEB Client">SEB Client</option><option value="SEB EB">SEB EB</option><option value="Standard Chartered  Client">Standard Chartered  Client</option><option value="Standard Chartered  EB">Standard Chartered  EB</option><option value="State Street Client">State Street Client</option><option value="State Street EB">State Street EB</option><option value="UBS AG Client">UBS AG Client</option><option value="UBS AG EB">UBS AG EB</option><option value="Westpac  Client">Westpac  Client</option><option value="Westpac EB">Westpac EB</option>
                                          					</select></td>
                                      	<td>Rate:</td><td><input tabindex="6" type="text" id="fxfw_rate" onBlur="$('#fxfw_camt').val(parseInt($('#fxfw_not').val().replace(/,/g,'')) * parseFloat($('#fxfw_rate').val()));" name="rate"></td>
                                          <td>Trade Date:</td><td><input placeholder="dd/mm/yy" tabindex="11" type="text" name="trade_date" id="fxfw_td"></td>
                                          <td>Expiry:</td><td>		<select name="expiry">								<option value="N" selected="selected">N</option> 						
              												<option value="Y">Y</option>
              												</select></td>
                                      
                                      </tr>
                                      -->                        
              <tr>                        	
                  <td>Client:</td><td>
                       <select class="client_select" name="client" tabindex="1">                                      
                        
                          <option <?php if(isset($client) && $client == ""){ echo "selected"; }?> value="">Select Client</option>                          
                          <?php
                          $sql2 = "select * from clients order by name";
                        	$result2 = $conn->query($sql2);
                                  
                          while($fetch2 = $result2->fetch_array()) 
                          {
                          ?>    
                               <option <?php if(isset($client) && $client == $fetch2['id']){ echo "selected"; } ?> value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option> 
                          <?php
                          }                          
                          ?>                                             					
                        </select>
                  </td>                        	  
                  <td>Rate:</td><td>
                  <input tabindex="5" id="fxsp_rate" class="fxfw_rate all_numbers_rate" type="text" name="rate" value="<?=$rate;?>" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>                            <td>Trade Date:</td><td>
                  <input tabindex="10"  class="all_dates" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>                            <td>Expiry:</td><td>		                             
                  <select tabindex="14" name="expiry">								                             
                    <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N
                    </option> 						 												    
                    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y
                    </option>   												    
                  </select></td>                        
              </tr>  
              <tr>                        	
                  <td>Client Trader:</td>
                  <td colspan="7">
                      <select class="client_trader_change" name="client_trader" tabindex="1">
                             
                        <option value="">Client Trader</option> 
                                                   
                        <?php
                        if($client <> ""){
                        
                            $sql3 = "select * from client_trader where client_id=$client order by name";
                          	$result3 = $conn->query($sql3);
                                    
                            while($fetch3 = $result3->fetch_array()) 
                            {
                            ?>    
                                 <option <?php if(isset($client_trader) && $client_trader == $fetch3['id']){ echo "selected"; }?>  value="<?=$fetch3['id'];?>"><?=$fetch3['name'];?></option> 
                            <?php
                            }   
                        }                       
                        ?>      
                      
                      </select>
                  </td>                        	
                                   
              </tr>                                                                                                   
              <tr>                        	<td>CCY_pair:</td><td>
                  <select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">                            	           
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select></td>                        	   <td>Mid Price:</td><td>
                  <input tabindex="6" type="text" value="<?=$mid_price;?>" class="all_numbers" name="mid_price"></td>                            <td>Value Date:</td><td>
                  <input type="text" placeholder="dd/mm/yy" tabindex="11"  class="all_dates" name="value_date" value="<?=$value_date;?>"></td>                            <td>SPCUT:</td><td>                                  
                  <select tabindex="15" name="spcut">                                  
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC
                    </option>
                  </select>                            </td>                        
              </tr>                                                  
              <tr>                        		<td>Buy/Sell:</td><td>
                  <select tabindex="3" name="buy_sell">                                
                    <option value="" selected="selected">
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S
                    </option>
                  </select></td>                        	                       	                           <td>Counter Amount:</td><td>
                  <input tabindex="7" value="<?=$counter_amt;?>" name="counter_amt" id="fxsp_camt"  class="fxfw_camt all_numbers" type="text"></td>                          <td>Traded As:</td><td>                                  
                  <select tabindex="12" name="traded_as">                                      
                    <option value="">
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FX" || $traded_as == ""){ echo "selected"; }?> value="FX" >FX
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE
                    </option>                                  
                  </select>                          </td>                          <td></td><td></td>                           
              </tr>                                                                          
              <tr>                        	<td>Notional:</td><td>
                  <input tabindex="4" name="notional" value="<?=$Notional;?>" class="fxfw_not all_numbers" id="fxsp_not" type="text"></td>                        	<td>Calc:</td><td>                            
                  <select tabindex="8" name="calc">                              
                    <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply
                    </option>												      
                    <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide
                    </option>
                  </select>                                                         </td>                            <td>Prime broker:</td><td>
                  <select tabindex="13" name="prime_broker">                                    
                    <option value="">...
                    </option>                                    
                    <!--<option value="CITI" >CITI</option>-->                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS"  || $prime_broker == ""){ echo "selected"; }?> value="RBS">RBS
                    </option>                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST
                    </option>
                  </select></td>                                                                 <td>Settlement:</td><td>                              
                  <select tabindex="16" name="settlement">                                
                    <option value="">
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH
                    </option>
                  </select>                                                            </td>                        
              </tr>                                                                          
              <tr>                        	   <td></td>                             <td>
                  <select style="display:none;" tabindex="5" name="inverted">                                
                    <option value="">
                    </option>    												    
                    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I
                    </option>
                  </select>                             </td>                                                           <td>Deliverability:</td>                             <td>                             
                  <select tabindex="9" name="deliverablity">      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND
                    </option>      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "D" || $deliverablity == ""){ echo "selected"; }?> value="D">D
                    </option>      											 
                  </select>                            </td>                            <td></td><td></td>                            
                <!--<td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>-->                            <td>FX_PAIR ID:</td><td>
                  <input name="fx_pair_id" readonly value="<?=$fx_pair_id;?>" type="text"></td>                        
              </tr>                                                 
              <tr>                        	<td></td><td></td>                        	<td></td><td></td>                            <td></td><td></td>                            <td>Matching Date:</td><td>
                  <input  class="all_dates" placeholder="dd/mm/yy" tabindex="17"  value="<?=$matching_date;?>" name="match_date" type="text"></td>							               <td>
                  <input type="submit" name="submit" value="Submit" style="display:none;"></td>                        
              </tr>
                                                                                                                                      
            </tbody>                
          </table>				
        </form>            
      </div>        
    </div>        
    <!--------------------------------------------------------------------------------------------------------------->         
    <!-- ***************************************************************  -->        
    <div class="row" id="FXNDF" style="display:<?=$contract_FXNDF;?>">        	
      <div class="col-xs-12" style="background-color:#eee;">			     
        <form id="FXNDF_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                          
          <input type="hidden" name="id_contract" value="<?=$id_contract;?>">                           	
          <table class="table" border="0">                	
            <tbody>                    	  
              <tr>                        	
                  <td>Client:</td>
                  <td>
                    <select class="client_select" name="client" tabindex="1"> 
                      <option <?php if(isset($client) && $client == ""){ echo "selected"; }?> value="">Select Client</option>                          
                      <?php
                      $sql2 = "select * from clients order by name";
                    	$result2 = $conn->query($sql2);
                              
                      while($fetch2 = $result2->fetch_array()) 
                      {
                      ?>    
                           <option <?php if(isset($client) && $client == $fetch2['id']){ echo "selected"; } ?> value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option> 
                      <?php
                      }                          
                      ?>                                             					
                    </select>
                  </td>                        	
                  <td>Rate:</td><td>
                  <input tabindex="6" id="fxsp_rate" class="fxndf_rate all_numbers_rate" type="text" name="rate" value="<?=$rate;?>" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>                            <td>Trade Date:</td><td>
                  <input class="all_dates" tabindex="11" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>                            <td>Expiry:</td><td>		                             
                  <select tabindex="16" name="expiry">								                             
                    <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N
                    </option> 						 												    
                    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y
                    </option>   												    
                  </select></td>                        
              </tr>   
              <tr>                        	
                  <td>Client Trader:</td>
                  <td colspan="7">
                      <select class="client_trader_change" name="client_trader" tabindex="1">
                             
                        <option value="">Client Trader</option> 
                                                   
                        <?php
                        if($client <> ""){
                        
                            $sql3 = "select * from client_trader where client_id=$client order by name";
                          	$result3 = $conn->query($sql3);
                                    
                            while($fetch3 = $result3->fetch_array()) 
                            {
                            ?>    
                                 <option <?php if(isset($client_trader) && $client_trader == $fetch3['id']){ echo "selected"; }?>  value="<?=$fetch3['id'];?>"><?=$fetch3['name'];?></option> 
                            <?php
                            }   
                        }                       
                        ?>      
                      
                      </select>
                  </td>                        	
                                   
              </tr>                                 
              <tr>                        	<td>CCY_pair:</td><td>
                  <select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">                            	           
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select></td>                        	   <td>Mid Price:</td><td>
                  <input tabindex="7" type="text" value="<?=$mid_price;?>" class="all_numbers" name="mid_price"></td>                            <td>Value Date:</td><td>
                  <input  class="fxndf_value_date" type="text" placeholder="dd/mm/yy" tabindex="12" name="value_date" value="<?=$value_date;?>"></td>                            <td>SPCUT:</td><td>                                  
                  <select tabindex="17" name="spcut">                                  
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB
                    </option>        										      
                    <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC
                    </option>
                  </select>                            </td>                        
              </tr>                                                                                                   
              <tr>                        	<td>Buy/Sell:</td><td>
                  <select tabindex="3" name="buy_sell">                                
                    <option value="" selected="selected">
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S
                    </option>
                  </select></td>                        	                            <td>Counter Amount:</td><td>
                  <input tabindex="8" value="<?=$counter_amt;?>" name="counter_amt" id="fxsp_camt"  class="fxndf_camt all_numbers" type="text"></td>                           
                  <td>Fixing&nbsp;Date: </td><td>
                  <input class="all_dates fxndf_fixing_date" placeholder="dd/mm/yy" tabindex="13" type="text" value="<?=$fixing_date;?>" name="fixing_date"></td>                                  <td>Cut Time:</td><td>                                      
                  <select tabindex="18" name="cut_time">                                          
                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00
                    </option>										                      
                    <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00
                    </option>                                      
                  </select>                                  </td>                        
              </tr>                                                                         
              <tr>                        	<td>Notional:</td><td>
                  <input tabindex="4" name="notional" value="<?=$Notional;?>" id="fxsp_not"  class="fxndf_not all_numbers"  type="text"></td>                        	<td>Calc:</td><td>                            
                  <select tabindex="9" name="calc">                              
                    <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply
                    </option>												      
                    <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide
                    </option>
                  </select>                                                         </td>                             <td>Traded As:</td><td>                                  
                  <select tabindex="14" name="traded_as">                                      
                    <option value="">
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FX" || $traded_as == ""){ echo "selected"; }?> value="FX" >FX
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE
                    </option>                                  
                  </select>                                  </td>                            <td>Settlement:</td><td>                              
                  <select tabindex="19" name="settlement">                                
                    <option value="">
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH
                    </option>
                  </select>                                                            </td>                        
              </tr>                                                                          
              <tr>                        	<td>Inverted&nbsp;Price:</td><td>
                  <select tabindex="5" name="inverted">                                                     
                    <option value="">
                    </option>												 
                    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I
                    </option>
                  </select></td>                        	                             <td>Deliverability:</td>                             <td>                             
                  <select tabindex="10" name="deliverablity">      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND
                    </option>      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D
                    </option>      											 
                  </select>                            </td>                            <td>Prime broker:</td><td>
                  <select tabindex="15" name="prime_broker">                                    
                    <option value="">...
                    </option>                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS" || $prime_broker == ""){ echo "selected"; }?> value="RBS">RBS
                    </option>                                    
                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST
                    </option>
                  </select></td>                                                                                              <td>FX_PAIR ID:</td><td>
                  <input name="fx_pair_id" readonly value="<?=$fx_pair_id;?>" type="text"></td>                        
              </tr>                        
              <tr>                        	  <td></td><td></td>                        	  <td></td><td></td>                            <td></td><td></td>						               	
                <!--<td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>-->                            <td>Matching Date:</td><td>
                  <input  class="all_dates" placeholder="dd/mm/yy" tabindex="20"  value="<?=$matching_date;?>" name="match_date" type="text"></td>							             <td>
                  <input type="submit" name="submit" value="Submit" style="display:none;"></td>                        
              </tr>                    
            </tbody>                
          </table>			
        </form>            
      </div>        
    </div>        
    <!--------------------------------------------------------------------------------------------------------------->         
    <!-- ***************************************************************  -->        
    <div class="row" id="FXOPT" style="display:<?=$contract_FXOPT;?>">        	
      <div class="col-xs-12" style="background-color:#eee;">				
        <form id="FXOPT_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                             
          <input type="hidden" name="id_contract" value="<?=$id_contract;?>">                           	
          <table class="table" border="0">                	
            <tbody>                    	
              <tr>                        	
                  <td>Client:</td>
                  <td>
                    <select class="client_select" name="client" tabindex="1"> 
                      <option <?php if(isset($client) && $client == ""){ echo "selected"; }?> value="">Select Client</option>                          
                      <?php
                      $sql2 = "select * from clients order by name";
                    	$result2 = $conn->query($sql2);
                              
                      while($fetch2 = $result2->fetch_array()) 
                      {
                      ?>    
                           <option <?php if(isset($client) && $client == $fetch2['id']){ echo "selected"; } ?> value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option> 
                      <?php
                      }                          
                      ?>                                             					
                    </select>
                  </td>                        	
                  <td></td><td></td>                            <td>Trade Date:</td><td>
                  <input tabindex="14"  class="all_dates" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>                            <td>Expiry:</td><td>		                             
                  <select tabindex="22" name="expiry">								                             
                    <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N
                    </option> 						 												    
                    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y
                    </option>   												    
                  </select></td>                        
              </tr>     
              <tr>                        	
                  <td>Client Trader:</td>
                  <td colspan="7">
                      <select class="client_trader_change" name="client_trader" tabindex="1">
                             
                        <option value="">Client Trader</option> 
                                                   
                        <?php
                        if($client <> ""){
                        
                            $sql3 = "select * from client_trader where client_id=$client order by name";
                          	$result3 = $conn->query($sql3);
                                    
                            while($fetch3 = $result3->fetch_array()) 
                            {
                            ?>    
                                 <option <?php if(isset($client_trader) && $client_trader == $fetch3['id']){ echo "selected"; }?>  value="<?=$fetch3['id'];?>"><?=$fetch3['name'];?></option> 
                            <?php
                            }   
                        }                       
                        ?>      
                      
                      </select>
                  </td>                 	
                                   
              </tr>                      
              <tr>                        	
              <td>CCY_pair:</td><td>
                  <select tabindex="2" name="ccy_pair" class="ccy_pair">                            	           
                    
                    <!--onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}"-->
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select></td>                        	  
                  <td>Mid Price:</td><td>
                  <input type="text"  tabindex="8" value="<?=$mid_price;?>" class="all_numbers" name="mid_price"></td>                            
                  <td>Value Date:</td><td>
                  <input type="text" class="all_dates" placeholder="dd/mm/yy" tabindex="15" name="value_date" value="<?=$value_date;?>"></td>                            <td>Cut Time:</td><td>                                
                  <select tabindex="23" name="cut_time">                                    
                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00
                    </option>							                      
                    <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00
                    </option>                                
                  </select>                            
                </td>                        
              </tr>                        
              <tr>                        	
                  <td>Buy/Sell:</td><td>
                  <select tabindex="3" name="buy_sell">                                
                    <option value="" selected="selected">
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S
                    </option>
                  </select>                          
                  </td>                        	                                                    	 
                  
                  
                  <td>Counter Amount:</td>
                  <td>                                
                      <input tabindex="6" value="<?=$counter_amt;?>" name="counter_amt" id="fxopt_camt"  class="fxopt_camt all_numbers" type="text">
                  </td> 
                  
                  <td>Traded As:</td><td>                                  
                  <select tabindex="16" name="traded_as">                                      
                    <option value="">
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FX" || $traded_as == ""){ echo "selected"; }?> value="FX" >FX
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE
                    </option>                                  
                  </select>                            </td>                            <td>Settlement:</td><td>                              
                  <select tabindex="24" name="settlement">                                
                    <option value="">
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH
                    </option>
                  </select>                           
                </td>                        
              </tr>                        
              <tr>                        	
                  <td></td><td></td>                        	
                  <td>Calc:</td>                          
                  <td>                              
                  <select tabindex="9" name="calc">                              
                    <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply
                    </option>												      
                    <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide
                    </option>
                  </select>                                                         
                  </td>                                                        
                  <td>Prime broker:</td><td>
                  <select tabindex="17" name="prime_broker">                              
                    <option value="">...
                    </option>                              
                    <!--<option value="CITI" >CITI</option>-->                              
                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS" || $prime_broker == ""){ echo "selected"; }?> value="RBS">RBS
                    </option>                              
                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST
                    </option>
                  </select></td>                                                           
                  <td>FX_PAIR ID:</td>
                  <td><input name="fx_pair_id" readonly value="<?=$fx_pair_id;?>" type="text"></td>                        
              </tr>                        
              <tr>                                                	
              <td>
                  <select style="display:none;" tabindex="5" name="inverted">                            
                    <option value="">
                    </option>												    
                    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I
                    </option>
                  </select></td>                                                     	
                  <td></td>                            
                  <td>Deliverability:</td>                             
                  <td>                             
                  <select tabindex="10" name="deliverablity">      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND
                    </option>      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "D" || $deliverablity == ""){ echo "selected"; }?> value="D">D
                    </option>      											 
                  </select>                            
                  </td>                            
                  <td>Order Entry time:</td><td>
                    <input tabindex="18" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>                           
                    <td>Matching Date:</td><td>
                    <input  class="all_dates" placeholder="dd/mm/yy" tabindex="25"  value="<?=$matching_date;?>" name="match_date" type="text">
                  </td>                        
              </tr>                        
              <tr><td></td><td></td><td></td><td></td><td></td><td></td>
              </tr>                                    						
              <tr>            							
                  <td>Expiry:</td><td>
                  <input type="text" tabindex="4" class="all_dates expiry_date_opt" name="expiry_date" value="<?=$expiry_date;?>"></td>            							
                  
                  <td>Cut:</td>
                  <td>
                          <select tabindex="16" name="spcut">
                          <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
  									      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
  									      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
  									      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                  </td>
                                							
                  <td>Premium CCY:</td>
                  
                  <td>
                  
                        <!--<input type="text" value="<?=$premium_ccy;?>" name="premium_ccy" id="fxopt_premccy">-->
                        <select id="fxopt_premccy" name="premium_ccy"> 									
                          <option value="">
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "AUD"){ echo "selected"; }?> value="AUD">AUD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "BRL"){ echo "selected"; }?> value="BRL">BRL
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "CAD"){ echo "selected"; }?> value="CAD">CAD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "CHF"){ echo "selected"; }?> value="CHF">CHF
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "CNH"){ echo "selected"; }?> value="CNH">CNH
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "DKK"){ echo "selected"; }?> value="DKK">DKK
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "EUR"){ echo "selected"; }?> value="EUR">EUR
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "GBP"){ echo "selected"; }?> value="GBP">GBP
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "HKD"){ echo "selected"; }?> value="HKD">HKD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "HUF"){ echo "selected"; }?> value="HUF">HUF
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "INR"){ echo "selected"; }?> value="INR">INR
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "JPY"){ echo "selected"; }?> value="JPY">JPY
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "MXN"){ echo "selected"; }?> value="MXN">MXN
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "NOK"){ echo "selected"; }?> value="NOK">NOK
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "NZD"){ echo "selected"; }?> value="NZD">NZD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "SEK"){ echo "selected"; }?> value="SEK">SEK
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "SGD"){ echo "selected"; }?> value="SGD">SGD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "TRY"){ echo "selected"; }?> value="TRY">TRY
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "USD"){ echo "selected"; }?> value="USD">USD
                          </option>
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "ZAR"){ echo "selected"; }?> value="ZAR">ZAR
                          </option>	
                          <option <?php if(isset($premium_ccy) && $premium_ccy == "XAU"){ echo "selected"; }?> value="XAU">XAU
                          </option>											
                        </select>
                  
                  </td>  
                  
                  
                  
                            							
                  
                  <td></td><td></td>            						
              </tr>                        
              <tr>                        	  
                  <td>Delivery:</td><td>
                  <input  class="all_dates notional_sprelast settle_date_class" tabindex="5" type="text" value="<?=$settle_date;?>" name="settle_date"></td>                            <td>Notional:</td><td>
                  <input type="text" name="notional" tabindex="11" class="notional_slast all_numbers" value="<?=$Notional;?>" id="fxopt_not"></td>                            
                  <td>Payout CCY:</td><td>
                  <input type="text" value="<?=$payout_ccy;?>" tabindex="19" name="payout_ccy" class="all_numbers" id="fxopt_payout"></td>                            
                  <td></td><td></td>                        
              </tr>                        
              <tr>                        	
                  <td>Call/Put:</td><td>                          
                  <select name="spcut_cp" tabindex="6">                               
                    <option <?php if(isset($spcut_cp) && $spcut_cp == "C"){ echo "selected"; }?> value="C">C
                    </option>          										 
                    <option <?php if(isset($spcut_cp) && $spcut_cp == "P"){ echo "selected"; }?> value="P">P
                    </option>                               
                    <!--
									 <option <?php if(isset($spcut_cp) && $spcut_cp == "ECB"){ echo "selected"; }?> value="ECB">ECB</option>
									 <option <?php if(isset($spcut_cp) && $spcut_cp == "WMC"){ echo "selected"; }?> value="WMC">WMC</option>
                   -->                            
                  </select></td>                                                            
                  <td style="color:#BF3739;">PRICE %:</td><td>
                  <input type="text" class="all_numbers" tabindex="12"  name="price_percentage" value="<?=$price_percentage;?>" id="fxopt_price" ></td>       
                  <td>Option Style:</td><td>                                  
                  <select name="option_style" tabindex="20">                                  
                    <option <?php if(isset($option_style) && $option_style == "American"){ echo "selected"; }?> >American
                    </option>                                  
                    <option <?php if(isset($option_style) && ($option_style == "European" || $option_style == "")){ echo "selected"; }?> >European
                    </option>
                  </select>                            
                  </td>                            
                  <td></td>                            
                  <td></td>                        
              </tr>                        
              <tr>                          	
                <td>Strike:</td><td>
                  <input type="text" value="<?=$strike;?>" tabindex="7" class="strike_slast all_numbers"  name="strike"></td>                            
                <td style="color:#BF3739;">Premium amount:</td><td>
                  <input name="premium_amount" value="<?=$premium_amount;?>" tabindex="13" class="all_numbers" type="text" id="fxopt_premamt"></td>                            
                  <td>Calculations:</td><td>                                          
                  <select name="calculations" tabindex="21">                							              
                    <option <?php if(isset($calculations) && $calculations == "Reset"){ echo "selected"; }?> >Reset
                    </option>                                            
                    <option <?php if(isset($calculations) && $calculations == "Base Cash"){ echo "selected"; }?> >Base Cash
                    </option>                                            
                    <option <?php if(isset($calculations) && $calculations == "Counter Cash"){ echo "selected"; }?> >Counter Cash
                    </option>                                            
                    <option <?php if(isset($calculations) && $calculations == "Base %"){ echo "selected"; }?> >Base %
                    </option>                                            
                    <option <?php if(isset($calculations) && $calculations == "Counter %"){ echo "selected"; }?> >Counter %
                    </option>                                                                                     						
                  </select></td>                            <td></td>                            <td></td>                        
              </tr>                    
            </tbody>                
          </table>				
        </form>            
      </div>        
    </div>        
    <!--------------------------------------------------------------------------------------------------------------->         
    <!-- ***************************************************************  -->        
    <div class="row" id="EOPT" style="display:<?=$contract_EOPT;?>">        	
      <div class="col-xs-12" style="background-color:#eee;">				
        <form id="EOPT_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">            	
          <input type="hidden" name="id_contract" value="<?=$id_contract;?>">                           	
          <table class="table" border="0">                	
            <tbody>                    	
              <tr>                        	
              
                  <td>Client:</td><td>
                        <select class="client_select" name="client" tabindex="1"> 
                          <option <?php if(isset($client) && $client == ""){ echo "selected"; }?> value="">Select Client</option>                          
                          <?php
                          $sql2 = "select * from clients order by name";
                        	$result2 = $conn->query($sql2);
                                  
                          while($fetch2 = $result2->fetch_array()) 
                          {
                          ?>    
                               <option <?php if(isset($client) && $client == $fetch2['id']){ echo "selected"; } ?> value="<?=$fetch2['id'];?>"><?=$fetch2['name'];?></option> 
                          <?php
                          }                          
                          ?>                                             					
                        </select>
                  </td>                        	
                  <td></td><td></td>                            
                  <td>Trade Date:</td><td>
                  <input  class="all_dates" tabindex="21" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>                            <td>Expiry:</td><td>		                             
                  <select tabindex="32" name="expiry">								                             
                    <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N
                    </option> 						 												    
                    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y
                    </option>   												    
                  </select>
                  </td>                        
              </tr>     
              <tr>                        	
                  <td>Client Trader:</td>
                  <td colspan="7">
                      <select class="client_trader_change" name="client_trader" tabindex="1">
                             
                        <option value="">Client Trader</option> 
                                                   
                        <?php
                        if($client <> ""){
                        
                            $sql3 = "select * from client_trader where client_id=$client order by name";
                          	$result3 = $conn->query($sql3);
                                    
                            while($fetch3 = $result3->fetch_array()) 
                            {
                            ?>    
                                 <option <?php if(isset($client_trader) && $client_trader == $fetch3['id']){ echo "selected"; }?>  value="<?=$fetch3['id'];?>"><?=$fetch3['name'];?></option> 
                            <?php
                            }   
                        }                       
                        ?>      
                      
                      </select>
                  </td>                        	
                                   
              </tr>                       
              <tr>                        	
                  <td>CCY_pair:</td><td>
                  <select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">                            	           
                    <option value="">
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR
                    </option>                                         
                    <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD
                    </option>                            
                  </select></td>                        	  
                  <td>Mid Price:</td><td>
                  <input type="text" tabindex="12" value="<?=$mid_price;?>" class="all_numbers" name="mid_price"></td>                            
                  <td>Value Date:</td><td>
                  <input  class="all_dates" tabindex="22" type="text" placeholder="dd/mm/yy" tabindex="11"  name="value_date" value="<?=$value_date;?>"></td>                            <td>Cut Time:</td><td>                                
                  <select tabindex="33" name="cut_time">                                    
                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00
                    </option>							                      
                    <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00
                    </option>                                
                  </select>                            </td>                        
              </tr>                        
              <tr>                        	
                  <td>Buy/Sell:</td><td>
                  <select tabindex="3" name="buy_sell">                                
                    <option value="" selected="selected" >
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B
                    </option>                                
                    <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S
                    </option>
                  </select>                          </td>                        	                                                    	 <td></td><td></td>                            <td>Traded As:</td><td>                                  
                  <select tabindex="23" name="traded_as" >                                      
                    <option value="">
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FX"){ echo "selected"; }?> value="FX" >FX
                    </option>                                      
                    <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE
                    </option>                                  
                  </select>                            </td>                            <td>Settlement:</td><td>                              
                  <select tabindex="34" name="settlement">                                
                    <option value="">
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL
                    </option>              								 
                    <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH
                    </option>
                  </select>                            </td>                        
              </tr>                        
              <tr>                        	
                  <td></td><td></td>                        	
                  <td>Calc:</td>                          <td>                              
                  <select tabindex="13" name="calc">                              
                    <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply
                    </option>												      
                    <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide
                    </option>
                  </select>                                                         </td>                                                        
                  <td>Prime broker:</td><td>
                  <select tabindex="24" name="prime_broker">                              
                    <option value="">...
                    </option>                              
                    <!--<option value="CITI" >CITI</option>-->                              
                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS
                    </option>                              
                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST
                    </option>
                  </select></td>                                                           
                  <td>FX_PAIR ID:</td><td>
                  <input name="fx_pair_id" readonly value="<?=$fx_pair_id;?>" type="text"></td>                        
              </tr>                        
              <tr>                                                	
              <td>
                  <select style="display:none;" name="inverted">                            
                    <option value="">
                    </option>												    
                    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I
                    </option>
                  </select></td>                                                     	
                  <td></td>                            
                  <td>Deliverability:</td>                             <td>                             
                  <select tabindex="14" name="deliverablity">      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND
                    </option>      												
                    <option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D
                    </option>      											 
                  </select>                            </td>                            
                  <td>Order Entry time:</td><td>
                  <input tabindex="25" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>                            
                  <td>Matching Date:</td><td>
                  <input  class="all_dates" placeholder="dd/mm/yy" tabindex="35"  value="<?=$matching_date;?>" name="match_date" type="text"></td>                        
              </tr>                        
              <tr><td></td><td></td><td></td><td></td><td></td><td></td>
              </tr>                                    						
              <tr>            							
                  <td>Expiry:</td><td>
                  <input type="text"  tabindex="4" class="all_dates" name="expiry_date" value="<?=$expiry_date;?>" onchange=" var nd =  $('#fxopt_exp').val().split('/'); var nd = new Date(nd[2] + '/'+nd[1]+'/'+nd[0]);nd.setDate(nd.getDate()+2); $('#fxopt_st').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>            							
                    <!--
                    <td>Cut:</td>
                    <td>
                            <select tabindex="16" name="spcut">
                            <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
  										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
  										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
  										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                    </td>
                    
      							<td>Premium CCY:</td><td><input type="text" value="<?=$premium_ccy;?>" name="premium_ccy" id="fxopt_premccy"></td>
                    -->            							
                    <td></td><td></td>            						
              </tr>                        
              <tr>                        	  
                  <td>Settelment:</td><td>
                  <input tabindex="5" class="all_dates notional_prelast" type="text" value="<?=$settle_date;?>" name="settle_date"></td>                            
                  <td>Notional:</td><td>
                  <input type="text" name="notional" tabindex="15" class="notional_last all_numbers"  value="<?=$Notional;?>" id="eopt_not"></td>                            
                  <td>Payout CCY:</td><td>
                  <input type="text" value="<?=$payout_ccy;?>" tabindex="26" name="payout_ccy" class="all_numbers" id="fxopt_payout"></td>                            
                  <td></td><td></td>                        
              </tr>                        
              <tr>                        	
                  <td>Call/Put:</td><td>                          
                  <select name="spcut_cp" tabindex="6">                               
                    <option <?php if(isset($spcut_cp) && $spcut_cp == "Call"){ echo "selected"; }?> value="Call">Call
                    </option>          										 
                    <option <?php if(isset($spcut_cp) && $spcut_cp == "Put"){ echo "selected"; }?> value="Put">Put
                    </option>                               
                    <!--
										 <option <?php if(isset($spcut_cp) && $spcut_cp == "ECB"){ echo "selected"; }?> value="ECB">ECB</option>
										 <option <?php if(isset($spcut_cp) && $spcut_cp == "WMC"){ echo "selected"; }?> value="WMC">WMC</option>
                     -->                            
                  </select></td>                                                              
                  <td style="color:#BF3739;">PRICE %:</td><td>
                  <input type="text" tabindex="16" name="price_percentage" class="all_numbers" value="<?=$price_percentage;?>" id="eopt_price" ></td>                              
                  <td>Option Style:</td><td>                                  
                  <select name="option_style" tabindex="27">                                  
                    <option <?php if(isset($option_style) && $option_style == "American"){ echo "selected"; }?> >American
                    </option>                                  
                    <option <?php if(isset($option_style) && ($option_style == "European" || $option_style == "")){ echo "selected"; }?> >European
                    </option>
                  </select>                            
                  </td>                            <td></td>                            <td></td>                        
              </tr>                        
              <tr>                        	  
                  <td>Strike:</td><td>
                      <input type="text" tabindex="7" value="<?=$strike;?>" class="strike_last all_numbers" name="strike"></td>                            
                  <td style="color:#BF3739;">Premium amount:</td><td>
                      <input name="premium_amount" tabindex="17" value="<?=$premium_amount;?>" class="all_numbers" type="text" id="eopt_premamt"></td>                            
                  <td>Calculations:</td>
                  <td>                                          
                      <select name="calculations" tabindex="28">                							              
                        <option <?php if(isset($calculations) && $calculations == "Reset"){ echo "selected"; }?> >Reset
                        </option>                                            
                        <option <?php if(isset($calculations) && $calculations == "Base Cash"){ echo "selected"; }?> >Base Cash
                        </option>                                            
                        <option <?php if(isset($calculations) && $calculations == "Counter Cash"){ echo "selected"; }?> >Counter Cash
                        </option>                                            
                        <option <?php if(isset($calculations) && $calculations == "Base %"){ echo "selected"; }?> >Base %
                        </option>                                            
                        <option <?php if(isset($calculations) && $calculations == "Counter %"){ echo "selected"; }?> >Counter %
                        </option>                                                                                     						
                      </select>
                  </td>                            
                  <td></td> <td></td>                        
              </tr>                                                 
              <tr style="margin-top:15px;">                        	   
                  <td>Option Type:</td><td>
                  <input value="<?=$opt_type;?>" tabindex="8" name="opt_type" type="text"></td>                            
                  <td>Lower_Barrier:</td><td>
                  <input value="<?=$lower_barrier;?>" tabindex="18" name="lower_barrier" type="text"></td>                            
                  <td>Cash At:</td>                            
                  <td>                                  
                  <select name="cashat" tabindex="29">                                        
                    <option <?php if(isset($cashat) && $cashat == "Counter %"){ echo "selected"; }?>  value="Maturity">Maturity
                    </option>                                  
                  </select>                            
                  </td>                            
                  <td>Upper&nbsp;Barrier:</td>                            
                  <td>
                  <input name="up_barrier_sd" class="all_dates" tabindex="36" value="<?=$up_barrier_sd;?>"  type="text" placeholder="start date">
                  <br>                                
                  <input name="up_barrier_ed" class="all_dates" tabindex="37" value="<?=$up_barrier_ed;?>"  type="text" placeholder="end date"></td>                        
              </tr>                        
              <tr>                        	
                  <td>Barrier&nbsp;Type:</td><td>
                  <input value="<?=$barrier_type;?>"  tabindex="9" name="barrier_type" type="text"></td>                            
                  <td>Knock&ndash;in&ndash;out(I/O):</td><td>
                  <input  value="<?=$knock_in_out;?>" name="knock_in_out" tabindex="19" type="text"></td>                            
                  <td>Rebate_CCY:</td><td>
                  <input type="text" value="<?=$rebate_ccy;?>" class="all_numbers" tabindex="30" name="rebate_ccy"></td>                            
                  <td>Lower&nbsp;Barrier:</td>                            <td>
                  <input type="text"  class="all_dates" value="<?=$lw_barrier_sd;?>" tabindex="38" name="lw_barrier_sd" placeholder="start date">
                  <br>                                
                  <input type="text" placeholder="end date"  class="all_dates" value="<?=$lw_barrier_ed;?>" tabindex="39" name="lw_barrier_ed"></td>                        
              </tr>                        
              <tr>                        	  
                  <td>Upper Barrier:</td><td>
                  <input  value="<?=$up_barrier;?>" name="up_barrier" tabindex="10" type="text"></td>                            
                  <td>Touch&ndash;up&ndash;down:</td><td>
                  <input type="text"  value="<?=$touch_up_down;?>" tabindex="20" name="touch_up_down"></td>                            
                  <td>Rebate&nbsp;Amount:</td><td>
                  <input type="text" value="<?=$rebate_amt;?>" class="all_numbers" tabindex="31" name="rebate_amt"></td>                            
                  <td>Barrier&nbsp;Style:</td>                            
                  <td>                                
                  <select name="barrier_style" tabindex="40">                                    
                    <option <?php if(isset($barrier_style) && $barrier_style == "Counter %"){ echo "selected"; }?>>American
                    </option>                                
                  </select>                            
                  </td>                        
              </tr>                                                 
              <tr>                        
                  	<td>Middle Barrier:</td><td><input tabindex="11" name="mid_barrier" value="<?=$mid_barrier;?>"  type="text"></td>                        
              </tr>                    
            </tbody>                
          </table>				
        </form>            
      </div>        
    </div>        
    <!--------------------------------------------------------------------------------------------------------------->             
  </div>   
  <div class="row" style="margin-top:10px;">
    <style>
    input[type="button"]{margin-right:15px;}
    .data_saved{
        width: 400px;
        float: right;
        display: inline;
        padding: 5px;
        margin-bottom: 0px;
    }
    </style>    
    
    <!--<div class="btn-group" data-toggle="buttons">-->	
    <input type="button" class="btn btn-primary btn-sm" value="Save &amp; Copy" onclick="save_copy();">        
    <input type="button" class="btn btn-primary btn-sm" value="Save &amp; New" onclick="save_new();">        
    <input type="button" class="btn btn-primary btn-sm" value="Save &amp; Close" onclick="save_close();">        
    
    
    <?php
    $two_button = "display:none;";        
    if($id_contract <> ""){           
          $two_button = "";    
    }
    ?>
    
    <input type="button" style="<?=$two_button;?>" class="btn btn-success btn-sm delete_button" value="Delete">
    <input type="button" style="<?=$two_button;?>" class="btn btn-success btn-sm amend_button" value="Amend & Close">  
    
    
    <input type="button" class="btn btn-danger btn-sm close_button" value="Cancel">
    
    <div class="alert alert-success data_saved" id="success-alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong class="data_saved_text"></strong>    
    </div>
                           
    <input type="hidden" name="pb_email" id="pb_email_sent" value="<?=$pb_email_sent;?>">
    <input type="hidden" name="client_email" id="client_email_sent" value="<?=$client_email_sent;?>">
     
    <!--</div>-->
      
  </div>	
</div>                  	
<script>
     
      
	   $(document).ready(function(){  
     
          $( ".form_drag" ).draggable(); 
          
          $(':input').bind('keypress', function(eInner) {
          
              if(eInner.keyCode == 13) //if its a enter key
              {                                               
                  var tabindex = $(this).attr('tabindex');                    
                  tabindex++; //increment tabindex                       
                  var myform = $("#contract").val() + "_form";                                      
                  $('[tabindex=' + tabindex + ']').focus();       
                  return false;                         
              }
    	    
          });                                                                                                
          
          $('.close_button').on('click', function() {
              
              $('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').remove();                
              window.clearInterval(timeupdate);                         
              //$('#back').innerHTML("");
              $('#back').html("");
              $('#back').hide();
              $('#container').remove(); 
              
          });
          
          
          $('.delete_button').on('click', function() {
                  perform_anony("delete"); 
          });
          
          $('.amend_button').on('click', function() {          
                  perform_anony("amend"); 
          });
          
          function perform_anony(pa){             
                  
                  var myform = $("#contract").val() + "_form"; 
                  var real_val = $("#" + myform).find("input[name=id_contract]").val(); 
                  
                  var pb_email_sent = $("#pb_email_sent").val();
                  var client_email_sent = $("#client_email_sent").val();
                                    
                  $.ajax({
                          url: 'process_anony.php?id_contract=' + real_val +'&what_anony=' + pa + '&pb_email_sent=' + pb_email_sent + '&client_email_sent=' + client_email_sent,
                          dataType: 'json',
                          success: function(s){                          
                              
                              if(s == "ok"){
                                
                                /*
                                //alert('Information Updated');
                                $(".data_saved_text").html("Information Updated.");
                                $(".data_saved").show();
                                $(".data_saved").fadeTo(2000, 500).hide(500, function(){
                                    //$(".data_saved").alert('close');
                                });
                                */
                                
                                //alert(real_val);
                                
                                if(pa == "amend"){ 
                                          window.parent.getrecord_max();
                    
                                          $('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); 
                                          $('#container2').hide(); 
                                          $('#back').hide();
                                					window.clearInterval(timeupdate);
                                					getrecord();
                                                           
                                          window.self.close();
                                					$("#back").html("");  
                                }else{
                                
                                            $(".data_saved_text").html("Information Updated.");
                                            $(".data_saved").show();
                                            $(".data_saved").fadeTo(2000, 500).hide(500, function(){
                                                //$(".data_saved").alert('close');
                                            });
                                
                                }
                                
                                
                                
                                
                              }else{
                                //alert('Error, please try again!');
                              }
                                            
                          }, 
                          error: function(e){ //console.log(e.responseText); 
                            //alert(e);
                            alert('Error, please try again!');
                          } 
                    });   
          
          }
          
          
          
          $('.client_select').on('change', function() {
          
          
                var myform = $("#contract").val() + "_form";
                var client_val = $("#" + myform).find("select[name=client]").val(); 
                
                if(client_val == ""){
                
                      $("#" + myform).find("select[name=client_trader]")
                                  .empty()
                                  .append('<option value="">Client Trader</option>');
                
                }else{
                      
                      
                      $.ajax({
                            url: 'process/get_client_trader.php?id_client=' + client_val,
                            dataType: 'json',
                            success: function(s){                          
                                  
                                  $("#" + myform).find("select[name=client_trader]")
                                          .empty()
                                          .append(s);
                                              
                            }, 
                            error: function(e){ //console.log(e.responseText); 
                              //alert(e.responseText);
                              alert('Error, please try again!');
                            } 
                      });   
                      
                }
                                                            
          });
          
          
          //$('.client_trader_change').on('change', function() {           
                /*
                var myform = $("#contract").val() + "_form";
                var client_val = $("#" + myform).find("select[name=client]").val(); 
                alert();
                */                                          
          //});
          
          
            
          $('.ccy_pair').on('change', function() {
               
               $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); 
               $('#fxsp_oet').val($('#gmtime').html());
                
               var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); 
               
               $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); 
               
               
               // Change FXOPT Premium CCY and Payout CCY
                var myform_only = $("#contract").val();
                var myform = $("#contract").val() + "_form"; 
                
                if(myform_only == "FXOPT"){
                      
                    var mthis_val = $("#" + myform).find("select[name=ccy_pair]").val(); 
                    var mthis_curr = mthis_val.slice(0,3);                          
                    
                    $("#" + myform).find("select[name=premium_ccy]").val(mthis_curr);
                    $("#" + myform).find("input[name=payout_ccy]").val(mthis_curr);
                    
                }
               
               //
              
               if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY' || $(this).val()== 'USDTRY' || $(this).val()== 'USDCAD'){ 
                    //<?=$value_date_1;?>  
                    //nd.setDate(<?=$value_date_1;?>);
                    //$('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));
                    var phpDate1 = "<?php echo $value_date_1; ?>";
                    
                    $("#fxsp_vd").datepicker("setDate",phpDate1);
                    $('#fxsp_vd').css("background-color", "#FFC0CB");
                    
                                                                          
               }else{ 
               
                    var phpDate2 = "<?php echo $value_date_2; ?>";
                    
                    //nd.setDate(<?=$value_date_2;?>); 
                    //$('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));
                    $("#fxsp_vd").datepicker("setDate",phpDate2);
                    $('#fxsp_vd').css("background-color", "#FFF");
                    
               }
               
               
               
              
              //var client_val = $("#" + myform).find("select[name=client]").val(); 
                
               /** COVERT BASE : START **/
               
               call_convert_base_ccyrate();
               
               /** COVERT BASE : END **/
               
          });  
          
          
          $(document).on("change", ".pnl_rate", function (){
                    call_convert_base();
          });   
          
          
           
           
           
          
          $(document).on("change, keyup, blur", ".strike_slast, .notional_slast, .fxopt_camt", call_sum_function);
          
          function call_sum_function(){
              
              strike_amt_val =  $(".strike_slast").val();
              notional_amt_val = $(".notional_slast").val();
              
              strike_amt = numberWithoutCommas(strike_amt_val);
              notional_amt = numberWithoutCommas(notional_amt_val);
              total_strike_notional = "";
              
              if(strike_amt > 0 && notional_amt > 0){
                        
                  total_strike_notional =  (strike_amt * notional_amt).toFixed(2);
                  total_strike_notional = total_strike_notional.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
              
              }
              
              
              $(".fxopt_camt").val(total_strike_notional); 
              
          }  
          
                    
          $(document).on("change, keyup, blur", ".fxsp_not", call_convert_base);             
          $(document).on("change, keyup, blur", ".fxsp_rate", call_convert_base);
          $(document).on("change, keyup, blur", ".fxsp_camt", call_convert_base);
          
          function call_convert_base(){
               
               $(".rate_date").html("");
               
               var myform = $("#contract").val() + "_form";
               var this_val = $("#" + myform).find("select[name=ccy_pair]").val(); 
               var this_curr = this_val.slice(3,6);                 
               
               var main_curr = "";
               var opp_curr = "";
               
               var rate_amt_o = $("#" + myform).find("input[name=pnl_rate]").val();
               var notional_o = $("#" + myform).find("input[name=counter_amt]").val();
               
               var rate_amt = numberWithoutCommas(rate_amt_o);
               
               var notional = 0;
               
               var new_notional_amount = 0;
               
               if(notional_o != ""){
                  
                   notional = numberWithoutCommas(notional_o);
                  
                   //alert(notional_o + " " + notional);
               }
                              
               if(rate_amt == "" && notional > 0){
                             
                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");
                                
               } else {
               
                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");
               }        
             
                 
               if(this_curr == "USD"){
                    
                    main_curr = "";
                    $("#" + myform).find("select[name=pnl_ccy_pair]").val(this_val);
                    
                    $("#" + myform).find("input[name=pnl_rate]").val(1);   
                    //alert("f1");
                    notional_s = notional.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
                    
                    if(numberWithoutCommas(notional_s) > 0){
                          $("#" + myform).find("input[name=pnl_counter_amt]").val(notional_s);
                    }
                    
               }else{
                    
                    main_curr = this_curr+"USD";
                    opp_curr = "USD"+this_curr;
                    
                    $("#" + myform).find("select[name=pnl_ccy_pair]").val(main_curr);
                    
                    var my_pnl_ccy_val = $("#" + myform).find("select[name=pnl_ccy_pair]").val();
                     
                    if(my_pnl_ccy_val == "" || my_pnl_ccy_val == null){                              
                                        
                                  $("#" + myform).find("select[name=pnl_ccy_pair]").val(opp_curr);
                                  //alert("f2");
                                  // CHNAGE RATE IF CURRENCY ARE SAME
                                  if(opp_curr == this_val){                                          
                                            //alert("change Calc 1");
                                            rate_amt = $("#" + myform).find("input[name=rate]").val();                                            
                                            rate_amt = numberWithoutCommas(rate_amt);
                                            
                                            var pnl_rate_amt = $("#" + myform).find("input[name=pnl_rate]").val();
                                            
                                            if(pnl_rate_amt == "" && rate_amt != ""){   
                                                 
                                                
                                                $("#" + myform).find("input[name=pnl_rate]").val(rate_amt);
                                            }
                                  }
                                                                                                     
                                  if(notional > 0 && rate_amt > 0){
                                     //alert("right");                                      
                                     new_notional_amount = parseFloat(notional / rate_amt).toFixed(2);
                                                                  
                                  } 
                                                                    
                                  var pnl_rate = $("#" + myform).find("input[name=pnl_rate]").val();
                                  var pnl_counter_amt = $("#" + myform).find("input[name=pnl_counter_amt]").val();
                                  var pnl_ccy_pair = $("#" + myform).find("select[name=pnl_ccy_pair]").val();    
                  
                                  
                                  if(pnl_ccy_pair == ""){
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFC0CB");                         
                                  } else {                     
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFF");                  
                                  }
                                  
                                  if(pnl_rate == ""){
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");                          
                                  }else {                     
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");                       
                                  }
                                  
                                  if (pnl_counter_amt == ""){
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFC0CB");  
                                  } else {
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFF");                  
                                  }  
                                  
                                  if(new_notional_amount > 0){
                    
                                        new_notional_amount_s = new_notional_amount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");                              
                                        $("#" + myform).find("input[name=pnl_counter_amt]").val(new_notional_amount_s);
                                  }
                                  
                         
                    } else{  
                                  
                                  //alert("f3");
                                  // CHNAGE RATE IF CURRENCY ARE SAME
                                  if(my_pnl_ccy_val == this_val){                                         
                                            //alert("change Calc 2");
                                            rate_amt = $("#" + myform).find("input[name=rate]").val();                                            
                                            rate_amt = numberWithoutCommas(rate_amt);
                                            
                                            var pnl_rate_amt = $("#" + myform).find("input[name=pnl_rate]").val();
                                            
                                            if(pnl_rate_amt == "" && rate_amt != ""){  
                                                $("#" + myform).find("input[name=pnl_rate]").val(rate_amt);
                                            }
                                  }
                                                      
                                  if(notional > 0 && rate_amt > 0){
                                     new_notional_amount = parseFloat(notional * rate_amt).toFixed(2);
                                  } 
                                  
                                                                    
                                  if(new_notional_amount > 0){                         
                                        new_notional_amount_s = new_notional_amount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");                              
                                        $("#" + myform).find("input[name=pnl_counter_amt]").val(new_notional_amount_s);
                                  }
                                  
                                  var pnl_rate = $("#" + myform).find("input[name=pnl_rate]").val();
                                  var pnl_counter_amt = $("#" + myform).find("input[name=pnl_counter_amt]").val();
                                  var pnl_ccy_pair = $("#" + myform).find("select[name=pnl_ccy_pair]").val();    
                  
                                  
                                  if(pnl_ccy_pair == ""){
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFC0CB");                         
                                  } else {                     
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFF");                  
                                  }
                                  
                                  if(pnl_rate == ""){
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");                          
                                  }else {                     
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");                       
                                  }
                                  
                                  if (pnl_counter_amt == ""){
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFC0CB");  
                                  } else {
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFF");                  
                                  }   
                                  
                    }             
                    
                  }
          
          } 
          
          
          
          function call_convert_base_ccyrate(){
               
               $(".rate_date").html("");
               $(".rate_date").removeClass("text_red"); 
               
               var myform = $("#contract").val() + "_form";
               var this_val = $("#" + myform).find("select[name=ccy_pair]").val(); 
               var this_curr = this_val.slice(3,6);
               
               var main_curr = "";
               var opp_curr = "";
               
               var rate_amt_o = $("#" + myform).find("input[name=pnl_rate]").val();
               var notional_o = $("#" + myform).find("input[name=counter_amt]").val();
               
               var rate_amt = numberWithoutCommas(rate_amt_o);
               
               var notional = 0;
               
               var new_notional_amount = 0;
               
               if(notional_o != ""){
                  
                   notional = numberWithoutCommas(notional_o);
                  
                   //alert(notional_o + " " + notional);
               }
                              
               if(rate_amt == "" && notional > 0){
                             
                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");
                                
               } else {
               
                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");
               }        
                      
              
                 
               if(this_curr == "USD"){
                    //alert("f4");
                    main_curr = "";
                    $("#" + myform).find("select[name=pnl_ccy_pair]").val(this_val);
                    
                    $("#" + myform).find("input[name=pnl_rate]").val(1);   
                    
                    notional_s = notional.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
                    //alert("USD" + notional_s);
                    
                    //rate_amt = numberWithoutCommas(rate_amt);
                    if(numberWithoutCommas(notional_s) > 0){
                          $("#" + myform).find("input[name=pnl_counter_amt]").val(notional_s);
                    }
                    
               }else{
                    
                    main_curr = this_curr+"USD";
                    opp_curr = "USD"+this_curr;
                    
                    $("#" + myform).find("select[name=pnl_ccy_pair]").val(main_curr);
                    
                    var my_pnl_ccy_val = $("#" + myform).find("select[name=pnl_ccy_pair]").val();
                    
                    
                     
                    if(my_pnl_ccy_val == "" || my_pnl_ccy_val == null){                              
                                      
                          $("#" + myform).find("select[name=pnl_ccy_pair]").val(opp_curr);
                                                    
                          $.ajax({
                  
                              url: 'process/get_ccyrate.php?ccypair=' + opp_curr,
                              dataType: 'json',
                              success: function(s){ 
                              
                                  //s[i][1], s[i][10]
                                 
                                  var rt = s[0][0]; 
                                  //alert(my_pnl_ccy_val + "==" + this_val);
                                  //alert("f5");   
                                  if(rt > 0 && rt != null) {
                            
                                        $("#" + myform).find("input[name=pnl_rate]").val(rt);                                  
                                        $(".rate_date").html( "Updated on : " + s[0][1]); 
                                        
                                        $(".rate_date").addClass(s[0][2]);      
                                                                                
                                        var rate_amt = numberWithoutCommas(rt);
                                                                      
                                  }else{
                                  
                                        $("#" + myform).find("input[name=pnl_rate]").val("");
                                        var rate_amt = 0;
                                  }
                                  
                                  
                                  // CHNAGE RATE IF CURRENCY ARE SAME
                                  if(opp_curr == this_val){                                         
                                            //alert("change Calc 3");
                                            rate_amt = $("#" + myform).find("input[name=rate]").val();                                            
                                            rate_amt = numberWithoutCommas(rate_amt);
                                            
                                            var pnl_rate_amt = $("#" + myform).find("input[name=pnl_rate]").val();
                                            
                                            if(pnl_rate_amt == "" && rate_amt != ""){  
                                                $("#" + myform).find("input[name=pnl_rate]").val(rate_amt);
                                            }
                                            
                                  }
                                  
                                  if(notional > 0 && rate_amt > 0){
                                     
                                     new_notional_amount = parseFloat(notional / rate_amt).toFixed(2);
                                                                  
                                  } 
                                  
                                  var pnl_rate = $("#" + myform).find("input[name=pnl_rate]").val();
                                  var pnl_counter_amt = $("#" + myform).find("input[name=pnl_counter_amt]").val();
                                  var pnl_ccy_pair = $("#" + myform).find("select[name=pnl_ccy_pair]").val();    
                  
                                  
                                  if(pnl_ccy_pair == ""){
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFC0CB");                         
                                  } else {                     
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFF");                  
                                  }
                                  
                                  if(pnl_rate == ""){
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");                          
                                  }else {                     
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");                       
                                  }
                                  
                                  if (pnl_counter_amt == ""){
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFC0CB");  
                                  } else {
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFF");                  
                                  }    
                                  
                                  
                                  if(new_notional_amount > 0){
                    
                                        new_notional_amount_s = new_notional_amount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");                              
                                        $("#" + myform).find("input[name=pnl_counter_amt]").val(new_notional_amount_s);
                                  }
                                  
                                  
                              
                              }, 
                              error: function(e){ 
                                //console.log(e.responseText); 
                                //alert(e.responseText);
                                //alert('Error, please try again!');
                              } 
                          
                          });
                         
                          
                         
                    } else{  
                    
                          $.ajax({
                  
                              url: 'process/get_ccyrate.php?ccypair=' + main_curr,
                              dataType: 'json',
                              success: function(s){ 
                                  //alert(s);
                                  //alert(s);
                                  var rt = s[0][0]; 
                                  
                                  //alert("f6");  
                                  if(rt > 0 && rt != null) {
                            
                                        $("#" + myform).find("input[name=pnl_rate]").val(rt);   
                                        $(".rate_date").html( "Updated on : " + s[0][1]);                               
                                                                       
                                  }else{
                                  
                                        $("#" + myform).find("input[name=pnl_rate]").val("");
                                  }
                                  
                                  var rate_amt = numberWithoutCommas(rt);
                                  
                                  // CHNAGE RATE IF CURRENCY ARE SAME
                                  if(my_pnl_ccy_val == this_val){                                         
                                            //alert("change Calc 4");
                                            rate_amt = $("#" + myform).find("input[name=rate]").val();                                            
                                            rate_amt = numberWithoutCommas(rate_amt);
                                            
                                            var pnl_rate_amt = $("#" + myform).find("input[name=pnl_rate]").val();
                                            
                                           if(pnl_rate_amt == "" && rate_amt != ""){  
                                                $("#" + myform).find("input[name=pnl_rate]").val(rate_amt);
                                            }
                                  }
                                  
                                  if(notional > 0 && rate_amt > 0){
                                                                       
                                      new_notional_amount = parseFloat(notional * rate_amt).toFixed(2);
                                     
                                  } 
                                  
                                  if(new_notional_amount > 0){
                    
                                        new_notional_amount_s = new_notional_amount.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");                              
                                        $("#" + myform).find("input[name=pnl_counter_amt]").val(new_notional_amount_s);
                                  }
                                  
                                  
                                  var pnl_rate = $("#" + myform).find("input[name=pnl_rate]").val();
                                  var pnl_counter_amt = $("#" + myform).find("input[name=pnl_counter_amt]").val();
                                  var pnl_ccy_pair = $("#" + myform).find("select[name=pnl_ccy_pair]").val();    
                  
                                  
                                  if(pnl_ccy_pair == ""){
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFC0CB");                         
                                  } else {                     
                                        $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFF");                  
                                  }
                                  
                                  if(pnl_rate == ""){
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");                          
                                  }else {                     
                                        $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFF");                       
                                  }
                                  
                                  if (pnl_counter_amt == ""){
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFC0CB");  
                                  } else {
                                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFF");                  
                                  }    
                                  
                                  
                              
                              }, 
                              error: function(e){ 
                                //console.log(e.responseText); 
                                //alert(e.responseText);
                                //alert('Error, please try again!');
                              } 
                          
                          });                                                     
                          
                    }             
                    
                  }
          
          } 
               
          
          $(".all_dates").datepicker({ dateFormat: 'dd/mm/yy' });
          $(".fxndf_value_date").datepicker({
                  dateFormat: 'dd/mm/yy'                            
          });
      
	});
  
  
	</script> 	
<?php
	}
?>