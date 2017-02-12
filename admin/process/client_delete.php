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
  $id_contract = $_GET['id_client'];
   
  $sql = "delete FROM clients where id = $id_contract";
 	$result = $conn->query($sql);
  
  if($result){
       echo json_encode("ok");
  } else {
       echo json_encode("error");
  }
    
  //echo json_encode($output);  
  exit;
?>
       