<?php
session_start();
require_once('../inc/def.php');
if(tdrLoggedIn()){  }
	
  // Create connection
	// $conn = new mysqli($servername, $username, $password, $dbname);
  $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
  $tdrID = $_SESSION['auth_id'];
  $id_contract = $_GET['id_contract'];
  $what_anony = $_GET['what_anony']; 
  
  $pb_email_sent = $_GET['pb_email_sent']; 
  $client_email_sent = $_GET['client_email_sent']; 
  
  if($pb_email_sent == "" || $pb_email_sent == 0){
        $pb_email_sent_save = 0;
  }else{
        $pb_email_sent_save = 3;
  }
  
  if($client_email_sent == "" || $client_email_sent == 0){
        $client_email_sent = 0;
  }else{
        $client_email_sent = 3;
  }
  
  
  if($what_anony == "delete"){
       $update_col = "deleted_trade_flag";
  }      
  if($what_anony == "amend"){
       $update_col = "amended_trade_flag";
  }
   
  $sql = "update contract set $update_col = 1, pb_email = $pb_email_sent_save, client_email = $client_email_sent where tdrID = $tdrID and id_contract = $id_contract";
 	$result = $conn->query($sql);
  
  if($result){
       echo json_encode("ok");
  } else {
       echo json_encode("error");
  }
    
  //echo json_encode($output);  
  exit;
?>
       