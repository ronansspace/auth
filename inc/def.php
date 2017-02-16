<?php
define(HOMEPAGE,"http://46.101.30.196");
define(DBHOST,"localhost");
define(DBUSER,"root");
define(DBPASS,"f6a23e727b2ec091c4a42d117ef744bcf8ee7dbc59802700");
define(DBNAME,"cmarkets");

function generateFormToken($form) {
   
    // generate a token from an unique value
    $token = md5(uniqid(microtime(), true));  
    	
    // Write the generated token to the session variable to check it against the hidden field when the form is sent
    $_SESSION[$form.'_token'] = $token; 
    	
    return $token;
}
function verifyFormToken($form,$token) {
    
    // check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) { 
		return false;
    }
	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $token) {
		return false;
    }
	return true;
}
function tdrLoggedIn(){
	
  if((isset($_SESSION['auth']) && $_SESSION['auth']==1 && isset($_SESSION['auth_id'])) || (isset($_COOKIE['auth']) && isset($_COOKIE['auth_id']))){
	    
      if(!isset($_SESSION['auth']) || !isset($_SESSION['super_admin'])){ 
            
            $_SESSION['auth'] = $_COOKIE['auth'];
      			$_SESSION['auth_id'] = $_COOKIE['auth_id'];
            $_SESSION['super_admin'] = $_COOKIE['super_admin'];
      
      }
      
      return true; 
      
  }else{
      return false;
  }    
  	  
}
?>