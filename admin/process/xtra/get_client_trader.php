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
  $cl_id = $_GET['id_client'];    	  
  
    
  $sql = "select * from client_trader where client_id=$cl_id";
    
	$result = $conn->query($sql);
  $size = $result->num_rows;

                      
  $ot = '<option value="">Client Trader</option>';         
  
  while($fetch = $result->fetch_array()) {
  
        $ot .=  '<option value="'.$fetch["id"].'">'.$fetch["name"].'</option>';
        
  }
  
  echo json_encode($ot);  
  exit;
?>
       