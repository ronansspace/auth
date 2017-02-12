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
      	  
  
    
  $sql = "SELECT * FROM clients order by name";
    
	$result = $conn->query($sql);
    
  $size = $result->num_rows;

  
  if($size <= 0){
  
    print json_encode("empty");
    exit;
    
  }                      
          
  while($fetch = $result->fetch_array()) {
  
               
        $output[] = array (           
        
            $fetch["id"],$fetch["name"],$fetch["email"]
        
        );
        
        
  }
  
  echo json_encode($output);  
  exit;
?>
       