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
      
?>

    
	<div class="container-fluid">
    	 
       <div style="width:90%;margin:0 auto;padding-top:15px;">             
       
       <header>
        	  <img src="images/logo.jpg">
            <h1>Manage CCY Rates</h1>
            <h3>
              <label class="label label-success" style="font-weight:100; margin-right:10px;">Trader ID: <?php echo $_SESSION['auth_id'];?></label>
              <label class="label label-info" style="font-weight:100; margin-right:10px;">Trader : <?=ucfirst($client);?></label>
              <button onclick="logout();" class="btn btn-danger btn-sm">Logout</button>
            </h3>
            <br style="clear:both">
        </header>
        
        <div class="controls-div">
            <div class="btn-group" data-toggle="buttons">
                <input type="button" class="btn btn-primary btn-sm record_new" value="New CCY Rate" style="margin-right:0px;">
                <input type="button" class="btn btn-danger btn-sm record_delete" value="Delete CCY Rate" style="margin-right:5px;">
            </div>
        </div>
                                   
        <div style="width:70%;margin: 0 auto;">             
            <table id="jsontable_users" class="display table table-hover table-striped table-bordered nowrap" cellspacing="0" width="100%">
            
                <thead>
                    <tr>                   
                          <th width="2%"> </th>  
                          <th width="4%">ID</th>
                        
                          <th>CCY Pair</th>
                          <th>Rate</th>
                         
                          <th width="25%">Date</th>                         
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
      
      $("body").disableSelection();
      
      $(document).ready(function() {
            getrecord_max();                        
      });     
      
      $(document).on("click", ".record_new", function (){
              
              var page = "newccyrate.php";                     
              $('#back').load('newccyrate.php',function(responseTxt, statusTxt, xhr){                          
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
                
                alert('Select a record.');
                return false;
          
          } else {
             
                   if ($('.check_box:checkbox:checked').length > 1) {                            
                           // your code goes here
                           alert("Please choose only one record to perform delete.");
                           return false;                          
                    }else{    
                    
                          if (confirm('Delete CCY Pair Rate ?')) {                                      
                         
                                //var id_contract = sThisVal;
                                $.ajax({
                                        
                                        url: 'process/ccyrate_delete.php?id_contract=' + checkedVals,
                                        dataType: 'json',
                                        success: function(s){                          
                                            
                                            if(s == "ok"){
                                              //alert('Record Deleted');
                                              getrecord_max();
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
                              //alert('Error');
                          }                          
                    }
         }  
              
      });    
            
      function getrecord_max(){
                  
            $('#jsontable_users').dataTable().fnDestroy();
			      
            var oTable = $('#jsontable_users').dataTable({
               
               "iDisplayLength": 25,
               "processing": true,
               "scrollX": true,
            
            });                                                                                    
                     
            $.ajax({
            
                  url: 'process/all_ccyrates.php',
                  dataType: 'json',
                  success: function(s){ 
                      
                      oTable.fnClearTable();
                      
                      if(s == "empty"){                      
                      }else{  
                      
                            for(var i = 0; i < s.length; i++) 
                            { 
                                  
                                  oTable.fnAddData([ "<input type='checkbox' name='id_trades' class='check_box' value='"+s[i][0]+"'/>", s[i][0], s[i][1], 
                                    s[i][2], s[i][3]
                                  ]);                                       
                                  var theNode = oTable.fnSettings().aoData[i].nTr;
                                  theNode.setAttribute('data-did', s[i][0]);
                                  theNode.setAttribute('class', 'record_row'); 
                            } 
                      
                      }
                                            
                  }, 
                  error: function(e){ 
                  
                    //console.log(e.responseText); 
                    //alert(e.responseText);
                    //alert('Error loading records.')
                  
                  } 
            });
      }
      
      
      function save_user_close(){  
      
          $.ajax({
      					
                    url: "process/ccyrate_store.php?id_user="+$("#id_user").val(),
          					data: $("#FXSP_form").serialize(),
          					async:false,
          					method:'POST',
                
      		  }).done(function( data ) {
                
                      if(data == "already"){
                            alert('CCY Pair rate already exists');
                      }else{
            					
                              window.parent.getrecord_max();
                              
                              $('#FXSP').hide(); 
                              $('#container2').hide();
                              $('#back').html("");
                              $('#back').hide();
                              $('#container').remove();
                               
                              $('#back').hide();
                      }
                
      		  });       
            
		}
    
    $(document).on("dblclick", ".record_row", function (){
              var did = $(this).data("did");
              
              $('#back').html("");
              
              $('#back').load('newccyrate.php?id='+did,function(responseTxt, statusTxt, xhr){if(statusTxt == 'success'){ 
              
              
              $('#back').show(); 
              ch_contract(); 
              $('.container').show();} if(statusTxt == 'error') alert('Error: ' + xhr.status + ': ' + xhr.statusText);});
          
    }); 
      
      
		
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
      
   /////  END :  LOAD FILE CONTENT  ///////
    
    
	</script> 	
    
    <div id="back" style="display:none;"></div>           
    <div id="back_email" style="display:none;"></div>
   
<?php

}else{  
 
    header("Location: ".HOMEPAGE);      
}

?>
</body>
</html>