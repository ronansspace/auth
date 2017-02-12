<?php
session_start();
require_once('../../inc/def.php');
if(tdrLoggedIn()){  }

  // Create connection
	// $conn = new mysqli($servername, $username, $password, $dbname);
  $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
  $tdrID = $_SESSION['auth_id'];
  $ccypair = strtoupper($_GET['ccypair']);    	  
  
    
  $sql = "select * from ccyrate where ccypair='$ccypair'";
    
	$result = $conn->query($sql);
  $size = $result->num_rows;

  $fetch = $result->fetch_array();
  
  $dt = date("d/m/Y", strtotime($fetch['date']));
  
  $date_now = date("d/m/Y");
 
  if($date_now > $dt){
       $text_red = "text_red"; 
  }else{                                          
       $text_red = ""; 
  }           
  
  $output[] = array (
  
        $fetch["rate"], $dt, $text_red
  );     
  //$ot = $fetch["rate"];  
  
  echo json_encode($output);  
  exit;
?>
       