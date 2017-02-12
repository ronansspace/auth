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
			padding: 5px 5px;
			margin-top:30px;
			border:1px solid black;
			width: 450px;
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
		td input[type="text"],td input[type="date"], input[type="email"], textarea{ 
          
          line-height:90%; width: 100%;
          border: 1px solid #ccc;
          background-color: #fff;
          height: 22px;
          padding: 5px 10px;
          font-size: 12px;
          line-height: 1.5;
          border-radius: 3px;      
          
    }
		
    td input[type="date"]{ height:90%;}
		td{ white-space:nowrap;}
    
    /*.col-md-12 {padding-right:0px;}*/
    .table>tbody>tr>td{
      padding: 6px;
      padding-left: 5px;
      line-height: 1;
      vertical-align: middle;
      border-top: 1px solid #ddd;
    }
    .table{
            margin-top: 20px;  
            margin-bottom: 0px;
    }
    .well{
        margin-bottom: 0px !important;
        min-height: 20px !important;
        padding: 19px !important;
        /* margin-bottom: 20px; */
        background-color: #FBFBFB !important;
        border: 0px solid #e3e3e3; 
        border-radius: 0px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05) !important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.05) !important;
    }
    .row{
      padding: 0px;
      margin-right: 0px;
      margin-left: 0px; 
      
    }
    .col-md-12{
        
            padding-right: 0px;
            padding-left: 0px;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 0px;
        font-weight: 200;
    }
    </style>
    

<div class="container form_drag" style="overflow:auto;">

    <div class="row">
      	<div class="row">
          	<div class="col-md-12">
              	<div class="well">
                    <form class="form_email" method="POST" name="form_email" action="/" enctype="multipart/form-data"> 
                           <fieldset><h4>Email Trades:</h4>
                           
                           <div id="email_message" style="display:none;"> 
                           
                                <div class="alert alert-success">
                                  <strong>Email !</strong> sent successfully.
                                </div>
                                <center>
                                  <input type="button" class="btn btn-sm btn-danger close_button_email" value="Close">
                                </center>
                                
                           </div>
                           
                           <table class="table" border="0" id="table_form">
                           
                                  <tbody><tr><td><label for="name">Name: </label></td>
                                  <td><input type="text" required name="name" class="setInputSize"></td></tr>
                                   
                                  <tr><td><label for="email">To: </label></td>
                                  <td><input type="email" required name="emailTo" class="setInputSize"></td></tr>
                                   
                                   <tr><td><label for="Cc">Cc: </label></td>
                                  <td><input type="email" name="emailCc" class="setInputSize"></td></tr>
                                  
                                  <tr><td><label for="message">Message:</label></td>
                                  <td><textarea name="message" style="height: 68px;"></textarea></td></tr>
                                   
                                  <tr><td colspan="2"><label for="uploaded_file">Select A File To Upload:</label></td></tr>
                                  <tr><td colspan="2">
                                  <input type="file" name="uploaded_file" class="btn btn-default" style="width:100%"></td></tr>
                                   
                                  <tr><td colspan="2">
                                    
                                    
                                    <div class="row" style="margin-top:10px;float:right;">
                                        
                                        <input type="hidden" name="id_trades" value="<?=$_GET["id_contract"];?>">
                                        
                                        <input type="submit" id="submitButton" class="btn btn-sm btn-default" value="Send Email">
                                        
                                        <input type="button" class="btn btn-sm btn-danger close_button_email" value="Cancel">
                                      </div>
                                  
                                  
                                  </td></tr></tbody>
                                  
                            </table>
                          
                          
                          </fieldset>
                    </form>
                </div>
              
        	 </div>
        </div>
    
        
  	</div>
    
</div>
    
    
    
	<script>
  
	   $(document).ready(function(){  
     
          $( ".form_drag" ).draggable(); 
          
          
          $('.close_button_email').on('click', function() {
             
              
              //$('#FXSP,#FXFW,#FXNDF,#FXOPT,#EOPT').remove(); 
             
               
              //window.clearInterval(timeupdate);
               
              
              //$('#back').innerHTML("");
              $('#back_email').html("");
              $('#container').hide();
              $('#back_email').hide();
              
              
              
              
          });
     
     });  
     
     $(".form_email").submit(function( event ) {          
        
        event.preventDefault();                   
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: 'emailtradeform.php',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {                    
                //alert(data);
                if(data == "fl_size"){                     
                      alert("Max allowed file size is 1MB");                 
                }
                if(data == "sent"){                       
                      $("#table_form").hide();
                      $("#email_message").show();    
                      window.parent.getrecord_max();
                }
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
        return false;
        
                
     });
     
     
     
     
     

  </script>
    
    
<?php
}
?>   
  