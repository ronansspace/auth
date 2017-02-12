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
//$touch_up_down = "";
//$rebate_amt = "";
$barrier_style = "";
$mid_barrier = "";


if(isset($_GET['id'])){

    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
	  } 
    
	  $tdrID = $_SESSION['auth_id'];
  
    $id_contract = $_GET['id'];
    $sql = "SELECT * FROM contract where id_contract = $id_contract";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    
    
		$id_contract = str_replace(' ','&nbsp;',htmlentities($row['id_contract']));
		
		$filesent = str_replace(' ','&nbsp;',htmlentities($row['filesent']));
		$contract = str_replace(' ','&nbsp;',htmlentities($row['contract']));
    $account = str_replace(' ','&nbsp;',htmlentities($row['account']));
    
    
		//$client = str_replace(' ','&nbsp;',htmlentities($row['client']));
    $client = $row['client'];
		$cparty = str_replace(' ','&nbsp;',htmlentities($row['cparty']));
		$buy_sell = str_replace(' ','&nbsp;',htmlentities($row['buy_sell']));
		$Notional = str_replace(' ','&nbsp;',htmlentities($row['Notional']));
		$ccy_pair = str_replace(' ','&nbsp;',htmlentities($row['ccy_pair']));
		$p_c = str_replace(' ','&nbsp;',htmlentities($row['p_c']));
		$counter_amt = str_replace(' ','&nbsp;',htmlentities($row['counter_amt']));
		$expiry_date = str_replace(' ','&nbsp;',htmlentities($row['expiry_date']));
		$optcut = str_replace(' ','&nbsp;',htmlentities($row['optcut']));
		$settle_date = str_replace(' ','&nbsp;',htmlentities($row['settle_date']));
		$price = str_replace(' ','&nbsp;',htmlentities($row['price']));
		$rate = str_replace(' ','&nbsp;',htmlentities($row['rate']));
		$prem_amt = str_replace(' ','&nbsp;',htmlentities($row['prem_amt']));
		//$prem_ccy = str_replace(' ','&nbsp;',htmlentities($row['prem_ccy']));
		$type = str_replace(' ','&nbsp;',htmlentities($row['type']));
		$barrier_type = str_replace(' ','&nbsp;',htmlentities($row['barrier_type']));
		$l_barrier = str_replace(' ','&nbsp;',htmlentities($row['l_barrier']));
		$u_barrier = str_replace(' ','&nbsp;',htmlentities($row['u_barrier']));
		$knock_in_out = str_replace(' ','&nbsp;',htmlentities($row['knock_in_out']));
		$touch_up_down = str_replace(' ','&nbsp;',htmlentities($row['touch_up_down']));
		$cash_at = str_replace(' ','&nbsp;',htmlentities($row['cash_at']));
		$rebate_ccy = str_replace(' ','&nbsp;',htmlentities($row['rebate_ccy']));
		$trade_date = str_replace(' ','&nbsp;',htmlentities($row['trade_date']));
		$value_date = str_replace(' ','&nbsp;',htmlentities($row['value_date']));
		$expiry = str_replace(' ','&nbsp;',htmlentities($row['expiry']));
		$rebate_amt = str_replace(' ','&nbsp;',htmlentities($row['rebate_amt']));
		$payout_ccy = str_replace(' ','&nbsp;',htmlentities($row['payout_ccy']));
		$barrier_start_date = str_replace(' ','&nbsp;',htmlentities($row['barrier_start_date']));
		$barrier_end_date = str_replace(' ','&nbsp;',htmlentities($row['barrier_end_date']));
		$spcut = str_replace(' ','&nbsp;',htmlentities($row['spcut']));
		$fx_pair_id = str_replace(' ','&nbsp;',htmlentities($row['fx_pair_id']));
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
    $mid_price = $row['mid_price'];    
    $deliverablity = $row['deliverablity'];
    $fixing_date = $row['fixing_date']; 
    
    $premium_ccy = $row['premium_ccy']; 
    $spcut_cp = $row['spcut_cp']; 
    $premium_amount = $row['premium_amount']; 
    $calculations = $row['calculations']; 
    $price_percentage = $row['price_percentage']; 
    $strike = $row['strike'];
    $option_style = $row['option_style'];
    
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
   
   
}



?>
<?php
if(!tdrLoggedIn()){	
}
else{
?>
<style>
		#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT{
			display:none;
		}
		div.container{
			background-color:#fff;
			padding:10px 60px;
			margin-top:5px;
			border:1px solid black;
			
		}
		div.top{background-color:#101010; padding-top:4px; padding-bottom:5px;}
		label.lb-left{
			padding:3px 12px; color:#fff; background-color:#5E94DD;border-top-right-radius: 0em;border-bottom-right-radius: 0em;
		}
		label.lb-right{
			background-color:#fff;padding:3px 12px; color:#101010;border-top-left-radius: 0em;border-bottom-left-radius: 0em; margin-right:20px;
		}
		label.lb-right select{
			border:none; outline:none; min-width:70px;
		}
		td select,td input[type="text"],td input[type="date"]{
			width:135px;
		}
		td input[type="text"],td input[type="date"]{ line-height:90%;}
		td input[type="date"]{ height:90%;}
		td{ white-space:nowrap;}
    
    .col-md-12 {padding-right:0px;}
    </style>
    <div class="container" style="max-height:650px; overflow:auto;">
	<div class="row" style="min-width:991px;">
    	<div class="row">
        	<div class="col-md-12 top">
            	<label class="label lb-left">Trade Date</label><label class="label lb-right"><?php echo date("Y-m-d"); ?></label>
                <label class="label lb-left">Trade Time</label><label id="time" class="label lb-right"><?php echo date("H:i:s"); ?></label>
                <label class="label lb-left">GMT Time</label><label id="gmtime" class="label lb-right"><?php echo gmdate("H:i:s"); ?></label>
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
                <div style="float:right;"><label class="label lb-left" style="background-color:#46D430;">Contract</label>
                <label class="label lb-right" style="padding-right:3px;">
                <select id="contract" onChange="ch_contract();">
                        	<option <?php if(isset($contract) && $contract == "FXSP"){ echo "selected"; }?> value="FXSP">FXSP</option>
                            <option <?php if(isset($contract) && $contract == "FXFW"){ echo "selected"; }?> value="FXFW">FXFW</option>
                            <option <?php if(isset($contract) && $contract == "FXNDF"){ echo "selected"; }?> value="FXNDF">FXNDF</option>
                            <option <?php if(isset($contract) && $contract == "FXOPT"){ echo "selected"; }?> value="FXOPT">FXOPT</option>
                            <option <?php if(isset($contract) && $contract == "EOPT"){ echo "selected"; }?> value="EOPT">EOPT</option>
                </select>
                </label>
						    <label class="label lb-left" style="background-color:#46D430;">Account</label><label class="label lb-right" style="padding-right:3px;">
            
                <select id="account">
                    	<option <?php if(isset($account) && $account == "Curve"){ echo "selected"; }?> value="Curve" selected>Curve</option>
                      <option <?php if(isset($account) && $account == "Curve_MP"){ echo "selected"; }?> value="Curve_MP">Curve_MP</option>
             		</select></label>
                 <label class="label lb-left">Trade Status</label>
                 <label class="label lb-right" style="padding-right:3px;">
                 <select name="status" id="status">
             		    <option <?php if(isset($status) && $status == "Active"){ echo "selected"; }?> value="Active">Active</option>
                    <option <?php if(isset($status) && $status == "Abandoned"){ echo "selected"; }?> value="Abandoned">Abandoned</option>
                    <option <?php if(isset($status) && $status == "Excercise"){ echo "selected"; }?> value="Excercise">Excercise</option>
                    <option <?php if(isset($status) && $status == "Triggered"){ echo "selected"; }?> value="Triggered">Triggered</option>
                    <option <?php if(isset($status) && $status == "SETTELED"){ echo "selected"; }?> value="SETTELED">SETTELED</option>
                    <option <?php if(isset($status) && $status == "NOVATED"){ echo "selected"; }?> value="NOVATED">NOVATED</option>
                    <option <?php if(isset($status) && $status == "TEARUP"){ echo "selected"; }?> value="TEARUP">TEARUP</option>
                </select></label></div>
        	</div>
        </div>
        <div class="row" id="FXSP" style="display:<?=$contract_FXSP;?>">
        	<div class="col-xs-12" style="background-color:#eee;">
				<form id="FXSP_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
        
              <input type="hidden" name="id_contract" value="<?=$id_contract;?>">
              
            	<table class="table" border="0">
                	<tbody>
                    	<tr>
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option <?php if(isset($client) && $client == "ALSTRA-G/U RBS"){ echo "selected"; }?> value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option>
                                        <option <?php if(isset($client) && $client == "BALDR-G/U RBS"){ echo "selected"; }?> value="BALDR-G/U RBS">BALDR-G/U RBS   </option>
                                        <option <?php if(isset($client) && $client == "Bank of America Client"){ echo "selected"; }?> value="Bank of America Client">Bank of America Client</option>
                                        <option <?php if(isset($client) && $client == "Bank of America EB"){ echo "selected"; }?> value="Bank of America EB">Bank of America EB</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc Client"){ echo "selected"; }?>  value="Barclays Bank Plc Client">Barclays Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc EB"){ echo "selected"; }?>  value="Barclays Bank Plc EB">Barclays Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas Client"){ echo "selected"; }?>  value="BNP Paribas Client">BNP Paribas Client</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas EB"){ echo "selected"; }?>  value="BNP Paribas EB">BNP Paribas EB</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U Client"){ echo "selected"; }?>  value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U DB"){ echo "selected"; }?>  value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup Client"){ echo "selected"; }?>  value="CitiGroup Client">CitiGroup Client</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup EB"){ echo "selected"; }?>  value="CitiGroup EB">CitiGroup EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  Client"){ echo "selected"; }?>  value="Credit Agricole  Client">Credit Agricole  Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  EB"){ echo "selected"; }?>  value="Credit Agricole  EB">Credit Agricole  EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG Client"){ echo "selected"; }?>  value="Credit Suisse AG Client">Credit Suisse AG Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG EB"){ echo "selected"; }?>  value="Credit Suisse AG EB">Credit Suisse AG EB</option>
                                        <option <?php if(isset($client) && $client == "CURVE_MP"){ echo "selected"; }?>  value="CURVE_MP">CURVE_MP</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  Client"){ echo "selected"; }?>  value="Goldman Sachs  Client">Goldman Sachs  Client</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  EB"){ echo "selected"; }?>  value="Goldman Sachs  EB">Goldman Sachs  EB</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U Client"){ echo "selected"; }?>  value="GRATICULE- G/U Client">GRATICULE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U DB"){ echo "selected"; }?>  value="GRATICULE- G/U DB">GRATICULE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc Client"){ echo "selected"; }?>  value="HSBC Plc Client">HSBC Plc Client</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc EB"){ echo "selected"; }?>  value="HSBC Plc EB">HSBC Plc EB</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard  Bank Plc Client"){ echo "selected"; }?> value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard Bank Plc EB"){ echo "selected"; }?>  value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA Client"){ echo "selected"; }?>  value="JP Morgan NA Client">JP Morgan NA Client</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA EB"){ echo "selected"; }?>  value="JP Morgan NA EB">JP Morgan NA EB</option>
                                        <option <?php if(isset($client) && $client == "LDF- G/U JPM"){ echo "selected"; }?>  value="LDF- G/U JPM">LDF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "LSF- G/U JPM"){ echo "selected"; }?>  value="LSF- G/U JPM">LSF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI"){ echo "selected"; }?>  value="MKP- G/U CITI">MKP- G/U CITI</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI Client"){ echo "selected"; }?>  value="MKP- G/U CITI Client">MKP- G/U CITI Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int Client"){ echo "selected"; }?>  value="Morgan Stanley Int Client">Morgan Stanley Int Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int EB"){ echo "selected"; }?>  value="Morgan Stanley Int EB">Morgan Stanley Int EB</option>
                                        <option <?php if(isset($client) && $client == "NAB Client"){ echo "selected"; }?>  value="NAB Client">NAB Client</option>
                                        <option <?php if(isset($client) && $client == "NAB EB"){ echo "selected"; }?>  value="NAB EB">NAB EB</option>
                                        <option <?php if(isset($client) && $client == "Natixis Client"){ echo "selected"; }?>  value="Natixis Client">Natixis Client</option>
                                        <option <?php if(isset($client) && $client == "Natixis EB"){ echo "selected"; }?>  value="Natixis EB">Natixis EB</option>
                                        <option <?php if(isset($client) && $client == "Nomura Client"){ echo "selected"; }?>  value="Nomura Client">Nomura Client</option>
                                        <option <?php if(isset($client) && $client == "Nomura EB"){ echo "selected"; }?>  value="Nomura EB">Nomura EB</option>
                                        <option <?php if(isset($client) && $client == "OMEGA-G/U JPM"){ echo "selected"; }?>  value="OMEGA-G/U JPM">OMEGA-G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "OPERA- G/U DB"){ echo "selected"; }?>  value="OPERA- G/U DB">OPERA- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "PERMAL- G/U JPM"){ echo "selected"; }?>  value="PERMAL- G/U JPM">PERMAL- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PRELUDE- G/U JPM"){ echo "selected"; }?>  value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PROLOGUE- G/U JPM"){ echo "selected"; }?>  value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "Prologue Mapplewood G/U JPM"){ echo "selected"; }?>  value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "RBC  Client"){ echo "selected"; }?>  value="RBC  Client">RBC  Client</option>
                                        <option <?php if(isset($client) && $client == "RBC  EB"){ echo "selected"; }?>  value="RBC  EB">RBC  EB</option>
                                        <option <?php if(isset($client) && $client == "RBS Client"){ echo "selected"; }?>  value="RBS Client">RBS Client</option>
                                        <option <?php if(isset($client) && $client == "RBS EB"){ echo "selected"; }?>  value="RBS EB">RBS EB</option>
                                        <option <?php if(isset($client) && $client == "RESILIENCE- G/U UBS"){ echo "selected"; }?>  value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option>
                                        <option <?php if(isset($client) && $client == "SEB Client"){ echo "selected"; }?>  value="SEB Client">SEB Client</option>
                                        <option <?php if(isset($client) && $client == "SEB EB"){ echo "selected"; }?>  value="SEB EB">SEB EB</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  Client"){ echo "selected"; }?>  value="Standard Chartered  Client">Standard Chartered  Client</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  EB"){ echo "selected"; }?>  value="Standard Chartered  EB">Standard Chartered  EB</option>
                                        <option <?php if(isset($client) && $client == "State Street Client"){ echo "selected"; }?>  value="State Street Client">State Street Client</option>
                                        <option <?php if(isset($client) && $client == "State Street EB"){ echo "selected"; }?>  value="State Street EB">State Street EB</option>
                                        <option <?php if(isset($client) && $client == "UBS AG Client"){ echo "selected"; }?>  value="UBS AG Client">UBS AG Client</option>
                                        <option <?php if(isset($client) && $client == "UBS AG EB"){ echo "selected"; }?>  value="UBS AG EB">UBS AG EB</option>
                                        <option <?php if(isset($client) && $client == "Westpac  Client"){ echo "selected"; }?>  value="Westpac  Client">Westpac  Client</option>
                                        <option <?php if(isset($client) && $client == "Westpac EB"){ echo "selected"; }?>  value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td>Rate:</td><td><input tabindex="6" id="fxsp_rate" type="text" name="rate" value="<?=$rate;?>" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>
                            <td>Trade Date:</td><td><input tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"   class="all_dates"></td>
                            <td>Expiry:</td><td>		
                            <select tabindex="15" name="expiry">								
                            <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N</option> 						
												    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y</option>  
												    </select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	           <option value=""></option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td></td><td></td>
                            <td>Value Date:</td><td><input type="text" placeholder="dd/mm/yy" tabindex="11"   class="all_dates" name="value_date" value="<?=$value_date;?>"></td>
                            <td>SPCUT:</td><td>
                                  <select tabindex="16" name="spcut">
                                  <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
        										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
        										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
        										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                            </td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell:</td><td><select tabindex="3" name="buy_sell">
                                <option value="" selected="selected"></option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B</option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S</option></select></td>
                        	
                          <td>Counter Amount:</td><td><input tabindex="8" value="<?=$counter_amt;?>" name="counter_amt" id="fxsp_camt" type="text"></td>
                            <td>Traded As:</td><td>
                                  <select tabindex="12" name="traded_as">
                                      <option value=""></option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FX"){ echo "selected"; }?> value="FX" >FX</option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE</option>
                                  </select>
                                  </td>
                                  <td>Cut Time:</td><td>
                                      <select tabindex="17" name="cut_time">
                                          <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00</option>
										                      <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00</option>
                                      </select>
                                  </td>
                        </tr>
                        <tr>
                        	<td>Notional:</td><td><input tabindex="4" name="notional" value="<?=$Notional;?>" id="fxsp_not" type="text" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc:</td><td>
                            <select tabindex="9" name="calc">
                              <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply</option>
												      <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide</option></select>
                            
                            </td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker">
                                    <option value="">...</option>
                                    <!--<option value="CITI" >CITI</option>-->
                                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS</option>
                                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST</option></select></td>
                                    
                            <td>Settlement:</td><td>
                              <select tabindex="18" name="settlement">
                                <option value=""></option>
              								 <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL</option>
              								 <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH</option></select>
                               
                            </td>
                        </tr>
                        <tr>
                        	<td></td><td><select style="display:none;" tabindex="5" name="inverted">
                            <option value=""></option>
												    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I</option></select></td>
                        	<td></td><td></td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>
                            <td>FX_PAIR ID:</td><td><input name="fx_pair_id" disabled value="fxp_123" value="<?=$fx_pair_id;?>" type="text"></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td></td><td></td>
                            <td></td><td></td>
                            <td>Matching Date:</td><td><input placeholder="dd/mm/yy" tabindex="19"  value="<?=$matching_date;?>"  class="all_dates" name="match_date" type="text"></td>
							               <td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
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
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option <?php if(isset($client) && $client == "ALSTRA-G/U RBS"){ echo "selected"; }?> value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option>
                                        <option <?php if(isset($client) && $client == "BALDR-G/U RBS"){ echo "selected"; }?> value="BALDR-G/U RBS">BALDR-G/U RBS   </option>
                                        <option <?php if(isset($client) && $client == "Bank of America Client"){ echo "selected"; }?> value="Bank of America Client">Bank of America Client</option>
                                        <option <?php if(isset($client) && $client == "Bank of America EB"){ echo "selected"; }?> value="Bank of America EB">Bank of America EB</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc Client"){ echo "selected"; }?>  value="Barclays Bank Plc Client">Barclays Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc EB"){ echo "selected"; }?>  value="Barclays Bank Plc EB">Barclays Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas Client"){ echo "selected"; }?>  value="BNP Paribas Client">BNP Paribas Client</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas EB"){ echo "selected"; }?>  value="BNP Paribas EB">BNP Paribas EB</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U Client"){ echo "selected"; }?>  value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U DB"){ echo "selected"; }?>  value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup Client"){ echo "selected"; }?>  value="CitiGroup Client">CitiGroup Client</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup EB"){ echo "selected"; }?>  value="CitiGroup EB">CitiGroup EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  Client"){ echo "selected"; }?>  value="Credit Agricole  Client">Credit Agricole  Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  EB"){ echo "selected"; }?>  value="Credit Agricole  EB">Credit Agricole  EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG Client"){ echo "selected"; }?>  value="Credit Suisse AG Client">Credit Suisse AG Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG EB"){ echo "selected"; }?>  value="Credit Suisse AG EB">Credit Suisse AG EB</option>
                                        <option <?php if(isset($client) && $client == "CURVE_MP"){ echo "selected"; }?>  value="CURVE_MP">CURVE_MP</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  Client"){ echo "selected"; }?>  value="Goldman Sachs  Client">Goldman Sachs  Client</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  EB"){ echo "selected"; }?>  value="Goldman Sachs  EB">Goldman Sachs  EB</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U Client"){ echo "selected"; }?>  value="GRATICULE- G/U Client">GRATICULE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U DB"){ echo "selected"; }?>  value="GRATICULE- G/U DB">GRATICULE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc Client"){ echo "selected"; }?>  value="HSBC Plc Client">HSBC Plc Client</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc EB"){ echo "selected"; }?>  value="HSBC Plc EB">HSBC Plc EB</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard  Bank Plc Client"){ echo "selected"; }?> value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard Bank Plc EB"){ echo "selected"; }?>  value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA Client"){ echo "selected"; }?>  value="JP Morgan NA Client">JP Morgan NA Client</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA EB"){ echo "selected"; }?>  value="JP Morgan NA EB">JP Morgan NA EB</option>
                                        <option <?php if(isset($client) && $client == "LDF- G/U JPM"){ echo "selected"; }?>  value="LDF- G/U JPM">LDF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "LSF- G/U JPM"){ echo "selected"; }?>  value="LSF- G/U JPM">LSF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI"){ echo "selected"; }?>  value="MKP- G/U CITI">MKP- G/U CITI</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI Client"){ echo "selected"; }?>  value="MKP- G/U CITI Client">MKP- G/U CITI Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int Client"){ echo "selected"; }?>  value="Morgan Stanley Int Client">Morgan Stanley Int Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int EB"){ echo "selected"; }?>  value="Morgan Stanley Int EB">Morgan Stanley Int EB</option>
                                        <option <?php if(isset($client) && $client == "NAB Client"){ echo "selected"; }?>  value="NAB Client">NAB Client</option>
                                        <option <?php if(isset($client) && $client == "NAB EB"){ echo "selected"; }?>  value="NAB EB">NAB EB</option>
                                        <option <?php if(isset($client) && $client == "Natixis Client"){ echo "selected"; }?>  value="Natixis Client">Natixis Client</option>
                                        <option <?php if(isset($client) && $client == "Natixis EB"){ echo "selected"; }?>  value="Natixis EB">Natixis EB</option>
                                        <option <?php if(isset($client) && $client == "Nomura Client"){ echo "selected"; }?>  value="Nomura Client">Nomura Client</option>
                                        <option <?php if(isset($client) && $client == "Nomura EB"){ echo "selected"; }?>  value="Nomura EB">Nomura EB</option>
                                        <option <?php if(isset($client) && $client == "OMEGA-G/U JPM"){ echo "selected"; }?>  value="OMEGA-G/U JPM">OMEGA-G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "OPERA- G/U DB"){ echo "selected"; }?>  value="OPERA- G/U DB">OPERA- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "PERMAL- G/U JPM"){ echo "selected"; }?>  value="PERMAL- G/U JPM">PERMAL- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PRELUDE- G/U JPM"){ echo "selected"; }?>  value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PROLOGUE- G/U JPM"){ echo "selected"; }?>  value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "Prologue Mapplewood G/U JPM"){ echo "selected"; }?>  value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "RBC  Client"){ echo "selected"; }?>  value="RBC  Client">RBC  Client</option>
                                        <option <?php if(isset($client) && $client == "RBC  EB"){ echo "selected"; }?>  value="RBC  EB">RBC  EB</option>
                                        <option <?php if(isset($client) && $client == "RBS Client"){ echo "selected"; }?>  value="RBS Client">RBS Client</option>
                                        <option <?php if(isset($client) && $client == "RBS EB"){ echo "selected"; }?>  value="RBS EB">RBS EB</option>
                                        <option <?php if(isset($client) && $client == "RESILIENCE- G/U UBS"){ echo "selected"; }?>  value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option>
                                        <option <?php if(isset($client) && $client == "SEB Client"){ echo "selected"; }?>  value="SEB Client">SEB Client</option>
                                        <option <?php if(isset($client) && $client == "SEB EB"){ echo "selected"; }?>  value="SEB EB">SEB EB</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  Client"){ echo "selected"; }?>  value="Standard Chartered  Client">Standard Chartered  Client</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  EB"){ echo "selected"; }?>  value="Standard Chartered  EB">Standard Chartered  EB</option>
                                        <option <?php if(isset($client) && $client == "State Street Client"){ echo "selected"; }?>  value="State Street Client">State Street Client</option>
                                        <option <?php if(isset($client) && $client == "State Street EB"){ echo "selected"; }?>  value="State Street EB">State Street EB</option>
                                        <option <?php if(isset($client) && $client == "UBS AG Client"){ echo "selected"; }?>  value="UBS AG Client">UBS AG Client</option>
                                        <option <?php if(isset($client) && $client == "UBS AG EB"){ echo "selected"; }?>  value="UBS AG EB">UBS AG EB</option>
                                        <option <?php if(isset($client) && $client == "Westpac  Client"){ echo "selected"; }?>  value="Westpac  Client">Westpac  Client</option>
                                        <option <?php if(isset($client) && $client == "Westpac EB"){ echo "selected"; }?>  value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td>Rate:</td><td><input tabindex="6" id="fxsp_rate" type="text" name="rate" value="<?=$rate;?>" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>
                            <td>Trade Date:</td><td><input tabindex="10"  class="all_dates" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>
                            <td>Expiry:</td><td>		
                            <select tabindex="15" name="expiry">								
                            <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N</option> 						
												    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y</option>  
												    </select></td>
                        </tr>
                        
                        
                        
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	           <option value=""></option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	   <td>Mid Price:</td><td><input tabindex="7" type="text" value="<?=$mid_price;?>" name="mid_price"></td>
                            <td>Value Date:</td><td><input type="text" placeholder="dd/mm/yy" tabindex="11"  class="all_dates" name="value_date" value="<?=$value_date;?>"></td>
                            <td>SPCUT:</td><td>
                                  <select tabindex="16" name="spcut">
                                  <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
        										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
        										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
        										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                            </td>
                        </tr>
                        
                                                
                         <tr>
                        	<td>Notional:</td><td><input tabindex="4" name="notional" value="<?=$Notional;?>" id="fxsp_not" type="text" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc:</td><td>
                            <select tabindex="9" name="calc">
                              <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply</option>
												      <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide</option></select>
                            
                            </td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker">
                                    <option value="">...</option>
                                    <!--<option value="CITI" >CITI</option>-->
                                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS</option>
                                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST</option></select></td>
                                    
                            <td>Settlement:</td><td>
                              <select tabindex="18" name="settlement">
                                <option value=""></option>
              								 <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL</option>
              								 <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH</option></select>
                               
                            </td>
                        </tr>
                        
                        
                        <tr>
                        	   <td></td>
                             <td><select style="display:none;" tabindex="5" name="inverted">
                                <option value=""></option>
    												    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I</option></select>
                             </td>
                             
                             <td>Deliverability:</td>
                             <td>
                             <select tabindex="10" name="deliverablity">
      												<option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND</option>
      												<option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D</option>
      											 </select>
                            </td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>
                            <td>FX_PAIR ID:</td><td><input name="fx_pair_id" disabled value="fxp_123" value="<?=$fx_pair_id;?>" type="text"></td>
                        </tr>
                        
                        <tr>
                        	<td></td><td></td>
                        	<td></td><td></td>
                            <td></td><td></td>
                            <td>Matching Date:</td><td><input  class="all_dates" placeholder="dd/mm/yy" tabindex="19"  value="<?=$matching_date;?>" name="match_date" type="text"></td>
							               <td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
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
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option <?php if(isset($client) && $client == "ALSTRA-G/U RBS"){ echo "selected"; }?> value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option>
                                        <option <?php if(isset($client) && $client == "BALDR-G/U RBS"){ echo "selected"; }?> value="BALDR-G/U RBS">BALDR-G/U RBS   </option>
                                        <option <?php if(isset($client) && $client == "Bank of America Client"){ echo "selected"; }?> value="Bank of America Client">Bank of America Client</option>
                                        <option <?php if(isset($client) && $client == "Bank of America EB"){ echo "selected"; }?> value="Bank of America EB">Bank of America EB</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc Client"){ echo "selected"; }?>  value="Barclays Bank Plc Client">Barclays Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc EB"){ echo "selected"; }?>  value="Barclays Bank Plc EB">Barclays Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas Client"){ echo "selected"; }?>  value="BNP Paribas Client">BNP Paribas Client</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas EB"){ echo "selected"; }?>  value="BNP Paribas EB">BNP Paribas EB</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U Client"){ echo "selected"; }?>  value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U DB"){ echo "selected"; }?>  value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup Client"){ echo "selected"; }?>  value="CitiGroup Client">CitiGroup Client</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup EB"){ echo "selected"; }?>  value="CitiGroup EB">CitiGroup EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  Client"){ echo "selected"; }?>  value="Credit Agricole  Client">Credit Agricole  Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  EB"){ echo "selected"; }?>  value="Credit Agricole  EB">Credit Agricole  EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG Client"){ echo "selected"; }?>  value="Credit Suisse AG Client">Credit Suisse AG Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG EB"){ echo "selected"; }?>  value="Credit Suisse AG EB">Credit Suisse AG EB</option>
                                        <option <?php if(isset($client) && $client == "CURVE_MP"){ echo "selected"; }?>  value="CURVE_MP">CURVE_MP</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  Client"){ echo "selected"; }?>  value="Goldman Sachs  Client">Goldman Sachs  Client</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  EB"){ echo "selected"; }?>  value="Goldman Sachs  EB">Goldman Sachs  EB</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U Client"){ echo "selected"; }?>  value="GRATICULE- G/U Client">GRATICULE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U DB"){ echo "selected"; }?>  value="GRATICULE- G/U DB">GRATICULE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc Client"){ echo "selected"; }?>  value="HSBC Plc Client">HSBC Plc Client</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc EB"){ echo "selected"; }?>  value="HSBC Plc EB">HSBC Plc EB</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard  Bank Plc Client"){ echo "selected"; }?> value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard Bank Plc EB"){ echo "selected"; }?>  value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA Client"){ echo "selected"; }?>  value="JP Morgan NA Client">JP Morgan NA Client</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA EB"){ echo "selected"; }?>  value="JP Morgan NA EB">JP Morgan NA EB</option>
                                        <option <?php if(isset($client) && $client == "LDF- G/U JPM"){ echo "selected"; }?>  value="LDF- G/U JPM">LDF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "LSF- G/U JPM"){ echo "selected"; }?>  value="LSF- G/U JPM">LSF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI"){ echo "selected"; }?>  value="MKP- G/U CITI">MKP- G/U CITI</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI Client"){ echo "selected"; }?>  value="MKP- G/U CITI Client">MKP- G/U CITI Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int Client"){ echo "selected"; }?>  value="Morgan Stanley Int Client">Morgan Stanley Int Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int EB"){ echo "selected"; }?>  value="Morgan Stanley Int EB">Morgan Stanley Int EB</option>
                                        <option <?php if(isset($client) && $client == "NAB Client"){ echo "selected"; }?>  value="NAB Client">NAB Client</option>
                                        <option <?php if(isset($client) && $client == "NAB EB"){ echo "selected"; }?>  value="NAB EB">NAB EB</option>
                                        <option <?php if(isset($client) && $client == "Natixis Client"){ echo "selected"; }?>  value="Natixis Client">Natixis Client</option>
                                        <option <?php if(isset($client) && $client == "Natixis EB"){ echo "selected"; }?>  value="Natixis EB">Natixis EB</option>
                                        <option <?php if(isset($client) && $client == "Nomura Client"){ echo "selected"; }?>  value="Nomura Client">Nomura Client</option>
                                        <option <?php if(isset($client) && $client == "Nomura EB"){ echo "selected"; }?>  value="Nomura EB">Nomura EB</option>
                                        <option <?php if(isset($client) && $client == "OMEGA-G/U JPM"){ echo "selected"; }?>  value="OMEGA-G/U JPM">OMEGA-G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "OPERA- G/U DB"){ echo "selected"; }?>  value="OPERA- G/U DB">OPERA- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "PERMAL- G/U JPM"){ echo "selected"; }?>  value="PERMAL- G/U JPM">PERMAL- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PRELUDE- G/U JPM"){ echo "selected"; }?>  value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PROLOGUE- G/U JPM"){ echo "selected"; }?>  value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "Prologue Mapplewood G/U JPM"){ echo "selected"; }?>  value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "RBC  Client"){ echo "selected"; }?>  value="RBC  Client">RBC  Client</option>
                                        <option <?php if(isset($client) && $client == "RBC  EB"){ echo "selected"; }?>  value="RBC  EB">RBC  EB</option>
                                        <option <?php if(isset($client) && $client == "RBS Client"){ echo "selected"; }?>  value="RBS Client">RBS Client</option>
                                        <option <?php if(isset($client) && $client == "RBS EB"){ echo "selected"; }?>  value="RBS EB">RBS EB</option>
                                        <option <?php if(isset($client) && $client == "RESILIENCE- G/U UBS"){ echo "selected"; }?>  value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option>
                                        <option <?php if(isset($client) && $client == "SEB Client"){ echo "selected"; }?>  value="SEB Client">SEB Client</option>
                                        <option <?php if(isset($client) && $client == "SEB EB"){ echo "selected"; }?>  value="SEB EB">SEB EB</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  Client"){ echo "selected"; }?>  value="Standard Chartered  Client">Standard Chartered  Client</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  EB"){ echo "selected"; }?>  value="Standard Chartered  EB">Standard Chartered  EB</option>
                                        <option <?php if(isset($client) && $client == "State Street Client"){ echo "selected"; }?>  value="State Street Client">State Street Client</option>
                                        <option <?php if(isset($client) && $client == "State Street EB"){ echo "selected"; }?>  value="State Street EB">State Street EB</option>
                                        <option <?php if(isset($client) && $client == "UBS AG Client"){ echo "selected"; }?>  value="UBS AG Client">UBS AG Client</option>
                                        <option <?php if(isset($client) && $client == "UBS AG EB"){ echo "selected"; }?>  value="UBS AG EB">UBS AG EB</option>
                                        <option <?php if(isset($client) && $client == "Westpac  Client"){ echo "selected"; }?>  value="Westpac  Client">Westpac  Client</option>
                                        <option <?php if(isset($client) && $client == "Westpac EB"){ echo "selected"; }?>  value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td>Rate:</td><td><input tabindex="6" id="fxsp_rate" type="text" name="rate" value="<?=$rate;?>" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>
                            <td>Trade Date:</td><td><input class="all_dates" tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>
                            <td>Expiry:</td><td>		
                            <select tabindex="15" name="expiry">								
                            <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N</option> 						
												    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y</option>  
												    </select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	           <option value=""></option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	   <td>Mid Price:</td><td><input tabindex="7" type="text" value="<?=$mid_price;?>" name="mid_price"></td>
                            <td>Value Date:</td><td><input  class="all_dates" type="text" placeholder="dd/mm/yy" tabindex="11" name="value_date" value="<?=$value_date;?>"></td>
                            <td>SPCUT:</td><td>
                                  <select tabindex="16" name="spcut">
                                  <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
        										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
        										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
        										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                            </td>
                        </tr>
                        
                        
                        
                        <tr>
                        	<td>Buy/Sell:</td><td><select tabindex="3" name="buy_sell">
                                <option value="" selected="selected"></option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B</option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S</option></select></td>
                        	
                           <td>Counter Amount:</td><td><input tabindex="8" value="<?=$counter_amt;?>" name="counter_amt" id="fxsp_camt" type="text"></td>
                           <td>Fixing&nbsp;Date: </td><td><input class="all_dates" placeholder="dd/mm/yy" type="text" value="<?=$fixing_date;?>" name="fixing_date"></td>
                                  <td>Cut Time:</td><td>
                                      <select tabindex="17" name="cut_time">
                                          <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00</option>
										                      <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00</option>
                                      </select>
                                  </td>
                        </tr>
                                                
                        <tr>
                        	<td>Notional:</td><td><input tabindex="4" name="notional" value="<?=$Notional;?>" id="fxsp_not" type="text" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc:</td><td>
                            <select tabindex="9" name="calc">
                              <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply</option>
												      <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide</option></select>
                            
                            </td>
                             <td>Traded As:</td><td>
                                  <select tabindex="12" name="traded_as">
                                      <option value=""></option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FX"){ echo "selected"; }?> value="FX" >FX</option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE</option>
                                  </select>
                                  </td>
                            <td>Settlement:</td><td>
                              <select tabindex="18" name="settlement">
                                <option value=""></option>
              								 <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL</option>
              								 <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH</option></select>                               
                            </td>
                        </tr>
                        
                        
                        <tr>
                        	<td>Inverted&nbsp;Price:</td><td><select name="inverted">
                          
                          <option value=""></option>
												 <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I</option></select></td>
                        	
                            <td>Deliverability:</td>
                             <td>
                             <select tabindex="10" name="deliverablity">
      												<option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND</option>
      												<option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D</option>
      											 </select>
                            </td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker">
                                    <option value="">...</option>
                                    <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS</option>
                                    <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST</option></select></td>
                                    
                            
                            <td>FX_PAIR ID:</td><td><input name="fx_pair_id" disabled value="fxp_123" value="<?=$fx_pair_id;?>" type="text"></td>
                        </tr>
                        <tr>
                        	  <td></td><td></td>
                        	  <td></td><td></td>
						               	<td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>
                            <td>Matching Date:</td><td><input  class="all_dates" placeholder="dd/mm/yy" tabindex="19"  value="<?=$matching_date;?>" name="match_date" type="text"></td>
							             <td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
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
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option <?php if(isset($client) && $client == "ALSTRA-G/U RBS"){ echo "selected"; }?> value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option>
                                        <option <?php if(isset($client) && $client == "BALDR-G/U RBS"){ echo "selected"; }?> value="BALDR-G/U RBS">BALDR-G/U RBS   </option>
                                        <option <?php if(isset($client) && $client == "Bank of America Client"){ echo "selected"; }?> value="Bank of America Client">Bank of America Client</option>
                                        <option <?php if(isset($client) && $client == "Bank of America EB"){ echo "selected"; }?> value="Bank of America EB">Bank of America EB</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc Client"){ echo "selected"; }?>  value="Barclays Bank Plc Client">Barclays Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc EB"){ echo "selected"; }?>  value="Barclays Bank Plc EB">Barclays Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas Client"){ echo "selected"; }?>  value="BNP Paribas Client">BNP Paribas Client</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas EB"){ echo "selected"; }?>  value="BNP Paribas EB">BNP Paribas EB</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U Client"){ echo "selected"; }?>  value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U DB"){ echo "selected"; }?>  value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup Client"){ echo "selected"; }?>  value="CitiGroup Client">CitiGroup Client</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup EB"){ echo "selected"; }?>  value="CitiGroup EB">CitiGroup EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  Client"){ echo "selected"; }?>  value="Credit Agricole  Client">Credit Agricole  Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  EB"){ echo "selected"; }?>  value="Credit Agricole  EB">Credit Agricole  EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG Client"){ echo "selected"; }?>  value="Credit Suisse AG Client">Credit Suisse AG Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG EB"){ echo "selected"; }?>  value="Credit Suisse AG EB">Credit Suisse AG EB</option>
                                        <option <?php if(isset($client) && $client == "CURVE_MP"){ echo "selected"; }?>  value="CURVE_MP">CURVE_MP</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  Client"){ echo "selected"; }?>  value="Goldman Sachs  Client">Goldman Sachs  Client</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  EB"){ echo "selected"; }?>  value="Goldman Sachs  EB">Goldman Sachs  EB</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U Client"){ echo "selected"; }?>  value="GRATICULE- G/U Client">GRATICULE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U DB"){ echo "selected"; }?>  value="GRATICULE- G/U DB">GRATICULE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc Client"){ echo "selected"; }?>  value="HSBC Plc Client">HSBC Plc Client</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc EB"){ echo "selected"; }?>  value="HSBC Plc EB">HSBC Plc EB</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard  Bank Plc Client"){ echo "selected"; }?> value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard Bank Plc EB"){ echo "selected"; }?>  value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA Client"){ echo "selected"; }?>  value="JP Morgan NA Client">JP Morgan NA Client</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA EB"){ echo "selected"; }?>  value="JP Morgan NA EB">JP Morgan NA EB</option>
                                        <option <?php if(isset($client) && $client == "LDF- G/U JPM"){ echo "selected"; }?>  value="LDF- G/U JPM">LDF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "LSF- G/U JPM"){ echo "selected"; }?>  value="LSF- G/U JPM">LSF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI"){ echo "selected"; }?>  value="MKP- G/U CITI">MKP- G/U CITI</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI Client"){ echo "selected"; }?>  value="MKP- G/U CITI Client">MKP- G/U CITI Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int Client"){ echo "selected"; }?>  value="Morgan Stanley Int Client">Morgan Stanley Int Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int EB"){ echo "selected"; }?>  value="Morgan Stanley Int EB">Morgan Stanley Int EB</option>
                                        <option <?php if(isset($client) && $client == "NAB Client"){ echo "selected"; }?>  value="NAB Client">NAB Client</option>
                                        <option <?php if(isset($client) && $client == "NAB EB"){ echo "selected"; }?>  value="NAB EB">NAB EB</option>
                                        <option <?php if(isset($client) && $client == "Natixis Client"){ echo "selected"; }?>  value="Natixis Client">Natixis Client</option>
                                        <option <?php if(isset($client) && $client == "Natixis EB"){ echo "selected"; }?>  value="Natixis EB">Natixis EB</option>
                                        <option <?php if(isset($client) && $client == "Nomura Client"){ echo "selected"; }?>  value="Nomura Client">Nomura Client</option>
                                        <option <?php if(isset($client) && $client == "Nomura EB"){ echo "selected"; }?>  value="Nomura EB">Nomura EB</option>
                                        <option <?php if(isset($client) && $client == "OMEGA-G/U JPM"){ echo "selected"; }?>  value="OMEGA-G/U JPM">OMEGA-G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "OPERA- G/U DB"){ echo "selected"; }?>  value="OPERA- G/U DB">OPERA- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "PERMAL- G/U JPM"){ echo "selected"; }?>  value="PERMAL- G/U JPM">PERMAL- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PRELUDE- G/U JPM"){ echo "selected"; }?>  value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PROLOGUE- G/U JPM"){ echo "selected"; }?>  value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "Prologue Mapplewood G/U JPM"){ echo "selected"; }?>  value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "RBC  Client"){ echo "selected"; }?>  value="RBC  Client">RBC  Client</option>
                                        <option <?php if(isset($client) && $client == "RBC  EB"){ echo "selected"; }?>  value="RBC  EB">RBC  EB</option>
                                        <option <?php if(isset($client) && $client == "RBS Client"){ echo "selected"; }?>  value="RBS Client">RBS Client</option>
                                        <option <?php if(isset($client) && $client == "RBS EB"){ echo "selected"; }?>  value="RBS EB">RBS EB</option>
                                        <option <?php if(isset($client) && $client == "RESILIENCE- G/U UBS"){ echo "selected"; }?>  value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option>
                                        <option <?php if(isset($client) && $client == "SEB Client"){ echo "selected"; }?>  value="SEB Client">SEB Client</option>
                                        <option <?php if(isset($client) && $client == "SEB EB"){ echo "selected"; }?>  value="SEB EB">SEB EB</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  Client"){ echo "selected"; }?>  value="Standard Chartered  Client">Standard Chartered  Client</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  EB"){ echo "selected"; }?>  value="Standard Chartered  EB">Standard Chartered  EB</option>
                                        <option <?php if(isset($client) && $client == "State Street Client"){ echo "selected"; }?>  value="State Street Client">State Street Client</option>
                                        <option <?php if(isset($client) && $client == "State Street EB"){ echo "selected"; }?>  value="State Street EB">State Street EB</option>
                                        <option <?php if(isset($client) && $client == "UBS AG Client"){ echo "selected"; }?>  value="UBS AG Client">UBS AG Client</option>
                                        <option <?php if(isset($client) && $client == "UBS AG EB"){ echo "selected"; }?>  value="UBS AG EB">UBS AG EB</option>
                                        <option <?php if(isset($client) && $client == "Westpac  Client"){ echo "selected"; }?>  value="Westpac  Client">Westpac  Client</option>
                                        <option <?php if(isset($client) && $client == "Westpac EB"){ echo "selected"; }?>  value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td></td><td></td>
                            <td>Trade Date:</td><td><input tabindex="10"  class="all_dates" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>
                            <td>Expiry:</td><td>		
                            <select tabindex="15" name="expiry">								
                            <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N</option> 						
												    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y</option>  
												    </select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	           <option value=""></option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	  <td>Mid Price:</td><td><input type="text" value="<?=$mid_price;?>" name="mid_price"></td>
                            <td>Value Date:</td><td><input type="text" class="all_dates" placeholder="dd/mm/yy" tabindex="11" name="value_date" value="<?=$value_date;?>"></td>
                            <td>Cut Time:</td><td>
                                <select tabindex="17" name="cut_time">
                                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00</option>
							                      <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell:</td><td><select tabindex="3" name="buy_sell">
                                <option value="" selected="selected"></option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B</option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S</option></select>
                          </td>
                        	
                          
                        	 <td></td><td></td>
                            <td>Traded As:</td><td>
                                  <select tabindex="12" name="traded_as">
                                      <option value=""></option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FX"){ echo "selected"; }?> value="FX" >FX</option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE</option>
                                  </select>
                            </td>
                            <td>Settlement:</td><td>
                              <select tabindex="18" name="settlement">
                                <option value=""></option>
              								 <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL</option>
              								 <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH</option></select>
                            </td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td>Calc:</td>
                          <td>
                              <select tabindex="9" name="calc">
                              <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply</option>
												      <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide</option></select>
                            
                            </td>
                            
                           <td>Prime broker:</td><td><select tabindex="13" name="prime_broker">
                              <option value="">...</option>
                              <!--<option value="CITI" >CITI</option>-->
                              <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS</option>
                              <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST</option></select></td>
                              
                            <td>FX_PAIR ID:</td><td><input name="fx_pair_id" disabled value="fxp_123" value="<?=$fx_pair_id;?>" type="text"></td>
                        </tr>
                        <tr>
                       
                        	<td><select style="display:none;" tabindex="5" name="inverted">
                            <option value=""></option>
												    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I</option></select></td>
                            
                        	<td></td> 
                          <td>Deliverability:</td>
                             <td>
                             <select tabindex="10" name="deliverablity">
      												<option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND</option>
      												<option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D</option>
      											 </select>
                            </td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>
                            <td>Matching Date:</td><td><input  class="all_dates" placeholder="dd/mm/yy" tabindex="19"  value="<?=$matching_date;?>" name="match_date" type="text"></td>
                        </tr>
                        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                       
            						<tr>
            							<td>Expiry:</td><td><input type="text"  class="all_dates" name="expiry_date" value="<?=$expiry_date;?>" onchange=" var nd =  $('#fxopt_exp').val().split('/'); var nd = new Date(nd[2] + '/'+nd[1]+'/'+nd[0]);nd.setDate(nd.getDate()+2); $('#fxopt_st').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>
            							<td>Cut:</td>
                          <td>
                                  <select tabindex="16" name="spcut">
                                  <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
        										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
        										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
        										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                          </td>
            							<td>Premium CCY:</td><td><input type="text" value="<?=$premium_ccy;?>" name="premium_ccy" id="fxopt_premccy"></td>
            							<td></td><td></td>
            						</tr>
                        <tr>
                        	  <td>Settelment:</td><td><input  class="all_dates" type="text" value="<?=$settle_date;?>" name="settle_date"></td>
                            <td>Notional:</td><td><input type="text" name="notional" value="<?=$Notional;?>" id="fxopt_not" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                            <td>Payout CCY:</td><td><input type="text" value="<?=$payout_ccy;?>" name="payout_ccy" id="fxopt_payout"></td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                        	<td>C/P:</td><td>
                          <select name="spcut_cp">
                               <option <?php if(isset($spcut_cp) && $spcut_cp == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "ECB"){ echo "selected"; }?> value="ECB">ECB</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select></td>
                            <td style="color:#BF3739;">PRICE %:</td><td><input type="text" name="price_percentage" value="<?=$price_percentage;?>" id="fxopt_price" onBlur="$('#fxopt_premamt').val(parseInt($('#fxopt_not').val().replace(/,/g,'')) * parseFloat($('#fxopt_price').val()));"></td>
                            <td>Option Style:</td><td>
                                  <select name="option_style">
                                  <option <?php if(isset($option_style) && $option_style == "American"){ echo "selected"; }?> >American</option>
                                  <option <?php if(isset($option_style) && $option_style == "European"){ echo "selected"; }?> >European</option></select>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                          	<td>Strike:</td><td><input type="text" value="<?=$strike;?>" name="strike"></td>
                            <td style="color:#BF3739;">Premium amount:</td><td><input name="premium_amount" value="<?=$premium_amount;?>" type="text" id="fxopt_premamt"></td>
                            <td>Calculations:</td><td>
                                          <select name="calculations">
                							              <option <?php if(isset($calculations) && $calculations == "Reset"){ echo "selected"; }?> >Reset</option>
                                            <option <?php if(isset($calculations) && $calculations == "Base Cash"){ echo "selected"; }?> >Base Cash</option>
                                            <option <?php if(isset($calculations) && $calculations == "Counter Cash"){ echo "selected"; }?> >Counter Cash</option>
                                            <option <?php if(isset($calculations) && $calculations == "Base %"){ echo "selected"; }?> >Base %</option>
                                            <option <?php if(isset($calculations) && $calculations == "Counter %"){ echo "selected"; }?> >Counter %</option>
                                                        
                            						</select></td>
                            <td></td>
                            <td></td>
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
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option <?php if(isset($client) && $client == "ALSTRA-G/U RBS"){ echo "selected"; }?> value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option>
                                        <option <?php if(isset($client) && $client == "BALDR-G/U RBS"){ echo "selected"; }?> value="BALDR-G/U RBS">BALDR-G/U RBS   </option>
                                        <option <?php if(isset($client) && $client == "Bank of America Client"){ echo "selected"; }?> value="Bank of America Client">Bank of America Client</option>
                                        <option <?php if(isset($client) && $client == "Bank of America EB"){ echo "selected"; }?> value="Bank of America EB">Bank of America EB</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc Client"){ echo "selected"; }?>  value="Barclays Bank Plc Client">Barclays Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "Barclays Bank Plc EB"){ echo "selected"; }?>  value="Barclays Bank Plc EB">Barclays Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas Client"){ echo "selected"; }?>  value="BNP Paribas Client">BNP Paribas Client</option>
                                        <option <?php if(isset($client) && $client == "BNP Paribas EB"){ echo "selected"; }?>  value="BNP Paribas EB">BNP Paribas EB</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U Client"){ echo "selected"; }?>  value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "CAPSTONE- G/U DB"){ echo "selected"; }?>  value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup Client"){ echo "selected"; }?>  value="CitiGroup Client">CitiGroup Client</option>
                                        <option <?php if(isset($client) && $client == "CitiGroup EB"){ echo "selected"; }?>  value="CitiGroup EB">CitiGroup EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  Client"){ echo "selected"; }?>  value="Credit Agricole  Client">Credit Agricole  Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Agricole  EB"){ echo "selected"; }?>  value="Credit Agricole  EB">Credit Agricole  EB</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG Client"){ echo "selected"; }?>  value="Credit Suisse AG Client">Credit Suisse AG Client</option>
                                        <option <?php if(isset($client) && $client == "Credit Suisse AG EB"){ echo "selected"; }?>  value="Credit Suisse AG EB">Credit Suisse AG EB</option>
                                        <option <?php if(isset($client) && $client == "CURVE_MP"){ echo "selected"; }?>  value="CURVE_MP">CURVE_MP</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  Client"){ echo "selected"; }?>  value="Goldman Sachs  Client">Goldman Sachs  Client</option>
                                        <option <?php if(isset($client) && $client == "Goldman Sachs  EB"){ echo "selected"; }?>  value="Goldman Sachs  EB">Goldman Sachs  EB</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U Client"){ echo "selected"; }?>  value="GRATICULE- G/U Client">GRATICULE- G/U Client</option>
                                        <option <?php if(isset($client) && $client == "GRATICULE- G/U DB"){ echo "selected"; }?>  value="GRATICULE- G/U DB">GRATICULE- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc Client"){ echo "selected"; }?>  value="HSBC Plc Client">HSBC Plc Client</option>
                                        <option <?php if(isset($client) && $client == "HSBC Plc EB"){ echo "selected"; }?>  value="HSBC Plc EB">HSBC Plc EB</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard  Bank Plc Client"){ echo "selected"; }?> value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option>
                                        <option <?php if(isset($client) && $client == "ICBC Standard Bank Plc EB"){ echo "selected"; }?>  value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA Client"){ echo "selected"; }?>  value="JP Morgan NA Client">JP Morgan NA Client</option>
                                        <option <?php if(isset($client) && $client == "JP Morgan NA EB"){ echo "selected"; }?>  value="JP Morgan NA EB">JP Morgan NA EB</option>
                                        <option <?php if(isset($client) && $client == "LDF- G/U JPM"){ echo "selected"; }?>  value="LDF- G/U JPM">LDF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "LSF- G/U JPM"){ echo "selected"; }?>  value="LSF- G/U JPM">LSF- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI"){ echo "selected"; }?>  value="MKP- G/U CITI">MKP- G/U CITI</option>
                                        <option <?php if(isset($client) && $client == "MKP- G/U CITI Client"){ echo "selected"; }?>  value="MKP- G/U CITI Client">MKP- G/U CITI Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int Client"){ echo "selected"; }?>  value="Morgan Stanley Int Client">Morgan Stanley Int Client</option>
                                        <option <?php if(isset($client) && $client == "Morgan Stanley Int EB"){ echo "selected"; }?>  value="Morgan Stanley Int EB">Morgan Stanley Int EB</option>
                                        <option <?php if(isset($client) && $client == "NAB Client"){ echo "selected"; }?>  value="NAB Client">NAB Client</option>
                                        <option <?php if(isset($client) && $client == "NAB EB"){ echo "selected"; }?>  value="NAB EB">NAB EB</option>
                                        <option <?php if(isset($client) && $client == "Natixis Client"){ echo "selected"; }?>  value="Natixis Client">Natixis Client</option>
                                        <option <?php if(isset($client) && $client == "Natixis EB"){ echo "selected"; }?>  value="Natixis EB">Natixis EB</option>
                                        <option <?php if(isset($client) && $client == "Nomura Client"){ echo "selected"; }?>  value="Nomura Client">Nomura Client</option>
                                        <option <?php if(isset($client) && $client == "Nomura EB"){ echo "selected"; }?>  value="Nomura EB">Nomura EB</option>
                                        <option <?php if(isset($client) && $client == "OMEGA-G/U JPM"){ echo "selected"; }?>  value="OMEGA-G/U JPM">OMEGA-G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "OPERA- G/U DB"){ echo "selected"; }?>  value="OPERA- G/U DB">OPERA- G/U DB</option>
                                        <option <?php if(isset($client) && $client == "PERMAL- G/U JPM"){ echo "selected"; }?>  value="PERMAL- G/U JPM">PERMAL- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PRELUDE- G/U JPM"){ echo "selected"; }?>  value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "PROLOGUE- G/U JPM"){ echo "selected"; }?>  value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "Prologue Mapplewood G/U JPM"){ echo "selected"; }?>  value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option>
                                        <option <?php if(isset($client) && $client == "RBC  Client"){ echo "selected"; }?>  value="RBC  Client">RBC  Client</option>
                                        <option <?php if(isset($client) && $client == "RBC  EB"){ echo "selected"; }?>  value="RBC  EB">RBC  EB</option>
                                        <option <?php if(isset($client) && $client == "RBS Client"){ echo "selected"; }?>  value="RBS Client">RBS Client</option>
                                        <option <?php if(isset($client) && $client == "RBS EB"){ echo "selected"; }?>  value="RBS EB">RBS EB</option>
                                        <option <?php if(isset($client) && $client == "RESILIENCE- G/U UBS"){ echo "selected"; }?>  value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option>
                                        <option <?php if(isset($client) && $client == "SEB Client"){ echo "selected"; }?>  value="SEB Client">SEB Client</option>
                                        <option <?php if(isset($client) && $client == "SEB EB"){ echo "selected"; }?>  value="SEB EB">SEB EB</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  Client"){ echo "selected"; }?>  value="Standard Chartered  Client">Standard Chartered  Client</option>
                                        <option <?php if(isset($client) && $client == "Standard Chartered  EB"){ echo "selected"; }?>  value="Standard Chartered  EB">Standard Chartered  EB</option>
                                        <option <?php if(isset($client) && $client == "State Street Client"){ echo "selected"; }?>  value="State Street Client">State Street Client</option>
                                        <option <?php if(isset($client) && $client == "State Street EB"){ echo "selected"; }?>  value="State Street EB">State Street EB</option>
                                        <option <?php if(isset($client) && $client == "UBS AG Client"){ echo "selected"; }?>  value="UBS AG Client">UBS AG Client</option>
                                        <option <?php if(isset($client) && $client == "UBS AG EB"){ echo "selected"; }?>  value="UBS AG EB">UBS AG EB</option>
                                        <option <?php if(isset($client) && $client == "Westpac  Client"){ echo "selected"; }?>  value="Westpac  Client">Westpac  Client</option>
                                        <option <?php if(isset($client) && $client == "Westpac EB"){ echo "selected"; }?>  value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td></td><td></td>
                            <td>Trade Date:</td><td><input  class="all_dates" tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" value="<?=$trade_date;?>"></td>
                            <td>Expiry:</td><td>		
                            <select tabindex="15" name="expiry">								
                            <option <?php if(isset($expiry) && $expiry == "N"){ echo "selected"; }?> value="N">N</option> 						
												    <option <?php if(isset($expiry) && $expiry == "Y"){ echo "selected"; }?> value="Y">Y</option>  
												    </select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	           <option value=""></option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCAD"){ echo "selected"; }?> value="AUDCAD">AUDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDCHF"){ echo "selected"; }?> value="AUDCHF">AUDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDGBP"){ echo "selected"; }?> value="AUDGBP">AUDGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDJPY"){ echo "selected"; }?> value="AUDJPY">AUDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDNZD"){ echo "selected"; }?> value="AUDNZD">AUDNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDSGD"){ echo "selected"; }?> value="AUDSGD">AUDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "AUDUSD"){ echo "selected"; }?> value="AUDUSD">AUDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "BRLHUF"){ echo "selected"; }?> value="BRLHUF">BRLHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CADJPY"){ echo "selected"; }?> value="CADJPY">CADJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "CHFJPY"){ echo "selected"; }?> value="CHFJPY">CHFJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURAUD"){ echo "selected"; }?> value="EURAUD">EURAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURBRL"){ echo "selected"; }?> value="EURBRL">EURBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCAD"){ echo "selected"; }?> value="EURCAD">EURCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCHF"){ echo "selected"; }?> value="EURCHF">EURCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCNH"){ echo "selected"; }?> value="EURCNH">EURCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURCZK"){ echo "selected"; }?> value="EURCZK">EURCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURGBP"){ echo "selected"; }?> value="EURGBP">EURGBP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURHUF"){ echo "selected"; }?> value="EURHUF">EURHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURINR"){ echo "selected"; }?> value="EURINR">EURINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURJPY"){ echo "selected"; }?> value="EURJPY">EURJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURMXN"){ echo "selected"; }?> value="EURMXN">EURMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNOK"){ echo "selected"; }?> value="EURNOK">EURNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURNZD"){ echo "selected"; }?> value="EURNZD">EURNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURPLN"){ echo "selected"; }?> value="EURPLN">EURPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSEK"){ echo "selected"; }?> value="EURSEK">EURSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURSGD"){ echo "selected"; }?> value="EURSGD">EURSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURTRY"){ echo "selected"; }?> value="EURTRY">EURTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURUSD"){ echo "selected"; }?> value="EURUSD">EURUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "EURZAR"){ echo "selected"; }?> value="EURZAR">EURZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPAUD"){ echo "selected"; }?> value="GBPAUD">GBPAUD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCAD"){ echo "selected"; }?> value="GBPCAD">GBPCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCHF"){ echo "selected"; }?> value="GBPCHF">GBPCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPCNH"){ echo "selected"; }?> value="GBPCNH">GBPCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHKD"){ echo "selected"; }?> value="GBPHKD">GBPHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPHUF"){ echo "selected"; }?> value="GBPHUF">GBPHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPILS"){ echo "selected"; }?> value="GBPILS">GBPILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPJPY"){ echo "selected"; }?> value="GBPJPY">GBPJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMXN"){ echo "selected"; }?> value="GBPMXN">GBPMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPMYR"){ echo "selected"; }?> value="GBPMYR">GBPMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNOK"){ echo "selected"; }?> value="GBPNOK">GBPNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPNZD"){ echo "selected"; }?> value="GBPNZD">GBPNZD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPPLN"){ echo "selected"; }?> value="GBPPLN">GBPPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPRUB"){ echo "selected"; }?> value="GBPRUB">GBPRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSEK"){ echo "selected"; }?> value="GBPSEK">GBPSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPSGD"){ echo "selected"; }?> value="GBPSGD">GBPSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPTRY"){ echo "selected"; }?> value="GBPTRY">GBPTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "GBPUSD"){ echo "selected"; }?> value="GBPUSD">GBPUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="GBPZAR">GBPZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "INRJPY"){ echo "selected"; }?> value="INRJPY">INRJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "JPYKRW"){ echo "selected"; }?> value="JPYKRW">JPYKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="MXNJPY">MXNJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKJPY"){ echo "selected"; }?> value="NOKJPY">NOKJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NOKSEK"){ echo "selected"; }?> value="NOKSEK">NOKSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDCAD"){ echo "selected"; }?> value="NZDCAD">NZDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDJPY"){ echo "selected"; }?> value="NZDJPY">NZDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "NZDUSD"){ echo "selected"; }?> value="NZDUSD">NZDUSD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "SGDJPY"){ echo "selected"; }?> value="SGDJPY">SGDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYCZK"){ echo "selected"; }?> value="TRYCZK">TRYCZK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "TRYJPY"){ echo "selected"; }?> value="TRYJPY">TRYJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDBRL"){ echo "selected"; }?> value="USDBRL">USDBRL</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCAD"){ echo "selected"; }?> value="USDCAD">USDCAD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCHF"){ echo "selected"; }?> value="USDCHF">USDCHF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCLP"){ echo "selected"; }?> value="USDCLP">USDCLP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNH"){ echo "selected"; }?> value="USDCNH">USDCNH</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDCNY"){ echo "selected"; }?> value="USDCNY">USDCNY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHKD"){ echo "selected"; }?> value="USDHKD">USDHKD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDHUF"){ echo "selected"; }?> value="USDHUF">USDHUF</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDIDR"){ echo "selected"; }?> value="USDIDR">USDIDR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDILS"){ echo "selected"; }?> value="USDILS">USDILS</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDINR"){ echo "selected"; }?> value="USDINR">USDINR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDJPY"){ echo "selected"; }?> value="USDJPY">USDJPY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDKRW"){ echo "selected"; }?> value="USDKRW">USDKRW</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMXN"){ echo "selected"; }?> value="USDMXN">USDMXN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDMYR"){ echo "selected"; }?> value="USDMYR">USDMYR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDNOK"){ echo "selected"; }?> value="USDNOK">USDNOK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPHP"){ echo "selected"; }?> value="USDPHP">USDPHP</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDPLN"){ echo "selected"; }?> value="USDPLN">USDPLN</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDRUB"){ echo "selected"; }?> value="USDRUB">USDRUB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSEK"){ echo "selected"; }?> value="USDSEK">USDSEK</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDSGD"){ echo "selected"; }?> value="USDSGD">USDSGD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTHB"){ echo "selected"; }?> value="USDTHB">USDTHB</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTRY"){ echo "selected"; }?> value="USDTRY">USDTRY</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDTWD"){ echo "selected"; }?> value="USDTWD">USDTWD</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "USDZAR"){ echo "selected"; }?> value="USDZAR">USDZAR</option>
                                         <option <?php if(isset($ccy_pair) && $ccy_pair == "XAUUSD"){ echo "selected"; }?> value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	  <td>Mid Price:</td><td><input type="text" value="<?=$mid_price;?>" name="mid_price"></td>
                            <td>Value Date:</td><td><input  class="all_dates" type="text" placeholder="dd/mm/yy" tabindex="11"  name="value_date" value="<?=$value_date;?>"></td>
                            <td>Cut Time:</td><td>
                                <select tabindex="17" name="cut_time">
                                    <option <?php if(isset($cut_time) && $cut_time == "10:00"){ echo "selected"; }?> value="10:00">10:00</option>
							                      <option <?php if(isset($cut_time) && $cut_time == "15:00"){ echo "selected"; }?> value="15:00">15:00</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell:</td><td><select tabindex="3" name="buy_sell">
                                <option value="" selected="selected"></option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "B"){ echo "selected"; }?> value="B">B</option>
                                <option <?php if(isset($buy_sell) && $buy_sell == "S"){ echo "selected"; }?> value="S">S</option></select>
                          </td>
                        	
                          
                        	 <td></td><td></td>
                            <td>Traded As:</td><td>
                                  <select tabindex="12" name="traded_as">
                                      <option value=""></option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FX"){ echo "selected"; }?> value="FX" >FX</option>
                                      <option <?php if(isset($traded_as) && $traded_as == "FXBACKOFFICE"){ echo "selected"; }?> value="FXBACKOFFICE">FXBACKOFFICE</option>
                                  </select>
                            </td>
                            <td>Settlement:</td><td>
                              <select tabindex="18" name="settlement">
                                <option value=""></option>
              								 <option <?php if(isset($settlement) && $settlement == "PHYSICAL"){ echo "selected"; }?> value="PHYSICAL">PHYSICAL</option>
              								 <option <?php if(isset($settlement) && $settlement == "CASH"){ echo "selected"; }?> value="CASH">CASH</option></select>
                            </td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td>Calc:</td>
                          <td>
                              <select tabindex="9" name="calc">
                              <option <?php if(isset($calc) && $calc == "Multiply"){ echo "selected"; }?> value="Multiply">Multiply</option>
												      <option <?php if(isset($calc) && $calc == "Divide"){ echo "selected"; }?> value="Divide">Divide</option></select>
                            
                            </td>
                            
                           <td>Prime broker:</td><td><select tabindex="13" name="prime_broker">
                              <option value="">...</option>
                              <!--<option value="CITI" >CITI</option>-->
                              <option <?php if(isset($prime_broker) && $prime_broker == "RBS"){ echo "selected"; }?> value="RBS">RBS</option>
                              <option <?php if(isset($prime_broker) && $prime_broker == "TEST"){ echo "selected"; }?> value="TEST">TEST</option></select></td>
                              
                            <td>FX_PAIR ID:</td><td><input name="fx_pair_id" disabled value="fxp_123" value="<?=$fx_pair_id;?>" type="text"></td>
                        </tr>
                        <tr>
                       
                        	<td><select style="display:none;" tabindex="5" name="inverted">
                            <option value=""></option>
												    <option value="I" <?php if(isset($inverted) && $inverted == "I"){ echo "selected"; }?>>I</option></select></td>
                            
                        	<td></td> 
                          <td>Deliverability:</td>
                             <td>
                             <select tabindex="10" name="deliverablity">
      												<option <?php if(isset($deliverablity) && $deliverablity == "ND"){ echo "selected"; }?> value="ND">ND</option>
      												<option <?php if(isset($deliverablity) && $deliverablity == "D"){ echo "selected"; }?> value="D">D</option>
      											 </select>
                            </td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" value="<?=$order_entry_time;?>" type="text" ></td>
                            <td>Matching Date:</td><td><input  class="all_dates" placeholder="dd/mm/yy" tabindex="19"  value="<?=$matching_date;?>" name="match_date" type="text"></td>
                        </tr>
                        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                       
            						<tr>
            							<td>Expiry:</td><td><input type="text"  class="all_dates" name="expiry_date" value="<?=$expiry_date;?>" onchange=" var nd =  $('#fxopt_exp').val().split('/'); var nd = new Date(nd[2] + '/'+nd[1]+'/'+nd[0]);nd.setDate(nd.getDate()+2); $('#fxopt_st').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>
            							<td>Cut:</td>
                          <td>
                                  <select tabindex="16" name="spcut">
                                  <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
        										      <option <?php if(isset($spcut) && $spcut == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
        										      <option <?php if(isset($spcut) && $spcut == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">ECB</option>
        										      <option <?php if(isset($spcut) && $spcut == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select>
                          </td>
            							<td>Premium CCY:</td><td><input type="text" value="<?=$premium_ccy;?>" name="premium_ccy" id="fxopt_premccy"></td>
            							<td></td><td></td>
            						</tr>
                        <tr>
                        	  <td>Settelment:</td><td><input  class="all_dates" type="text" value="<?=$settle_date;?>" name="settle_date"></td>
                            <td>Notional:</td><td><input type="text" name="notional" value="<?=$Notional;?>" id="fxopt_not" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                            <td>Payout CCY:</td><td><input type="text" value="<?=$payout_ccy;?>" name="payout_ccy" id="fxopt_payout"></td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                        	<td>C/P:</td><td>
                          <select name="spcut_cp">
                               <option <?php if(isset($spcut_cp) && $spcut_cp == "NEW YORK"){ echo "selected"; }?> value="NEW YORK">NEW YORK</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "TOKYO"){ echo "selected"; }?> value="TOKYO">TOKYO</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "ECB"){ echo "selected"; }?> value="ECB">ECB</option>
          										 <option <?php if(isset($spcut_cp) && $spcut_cp == "WMC"){ echo "selected"; }?> value="WMC">WMC</option></select></td>
                              <td style="color:#BF3739;">PRICE %:</td><td><input type="text" name="price_percentage" value="<?=$price_percentage;?>" id="fxopt_price" onBlur="$('#fxopt_premamt').val(parseInt($('#fxopt_not').val().replace(/,/g,'')) * parseFloat($('#fxopt_price').val()));"></td>
                              <td>Option Style:</td><td>
                                  <select name="option_style">
                                  <option <?php if(isset($option_style) && $option_style == "American"){ echo "selected"; }?> >American</option>
                                  <option <?php if(isset($option_style) && $option_style == "European"){ echo "selected"; }?> >European</option></select>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        	  <td>Strike:</td><td><input type="text" value="<?=$strike;?>" name="strike"></td>
                            <td style="color:#BF3739;">Premium amount:</td><td><input name="premium_amount" value="<?=$premium_amount;?>" type="text" id="fxopt_premamt"></td>
                            <td>Calculations:</td><td>
                                          <select name="calculations">
                							              <option <?php if(isset($calculations) && $calculations == "Reset"){ echo "selected"; }?> >Reset</option>
                                            <option <?php if(isset($calculations) && $calculations == "Base Cash"){ echo "selected"; }?> >Base Cash</option>
                                            <option <?php if(isset($calculations) && $calculations == "Counter Cash"){ echo "selected"; }?> >Counter Cash</option>
                                            <option <?php if(isset($calculations) && $calculations == "Base %"){ echo "selected"; }?> >Base %</option>
                                            <option <?php if(isset($calculations) && $calculations == "Counter %"){ echo "selected"; }?> >Counter %</option>
                                                        
                            						</select></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <tr style="margin-top:15px;">
                        	   <td>Option Type:</td><td><input value="<?=$opt_type;?>" name="opt_type" type="text"></td>
                            <td>Lower_Barrier:</td><td><input value="<?=$lower_barrier;?>" name="lower_barrier" type="text"></td>
                            <td>Cash At:</td>
                            <td>
                                  <select name="cashat">
                                        <option <?php if(isset($cashat) && $cashat == "Counter %"){ echo "selected"; }?>  value="Maturity">Maturity</option>
                                  </select>
                            </td>
                            <td>Upper&nbsp;Barrier:</td>
                            <td><input name="up_barrier_sd" class="all_dates" value="<?=$up_barrier_sd;?>"  type="text" placeholder="start date"><br>
                                <input name="up_barrier_ed" class="all_dates" value="<?=$up_barrier_ed;?>"  type="text" placeholder="end date"></td>
                        </tr>
                        <tr>
                        	<td>Barrier&nbsp;Type:</td><td><input value="<?=$barrier_type;?>"  name="barrier_type" type="text"></td>
                            <td>Knock&ndash;in&ndash;out(I/O):</td><td><input  value="<?=$knock_in_out;?>" name="knock_in_out" type="text"></td>
                            <td>Rebate_CCY:</td><td><input type="text" value="<?=$rebate_ccy;?>" name="rebate_ccy"></td>
                            <td>Lower&nbsp;Barrier:</td>
                            <td><input type="text"  class="all_dates" value="<?=$lw_barrier_sd;?>" name="lw_barrier_sd" placeholder="start date"><br>
                                <input type="text" placeholder="end date"  class="all_dates" value="<?=$lw_barrier_ed;?>"  name="lw_barrier_ed"></td>
                        </tr>
                        <tr>
                        	  <td>Upper Barrier:</td><td><input  value="<?=$up_barrier;?>" name="up_barrier" type="text"></td>
                            <td>Touch&ndash;up&ndash;down:</td><td><input type="text"  value="<?=$touch_up_down;?>" name="touch_up_down"></td>
                            <td>Rebate&nbsp;Amount:</td><td><input type="text" value="<?=$rebate_amt;?>" name="rebate_amt"></td>
                            <td>Barrier&nbsp;Style:</td>
                            <td>
                                <select name="barrier_style">
                                    <option <?php if(isset($barrier_style) && $barrier_style == "Counter %"){ echo "selected"; }?>>American</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td>Middle Barrier:</td><td><input name="mid_barrier" value="<?=$mid_barrier;?>"  type="text"></td>
                        </tr>
                    </tbody>
                </table>
				</form>
            </div>
        </div>
        <!--------------------------------------------------------------------------------------------------------------->
        
    </div>
   <div class="row" style="margin-top:10px;"><style>input[type="button"]{margin-right:15px;}</style>
    	<input type="button" class="btn btn-primary" value="Save &amp; Copy" onclick="save_copy();">
        <input type="button" class="btn btn-primary" value="Save &amp; New" onclick="save_new();">
        <input type="button" class="btn btn-success" value="Save &amp; Close" onclick="save_close();">
        <input type="button" class="btn btn-danger" value="Cancel" onClick="$('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); $('#container2').hide(); $('#back').hide(); window.clearInterval(timeupdate); $('#back').html('');">
    </div>
	</div>
	<script>
  
  
  
	   $(document).ready(function(){
          $('input','select').bind('keypress', function(eInner) {
              if (eInner.keyCode == 13) //if its a enter key
              {
                  var tabindex = $(this).attr('tabindex');
                  tabindex++; //increment tabindex
                  $('[tabindex=' + tabindex + ']').focus();
      
                  //$('#Msg').text($(this).attr('id') + " tabindex: " + tabindex + " next element: " + $('*').attr('tabindex').id);
      
      
                  // to cancel out Onenter page postback in asp.net
                  return false;
              }
    	     });
      
      $(".all_dates").datepicker({ dateFormat: 'dd/mm/yy' });
      
      /*
	    $("#fxsp_vd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxsp_td").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxsp_md").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxfw_vd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxfw_td").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxfw_md").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxndf_vd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxndf_td").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxndf_md").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxndf_fd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxopt_td").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxopt_vd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxopt_md").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxopt_exp").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#fxopt_st").datepicker({ dateFormat: 'dd/mm/yy' });
			
			$("#eopt_td").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_vd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_md").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_exp").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_st").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_ubsd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_ubed").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_lbsd").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#eopt_lbed").datepicker({ dateFormat: 'dd/mm/yy' });
      */
      
			});
		function ch_contract(){
			var val = $("#contract").val();
			$("#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT").hide();
			$('#'+val).show();
		}
	function save_close(){
			var val = $("#contract").val();
			val = "form#"+val+"_form";			
			$.ajax({
					//url: "http://www.curvemarkets.com/auth/admin/store.php?contract="+$("#contract").val()+"&account="+$("#account").val(),
          url: "store.php?contract="+$("#contract").val()+"&account="+$("#account").val()+"&status="+$("#status").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
				}).done(function( data ) {
					
          //alert(data);
          $('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); 
          $('#container2').hide(); 
          $('#back').hide();
					window.clearInterval(timeupdate);
					getrecord();
					$("#back").html("");
          
				});
		}
		function save_new(){
			var val = $("#contract").val();
			val = "form#"+val+"_form";			
			$.ajax({
				  url: "store.php?contract="+$("#contract").val()+"&account="+$("#account").val()+"&status="+$("#status").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
				}).done(function( data ) {
        
           var myform = $("#contract").val() + "_form";
           $("#" + myform).find("input[type=text],input[type=hidden], textarea").val("");
          
           $("#" + myform + " select option:first-child").attr("selected", "selected");
          
				});
		}
		function save_copy(){
			var val = $("#contract").val();
			val = "form#"+val+"_form";			
			$.ajax({
					
          url: "store.php?contract="+$("#contract").val()+"&account="+$("#account").val()+"&status="+$("#status").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
          
				}).done(function( data ) {
        
					alert('Data Saved');
					
          var myform = $("#contract").val() + "_form";
          $("#" + myform).find("input[type=hidden]").val("");
          
				});
		}
	</script>
	<?php
	}
	?>