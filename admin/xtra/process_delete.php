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
  $id_contract_name = "Tlink_".$id_contract;
  
  $sql4 = "SELECT * FROM contract where id_contract = $id_contract";
  $result4 = $conn->query($sql4);
  $row4 = $result4->fetch_assoc(); 
  
  $id_contract_name_2 = $row4["fx_pair_id"];
  
                           
  $sql1 = "delete FROM contract where id_contract = $id_contract OR fx_pair_id = '$id_contract_name'";
  $result = $conn->query($sql1);
  
  if($id_contract_name_2 <> ""){
        
        $master_id = explode("_", $row4["fx_pair_id"]);
        $master_id_id = $master_id[1];
        
        $sql2 = "delete FROM contract where id_contract = $id_contract OR id_contract = $master_id_id OR fx_pair_id = '$id_contract_name_2'";
        $result2 = $conn->query($sql2);
        
  }
  
  $sql3 = "delete FROM profit_loss where trade_id = $id_contract OR master_trade_id = $id_contract";
  $result3 = $conn->query($sql3);
  //
  
  
 	
  
  if($result){
       echo json_encode("ok");
  } else {
       echo json_encode("error");
  }
    
  //echo json_encode($output);  
  exit;
?>
       