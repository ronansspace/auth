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
      	  
  
    
  $sql = "SELECT * FROM traders";
    
	$result = $conn->query($sql);
    
  $size = $result->num_rows;

  
  if($size <= 0){
  
    print json_encode("empty");
    exit;
    
  }                      
          
  while($fetch = $result->fetch_array()) {
        
        if($fetch["super_admin"] == 1){
            $sa = "YES";
        }else{
            $sa = "NO";
        }
               
        $output[] = array (           
        
            $fetch["pid"],$fetch["tdrID"],$fetch["tdrEMAIL"],$sa
        
        );
        
        
  }
  
  echo json_encode($output);  
  exit;
?>
       