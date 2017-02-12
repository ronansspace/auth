<?php
session_start();
require_once('../inc/def.php');
?>
	<!doctype html>
    <html>
    <head><meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Blotter Page</title>
    <!-- Bootstrap -->
	<link rel="stylesheet" href="pace.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
	body{
		background-color:#fafafa;
	}
	.container-fluid{
		padding:15px;
		min-width:960px;
	}
	header,div.filter{
		background-color:#fff;
		border:1px solid #4B4B4B;
		padding:10px;
		text-align:center;
		height:70px;
	}
	header img{
		height:50px;
		float:left;
	}
	header h3{
		float:right;
				display:inline;
	}
	header h1{
		display:inline-block;
		margin:0px;
		margin-top:3px;
		color:#464646;
	}
	div.filter{
		background-color:transparent;
		margin-top:10px;
		height:auto;
		text-align:left;
		overflow:auto;
		background-image:url(filter.png);
		background-repeat:no-repeat;
		background-position:left center;
		background-size:38px 38px;
		padding-left:40px;
	}
	div.filter table{
		display:inline-block;
	}
	div.filter td{
		text-align:center;
	}
	div.filter input{
		height:100%;
	}
	div.filter input,div.filter select{
		width:75px;
		padding:0px 2px;
	}
	thead.thead th,tbody#result td{
		padding:2px 10px !important;
		white-space:nowrap;
	}
	#back{ width:100%; height:100%; background-color:rgba(42,42,42,0.57); position:fixed; top:0px; left:0px; -webkit-user-select:none;-moz-user-select:none;}
	.paging-nav {
  text-align: right;
  padding-top: 2px;
  display:inline-block;
  position:fixed;
   right:50px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

	</style>
</head>
<body>
<?php
if(tdrLoggedIn()){	
	?>
	<div class="container-fluid">
    	<header>
        	<img src="logo.jpg"><h1>Foreign Exchange</h1><h3><label class="label label-success" style="font-weight:100; margin-right:10px;">Trader ID: <?php echo $_SESSION['auth_id'];?></label><label class="label label-info" style="font-weight:100; margin-right:10px;">Trader Deptt</label><button onclick="logout();" class="btn btn-danger btn-sm">Logout</button></h3>
            <br style="clear:both">
        </header>
        <div class="filter" style="display:none;">
            <table style="overflow:auto;">
				<tbody><tr>
				
				<td><label for="TradeStatus">TradeStatus </label></td>	
				<td><label for="Contract">Contract </label></td>	
				<td><label for="ID">ID </label></td>
				<td><label for="Client">Client </label></td>	
				<td><label for="ccy_pair">CCY Pair </label></td>
				<td><label for="BS">B/S </label></td>		
				<td><label for="Notional">Notional </label></td>	
				<td><label for="Rate">Rate </label></td>	
				<td><label for="CounterAmount">CounterAmt </label></td>	
				<td><label for="TradingDate">TradingDate</label></td>
				<td><label for="ValueDate">ValueDate</label></td>
				<td><label for="CounterParty">CounterParty</label></td>
				<td><label for="Expiry">Expiry</label></td>									
				<td><label for="SPCUT">SPCUT</label></td>									
				<td><label for="FX_Pair_ID">FX Pair ID</label></td>	
			</tr>
			<tr>
				<td><select id="TradeStatus" name="TradeStatus">
					 <option value="">
					</option>
					<option>Abandoned</option><option selected="selected">Active</option>					</select></td>
				<td><select id="Contract" name="Contract">
					 <option value="-">
					</option>
					<option>EOPT</option><option>FXFW</option><option>FXNDF</option><option>FXOPT</option><option>FXSP</option>					</select></td>
				<td><input id="ID" name="ID" value=""></td>				
				<td><input id="Client" name="Client" value=""></td>									
				<td><input id="ccy_pair" name="ccy_pair" value=""></td>
				<td><input id="BS" name="BS" value=""></td>
				<td><input id="Notional" name="Notional" value=""></td>				
				<td><input id="Rate" name="Rate" value=""></td>				
				<td><input id="CounterAmount" name="CounterAmount" value=""></td>
				<td><input id="TradingDate" name="TradingDate" value=""></td>						
				<td><input id="ValueDate" name="ValueDate" value=""></td>						
				<td><input id="CounterParty" name="CounterParty" value=""></td>
				<td><input id="Expiry" name="Expiry" value=""></td>
				<td><input id="SPCUT" name="SPCUT" value=""></td>
				<td><input id="FX_Pair_ID" name="FX_Pair_ID" value=""></td>
				<td><input type="button" class="btn btn-xs btn-info" name="refresh" value="Reset" title="Clear all Values"></td>
			</tr>
			<tr>	
				<td><label for="ExpiryDate">ExpiryDate</label></td>									
				<td><label for="CP">C/P</label></td>									
				<td><label for="Strike">Strike</label></td>								
				<td><label for="Price">Price</label></td>									
				<td><label for="PremiumAmount">PremiumAmt</label></td>									
				<td><label for="PremiumCCY">PreCCY</label></td>									
				<td><label for="PayoutCCY">PayCCY</label></td>	
				<td><label for="OptionType">OptType</label></td>									
				<td><label for="BarrierType">BarType</label></td>
			</tr>
			<tr>
				<td><input id="ExpiryDate" name="ExpiryDate" value="" ></td>
				<td><input id="CP" name="CP" value="" ></td>
				<td><input id="Strike" name="Strike" value="" ></td>												
				<td><input id="Price" name="Price" value="" ></td>
				<td><input id="PremiumAmount" name="PremiumAmount" value="" ></td>
				<td><input id="PremiumCCY" name="PremiumCCY" value="" ></td>
				<td><input id="PayoutCCY" name="PayoutCCY" value="" ></td>
				
				<td><input id="OptionType" name="OptionType" value="" ></td>	
				<td><input id="BarrierType" name="BarrierType" value="" ></td>	
				
			</tr>
		</tbody></table>
        </div>
        <div style="border-radius:10px; margin-top:10px; padding:5px 50px;">
        	<input type="button" class="btn btn-success" value="New Trade" onclick="$('#back').load('http://www.curvemarkets.com/auth/admin/newtrade.php',function(responseTxt, statusTxt, xhr){if(statusTxt == 'success'){ $('#back').show(); ch_contract(); $('.container').show();} if(statusTxt == 'error') alert('Error: ' + xhr.status + ': ' + xhr.statusText);});" style="margin-right:10px;">
            <input type="button" class="btn btn-primary" value="Copy Trade" style="margin-right:150px;" onclick="alert('not implemented');">
            <input type="button" class="btn btn-default" value="Trade By Date" onclick="$('#tradebdate').css('display','inline-block');">
            <div id="tradebdate" style="display:none;"><input type="text" placeholder="Start Date" id="stDate"> <input type="text" id="enDate" placeholder="End Date"> <input type="button" class="btn btn-xs btn-warning" value="Submit"></div>
        </div>
        <div style="margin-top:10px;">
        	<span class="btn btn-info" onclick="getrecord();">Result &nbsp;&nbsp;<span class="badge"> 245 </span></span>
        </div>
        <div style="margin-top:10px;"><div id="tablepar" style="overflow:auto; width:96%; margin-left:calc(2%); background-color:#fff; border:1px solid black;"><table class="table table-hover table-condensed table-responsive table-striped" style="margin-bottom:0px;" id="table-demo1"><thead class="thead">
            			<tr><th style="padding:2px 5px !important;"><input type="checkbox" onChange="if($(this).prop('checked')){ $('#result > tr > td > input[type=checkbox]').prop('checked',true);}else{$('#result > tr > td > input[type=checkbox]').prop('checked',false);}"></th>
                        <th style="padding:2px 5px !important;">ID</th>
                        <th>Match</th>
                        <th>Filesent</th>
                        <th>Dept</th>
                        <th>TName</th>
                        <th>TSwap</th>
                        <th>Contract</th>
                        <th>Client</th>
                        <th>Cparty</th>
                        <th>B/S</th>
                        <th>Notional</th>
                        <th>CCY</th>
                        <th>Strike</th>
                        <th>P/C</th>
                        <th>Counter&nbsp;Amount</th>
                        <th>Expiry&nbsp;Date</th>
                        <th>OptCut</th>
                        <th>Sett&nbsp;Date</th>
                        <th>Price</th>
                        <th>Rate</th>
                        <th>Prem&nbsp;Amount</th>
                        <th>Prem&nbsp;CCY</th>
                        <th>Type</th>
                        <th>Barrier&nbsp;Type</th>
                        <th>Lower&nbsp;Barrier</th>
                        <th>Upper&nbsp;Barrier</th>
                        <th>Knock&nbsp;in&nbsp;out</th>
                        <th>Touch&nbsp;up&nbsp;down</th>
                        <th>Cash&nbsp;at</th>
                        <th>Rebate&nbsp;CCY</th>
                        <th>Trade&nbsp;Date</th>
                        <th>Value&nbsp;Date</th>
                        <th>Expiry</th>
                        <th>Rebate&nbsp;Amount</th>
                        <th>Payout&nbsp;CCY</th>
                        <th>Barrier&nbsp;StartDate</th>
                        <th>Barrier&nbsp;EndDate</th>
                        <th>SPCUT</th>
                        <th>Settlement</th>
                        <th>FX&nbsp;Pair&nbsp;ID</th>
                        <th>platform</th>
						<th>indicator</th>
                        <th>platform_trade_id</th>
                        <th>Status</th></tr>
                	</thead>
                	<tbody id="result">
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr><td style="padding:2px 5px;"></td>&nbsp;&nbsp;&nbsp;<td style="padding:2px 5px;">&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td>
						</tr>
                		<!--
                        <?php
                           // add record from php database
                       	?>
                        -->
					</tbody></table></div></div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="pace.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="paging.js"></script>
    <script>
		$(document).ready(function() {
			/*$("#result").bind("DOMSubtreeModified",function(){
  				var len = document.getElementById("result").getElementsByTagName("tr").length;
                $(".badge").html("&nbsp;"+len+"&nbsp;");
			});
			{
			var len = document.getElementById("result").getElementsByTagName("tr").length;
                $(".badge").html("&nbsp;"+len+"&nbsp;");
			}
			*/
			getrecord();		
    });
			var result_count  = 0 ;
			var tableid = 1;
			$("#stDate").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#enDate").datepicker({ dateFormat: 'dd/mm/yy' });
		function updateRecord(){
				$(".badge").html("&nbsp;"+result_count+"&nbsp;");
			}
		
		function getrecord(){
			$.ajax({
					url: "http://www.curvemarkets.com/auth/admin/getrecord.php",
					method:'GET',
					dataType: 'html',
				}).done(function( data ) {
					$("#result").html(data);
					result_count = $("#result tr").length;
					updateRecord();
					//$('.paging-nav').remove();
					$('#table-demo'+tableid).paging({limit:10});
				
				});
		}
		function logout(){
			$.ajax({
			url: 'logout.php',
			type: 'GET',
			async:false,
			success: function(data) {
						//called when successful
						if(data == "success"){
							window.open("<?php echo HOMEPAGE; ?>","_self");
						}
						if(data == "failed"){
							window.open("<?php echo HOMEPAGE; ?>","_self");
						}
					},
					error: function(e) {
					}
			});
		}
		
	
    </script>
    
    <div id="back" style="display:none;">
	
    </div></div>
	<?php
}
else{
	header("Location: ".HOMEPAGE);
}
?>
</body>
</html>