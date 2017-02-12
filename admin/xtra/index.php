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
    <title>Curve Markets FX Blotter</title>
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="include/pace.css">
    <link rel="stylesheet" href=include/bootstrap.css">
    
    <!-- Optional theme 
    
    <link rel="stylesheet" href="include/bootstrap-theme.css"> -->
    <link rel="stylesheet" href="include/jquery-ui.css">   
    <link rel="stylesheet" href="include_online/datatables.min.css">   
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>-->    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
   <link rel="stylesheet" href="include/main.css">
   
</head>
<body>
<?php
if(tdrLoggedIn()){	

      include("admin_header.php");
      
      $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
      $sql = "SELECT * FROM traders where pid = ".$_SESSION['auth_id'];
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      
      $client = $row['tdrID'];
      
      //$deci = strlen(substr(strrchr("4562.456", "."), 1));
      //$notional =  number_format("4562.456", $deci, '.', '');
      //print $notional;
      
?>

    
	<div class="container-fluid">
       
       <div style="width:90%;margin:0 auto;padding-top:15px;">             
       
       <header>
        	<img src="images/logo.jpg">
            <h1>Foreign Exchange</h1>
            <h3>
              <label class="label label-success" style="font-weight:100; margin-right:10px;">Trader ID: <?php echo $_SESSION['auth_id'];?></label>
              <label class="label label-info" style="font-weight:100; margin-right:10px;">Trader : <?=ucfirst($client);?></label>
              <button onclick="logout();" class="btn btn-danger btn-sm">Logout</button>
            </h3>
            <br style="clear:both">
        </header>
        
        <div class="controls-div">
            
            <div class="btn-group" data-toggle="buttons">
                <input type="button" class="btn btn-primary btn-sm record_new" value="New Trade" style="margin-right:0px;">
                <input type="button" class="btn btn-primary btn-sm record_copy" value="Copy Trade" style="margin-right:0px;">
                <input type="button" class="btn btn-danger btn-sm record_delete" value="Delete Trade" style="margin-right:5px;">
            </div>
            
            <div class="btn-group" data-toggle="buttons">
                <input type="button" class="btn btn-info btn-sm email_rbs" value="Email RBS" style="">
                <input type="button" class="btn btn-info btn-sm email_client" value="Email Client" style="margin-right:0px;">
                <input type="button" class="btn btn-info btn-sm view_csv" value="View CSV" style="margin-right:5px;">
            </div>
           
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-sm btn-default">
                <input type="radio" name="options" value="1" autocomplete="off"> All Trades
              </label>
              <label class="btn btn-sm btn-default active" >
                <input type="radio" name="options" value="2" autocomplete="off" checked> Today's Trade 
              </label>
              <label class="btn btn-sm btn-default">
                <input type="radio" name="options" value="3" autocomplete="off"> Unmatched
              </label>
              <label class="btn btn-sm btn-default">
                <input type="radio" name="options" value="4" autocomplete="off"> Last 10 Days
              </label>
              <label class="btn btn-sm btn-default">
                <input type="radio" name="options" value="5" autocomplete="off"> By Date
              </label>
            </div>
            
            
            <div id="tradebdate" style="width:20%;display:none;">
                <input type="text" class="input-xs" placeholder="Start Date" name="stDate" id="stDate"> 
                <input type="text" class="input-xs" placeholder="End Date" name="enDate" id="enDate"> 
                <input type="button" class="btn btn-xs btn-default" id="date_filter_submit" value="Submit">
            </div>
            
            
            <input type="hidden" name="trade_filter" value="1">
            
        </div>
        
                           
        <div style="width:60%;float:left;display:inline;">             
                  <h4 class="table_heading">Trades</h4>
                  <table id="jsontable" class="display table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                      <thead>
                          <tr>                             
                                  <th> </th> 
                                  <th>ID</th>
                                  <th>TET</th>
                                  <th>PB</th>
                                  <th>Client</th>
                                  <th>Contract</th>
                                  <th>Client</th>
                                  <th>B/S</th>
                                  <th>Notional</th>
                                  <th>CCY</th>
                                  <th>Counter&nbsp;Amount</th>
                                  <th>Rate</th>
                                  <th>Trade&nbsp;Date</th>
                                  <th>Value&nbsp;Date</th>
                                  <th>Trader</th>
                                  <th>SPCUT</th>
                                  <th>Status</th>                          
                                  <th>Prem&nbsp;Amount</th>
                                  <th>Barrier&nbsp;Type</th>
                                  <th>Lower&nbsp;Barrier</th>
                                  <th>Upper&nbsp;Barrier</th>
                                  <th>Knock&nbsp;in&nbsp;out</th>
                                  <th>Touch&nbsp;up&nbsp;down</th>                        
                                  <th>Rebate&nbsp;CCY</th>
                                  <th>Expiry</th>
                                  <th>Rebate&nbsp;Amount</th>
                                  <th>Payout&nbsp;CCY</th>
                                  <th>Delivery</th>
                                  <th>FX&nbsp;Pair&nbsp;ID</th>
                                  <th>platform</th>
          						            <th>indicator</th>
                                  <th>platform_trade_id</th>
                                  <th>Cparty</th>
                                  <th>P/C</th>
                                  <th>OptCut</th>
                                  <th>Type</th>
                                  <th>Cash&nbsp;at</th>
                                  <th>Barrier&nbsp;StartDate</th>
                                  <th>Barrier&nbsp;EndDate</th>
                                  <th>Strike</th>
                                  <th>Expiry&nbsp;Date</th>                        
                                  <th>Sett&nbsp;Date</th>
                                  <th>Price</th>
                                 </tr>
                          </tr>
                      </thead>                        
                  </table>
        </div>
        <div style="width:40%;float:left;display:inline;padding-left:10px;">
                <h4 class="table_heading">Brokerage</h4>
                <table id="jsontable_pnl" class="display table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                             <tr>                             
                                <!--<th>ID</th>-->
                                <th>Trade ID</th>
                                
                                <th>Gros Profit</th>
                                
                                <th>PB Cost</th>
                                <th>Venue Cost</th>
                                <th>Total Cost</th>                                
                                
                                <th>Net Profit</th>
                                
                                <th>Contract</th>  
                                <!--<th>CCY Pair</th>                       
                                <th>Client</th>-->
                                <th>Trader</th>
                                
                                <!--<th>Notional</th>-->
                                
                                <!--<th>Trade Date</th> 
                                <th>Value Date</th>--> 
                                
                                
                                <th>FX Pair ID</th>                  
                              </tr>
                        </tr>
                    </thead>                        
                </table>
        </div>
        
        
        
       </div>       
    </div>      
    
    
    <?php         
      include('footer.php');     
    ?>
    
    
    <script src="include/jquery10.js"></script>
    <script src="include/pace.min.js"></script> 
    <script src="include/bootstrap.min.js"></script> 
    
    <script type="text/javascript" src="include_online/datatable.js"></script>
    <script type="text/javascript" src="include_online/bootstrap.js"></script>
    
    <!--
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
    -->
    <script src="include/jquery-ui-11.js"></script>
    <script src="include/paging.js"></script>
   
    
    <script>
    
    
      var pTable = $('#jsontable_pnl').dataTable({
                  "iDisplayLength": 25,
                  "processing": true,
                  "scrollX": true,
                  
      });   
    
      $(document).on("click", ".email_rbs", function (){  
          
          event.preventDefault();            
        
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
               
                var formData = new FormData($(this)[0]);
                
                $.ajax({
                    url: 'emailtrade_rbs.php?id_trades=' + checkedVals,
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function (data) {                    
                        //alert(data);
                        if(data == "sent"){  
                              //alert("Email Sent");
                        }
                        getrecord_max();
                        getrecord_pnl();   
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
                
                return false;
                
          }
     });
     
     
     $(document).on("click", ".view_csv", function (){  
          
          event.preventDefault();            
        
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
               
                //var formData = new FormData($(this)[0]);
                
                window.open('emailtrade_csv.php?id_trades=' + checkedVals);
                $('.check_box').removeAttr('checked');
                
                
          }
                
     });
     
     
     $(document).on("click", ".email_client", function (){  
          
          event.preventDefault();            
        
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
          
                if ($('.check_box:checkbox:checked').length > 1) { 
                    
                    alert('Select only one trade');
                    return false;
                
                }else{
                
                    var formData = new FormData($(this)[0]);
                
                    $.ajax({
                        url: 'emailtrade_client.php?id_trades=' + checkedVals,
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function (data) {                    
                            //alert(data);
                            
                            if(data == "sent"){      
                                  //alert("Email Sent"); 
                                  getrecord_max();
                                  getrecord_pnl();                                   
                            }else if(data == "error_client_email"){
                                  alert("Client trader email not provided");
                            }else if(data == "error_client_trader"){
                                  alert("Client trader not provided");
                            }
                            
                            
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    
                    return false;
                
                }                
          }
                
     });
         
     
     
      $('input[name="options"]').change( function() {
          
          var all_val = $(this).val();
          $("#tradebdate").hide();
          
          if(all_val == 1){                  
               $('input[name="trade_filter"]').val(1);          
          } else if(all_val == 2){               
               $('input[name="trade_filter"]').val(2);          
          } else if(all_val == 3){               
               $('input[name="trade_filter"]').val(3);           
          } else if(all_val == 4){              
             $('input[name="trade_filter"]').val(4);               
          } else if(all_val == 5){             
             $("#tradebdate").css('display', 'inline'); 
             $("#tradebdate").show();                
             $('input[name="trade_filter"]').val(5);  
          }
          
          if(all_val != 5){             
             
             getrecord_max();
             getrecord_pnl();   
             
          }
          
          
      });
      
      $(document).on("click", "#date_filter_submit", function (){
             
            var stDate = $('input[name=stDate]').val(); 
            var enDate = $('input[name=enDate]').val(); 
            
            
            
            if(stDate == "" || enDate == ""){
            
                alert("Please choose date range.");
                return false;
            
            }else{
            
                getrecord_max();
                getrecord_pnl();   
                
            }
             
             
      });
      
      $("body").disableSelection();
      
      
      $(document).on("dblclick", ".record_row", function (){
              var did = $(this).data("did");
              
              $('#back').html("");
              
              $('#back').load('newtrade_new.php?id='+did,function(responseTxt, statusTxt, xhr){if(statusTxt == 'success'){ 
              $('#back').show(); 
              ch_contract(); 
              $('.container').show();} if(statusTxt == 'error') alert('Error: ' + xhr.status + ': ' + xhr.statusText);});
          
      }); 
      
      
      $(document).on("click", ".record_email", function (){
         
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
             
                    $('#back_email').load('emailtrade.php?id_contract=' + checkedVals ,function(responseTxt, statusTxt, xhr){
                    if(statusTxt == 'success'){ 
                            $('#back_email').show(); 
                            //ch_contract(); 
                            $('.container').show();
                            
                    }if(statusTxt == 'error') alert('Error: ' + xhr.status + ': ' + xhr.statusText);});
         }  
          
      });
      
     
      
      $(document).on("click", ".record_new", function (){
              
              var page = "newtrade_new.php";
                                         
              $('#back').load('newtrade_new.php',function(responseTxt, statusTxt, xhr){
                
                      if(statusTxt == 'success'){ 
                              $('#back').show(); 
                              ch_contract(); 
                              $('.container').show();
                      }
                      if(statusTxt == 'error'){ 
                              alert('Error: ' + xhr.status + ': ' + xhr.statusText);
                      }
                      
              });
              
          
      });
      
      $(document).on("click", ".record_delete", function (){
      
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
             
                   if ($('.check_box:checkbox:checked').length > 1) {                            
                           // your code goes here
                           alert("Please choose only one trade to perform delete.");
                           return false;                          
                    }else{    
                    
                          if (confirm('Delete Record ?')) {                                      
                         
                                //var id_contract = sThisVal;
                                $.ajax({
                                        
                                        url: 'process_delete.php?id_contract=' + checkedVals,
                                        dataType: 'json',
                                        success: function(s){                          
                                            
                                            if(s == "ok"){
                                              alert('Record Deleted');
                                              getrecord_max();
                                              getrecord_pnl();   
                                            }else{
                                              alert('Error delteing record, please try again!');
                                            }
                                                          
                                        }, 
                                        error: function(e){ //console.log(e.responseText); 
                                          //alert(e);
                                          alert('Error delteing record, please try again!');
                                        } 
                                  });
                          
                          } else {
                              //alert('Why did you press cancel? You should have confirmed');
                          }                          
                    }
         }  
              
      });    
      
      
      $(document).on("click", ".record_copy", function (){
      
          var checkedVals = $('.check_box:checkbox:checked').map(function() {
              return this.value;                                              
          }).get();
          
          if(checkedVals.join(",") == ""){
                
                alert('Select a trade first.');
                return false;
          
          } else {
                  
                  
             
                   if ($('.check_box:checkbox:checked').length > 1) {  
                                             
                           // your code goes here
                           alert("Please choose only one trade to perform copy.");
                           return false;    
                                                 
                    }else{    
                    
                          $('#back').load('newtrade_new.php?id='+checkedVals+'&only_copy=yes',function(responseTxt, statusTxt, xhr){if(statusTxt == 'success'){ 
                          $('#back').show(); 
                          ch_contract(); 
                          $('.container').show();} if(statusTxt == 'error') alert('Error: ' + xhr.status + ': ' + xhr.statusText);});
                                           
                    }
         }  
              
      });    
    
			var result_count  = 0 ;
			var tableid = 1;
			$("#stDate").datepicker({ dateFormat: 'dd/mm/yy' });
			$("#enDate").datepicker({ dateFormat: 'dd/mm/yy' });
      
		  function updateRecord(){
				    $(".badge").html("&nbsp;"+result_count+"&nbsp;");
			}
      //alert();
      $(document).ready(function() {
            
            getrecord_max();  
            
            getrecord_pnl();                      
      });
      
      function getrecord_pnl(){
           
            $('#jsontable_pnl').dataTable().fnDestroy();
            var pTable = $('#jsontable_pnl').dataTable({
                "iDisplayLength": 25,
                "processing": true,
                "scrollX": true                
            });
            
            var all_val = $('input[name=options]:checked').val(); 
            var stDate = $('input[name=stDate]').val(); 
            var enDate = $('input[name=enDate]').val(); 
             
            $.ajax({
            
                  url: 'process/pnl.php?method=fetchdata&theid='+all_val+'&stdate='+stDate+'&endate='+enDate + " ",
                  dataType: 'json',
                  success: function(s){ 
                      pTable.fnClearTable();
                      
                      if(s == "empty"){
                      
                      
                      } else {  
                      
                            for(var i = 0; i < s.length; i++) 
                            { 
                                  
                                  pTable.fnAddData([ 
                                      s[i][1], s[i][11], s[i][12], s[i][13], s[i][14], s[i][10], s[i][3], s[i][5], s[i][2]
                                  ]);                                 
                            
                            } // End For 
                      
                      }
                                            
                  }, 
                  error: function(e){ 
                  
                              alert(e);
                  } 
            });
       
      }
      
      
            
      function getrecord_max(){
            
             
            $('#jsontable').dataTable().fnDestroy();
            
            var oTable = $('#jsontable').dataTable({
            "iDisplayLength": 25,
            "processing": true,
            "scrollX": true,
            
            
            });
            
            var all_val = $('input[name=options]:checked').val(); 
            var stDate = $('input[name=stDate]').val(); 
            var enDate = $('input[name=enDate]').val(); 
            
            
            $.ajax({
            
                  url: 'process.php?method=fetchdata&theid='+all_val+'&stdate='+stDate+'&endate='+enDate + " ",
                  dataType: 'json',
                  success: function(s){ 
                  
                      oTable.fnClearTable();
                      
                      if(s == "empty"){
                      
                      
                      } else {  
                            
                            for(var i = 0; i < s.length; i++) 
                            { 
                                //, env - EMAIL ICON 
                                
                                oTable.fnAddData([ "<input type='checkbox' name='id_trades' class='check_box' value='"+s[i][0]+"'/>", s[i][0], s[i][45], s[i][40], 
                                    s[i][41], s[i][2], s[i][3], s[i][5], s[i][6], s[i][7], s[i][10],
                                    s[i][15], s[i][26], s[i][27], s[i][44], s[i][33], s[i][39], s[i][16], s[i][19], s[i][20], s[i][21], s[i][22], s[i][23], s[i][25],
                                    s[i][28], s[i][29], s[i][30], s[i][34], s[i][35], s[i][36], s[i][37], s[i][38],  
                                    s[i][4], s[i][9], s[i][12], s[i][18], s[i][24], s[i][31], s[i][32], s[i][8], s[i][11], s[i][13], s[i][14]
                                    ]);  
                                    
                                  var theNode = oTable.fnSettings().aoData[i].nTr;
                                  theNode.setAttribute('data-did', s[i][0]);
                                  theNode.setAttribute('class', 'record_row'); 
                            
                                  $('td', theNode)[3].setAttribute( 'class', s[i][42] );
                                  $('td', theNode)[4].setAttribute( 'class', s[i][43] );                                  
                            
                            } // End For 
                      
                      }
                      
                      
                                            
                  }, 
                  error: function(e){ 
                    //console.log(e.responseText); 
                    //alert(e.responseText);
                    //alert('Error loading records.')
                  } 
            });
      }
		
		  function logout(){
      
      			$.ajax({
      			url: 'logout.php',
      			type: 'GET',
      			async:false,
      			success: function(data) {
      						if(data == "success"){
      							window.open("../","_self");
      						}
      						if(data == "failed"){
      							window.open("../","_self");
      						}
      					},
      					error: function(e) {
      					}
      			});
          
		  }
      
      //// START : LOAD FILE CONTENT  ///
         
    
     function numberWithCommas(x) { 
                    
          if(x.indexOf('.') > -1){
              
              var n = x.toString().split(".");
              //Comma-fies the first part
              n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              //Combines the two sections
              
              return n.join(".");     
              
          
          }else{
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              
          }          
                   
     }
     
     function numberWithoutCommas(x){ 
         
          dx=x.replace(/\,/g,'');
          dx=parseFloat(dx,10);  
          
          return dx;                      
     }
     
      
  	   
  	function ch_contract(){
  		
        var val = $("#contract").val();
        
    		$("#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT").hide();
    		$('#'+val).show();
        
        
        var form_name = $("#contract").val();
        var myform = $("#contract").val() + "_form";
        
        if(form_name == "FXNDF"){
                
                $("#" + myform).find("input[name=value_date]").css("background-color", "#FFC0CB"); 
                $("#" + myform).find("input[name=fixing_date]").css("background-color", "#FFC0CB"); 
               
        }else{
        
                $("#" + myform).find("input[name=value_date]").css("background-color", "#ffffff"); 
                $("#" + myform).find("input[name=fixing_date]").css("background-color", "#ffffff"); 
        }  
      
  	}
    
    
    $(document).on("change", ".expiry_date_opt", expiry_date_opt_change);
    
    function expiry_date_opt_change(){
            
            var myform = $("#contract").val() + "_form";
            var mthis_val = $("#" + myform).find("select[name=ccy_pair]").val(); 
            var mthis_curr = mthis_val.slice(0,3);      
                    
            var date2 = $('.expiry_date_opt').datepicker('getDate', '+1d');
            
            if(mthis_curr == "CAD" || mthis_curr == "TRY"){
                 date2.setDate(date2.getDate()+1); 
            }else{
                 date2.setDate(date2.getDate()+2); 
            }
            
            $('.settle_date_class').datepicker('setDate', date2);
                  
    } 
     
    function check_form(){
         
          var myform = $("#contract").val() + "_form";
          var form_err = 0;
          
          var visi_me = $(".convert_base_area").is(':visible');
          
          var form_name = $("#contract").val();
          
          if(form_name == "FXNDF"){
                  
                  $("#" + myform).find("input[name=value_date]").css("background-color", "#ffffff"); 
                  $("#" + myform).find("input[name=fixing_date]").css("background-color", "#ffffff"); 
                  
                  var pnl_value_date = $("#" + myform).find("input[name=value_date]").val();
                  var pnl_fixing_date = $("#" + myform).find("input[name=fixing_date]").val();
                  
                  if(pnl_value_date == ""){                     
                       form_err = 1;  
                       $("#" + myform).find("input[name=value_date]").css("background-color", "#FFC0CB");                     
                  }
                  if(pnl_fixing_date == ""){                   
                       form_err = 1;  
                       $("#" + myform).find("input[name=fixing_date]").css("background-color", "#FFC0CB");                    
                  }                  
                
          }    
          
          
          if(form_name == "FXOPT"){
          
          
                   $("#" + myform).find("select[name=client]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("select[name=client_trader]").css("background-color", "#ffffff"); 
                   
                   $("#" + myform).find("select[name=ccy_pair]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("select[name=buy_sell]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=notional]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=counter_amt]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=price_percentage]").css("background-color", "#ffffff");
                    
                   $("#" + myform).find("input[name=value_date]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=trade_date]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=payout_ccy]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=settle_date]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=expiry_date]").css("background-color", "#ffffff"); 
                   $("#" + myform).find("input[name=premium_amount]").css("background-color", "#ffffff"); 
                       
                   
                   var opt_client = $("#" + myform).find("select[name=client]").val();
                   var opt_client_trader = $("#" + myform).find("select[name=client_trader]").val();
                   var opt_ccy_pair = $("#" + myform).find("select[name=ccy_pair]").val();
                   var opt_buy_sell = $("#" + myform).find("select[name=buy_sell]").val();
                   var opt_notional_val = $("#" + myform).find("input[name=notional]").val();
                   var opt_counter_amt = $("#" + myform).find("input[name=counter_amt]").val();
                   var opt_price_percentage = $("#" + myform).find("input[name=price_percentage]").val();
                   
                   var opt_value_date = $("#" + myform).find("input[name=value_date]").val();
                   var opt_trade_date = $("#" + myform).find("input[name=trade_date]").val();
                  
                   var opt_payout_ccy = $("#" + myform).find("input[name=payout_ccy]").val(); 
                   var opt_settle_date = $("#" + myform).find("input[name=settle_date]").val();
                   var opt_expiry_date = $("#" + myform).find("input[name=expiry_date]").val(); 
                   var opt_premium_amount = $("#" + myform).find("input[name=premium_amount]").val();
                   
                   if(opt_client == ""){                      
                          form_err = 1;  
                          $("#" + myform).find("select[name=client]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_client_trader == ""){                      
                          form_err = 1;  
                          $("#" + myform).find("select[name=client_trader]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_ccy_pair == ""){                      
                          form_err = 1;  
                          $("#" + myform).find("select[name=ccy_pair]").css("background-color", "#FFC0CB");        
                   }  
                   
                   
                   if(opt_value_date == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=value_date]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_trade_date == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=trade_date]").css("background-color", "#FFC0CB");        
                   }
                   
                   
                   if(opt_buy_sell == ""){                      
                          form_err = 1;  
                          $("#" + myform).find("select[name=buy_sell]").css("background-color", "#FFC0CB");        
                   }                       
                   if(opt_notional_val == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=notional]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_counter_amt == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=counter_amt]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_price_percentage == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=price_percentage]").css("background-color", "#FFC0CB");        
                   }
                   
                   if(opt_settle_date == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=settle_date]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_expiry_date == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=expiry_date]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_premium_amount == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=premium_amount]").css("background-color", "#FFC0CB");        
                   }
                   if(opt_payout_ccy == ""){                      
                          form_err = 1;                        
                          $("#" + myform).find("input[name=payout_ccy]").css("background-color", "#FFC0CB");        
                   }
          
          }      
          
          if(visi_me){
          
                  var pnl_ccy_pair = $("#" + myform).find("select[name=pnl_ccy_pair]").val();
                  var pnl_rate = $("#" + myform).find("input[name=pnl_rate]").val();
                  var pnl_counter_amt = $("#" + myform).find("input[name=pnl_counter_amt]").val();
                  
                  
                  if(pnl_ccy_pair == ""){
                       form_err = 1;  
                       $("#" + myform).find("select[name=pnl_ccy_pair]").css("background-color", "#FFC0CB");
                       
                  }
                  if (pnl_rate == ""){
                      form_err = 1;
                      $("#" + myform).find("input[name=pnl_rate]").css("background-color", "#FFC0CB");
                        
                  }
                  if (pnl_counter_amt == ""){
                      form_err = 1;
                      $("#" + myform).find("input[name=pnl_counter_amt]").css("background-color", "#FFC0CB");  
                  }
                  
          }
          
          if(form_err == 1){
              return false;
          }          
    
    }
  
	  function save_close(){  
    
            var form_check = check_form();
            
            if(form_check === false){
                  
                    return false;
            
            }else{
        
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
                                  
                					window.parent.getrecord_max();
                          window.parent.getrecord_pnl();   
                          
                          $('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').hide(); 
                          $('#container2').hide(); 
                          $('#back').hide();
                					window.clearInterval(timeupdate);
                					getrecord();
                                           
                          window.self.close();
                					$("#back").html("");   
                          
                          
                				});
                        
            }            
      
		}
    
    
		function save_new(){
    
    
      var form_check = check_form();
            
      if(form_check === false){
            
              return false;
      
      }else{
      
            var myform = $("#contract").val() + "_form";
            
            $("#" + myform).find("input[name=rate]").css("background-color", "#FFF");
            $("#" + myform).find("select[name=client]").css("background-color", "#FFF"); 
            $("#" + myform).find("select[name=buy_sell]").css("background-color", "#FFF"); 
            
      			var val = $("#contract").val();
      			val = "form#"+val+"_form";			
      			$.ajax({
      				  url: "store.php?contract="+$("#contract").val()+"&account="+$("#account").val()+"&status="+$("#status").val(),
      					data: $(val).serialize(),
      					async:false,
      					method:'POST',
      				}).done(function( data ) {
                  //alert(data);
                  //document.write(data);
                  $(".data_saved_text").html("Data Saved Successfully.");
                  $(".data_saved").show();
                  $(".data_saved").fadeTo(2000, 500).hide(500, function(){
                      //$(".data_saved").alert('close');
                  });
                    
                 $("#" + myform).find("input[type=text],input[type=hidden], textarea").val("");
                
                 $("#" + myform + " select option:first-child").attr("selected", "selected");
                
      				});
              
              
              $('.convert_base_area').show();
        
       } 
        
        
        
		}
    
    
		function save_copy(){
    
    
        var form_check = check_form();
            
        if(form_check === false){
              
                return false;
        
        }else{
                          
          			var val = $("#contract").val();
          			val = "form#"+val+"_form";			
          			$.ajax({
          					
                        url: "store.php?save_copy=1&contract="+$("#contract").val()+"&account="+$("#account").val()+"&status="+$("#status").val(),
              					data: $(val).serialize(),
              					async:false,
              					method:'POST',
                    
          				}).done(function( data ) {
                             
                      $(".data_saved_text").html("Data Saved Successfully.");
                      $(".data_saved").show();
                      $(".data_saved").fadeTo(2000, 500).hide(500, function(){
                          //$(".data_saved").alert('close');
                      });
                      
                      //alert(data);
                      
                      var myform = $("#contract").val() + "_form";
                      
                      $("#" + myform).find("input[name=rate]").val("");
                      $("#" + myform).find("input[name=rate]").css("background-color", "#FFC0CB");   
                        
                      
                      $("#" + myform).find("input[name=counter_amt]").val(0);
                      
                      $("#" + myform).find("select[name=client]").prop('selectedIndex', 0);
                      $("#" + myform).find("select[name=client]").css("background-color", "#FFC0CB"); 
                      
                      $("#" + myform).find("input[type=hidden]").val("");
                      
                      //$("#" + myform).find("select[name=buy_sell]").val("");
                      //$("#" + myform).find("select[name=buy_sell]").css("background-color", "#FFC0CB"); 
                      
                      valm = $("select[name=buy_sell]").val();
                      
                      if(valm == "S"){
                          $("#" + myform).find("select[name=buy_sell]").val("B");
                      }else{
                          $("#" + myform).find("select[name=buy_sell]").val("S");
                      }
                      
                      $("#" + myform).find("input[name=fx_pair_id]").val("TLink_"+data);
                      
                      // REMOVE  CONVERT BASE AREA //
                      
                      $("#" + myform).find(".convert_base_area").hide(); 
                      
                      // 
                      
                      
        				});
		      }
          
    }
    
    
    $(document).on('change', '.all_numbers_rate', function() {
          
          var x = $(this).val();
          var xy = x.toUpperCase();
          
          var m = x;
          
          
          
          if(xy.indexOf('Y') > -1){
                                                                
              m = xy.replace('Y',"");              
              m = m * 1000000000;
          
          }
          if(xy.indexOf('M') > -1){
                                                                
              m = xy.replace('M',"");              
              m = m * 1000000;
          
          }
          if(xy.indexOf('K') > -1){
                                                                
              m = xy.replace('K',"");              
              m = m * 1000;
          
          }
                    
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {  
          
                len_string = m.toString().split(".")[1];
                
                if(len_string){
                   numof_float = len_string.length; 
                }else{
                  numof_float = 2;
                }
                                           
                if(numof_float > 0){
                    m = parseFloat(m).toFixed(numof_float);
                }else{
                    m = parseFloat(m).toFixed(2);
                }                            
                      
          } else {               
                m = parseFloat(m).toFixed(6);              
          }                     
          
          if(isNaN(m)){ 
                 m = ""; 
          }else{
                 m = numberWithCommas(m);
          }
                   
          $(this).val(m);
                    
     });
    
    
    $(document).on('change', '.all_numbers', function() {
          
          var x = $(this).val();
          var xy = x.toUpperCase();
          
          var m = x;
          
          if(xy.indexOf('Y') > -1){
                                                                
              m = xy.replace('Y',"");              
              m = m * 1000000000;
          
          }
          if(xy.indexOf('M') > -1){
                                                                
              m = xy.replace('M',"");              
              m = m * 1000000;
          
          }
          if(xy.indexOf('K') > -1){
                                                                
              m = xy.replace('K',"");              
              m = m * 1000;
          
          }
          
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {                  
                
                len_string = m.toString().split(".")[1];
                
                if(len_string){
                   numof_float = len_string.length; 
                }else{
                  numof_float = 2;
                }
                
                if(numof_float > 0){
                    m = parseFloat(m).toFixed(numof_float);
                }else{
                    m = parseFloat(m).toFixed(2);
                }                            
               
                          
          } else {               
                m = parseFloat(m).toFixed(2);                 
          }
          
          //$(this).val(m.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));  
          if(isNaN(m)){ 
                 m = ""; 
          }else{
                 m = numberWithCommas(m);
          }
                   
          $(this).val(m);
                    
          //$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          
     });
    
    
    $(document).on("change, keyup, blur", ".fxsp_rate", cal_amount);
    $(document).on("change, keyup, blur", ".fxsp_not", cal_amount);
           
    function cal_amount(){
          
          var val_rate = $(".fxsp_rate").val();
          var val_not = $(".fxsp_not").val();
          
          val1 = numberWithoutCommas(val_rate);
          val2 = numberWithoutCommas(val_not);                  
          //alert(val1 + " - " + val2);
          
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {             
                cal_val = parseFloat(val1 * val2).toFixed(6);          
          } else {               
                cal_val = parseFloat(val1 * val2).toFixed(2);                 
          }
          
          
          
          if(isNaN(cal_val)){  cal_val = ""; }
                              
          $(".fxsp_camt").val(cal_val);
          
          var x = $(".fxsp_camt").val();    
          //$(".fxsp_camt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));  
          
          numberWithCommas(x);  
          $(".fxsp_camt").val(x);
                  
    
    }
     
    $(document).on("change, keyup, blur", ".fxfw_rate", cal_amount_fxfw);
    $(document).on("change, keyup, blur", ".fxfw_not", cal_amount_fxfw);
         
    function cal_amount_fxfw(){
          
          var val_rate = $(".fxfw_rate").val();
          var val_not = $(".fxfw_not").val();
          
          val1 = numberWithoutCommas(val_rate);
          val2 = numberWithoutCommas(val_not);      
          
           var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {             
                cal_val = parseFloat(val1 * val2).toFixed(6);        
          } else {               
                cal_val = parseFloat(val1 * val2).toFixed(2);                
          }               
          
          if(isNaN(cal_val)){  cal_val = ""; }
                    
          $(".fxfw_camt").val(cal_val);
          
          var x = $(".fxfw_camt").val();
          //$(".fxfw_camt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          //$(".fxsp_camt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));  
          
          numberWithCommas(x);  
          $(".fxsp_camt").val(x);
    
    }
    
    $(document).on("change, keyup, blur", ".fxndf_rate", cal_amount_fxndf);
    $(document).on("change, keyup, blur", ".fxndf_not", cal_amount_fxndf);

        
    function cal_amount_fxndf(){
          
          var val_rate = $(".fxndf_rate").val();
          var val_not = $(".fxndf_not").val();
          
          val1 = numberWithoutCommas(val_rate);
          val2 = numberWithoutCommas(val_not);                  
          
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {             
                cal_val = parseFloat(val1 * val2).toFixed(6);
          } else {               
                cal_val = parseFloat(val1 * val2).toFixed(2);  
          }   
          
          
          if(isNaN(cal_val)){  cal_val = ""; }
                    
          $(".fxndf_camt").val(cal_val);
          
          var x = $(".fxndf_camt").val();
          //$(".fxndf_camt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          numberWithCommas(x);  
          $(".fxndf_camt").val(x);
    
    }
    
    
    $(document).on("change, keyup, blur", "#fxopt_price", cal_amount_fxopt);
    $(document).on("change, keyup, blur", "#fxopt_not", cal_amount_fxopt);
        
    function cal_amount_fxopt(){
          
          var val_rate = $("#fxopt_price").val();
          var val_not = $("#fxopt_not").val();
          
          val1 = numberWithoutCommas(val_rate);
          val2 = numberWithoutCommas(val_not);       
          
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {             
                cal_val = parseFloat(val1 * val2).toFixed(6);
          } else {               
                cal_val = parseFloat(val1 * val2).toFixed(2);
          }       
          
          if(isNaN(cal_val)){  cal_val = ""; }
                    
          $("#fxopt_premamt").val(cal_val);
          
          var x = $("#fxopt_premamt").val();
          //$("#fxopt_premamt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          numberWithCommas(x);  
          $("#fxopt_premamt").val(x);
    
    }
        
    $(document).on("change, keyup, blur", "#eopt_price", cal_amount_eopt);
    $(document).on("change, keyup, blur", "#eopt_not", cal_amount_eopt);
        
    function cal_amount_eopt(){
          
          var val_rate = $("#eopt_price").val();
          var val_not = $("#eopt_not").val();
          
          val1 = numberWithoutCommas(val_rate);
          val2 = numberWithoutCommas(val_not);       
          
          var contract_val = $("#contract").val();
          
          if(contract_val == "FXNDF" || contract_val == "FXOPT") {             
                cal_val = parseFloat(val1 * val2).toFixed(6);
          } else {               
                cal_val = parseFloat(val1 * val2).toFixed(2);
          }     
          
          if(isNaN(cal_val)){  cal_val = ""; }
                    
          $("#eopt_premamt").val(cal_val);
          
          var x = $("#eopt_premamt").val();
          //$("#eopt_premamt").val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          numberWithCommas(x);  
          $("#eopt_premamt").val(x);
    
    }
    
    
    $(document).on("change", ".fxndf_value_date", fxndf_value_date_change);
    
    function fxndf_value_date_change(){
    
            var date2 = $('.fxndf_value_date').datepicker('getDate', '+1d'); 
            date2.setDate(date2.getDate()-2); 
            $('.fxndf_fixing_date').datepicker('setDate', date2);
                  
    }
    
    /////  END :  LOAD FILE CONTENT ///////
    
    
	</script> 	
    
    
    
    <div id="back" style="display:none;"></div>  
    
    <div id="back_email" style="display:none;"></div>
   
<?php

}else{   
    //header("Location: ".HOMEPAGE);
    header("Location: ../");      
}

?>
</body>
</html>