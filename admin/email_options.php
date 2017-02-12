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
        
        if ($conn->connect_error) {
    		    die("Connection failed: " . $conn->connect_error);
    	  } 
        
    	  $tdrID = $_SESSION['auth_id'];
      
        $sql = "SELECT * FROM email_settings";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        $rbs_email = $row['rbs_email'];
        $rbs_subject = $row['rbs_subject'];
        $rbs_body = $row['rbs_body'];
        $client_subject = $row['client_subject'];
        $client_body = $row['client_body'];
        $email_from = $row['email_from'];
        $email_footer = $row['email_footer'];
        $email_disclaimer = $row['email_disclaimer'];
        $email_cc = $row['email_cc'];
        
        $sql1 = "SELECT * FROM traders where pid = ".$_SESSION['auth_id'];
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        
        $client = $row1['tdrID'];
        
?>

    
	<div class="container-fluid">
    	 
       <div style="width:90%;margin:0 auto;padding-top:15px;">             
       
       <header>
        	<img src="images/logo.jpg">
            <h1>Manage Email Options</h1>
            <h3>
              <label class="label label-success" style="font-weight:100; margin-right:10px;">Trader ID: <?php echo $_SESSION['auth_id'];?></label>
              <label class="label label-info" style="font-weight:100; margin-right:10px;">Trader : <?=ucfirst($client);?></label>
              <button onclick="logout();" class="btn btn-danger btn-sm">Logout</button>
            </h3>
            <br style="clear:both">
        </header>
        <!--
        <div class="controls-div">
            <div class="btn-group" data-toggle="buttons">
                <input type="button" class="btn btn-primary btn-sm record_new" value="New Client" style="margin-right:0px;">
                <input type="button" class="btn btn-danger btn-sm record_delete" value="Delete Client" style="margin-right:5px;">
            </div>
        </dv>
        -->
        <br><br>
                       
        <div style="width:70%;margin: 0 auto;">             
              
              
              <div class="row" id="FXSP" style="">            	
                <div class="col-xs-12" style="background-color:#fff;">				
                  
                  <br>
                  <div class="alert alert-success email_saved" id="success-alert" style="display:none;">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong class="data_saved_text"> RECORD SAVED</strong>    
                  </div>
                  
                  <form id="FXSP_form" action="#" role="form" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                       
                                     	
                    <table class="table table_max" border="0">                	
                      <tbody>   
                           	
                        <tr>                                                    	
                            <td width="25%">RBS Email :</td>
                            <td colspan="3">
                              <input tabindex="1" id="fxsp_rate" class="form-control input-sm" type="text" name="rbs_email" value="<?=$rbs_email;?>"></td>
                            </td>  
                        </tr>  
                        
                        <tr>                                               	
                            <td>Email CC :</td>
                            <td colspan="3">
                              <input tabindex="1" id="fxsp_rate" class="form-control input-sm" type="text" name="email_cc" value="<?=$email_cc;?>"></td>
                            </td>   
                        </tr> 
                        
                        <tr>  
                                              	
                            <td>RBS Email Subject :</td>
                            <td colspan="3">
                              <input tabindex="1" id="fxsp_rate" class="form-control input-sm" type="text" name="rbs_subject" value="<?=$rbs_subject;?>"></td>
                            </td>   
                        </tr>  
                        <tr>              	
                            <td>RBS Email Body :</td>
                            <td colspan="3">
                              <textarea name="rbs_body" class="form-control input-sm" rows="7"><?=$rbs_body;?></textarea></td>
                            </td>   
                        </tr> 
                                      
                        <tr>                        
                        	<td colspan="4"><hr></td>					                                
                        </tr>  
                        
                       
                        <tr>                                                   	
                            <td>Client Email Subject :</td>
                            <td colspan="3">
                              <input tabindex="1" id="fxsp_rate" class="form-control input-sm" type="text" name="client_subject" value="<?=$client_subject;?>"></td>
                            </td>   
                        </tr>  
                        <tr>              	
                            <td>Client Email Body :</td>
                            <td colspan="3">
                              <textarea name="client_body" class="form-control input-sm" rows="7"><?=$client_body;?></textarea></td>
                            </td>   
                        </tr>                          
                        
                        <tr>                        
                        	<td colspan="4"><hr></td>					                                
                        </tr>                           
                       
                        <tr>                                               	
                            <td>Email From :</td>
                            <td colspan="3">
                              <input tabindex="1" id="fxsp_rate" class="form-control input-sm" type="text" name="email_from" value="<?=$email_from;?>"></td>
                            </td>   
                        </tr>  
                        
                        
                        
                        <tr>              	
                            <td>Email Footer :</td>
                            <td colspan="3">
                              <textarea name="email_footer" class="form-control input-sm" rows="7"><?=$email_footer;?></textarea></td>
                            </td>   
                        </tr> 
                        
                        <tr>              	
                            <td>Email Disclaimer :</td>
                            <td colspan="3">
                              <textarea name="email_disclaimer" class="form-control input-sm" rows="7"><?=$email_disclaimer;?></textarea></td>
                            </td>   
                        </tr> 
                        
                        
                        <tr>                        
                        	<td colspan="4"><hr></td>					                                
                        </tr>                           
                       
                        <tr>                                               	
                            
                            <td colspan="4" align="center">
                              <input type="button" class="btn btn-primary btn-sm update_info" value="Update Email Settings" style="margin-right:5px;">
                            </td>   
                        </tr>  
                        
                                          
                      </tbody>                
                    </table>				
                  </form>            
                </div>        
              </div>
        </div>
         
       </div>       
    </div>      
    <br><br><br>
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
      
     
      $(document).on("click", ".update_info", function (){          
      
          $.ajax({
      					
                url: "process/email_settings_store.php",
      					data: $("#FXSP_form").serialize(),
      					async:false,
      					method:'POST',
                
      		  }).done(function( data ) {   
                
                $(".email_saved").show();
                $(".email_saved").fadeTo(3000, 500).hide(500, function(){
                    
                });
                
                $(window).scrollTop(0);
                                                          
      		  });       
                        
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