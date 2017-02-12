<?php

session_start();
require_once('../inc/def.php');

$id_user = "";
$email = "";
$trader = "";
$super_admin = "";

if(isset($_GET['id'])){

        $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        
        if ($conn->connect_error) {
    		    die("Connection failed: " . $conn->connect_error);
    	  } 
        
    	  $tdrID = $_SESSION['auth_id'];
      
        $id_user = $_GET['id'];   
        $sql = "SELECT * FROM traders where pid = $id_user";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        $email = $row['tdrEMAIL'];
        $trader = $row['tdrID'];
        $super_admin = $row['super_admin'];
       
}


if(!tdrLoggedIn()){	
}else{

?>

<style>		    
         		
    div.container{ 			
    
            background-color:#fff; 			
            padding:10px 42px; 			
            margin-top:5px; 			
            border:1px solid black;
            width: 800px; 
    
    } 		
    
    div.top{ background-color:#101010; padding-top:4px; padding-bottom:5px; } 		
    label.lb-left{ padding:3px 12px; color:#fff; background-color:#5E94DD;border-top-right-radius: 0em;border-bottom-right-radius: 0em; } 		
    label.lb-right{ background-color:#fff;padding:3px 12px; color:#101010;border-top-left-radius: 0em;border-bottom-left-radius: 0em; margin-right:20px; } 		
    label.lb-right select{ border:none; outline:none; min-width:70px; } 		
    td select,td input[type="text"],td input[type="date"]{ width:90%; } 		
    td input[type="text"],td input[type="date"]{ line-height:90%; } 		
    td input[type="date"]{ height:90%; } 		
    td{ white-space:nowrap; }          
    .col-md-12 { padding-right:0px; }     
    .table>tbody>tr>td{ padding: 6px; padding-left: 5px; line-height: 1; vertical-align: middle;  border-top: 1px solid #ddd; }    
    .table{ margin-top: 20px; }             
        
    input[type="button"]{ margin-right:15px; }
    
    .data_saved{
        width: 400px;
        float: right;
        display: inline;
        padding: 5px;
        margin-bottom: 0px;
    }
                      
</style>    

<div class="container form_drag" style="overflow:auto;">	
  <div class="row">    	
    
    <div class="row" id="FXSP" style="">            	
      <div class="col-xs-12" style="background-color:#eee;">				
        <h4>Manage User</h4>
        
        <form id="FXSP_form" action="#" target="_blank" method="post" enctype="application/x-www-form-urlencoded">                       
          <input type="hidden" id="id_user" name="id_user" value="<?=$id_user;?>">                           	
          <table class="table" border="0">                	
            <tbody>     
                           	
              <tr>                        	
                  <td>Trader:</td>
                  <td>
                    <input tabindex="1" id="fxsp_rate" class="fxsp_rate" type="text" name="trader" value="<?=$trader;?>"></td>
                  </td>                        	
                  
                  <td>Password:</td>
                  <td>
                      <input tabindex="2" class="fxsp_rate" type="text" name="password" value="">
                  </td>                            
                         
              </tr>  
                            
              <tr>                        	
                  <td>Email:</td>
                  <td>
                      <input tabindex="3" type="text" name="email" value="<?=$email;?>" class="all_dates">
                  </td>                            
                  
                  <td>Admin:</td>
                  <td>		                             
                      <select tabindex="4" name="super_admin">								                             
                        <option <?php if(isset($super_admin) && $super_admin == "0" || $super_admin == ""){ echo "selected"; }?> value="0">NO</option> 						 												    
                        <option <?php if(isset($super_admin) && $super_admin == "1"){ echo "selected"; }?> value="1">YES</option>   												    
                      </select>
                  </td>                                     
              </tr>  
                                    
              <tr>                        
              						                                
              </tr>                    
            </tbody>                
          </table>				
        </form>            
      </div>        
    </div>                 
    
              
  </div> 
    
  <div class="row" style="margin-top:10px;">
  
    <input type="button" class="btn btn-primary btn-sm" value="Save &amp; Close" onclick="save_user_close();">    
            
    <input type="button" class="btn btn-danger btn-sm close_button" value="Cancel">
    
    <div class="alert alert-success data_saved" id="success-alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong class="data_saved_text"></strong>    
    </div>
    
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
              $('#back').html("");
              $('#back').hide();
              $('#container').remove(); 
          });
          
      
	});
  
    
    
	</script> 	
<?php
	}
?>