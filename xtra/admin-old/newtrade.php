<?php
session_start();
require_once('../inc/def.php');
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
                <div style="float:right;"><label class="label lb-left" style="background-color:#46D430;">Contract</label><label class="label lb-right" style="padding-right:3px;"><select id="contract" onChange="ch_contract();">
                        	<option value="FXSP">FXSP</option>
                            <option value="FXFW">FXFW</option>
                            <option value="FXNDF">FXNDF</option>
                            <option value="FXOPT">FXOPT</option>
                            <option value="EOPT">EOPT</option>
                 		</select></label>
						<label class="label lb-left" style="background-color:#46D430;">Account</label><label class="label lb-right" style="padding-right:3px;"><select id="account">
                        	<option value="Curve" selected>Curve</option>
                            <option value="Curve_MP">Curve_MP</option>
                 		</select></label><label class="label lb-left">Trade Status</label><label class="label lb-right" style="padding-right:3px;"><select>
                 		<option>Active</option>
                        <option>Abandoned</option>
                        <option>Excercise</option>
                        <option>Triggered</option>
                        <option>SETTELED</option>
                        <option>NOVATED</option>
                        <option>TEARUP</option>
                    </select></label></div>
        	</div>
        </div>
        <div class="row" id="FXSP">
        	<div class="col-xs-12" style="background-color:#eee;">
				<form id="FXSP_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
            	<table class="table" border="0">
                	<tbody>
                    	<tr>
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option><option value="BALDR-G/U RBS   ">BALDR-G/U RBS   </option><option value="Bank of America Client">Bank of America Client</option><option value="Bank of America EB">Bank of America EB</option><option value="Barclays Bank Plc Client">Barclays Bank Plc Client</option><option value="Barclays Bank Plc EB">Barclays Bank Plc EB</option><option value="BNP Paribas Client">BNP Paribas Client</option><option value="BNP Paribas EB">BNP Paribas EB</option><option value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option><option value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option><option value="CitiGroup Client">CitiGroup Client</option><option value="CitiGroup EB">CitiGroup EB</option><option value="Credit Agricole  Client">Credit Agricole  Client</option><option value="Credit Agricole  EB">Credit Agricole  EB</option><option value="Credit Suisse AG Client">Credit Suisse AG Client</option><option value="Credit Suisse AG EB">Credit Suisse AG EB</option><option value="CURVE_MP">CURVE_MP</option><option value="Goldman Sachs  Client">Goldman Sachs  Client</option><option value="Goldman Sachs  EB">Goldman Sachs  EB</option><option value="GRATICULE- G/U Client">GRATICULE- G/U Client</option><option value="GRATICULE- G/U DB">GRATICULE- G/U DB</option><option value="HSBC Plc Client">HSBC Plc Client</option><option value="HSBC Plc EB">HSBC Plc EB</option><option value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option><option value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option><option value="JP Morgan NA Client">JP Morgan NA Client</option><option value="JP Morgan NA EB">JP Morgan NA EB</option><option value="LDF- G/U JPM">LDF- G/U JPM</option><option value="LSF- G/U JPM">LSF- G/U JPM</option><option value="MKP- G/U CITI">MKP- G/U CITI</option><option value="MKP- G/U CITI Client">MKP- G/U CITI Client</option><option value="Morgan Stanley Int Client">Morgan Stanley Int Client</option><option value="Morgan Stanley Int EB">Morgan Stanley Int EB</option><option value="NAB Client">NAB Client</option><option value="NAB EB">NAB EB</option><option value="Natixis Client">Natixis Client</option><option value="Natixis EB">Natixis EB</option><option value="Nomura Client">Nomura Client</option><option value="Nomura EB">Nomura EB</option><option value="OMEGA-G/U JPM">OMEGA-G/U JPM</option><option value="OPERA- G/U DB">OPERA- G/U DB</option><option value="PERMAL- G/U JPM">PERMAL- G/U JPM</option><option value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option><option value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option><option value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option><option value="RBC  Client">RBC  Client</option><option value="RBC  EB">RBC  EB</option><option value="RBS Client">RBS Client</option><option value="RBS EB">RBS EB</option><option value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option><option value="SEB Client">SEB Client</option><option value="SEB EB">SEB EB</option><option value="Standard Chartered  Client">Standard Chartered  Client</option><option value="Standard Chartered  EB">Standard Chartered  EB</option><option value="State Street Client">State Street Client</option><option value="State Street EB">State Street EB</option><option value="UBS AG Client">UBS AG Client</option><option value="UBS AG EB">UBS AG EB</option><option value="Westpac  Client">Westpac  Client</option><option value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td>Rate:</td><td><input tabindex="6" id="fxsp_rate" type="text" name="rate" onBlur="$('#fxsp_camt').val(parseInt($('#fxsp_not').val().replace(/,/g,'')) * parseFloat($('#fxsp_rate').val()));"></td>
                            <td>Trade Date:</td><td><input tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" id="fxsp_td"></td>
                            <td>Expiry:</td><td>		<select tabindex="15" name="expiry">								<option value="N" selected="selected">N</option> 						
												<option value="Y">Y</option>
												</select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxsp_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxsp_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxsp_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxsp_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}">
                            	<option value=""></option><option value="AUDCAD">AUDCAD</option><option value="AUDCHF">AUDCHF</option><option value="AUDGBP">AUDGBP</option><option value="AUDJPY">AUDJPY</option><option value="AUDNZD">AUDNZD</option><option value="AUDSGD">AUDSGD</option><option value="AUDUSD">AUDUSD</option><option value="BRLHUF">BRLHUF</option><option value="CADJPY">CADJPY</option><option value="CHFJPY">CHFJPY</option><option value="EURAUD">EURAUD</option><option value="EURBRL">EURBRL</option><option value="EURCAD">EURCAD</option><option value="EURCHF">EURCHF</option><option value="EURCNH">EURCNH</option><option value="EURCZK">EURCZK</option><option value="EURGBP">EURGBP</option><option value="EURHUF">EURHUF</option><option value="EURINR">EURINR</option><option value="EURJPY">EURJPY</option><option value="EURMXN">EURMXN</option><option value="EURNOK">EURNOK</option><option value="EURNZD">EURNZD</option><option value="EURPLN">EURPLN</option><option value="EURSEK">EURSEK</option><option value="EURSGD">EURSGD</option><option value="EURTRY">EURTRY</option><option value="EURUSD">EURUSD</option><option value="EURZAR">EURZAR</option><option value="GBPAUD">GBPAUD</option><option value="GBPCAD">GBPCAD</option><option value="GBPCHF">GBPCHF</option><option value="GBPCNH">GBPCNH</option><option value="GBPHKD">GBPHKD</option><option value="GBPHUF">GBPHUF</option><option value="GBPILS">GBPILS</option><option value="GBPJPY">GBPJPY</option><option value="GBPMXN">GBPMXN</option><option value="GBPMYR">GBPMYR</option><option value="GBPNOK">GBPNOK</option><option value="GBPNZD">GBPNZD</option><option value="GBPPLN">GBPPLN</option><option value="GBPRUB">GBPRUB</option><option value="GBPSEK">GBPSEK</option><option value="GBPSGD">GBPSGD</option><option value="GBPTRY">GBPTRY</option><option value="GBPUSD">GBPUSD</option><option value="GBPZAR">GBPZAR</option><option value="INRJPY">INRJPY</option><option value="JPYKRW">JPYKRW</option><option value="MXNJPY">MXNJPY</option><option value="NOKJPY">NOKJPY</option><option value="NOKSEK">NOKSEK</option><option value="NZDCAD">NZDCAD</option><option value="NZDJPY">NZDJPY</option><option value="NZDUSD">NZDUSD</option><option value="SGDJPY">SGDJPY</option><option value="TRYCZK">TRYCZK</option><option value="TRYJPY">TRYJPY</option><option value="USDBRL">USDBRL</option><option value="USDCAD">USDCAD</option><option value="USDCHF">USDCHF</option><option value="USDCLP">USDCLP</option><option value="USDCNH">USDCNH</option><option value="USDCNY">USDCNY</option><option value="USDHKD">USDHKD</option><option value="USDHUF">USDHUF</option><option value="USDIDR">USDIDR</option><option value="USDILS">USDILS</option><option value="USDINR">USDINR</option><option value="USDJPY">USDJPY</option><option value="USDKRW">USDKRW</option><option value="USDMXN">USDMXN</option><option value="USDMYR">USDMYR</option><option value="USDNOK">USDNOK</option><option value="USDPHP">USDPHP</option><option value="USDPLN">USDPLN</option><option value="USDRUB">USDRUB</option><option value="USDSEK">USDSEK</option><option value="USDSGD">USDSGD</option><option value="USDTHB">USDTHB</option><option value="USDTRY">USDTRY</option><option value="USDTWD">USDTWD</option><option value="USDZAR">USDZAR</option><option value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td></td><td></td>
                            <td>Value Date</td><td><input type="text" placeholder="dd/mm/yy" tabindex="11"  id="fxsp_vd" name="value_date"></td>
                            <td>SPCUT</td><td><select tabindex="16" name="spcut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell</td><td><select tabindex="3" name="buy_sell"><option value="" selected="selected"></option><option value="B">B</option><option value="S">S</option></select></td>
                        	<td>Counter Amount</td><td><input tabindex="8" name="counter_amt" id="fxsp_camt" type="text"></td>
                            <td>Traded As</td><td><select tabindex="12" name="traded_as"><option value=""></option><option value="FX" selected="true">FX</option><option value="FXBACKOFFICE">FXBACKOFFICE</option></select></td>
                            <td>Cut Time</td><td><select tabindex="17" name="cut_time"><option value="10:00">10:00</option>
										 <option value="15:00">15:00</option></select></td>
                        </tr>
                        <tr>
                        	<td>Notional:</td><td><input tabindex="4" name="notional" id="fxsp_not" type="text" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc</td><td><select tabindex="9" name="calc"><option value="Multiply" selected="selected">Multiply</option>
												<option value="Divide">Divide</option></select></td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker"><option value="">...</option>
                                                                                                                <!--<option value="CITI" >CITI</option>-->
                                                                                                                <option selected="selected" value="RBS">RBS</option>
                                                                                                                <option value="TEST">TEST</option></select></td>
                            <td>Settlement</td><td><select tabindex="18" name="settlement"><option value=""></option>
								 <option value="PHYSICAL">PHYSICAL</option>
								 <option value="CASH">CASH</option></select></td>
                        </tr>
                        <tr>
                        	<td></td><td><select style="display:none;" tabindex="5" name="inverted"><option value="" selected></option>
												<option value="I">I</option></select></td>
                        	<td></td><td></td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxsp_oet" name="order_entry_time" type="text" ></td>
                            <td>FX_PAIR ID</td><td><input name="fx_pair_id" disabled value="fxp_123" type="text"></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td></td><td></td>
                            <td></td><td></td>
                            <td>Matching Date</td><td><input placeholder="dd/mm/yy" tabindex="19" id="fxsp_md" name="match_date" type="text"></td>
							<td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
                        </tr>
                    </tbody>
                </table>
				</form>
            </div>
        </div>
        
        <!-- ***************************************************************  -->
        <div class="row" id="FXFW">
        	<div class="col-xs-12" style="background-color:#eee;">
				<form id="FXFW_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
            	<table class="table" border="0">	
                	<tbody>
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
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxfw_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxfw_oet').val($('#gmtime').html());  $('#fxfw_td').val($.datepicker.formatDate('dd/mm/yy',date)); ">
                            	<option value=""></option><option value="AUDCAD">AUDCAD</option><option value="AUDCHF">AUDCHF</option><option value="AUDGBP">AUDGBP</option><option value="AUDJPY">AUDJPY</option><option value="AUDNZD">AUDNZD</option><option value="AUDSGD">AUDSGD</option><option value="AUDUSD">AUDUSD</option><option value="BRLHUF">BRLHUF</option><option value="CADJPY">CADJPY</option><option value="CHFJPY">CHFJPY</option><option value="EURAUD">EURAUD</option><option value="EURBRL">EURBRL</option><option value="EURCAD">EURCAD</option><option value="EURCHF">EURCHF</option><option value="EURCNH">EURCNH</option><option value="EURCZK">EURCZK</option><option value="EURGBP">EURGBP</option><option value="EURHUF">EURHUF</option><option value="EURINR">EURINR</option><option value="EURJPY">EURJPY</option><option value="EURMXN">EURMXN</option><option value="EURNOK">EURNOK</option><option value="EURNZD">EURNZD</option><option value="EURPLN">EURPLN</option><option value="EURSEK">EURSEK</option><option value="EURSGD">EURSGD</option><option value="EURTRY">EURTRY</option><option value="EURUSD">EURUSD</option><option value="EURZAR">EURZAR</option><option value="GBPAUD">GBPAUD</option><option value="GBPCAD">GBPCAD</option><option value="GBPCHF">GBPCHF</option><option value="GBPCNH">GBPCNH</option><option value="GBPHKD">GBPHKD</option><option value="GBPHUF">GBPHUF</option><option value="GBPILS">GBPILS</option><option value="GBPJPY">GBPJPY</option><option value="GBPMXN">GBPMXN</option><option value="GBPMYR">GBPMYR</option><option value="GBPNOK">GBPNOK</option><option value="GBPNZD">GBPNZD</option><option value="GBPPLN">GBPPLN</option><option value="GBPRUB">GBPRUB</option><option value="GBPSEK">GBPSEK</option><option value="GBPSGD">GBPSGD</option><option value="GBPTRY">GBPTRY</option><option value="GBPUSD">GBPUSD</option><option value="GBPZAR">GBPZAR</option><option value="INRJPY">INRJPY</option><option value="JPYKRW">JPYKRW</option><option value="MXNJPY">MXNJPY</option><option value="NOKJPY">NOKJPY</option><option value="NOKSEK">NOKSEK</option><option value="NZDCAD">NZDCAD</option><option value="NZDJPY">NZDJPY</option><option value="NZDUSD">NZDUSD</option><option value="SGDJPY">SGDJPY</option><option value="TRYCZK">TRYCZK</option><option value="TRYJPY">TRYJPY</option><option value="USDBRL">USDBRL</option><option value="USDCAD">USDCAD</option><option value="USDCHF">USDCHF</option><option value="USDCLP">USDCLP</option><option value="USDCNH">USDCNH</option><option value="USDCNY">USDCNY</option><option value="USDHKD">USDHKD</option><option value="USDHUF">USDHUF</option><option value="USDIDR">USDIDR</option><option value="USDILS">USDILS</option><option value="USDINR">USDINR</option><option value="USDJPY">USDJPY</option><option value="USDKRW">USDKRW</option><option value="USDMXN">USDMXN</option><option value="USDMYR">USDMYR</option><option value="USDNOK">USDNOK</option><option value="USDPHP">USDPHP</option><option value="USDPLN">USDPLN</option><option value="USDRUB">USDRUB</option><option value="USDSEK">USDSEK</option><option value="USDSGD">USDSGD</option><option value="USDTHB">USDTHB</option><option value="USDTRY">USDTRY</option><option value="USDTWD">USDTWD</option><option value="USDZAR">USDZAR</option><option value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td>Mid Price</td><td><input tabindex="7" type="text" name="mid_price"></td>
                            <td>Value Date</td><td><input placeholder="dd/mm/yy" tabindex="12" type="text" id="fxfw_vd" name="value_date"></td>
                            <td>SPCUT</td><td><select name="spcut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell</td><td><select tabindex="3" name="buy_sell"><option value="" selected="selected"></option><option value="B">B</option><option value="S">S</option></select></td>
                        	<td>Counter Amount</td><td><input tabindex="8" name="counter_amt" id="fxfw_camt" type="text"></td>
                            <td>Traded As</td><td><select tabindex="13" name="traded_as"><option value=""></option><option value="FX" selected>FX</option><option value="FXBACKOFFICE">FXBACKOFFICE</option></select></td>
                            <td>Cut Time</td><td><select name="cut_time"><option value="10:00">10:00</option>
										 <option value="15:00">15:00</option></select></td>
                        </tr>
                        <tr>
                        	<td>Notional:</td><td><input tabindex="4" name="notional" id="fxfw_not" type="text" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc</td><td><select tabindex="9" name="calc"><option value="Multiply" selected="selected">Multiply</option>
												<option value="Divide">Divide</option></select></td>
                            <td>Prime broker:</td><td><select name="prime_broker"><option value="">...</option>
                                                                                                                <!--<option value="CITI" >CITI</option>-->
                                                                                                                <option selected="selected" value="RBS">RBS</option>
                                                                                                                <option value="TEST">TEST</option></select></td>
                            <td>Settlement</td><td><select name="settlement"><option value=""></option>
								 <option value="PHYSICAL">PHYSICAL</option>
								 <option value="CASH">CASH</option></select></td>
                        </tr>
                        <tr>
                        	<td></td><td><select tabindex="5" style="display:none;" name="inverted"><option selected value=""></option>
												<option value="I">I</option></select></td>
                        	<td>Deliverability :</td><td><select tabindex="10" name="deliverablity">
												<option value="ND">ND</option>
												<option value="D" selected="selected">D</option>
											</select></td>
                            <td>Order Entry time:</td><td><input id="fxfw_oet" name="order_entry_time" type="text"></td>
                            <td>FX_PAIR ID</td><td><input name="fx_pair_id" disabled value="fxp_123" type="text"></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td></td><td></td>
                            <td></td><td></td>
                            <td>Matching Date</td><td><input placeholder="dd/mm/yy" id="fxfw_md" name="match_date" type="text"></td>
							<td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
                        </tr>
                    </tbody>
                </table>
				</form>
            </div>
        </div>
        <!--------------------------------------------------------------------------------------------------------------->
         <!-- ***************************************************************  -->
        <div class="row" id="FXNDF">
        	<div class="col-xs-12" style="background-color:#eee;">
			<form id="FXNDF_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
            	<table class="table" border="0">
                	<tbody>
                    	<tr>
                        	<td>Client:</td><td><select tabindex="1" name="client">
                            						<option value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option><option value="BALDR-G/U RBS   ">BALDR-G/U RBS   </option><option value="Bank of America Client">Bank of America Client</option><option value="Bank of America EB">Bank of America EB</option><option value="Barclays Bank Plc Client">Barclays Bank Plc Client</option><option value="Barclays Bank Plc EB">Barclays Bank Plc EB</option><option value="BNP Paribas Client">BNP Paribas Client</option><option value="BNP Paribas EB">BNP Paribas EB</option><option value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option><option value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option><option value="CitiGroup Client">CitiGroup Client</option><option value="CitiGroup EB">CitiGroup EB</option><option value="Credit Agricole  Client">Credit Agricole  Client</option><option value="Credit Agricole  EB">Credit Agricole  EB</option><option value="Credit Suisse AG Client">Credit Suisse AG Client</option><option value="Credit Suisse AG EB">Credit Suisse AG EB</option><option value="CURVE_MP">CURVE_MP</option><option value="Goldman Sachs  Client">Goldman Sachs  Client</option><option value="Goldman Sachs  EB">Goldman Sachs  EB</option><option value="GRATICULE- G/U Client">GRATICULE- G/U Client</option><option value="GRATICULE- G/U DB">GRATICULE- G/U DB</option><option value="HSBC Plc Client">HSBC Plc Client</option><option value="HSBC Plc EB">HSBC Plc EB</option><option value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option><option value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option><option value="JP Morgan NA Client">JP Morgan NA Client</option><option value="JP Morgan NA EB">JP Morgan NA EB</option><option value="LDF- G/U JPM">LDF- G/U JPM</option><option value="LSF- G/U JPM">LSF- G/U JPM</option><option value="MKP- G/U CITI">MKP- G/U CITI</option><option value="MKP- G/U CITI Client">MKP- G/U CITI Client</option><option value="Morgan Stanley Int Client">Morgan Stanley Int Client</option><option value="Morgan Stanley Int EB">Morgan Stanley Int EB</option><option value="NAB Client">NAB Client</option><option value="NAB EB">NAB EB</option><option value="Natixis Client">Natixis Client</option><option value="Natixis EB">Natixis EB</option><option value="Nomura Client">Nomura Client</option><option value="Nomura EB">Nomura EB</option><option value="OMEGA-G/U JPM">OMEGA-G/U JPM</option><option value="OPERA- G/U DB">OPERA- G/U DB</option><option value="PERMAL- G/U JPM">PERMAL- G/U JPM</option><option value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option><option value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option><option value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option><option value="RBC  Client">RBC  Client</option><option value="RBC  EB">RBC  EB</option><option value="RBS Client">RBS Client</option><option value="RBS EB">RBS EB</option><option value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option><option value="SEB Client">SEB Client</option><option value="SEB EB">SEB EB</option><option value="Standard Chartered  Client">Standard Chartered  Client</option><option value="Standard Chartered  EB">Standard Chartered  EB</option><option value="State Street Client">State Street Client</option><option value="State Street EB">State Street EB</option><option value="UBS AG Client">UBS AG Client</option><option value="UBS AG EB">UBS AG EB</option><option value="Westpac  Client">Westpac  Client</option><option value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td>Rate:</td><td><input type="text" id="fxndf_rate" onBlur="$('#fxndf_camt').val(parseInt($('#fxndf_not').val().replace(/,/g,'')) * parseFloat($('#fxndf_rate').val()));" name="rate"></td>
                            <td>Trade Date:</td><td><input placeholder="dd/mm/yy" type="text" name="trade_date" id="fxndf_td"></td>
                            <td>Expiry:</td><td>		<select name="expiry">								<option value="N" selected="selected">N</option> 						
												<option value="Y">Y</option>
												</select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select name="ccy_pair" onchange=" $('#fxndf_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxndf_oet').val($('#gmtime').html());  $('#fxndf_td').val($.datepicker.formatDate('dd/mm/yy',date)); ">
                            	<option value=""></option><option value="AUDCAD">AUDCAD</option><option value="AUDCHF">AUDCHF</option><option value="AUDGBP">AUDGBP</option><option value="AUDJPY">AUDJPY</option><option value="AUDNZD">AUDNZD</option><option value="AUDSGD">AUDSGD</option><option value="AUDUSD">AUDUSD</option><option value="BRLHUF">BRLHUF</option><option value="CADJPY">CADJPY</option><option value="CHFJPY">CHFJPY</option><option value="EURAUD">EURAUD</option><option value="EURBRL">EURBRL</option><option value="EURCAD">EURCAD</option><option value="EURCHF">EURCHF</option><option value="EURCNH">EURCNH</option><option value="EURCZK">EURCZK</option><option value="EURGBP">EURGBP</option><option value="EURHUF">EURHUF</option><option value="EURINR">EURINR</option><option value="EURJPY">EURJPY</option><option value="EURMXN">EURMXN</option><option value="EURNOK">EURNOK</option><option value="EURNZD">EURNZD</option><option value="EURPLN">EURPLN</option><option value="EURSEK">EURSEK</option><option value="EURSGD">EURSGD</option><option value="EURTRY">EURTRY</option><option value="EURUSD">EURUSD</option><option value="EURZAR">EURZAR</option><option value="GBPAUD">GBPAUD</option><option value="GBPCAD">GBPCAD</option><option value="GBPCHF">GBPCHF</option><option value="GBPCNH">GBPCNH</option><option value="GBPHKD">GBPHKD</option><option value="GBPHUF">GBPHUF</option><option value="GBPILS">GBPILS</option><option value="GBPJPY">GBPJPY</option><option value="GBPMXN">GBPMXN</option><option value="GBPMYR">GBPMYR</option><option value="GBPNOK">GBPNOK</option><option value="GBPNZD">GBPNZD</option><option value="GBPPLN">GBPPLN</option><option value="GBPRUB">GBPRUB</option><option value="GBPSEK">GBPSEK</option><option value="GBPSGD">GBPSGD</option><option value="GBPTRY">GBPTRY</option><option value="GBPUSD">GBPUSD</option><option value="GBPZAR">GBPZAR</option><option value="INRJPY">INRJPY</option><option value="JPYKRW">JPYKRW</option><option value="MXNJPY">MXNJPY</option><option value="NOKJPY">NOKJPY</option><option value="NOKSEK">NOKSEK</option><option value="NZDCAD">NZDCAD</option><option value="NZDJPY">NZDJPY</option><option value="NZDUSD">NZDUSD</option><option value="SGDJPY">SGDJPY</option><option value="TRYCZK">TRYCZK</option><option value="TRYJPY">TRYJPY</option><option value="USDBRL">USDBRL</option><option value="USDCAD">USDCAD</option><option value="USDCHF">USDCHF</option><option value="USDCLP">USDCLP</option><option value="USDCNH">USDCNH</option><option value="USDCNY">USDCNY</option><option value="USDHKD">USDHKD</option><option value="USDHUF">USDHUF</option><option value="USDIDR">USDIDR</option><option value="USDILS">USDILS</option><option value="USDINR">USDINR</option><option value="USDJPY">USDJPY</option><option value="USDKRW">USDKRW</option><option value="USDMXN">USDMXN</option><option value="USDMYR">USDMYR</option><option value="USDNOK">USDNOK</option><option value="USDPHP">USDPHP</option><option value="USDPLN">USDPLN</option><option value="USDRUB">USDRUB</option><option value="USDSEK">USDSEK</option><option value="USDSGD">USDSGD</option><option value="USDTHB">USDTHB</option><option value="USDTRY">USDTRY</option><option value="USDTWD">USDTWD</option><option value="USDZAR">USDZAR</option><option value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td>Mid Price</td><td><input type="text" name="mid_price"></td>
                            <td>Value Date</td><td><input placeholder="dd/mm/yy" type="text" id="fxndf_vd" name="value_date" onchange="var nd = $.datepicker.parseDate('dd/mm/yy', $(this).val());  nd.setDate(nd.getDate()-2); $('#fxndf_fd').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>
                            <td>SPCUT</td><td><select name="spcut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell</td><td><select name="buy_sell"><option value="" selected="selected"></option><option value="B">B</option><option value="S">S</option></select></td>
                        	<td>Counter&nbsp;Amount</td><td><input name="counter_amt" id="fxndf_camt" type="text"></td>
                            <td>Fixing&nbsp;Date: </td><td><input placeholder="dd/mm/yy" type="text" id="fxndf_fd" name="fixing_date"></td>
                            <td>Cut&nbsp;Time</td><td><select name="cut_time"><option value="10:00">10:00</option>
										 <option value="15:00">15:00</option></select></td>
                        </tr>
                        <tr>
                        	<td>Notional:</td><td><input name="notional" type="text" id="fxndf_not" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                        	<td>Calc</td><td><select name="calc"><option value="Multiply" selected="selected">Multiply</option>
												<option value="Divide">Divide</option></select></td>
                            <td>Traded As</td><td><select name="traded_as"><option value=""></option><option value="FX">FX</option><option value="FXBACKOFFICE">FXBACKOFFICE</option></select></td>
                            
                            <td>Settlement</td><td><select name="settlement"><option value=""></option>
								 <option value="PHYSICAL">PHYSICAL</option>
								 <option value="CASH">CASH</option></select></td>
                        </tr>
                        <tr>
                        	<td>Inverted&nbsp;Price:</td><td><select name="invertedprice"><option value=""></option>
												<option value="I">I</option></select></td>
                        	<td>Deliverability :</td><td><select name="deliverablity">
												<option value="ND" selected>ND</option>
												<option value="D">D</option>
											</select></td>
                            <td>Prime&nbsp;broker:</td><td><select name="prime_broker"><option value="">...</option>
                                                                                                                <!--<option value="CITI" >CITI</option>-->
                                                                                                                <option selected="selected" value="RBS">RBS</option>
                                                                                                                <option value="TEST">TEST</option></select></td>
      
                            
                            <td>FX_PAIR ID</td><td><input name="fx_pair_id" disabled value="fxp_123" type="text"></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td></td><td></td>
							<td>Order&nbsp;Entry&nbsp;time:</td><td><input id="fxndf_oet" name="order_entry_time" type="text"></td>
                            <td>Matching&nbsp;Date</td><td><input type="text" placeholder="dd/mm/yy" id="fxndf_md" name="match_date"></td>
							<td><input type="submit" name="submit" value="Submit" style="display:none;"></td>
                        </tr>
                    </tbody>
                </table>
			</form>
            </div>
        </div>
        <!--------------------------------------------------------------------------------------------------------------->
         <!-- ***************************************************************  -->
        <div class="row" id="FXOPT">
        	<div class="col-xs-12" style="background-color:#eee;">
				<form id="FXOPT_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
            	<table class="table" border="0">
                	<tbody>
                    	<tr>
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option><option value="BALDR-G/U RBS   ">BALDR-G/U RBS   </option><option value="Bank of America Client">Bank of America Client</option><option value="Bank of America EB">Bank of America EB</option><option value="Barclays Bank Plc Client">Barclays Bank Plc Client</option><option value="Barclays Bank Plc EB">Barclays Bank Plc EB</option><option value="BNP Paribas Client">BNP Paribas Client</option><option value="BNP Paribas EB">BNP Paribas EB</option><option value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option><option value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option><option value="CitiGroup Client">CitiGroup Client</option><option value="CitiGroup EB">CitiGroup EB</option><option value="Credit Agricole  Client">Credit Agricole  Client</option><option value="Credit Agricole  EB">Credit Agricole  EB</option><option value="Credit Suisse AG Client">Credit Suisse AG Client</option><option value="Credit Suisse AG EB">Credit Suisse AG EB</option><option value="CURVE_MP">CURVE_MP</option><option value="Goldman Sachs  Client">Goldman Sachs  Client</option><option value="Goldman Sachs  EB">Goldman Sachs  EB</option><option value="GRATICULE- G/U Client">GRATICULE- G/U Client</option><option value="GRATICULE- G/U DB">GRATICULE- G/U DB</option><option value="HSBC Plc Client">HSBC Plc Client</option><option value="HSBC Plc EB">HSBC Plc EB</option><option value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option><option value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option><option value="JP Morgan NA Client">JP Morgan NA Client</option><option value="JP Morgan NA EB">JP Morgan NA EB</option><option value="LDF- G/U JPM">LDF- G/U JPM</option><option value="LSF- G/U JPM">LSF- G/U JPM</option><option value="MKP- G/U CITI">MKP- G/U CITI</option><option value="MKP- G/U CITI Client">MKP- G/U CITI Client</option><option value="Morgan Stanley Int Client">Morgan Stanley Int Client</option><option value="Morgan Stanley Int EB">Morgan Stanley Int EB</option><option value="NAB Client">NAB Client</option><option value="NAB EB">NAB EB</option><option value="Natixis Client">Natixis Client</option><option value="Natixis EB">Natixis EB</option><option value="Nomura Client">Nomura Client</option><option value="Nomura EB">Nomura EB</option><option value="OMEGA-G/U JPM">OMEGA-G/U JPM</option><option value="OPERA- G/U DB">OPERA- G/U DB</option><option value="PERMAL- G/U JPM">PERMAL- G/U JPM</option><option value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option><option value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option><option value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option><option value="RBC  Client">RBC  Client</option><option value="RBC  EB">RBC  EB</option><option value="RBS Client">RBS Client</option><option value="RBS EB">RBS EB</option><option value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option><option value="SEB Client">SEB Client</option><option value="SEB EB">SEB EB</option><option value="Standard Chartered  Client">Standard Chartered  Client</option><option value="Standard Chartered  EB">Standard Chartered  EB</option><option value="State Street Client">State Street Client</option><option value="State Street EB">State Street EB</option><option value="UBS AG Client">UBS AG Client</option><option value="UBS AG EB">UBS AG EB</option><option value="Westpac  Client">Westpac  Client</option><option value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td></td><td></td>
                            <td>Trade Date:</td><td><input tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" id="fxopt_td"></td>
                            <td>Expiry:</td><td>		<select tabindex="15" name="expiry">								<option value="N" selected="selected">N</option> 						
												<option value="Y">Y</option>
												</select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#fxopt_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#fxopt_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#fxopt_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#fxopt_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#fxopt_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}  $('#fxopt_premccy').val($(this).val().substr(0,3)); $('#fxopt_payout').val($(this).val().substr(0,3)); ">
                            	<option value=""></option><option value="AUDCAD">AUDCAD</option><option value="AUDCHF">AUDCHF</option><option value="AUDGBP">AUDGBP</option><option value="AUDJPY">AUDJPY</option><option value="AUDNZD">AUDNZD</option><option value="AUDSGD">AUDSGD</option><option value="AUDUSD">AUDUSD</option><option value="BRLHUF">BRLHUF</option><option value="CADJPY">CADJPY</option><option value="CHFJPY">CHFJPY</option><option value="EURAUD">EURAUD</option><option value="EURBRL">EURBRL</option><option value="EURCAD">EURCAD</option><option value="EURCHF">EURCHF</option><option value="EURCNH">EURCNH</option><option value="EURCZK">EURCZK</option><option value="EURGBP">EURGBP</option><option value="EURHUF">EURHUF</option><option value="EURINR">EURINR</option><option value="EURJPY">EURJPY</option><option value="EURMXN">EURMXN</option><option value="EURNOK">EURNOK</option><option value="EURNZD">EURNZD</option><option value="EURPLN">EURPLN</option><option value="EURSEK">EURSEK</option><option value="EURSGD">EURSGD</option><option value="EURTRY">EURTRY</option><option value="EURUSD">EURUSD</option><option value="EURZAR">EURZAR</option><option value="GBPAUD">GBPAUD</option><option value="GBPCAD">GBPCAD</option><option value="GBPCHF">GBPCHF</option><option value="GBPCNH">GBPCNH</option><option value="GBPHKD">GBPHKD</option><option value="GBPHUF">GBPHUF</option><option value="GBPILS">GBPILS</option><option value="GBPJPY">GBPJPY</option><option value="GBPMXN">GBPMXN</option><option value="GBPMYR">GBPMYR</option><option value="GBPNOK">GBPNOK</option><option value="GBPNZD">GBPNZD</option><option value="GBPPLN">GBPPLN</option><option value="GBPRUB">GBPRUB</option><option value="GBPSEK">GBPSEK</option><option value="GBPSGD">GBPSGD</option><option value="GBPTRY">GBPTRY</option><option value="GBPUSD">GBPUSD</option><option value="GBPZAR">GBPZAR</option><option value="INRJPY">INRJPY</option><option value="JPYKRW">JPYKRW</option><option value="MXNJPY">MXNJPY</option><option value="NOKJPY">NOKJPY</option><option value="NOKSEK">NOKSEK</option><option value="NZDCAD">NZDCAD</option><option value="NZDJPY">NZDJPY</option><option value="NZDUSD">NZDUSD</option><option value="SGDJPY">SGDJPY</option><option value="TRYCZK">TRYCZK</option><option value="TRYJPY">TRYJPY</option><option value="USDBRL">USDBRL</option><option value="USDCAD">USDCAD</option><option value="USDCHF">USDCHF</option><option value="USDCLP">USDCLP</option><option value="USDCNH">USDCNH</option><option value="USDCNY">USDCNY</option><option value="USDHKD">USDHKD</option><option value="USDHUF">USDHUF</option><option value="USDIDR">USDIDR</option><option value="USDILS">USDILS</option><option value="USDINR">USDINR</option><option value="USDJPY">USDJPY</option><option value="USDKRW">USDKRW</option><option value="USDMXN">USDMXN</option><option value="USDMYR">USDMYR</option><option value="USDNOK">USDNOK</option><option value="USDPHP">USDPHP</option><option value="USDPLN">USDPLN</option><option value="USDRUB">USDRUB</option><option value="USDSEK">USDSEK</option><option value="USDSGD">USDSGD</option><option value="USDTHB">USDTHB</option><option value="USDTRY">USDTRY</option><option value="USDTWD">USDTWD</option><option value="USDZAR">USDZAR</option><option value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td>Mid Price</td><td><input type="text" name="mid_price"></td>
                            <td>Value Date</td><td><input type="text" placeholder="dd/mm/yy" tabindex="11"  id="fxopt_vd" name="value_date"></td>
                            <td>Cut Time</td><td><select tabindex="17" name="cut_time"><option value="10:00">10:00</option>
										 <option value="15:00">15:00</option></select></td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell</td><td><select tabindex="3" name="buy_sell"><option value="" selected="selected"></option><option value="B">B</option><option value="S">S</option></select></td>
                        	<td></td><td></td>
                            <td>Traded As</td><td><select tabindex="12" name="traded_as"><option value=""></option><option value="FX" selected="true">FX</option><option value="FXBACKOFFICE">FXBACKOFFICE</option></select></td>
                            <td>Settlement</td><td><select tabindex="18" name="settlement"><option value=""></option>
								 <option value="PHYSICAL">PHYSICAL</option>
								 <option value="CASH">CASH</option></select></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td>Calc</td><td><select tabindex="9" name="calc"><option value="Multiply" selected="selected">Multiply</option>
												<option value="Divide">Divide</option></select></td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker"><option value="">...</option>
                                                                                                                <!--<option value="CITI" >CITI</option>-->
                                                                                                                <option selected="selected" value="RBS">RBS</option>
                                                                                                                <option value="TEST">TEST</option></select></td>
                            <td>FX_PAIR ID</td><td><input name="fx_pair_id" disabled value="fxp_123" type="text"></td>
                        </tr>
                        <tr>
                        	<td><select style="display:none;" tabindex="5" name="inverted"><option value="" selected></option>
												<option value="I">I</option></select></td>
                        	<td></td><td>Deliverability :</td><td><select name="deliverablity">
												<option value="ND" >ND</option>
												<option value="D" selected>D</option>
											</select></td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="fxopt_oet" name="order_entry_time" type="text" ></td>
                            <td>Matching Date</td><td><input placeholder="dd/mm/yy" tabindex="19" id="fxopt_md" name="match_date" type="text"></td>
                        </tr>
                        <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                       
						<tr>
							<td>Expiry</td><td><input type="text" id="fxopt_exp" onchange=" var nd =  $('#fxopt_exp').val().split('/'); var nd = new Date(nd[2] + '/'+nd[1]+'/'+nd[0]);
  nd.setDate(nd.getDate()+2); $('#fxopt_st').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>
							<td>Cut</td><td><select name="spcut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
							<td>Premium CCY</td><td><input type="text" id="fxopt_premccy"></td>
							<td></td><td></td>
						</tr>
                        <tr>
                        	<td>Settelment</td><td><input type="text" id="fxopt_st"></td>
                            <td>Notional</td><td><input type="text" id="fxopt_not" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                            <td>Payout CCY</td><td><input type="text" id="fxopt_payout"></td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                        	<td>C/P</td><td><select name="spcut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
                            <td style="color:#BF3739;">PRICE %</td><td><input type="text" id="fxopt_price" onBlur="$('#fxopt_premamt').val(parseInt($('#fxopt_not').val().replace(/,/g,'')) * parseFloat($('#fxopt_price').val()));"></td>
                            <td>Option Style</td><td><select><option selected>American</option><option>European</option></select></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        	<td>Strike</td><td><input type="text"></td>
                            <td style="color:#BF3739;">Premium amount</td><td><input type="text" id="fxopt_premamt"></td>
                            <td>Calculations</td><td><select>
                            							<option selected>Reset</option>
                                                        <option>Base Cash</option>
                                                        <option>Counter Cash</option>
                                                        <option>Base %</option>
                                                        <option>Counter %</option>
                                                        
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
        <div class="row" id="EOPT">
        	<div class="col-xs-12" style="background-color:#eee;">
				<form id="EOPT_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">
            	<table class="table table-condensed " border="0">
                	<tbody>
                    	<tr>
                        	<td>Client:</td><td><select name="client" tabindex="1">
                            						<option value="ALSTRA-G/U RBS">ALSTRA-G/U RBS</option><option value="BALDR-G/U RBS   ">BALDR-G/U RBS   </option><option value="Bank of America Client">Bank of America Client</option><option value="Bank of America EB">Bank of America EB</option><option value="Barclays Bank Plc Client">Barclays Bank Plc Client</option><option value="Barclays Bank Plc EB">Barclays Bank Plc EB</option><option value="BNP Paribas Client">BNP Paribas Client</option><option value="BNP Paribas EB">BNP Paribas EB</option><option value="CAPSTONE- G/U Client">CAPSTONE- G/U Client</option><option value="CAPSTONE- G/U DB">CAPSTONE- G/U DB</option><option value="CitiGroup Client">CitiGroup Client</option><option value="CitiGroup EB">CitiGroup EB</option><option value="Credit Agricole  Client">Credit Agricole  Client</option><option value="Credit Agricole  EB">Credit Agricole  EB</option><option value="Credit Suisse AG Client">Credit Suisse AG Client</option><option value="Credit Suisse AG EB">Credit Suisse AG EB</option><option value="CURVE_MP">CURVE_MP</option><option value="Goldman Sachs  Client">Goldman Sachs  Client</option><option value="Goldman Sachs  EB">Goldman Sachs  EB</option><option value="GRATICULE- G/U Client">GRATICULE- G/U Client</option><option value="GRATICULE- G/U DB">GRATICULE- G/U DB</option><option value="HSBC Plc Client">HSBC Plc Client</option><option value="HSBC Plc EB">HSBC Plc EB</option><option value="ICBC Standard  Bank Plc Client">ICBC Standard  Bank Plc Client</option><option value="ICBC Standard Bank Plc EB">ICBC Standard Bank Plc EB</option><option value="JP Morgan NA Client">JP Morgan NA Client</option><option value="JP Morgan NA EB">JP Morgan NA EB</option><option value="LDF- G/U JPM">LDF- G/U JPM</option><option value="LSF- G/U JPM">LSF- G/U JPM</option><option value="MKP- G/U CITI">MKP- G/U CITI</option><option value="MKP- G/U CITI Client">MKP- G/U CITI Client</option><option value="Morgan Stanley Int Client">Morgan Stanley Int Client</option><option value="Morgan Stanley Int EB">Morgan Stanley Int EB</option><option value="NAB Client">NAB Client</option><option value="NAB EB">NAB EB</option><option value="Natixis Client">Natixis Client</option><option value="Natixis EB">Natixis EB</option><option value="Nomura Client">Nomura Client</option><option value="Nomura EB">Nomura EB</option><option value="OMEGA-G/U JPM">OMEGA-G/U JPM</option><option value="OPERA- G/U DB">OPERA- G/U DB</option><option value="PERMAL- G/U JPM">PERMAL- G/U JPM</option><option value="PRELUDE- G/U JPM">PRELUDE- G/U JPM</option><option value="PROLOGUE- G/U JPM">PROLOGUE- G/U JPM</option><option value="Prologue Mapplewood G/U JPM">Prologue Mapplewood G/U JPM</option><option value="RBC  Client">RBC  Client</option><option value="RBC  EB">RBC  EB</option><option value="RBS Client">RBS Client</option><option value="RBS EB">RBS EB</option><option value="RESILIENCE- G/U UBS">RESILIENCE- G/U UBS</option><option value="SEB Client">SEB Client</option><option value="SEB EB">SEB EB</option><option value="Standard Chartered  Client">Standard Chartered  Client</option><option value="Standard Chartered  EB">Standard Chartered  EB</option><option value="State Street Client">State Street Client</option><option value="State Street EB">State Street EB</option><option value="UBS AG Client">UBS AG Client</option><option value="UBS AG EB">UBS AG EB</option><option value="Westpac  Client">Westpac  Client</option><option value="Westpac EB">Westpac EB</option>
                            					</select></td>
                        	<td></td><td></td>
                            <td>Trade Date:</td><td><input tabindex="10" placeholder="dd/mm/yy" type="text" name="trade_date" id="eopt_td"></td>
                            <td>Expiry:</td><td>		<select tabindex="15" name="expiry">								<option value="N" selected="selected">N</option> 						
												<option value="Y">Y</option>
												</select></td>
                        </tr>
                        <tr>
                        	<td>CCY_pair:</td><td><select tabindex="2" name="ccy_pair" onchange=" $('#eopt_md').val($.datepicker.formatDate('dd/mm/yy',date)); $('#eopt_oet').val($('#gmtime').html()); var nd = new Date(date.getFullYear(),date.getMonth(),date.getDate()); $('#eopt_td').val($.datepicker.formatDate('dd/mm/yy',date)); if($(this).val() == 'TRYJPY' || $(this).val() == 'TRYCZK' || $(this).val()== 'CADJPY'){ nd.setDate(nd.getDate()+1); $('#eopt_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}else{ nd.setDate(nd.getDate()+2); $('#eopt_vd').val($.datepicker.formatDate('dd/mm/yy',nd));}  $('#eopt_premccy').val($(this).val().substr(0,3)); $('#eopt_payout').val($(this).val().substr(0,3)); ">
                            	<option value=""></option><option value="AUDCAD">AUDCAD</option><option value="AUDCHF">AUDCHF</option><option value="AUDGBP">AUDGBP</option><option value="AUDJPY">AUDJPY</option><option value="AUDNZD">AUDNZD</option><option value="AUDSGD">AUDSGD</option><option value="AUDUSD">AUDUSD</option><option value="BRLHUF">BRLHUF</option><option value="CADJPY">CADJPY</option><option value="CHFJPY">CHFJPY</option><option value="EURAUD">EURAUD</option><option value="EURBRL">EURBRL</option><option value="EURCAD">EURCAD</option><option value="EURCHF">EURCHF</option><option value="EURCNH">EURCNH</option><option value="EURCZK">EURCZK</option><option value="EURGBP">EURGBP</option><option value="EURHUF">EURHUF</option><option value="EURINR">EURINR</option><option value="EURJPY">EURJPY</option><option value="EURMXN">EURMXN</option><option value="EURNOK">EURNOK</option><option value="EURNZD">EURNZD</option><option value="EURPLN">EURPLN</option><option value="EURSEK">EURSEK</option><option value="EURSGD">EURSGD</option><option value="EURTRY">EURTRY</option><option value="EURUSD">EURUSD</option><option value="EURZAR">EURZAR</option><option value="GBPAUD">GBPAUD</option><option value="GBPCAD">GBPCAD</option><option value="GBPCHF">GBPCHF</option><option value="GBPCNH">GBPCNH</option><option value="GBPHKD">GBPHKD</option><option value="GBPHUF">GBPHUF</option><option value="GBPILS">GBPILS</option><option value="GBPJPY">GBPJPY</option><option value="GBPMXN">GBPMXN</option><option value="GBPMYR">GBPMYR</option><option value="GBPNOK">GBPNOK</option><option value="GBPNZD">GBPNZD</option><option value="GBPPLN">GBPPLN</option><option value="GBPRUB">GBPRUB</option><option value="GBPSEK">GBPSEK</option><option value="GBPSGD">GBPSGD</option><option value="GBPTRY">GBPTRY</option><option value="GBPUSD">GBPUSD</option><option value="GBPZAR">GBPZAR</option><option value="INRJPY">INRJPY</option><option value="JPYKRW">JPYKRW</option><option value="MXNJPY">MXNJPY</option><option value="NOKJPY">NOKJPY</option><option value="NOKSEK">NOKSEK</option><option value="NZDCAD">NZDCAD</option><option value="NZDJPY">NZDJPY</option><option value="NZDUSD">NZDUSD</option><option value="SGDJPY">SGDJPY</option><option value="TRYCZK">TRYCZK</option><option value="TRYJPY">TRYJPY</option><option value="USDBRL">USDBRL</option><option value="USDCAD">USDCAD</option><option value="USDCHF">USDCHF</option><option value="USDCLP">USDCLP</option><option value="USDCNH">USDCNH</option><option value="USDCNY">USDCNY</option><option value="USDHKD">USDHKD</option><option value="USDHUF">USDHUF</option><option value="USDIDR">USDIDR</option><option value="USDILS">USDILS</option><option value="USDINR">USDINR</option><option value="USDJPY">USDJPY</option><option value="USDKRW">USDKRW</option><option value="USDMXN">USDMXN</option><option value="USDMYR">USDMYR</option><option value="USDNOK">USDNOK</option><option value="USDPHP">USDPHP</option><option value="USDPLN">USDPLN</option><option value="USDRUB">USDRUB</option><option value="USDSEK">USDSEK</option><option value="USDSGD">USDSGD</option><option value="USDTHB">USDTHB</option><option value="USDTRY">USDTRY</option><option value="USDTWD">USDTWD</option><option value="USDZAR">USDZAR</option><option value="XAUUSD">XAUUSD</option>
                            </select></td>
                        	<td>Mid Price</td><td><input type="text" name="mid_price"></td>
                            <td>Value Date</td><td><input type="text" placeholder="dd/mm/yy" tabindex="11"  id="eopt_vd" name="value_date"></td>
                            <td>Cut Time</td><td><select tabindex="17" name="cut_time"><option value="10:00">10:00</option>
										 <option value="15:00">15:00</option></select></td>
                        </tr>
                        <tr>
                        	<td>Buy/Sell</td><td><select tabindex="3" name="buy_sell"><option value="" selected="selected"></option><option value="B">B</option><option value="S">S</option></select></td>
                        	<td></td><td></td>
                            <td>Traded As</td><td><select tabindex="12" name="traded_as"><option value=""></option><option value="FX" selected="true">FX</option><option value="FXBACKOFFICE">FXBACKOFFICE</option></select></td>
                            <td>Settlement</td><td><select tabindex="18" name="settlement"><option value=""></option>
								 <option value="PHYSICAL">PHYSICAL</option>
								 <option value="CASH">CASH</option></select></td>
                        </tr>
                        <tr>
                        	<td></td><td></td>
                        	<td>Calc</td><td><select tabindex="9" name="calc"><option value="Multiply" selected="selected">Multiply</option>
												<option value="Divide">Divide</option></select></td>
                            <td>Prime broker:</td><td><select tabindex="13" name="prime_broker"><option value="">...</option>
                                                                                                                <!--<option value="CITI" >CITI</option>-->
                                                                                                                <option selected="selected" value="RBS">RBS</option>
                                                                                                                <option value="TEST">TEST</option></select></td>
                            <td>FX_PAIR ID</td><td><input name="fx_pair_id" disabled value="fxp_123" type="text"></td>
                        </tr>
                        <tr>
                        	<td><select style="display:none;" tabindex="5" name="inverted"><option value="" selected></option>
												<option value="I">I</option></select></td>
                        	<td></td><td>Deliverability :</td><td><select name="deliverablity">
												<option value="ND" >ND</option>
												<option value="D" selected>D</option>
											</select></td>
                            <td>Order Entry time:</td><td><input tabindex="14" id="eopt_oet" name="order_entry_time" type="text" ></td>
                            <td>Matching Date</td><td><input placeholder="dd/mm/yy" tabindex="19" id="eopt_md" name="match_date" type="text"></td>
                        </tr>
                       
						<tr>
							<td>Expiry</td><td><input type="text" name="exp_date" id="eopt_exp" onchange=" var nd =  $('#eopt_exp').val().split('/'); var nd = new Date(nd[2] + '/'+nd[1]+'/'+nd[0]);
  nd.setDate(nd.getDate()+2); $('#eopt_st').val($.datepicker.formatDate('dd/mm/yy',nd));"></td>
							<td>Cut</td><td><select name="cut"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
							<td>Premium CCY</td><td><input type="text" name="prem_ccy" id="eopt_premccy"></td>
							<td></td><td></td>
						</tr>
                        <tr>
                        	<td>Settelment</td><td><input type="text" name="stt_date" id="eopt_st"></td>
                            <td>Notional</td><td><input name="notional" type="text" id="eopt_not" onblur="$(this).val($(this).val().replace(/,/g,'')); $(this).val($(this).val().replace('m','000000')); $(this).val($(this).val().replace('M','000000')); $(this).val((parseInt($(this).val())).formatMoney(0, '', ','));" onfocus="$(this).val($(this).val().replace(/,/g,''));"></td>
                            <td>Payout CCY</td><td><input type="text" name="payout_ccy" id="eopt_payout"></td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                        	<td>C&nbsp;&amp;&nbsp;P</td><td><select name="cp"><option value="NEW YORK">NEW YORK</option>
										 <option value="TOKYO">TOKYO</option>
										 <option value="NEW YORK">ECB</option>
										 <option value="TOKYO">WMC</option></select></td>
                            <td style="color:#BF3739;">PRICE %</td><td><input name="price" type="text" id="eopt_price" onBlur="$('#eopt_premamt').val(parseInt($('#eopt_not').val().replace(/,/g,'')) * parseFloat($('#eopt_price').val()));"></td>
                            <td>Option Style</td><td><select name="opt_style"><option selected>American</option><option>European</option></select></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                        	<td>Strike</td><td><input type="text" name="strike"></td>
                            <td style="color:#BF3739;">Premium amount</td><td><input type="text" name="prem_amt" id="eopt_premamt"></td>
                            <td>Calculations</td><td><select name="calculations">
                            							<option selected>Reset</option>
                                                        <option>Base Cash</option>
                                                        <option>Counter Cash</option>
                                                        <option>Base %</option>
                                                        <option>Counter %</option>
                                                        
                            						</select></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style="margin-top:15px;">
                        	<td>Option Type</td><td><input name="opt_type" type="text"></td>
                            <td>Lower_Barrier</td><td><input name="lower_barrier" type="text"></td>
                            <td>Cash At</td><td><select name="cashat"><option>Maturity</option></select></td>
                            <td>Upper&nbsp;Barrier</td><td><input name="up_barrier_sd" type="text" id="eopt_ubsd" placeholder="start date"><br><input name="up_barrier_ed" id="eopt_ubed" type="text" placeholder="end date"></td>
                        </tr>
                        <tr>
                        	<td>Barrier&nbsp;Type</td><td><input name="barrier_type" type="text"></td>
                            <td>Knock&ndash;in&ndash;out(I/O)</td><td><input name="knock-in-out" type="text"></td>
                            <td>Rebate_CCY</td><td><input type="text" name="rebate_ccy"></td>
                            <td>Lower&nbsp;Barrier</td><td><input type="text" id="eopt_lbsd" name="lw_barrier_sd" placeholder="start date"><br><input type="text" placeholder="end date" id="eopt_lbed" name="lw_barrier_ed"></td>
                        </tr>
                        <tr>
                        	<td>Upper Barrier</td><td><input name="up_barrier" type="text"></td>
                            <td>Touch&ndash;up&ndash;down</td><td><input type="text" name="touch-up-down"></td>
                            <td>Rebate&nbsp;Amount</td><td><input type="text" name="rebate_amt"></td>
                            <td>Barrier&nbsp;Style</td><td><select name="barrier_style"><option>American</option></select></td>
                        </tr>
                        <tr>
                        	<td>Middle Barrier</td><td><input name="mid_barrier" type="text"></td>
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
					url: "http://www.curvemarkets.com/auth/admin/store.php?contract="+$("#contract").val()+"&account="+$("#account").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
				}).done(function( data ) {
					$('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); $('#container2').hide(); $('#back').hide();
					window.clearInterval(timeupdate);
					getrecord();
					$("#back").html("");
				});
		}
		function save_new(){
			var val = $("#contract").val();
			val = "form#"+val+"_form";			
			$.ajax({
					url: "http://www.curvemarkets.com/auth/admin/store.php?contract="+$("#contract").val()+"&account="+$("#account").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
				}).done(function( data ) {
					document.getElementById($("#contract").val()+"_form").reset();
					//$('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); $('#container2').hide(); $('#back').hide();
					//window.clearInterval(timeupdate);
					//getrecord();
					//$("#back").html("");
				});
		}
		function save_copy(){
			var val = $("#contract").val();
			val = "form#"+val+"_form";			
			$.ajax({
					url: "http://www.curvemarkets.com/auth/admin/store.php?contract="+$("#contract").val()+"&account="+$("#account").val(),
					data: $(val).serialize(),
					async:false,
					method:'POST',
				}).done(function( data ) {
					alert('data saved');
					//document.getElementById($("#contract").val()+"_form").reset();
					//$('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); $('#container2').hide(); $('#back').hide();
					//window.clearInterval(timeupdate);
					//getrecord();
					//$("#back").html("");
				});
		}
	</script>
	<?php
	}
	?>