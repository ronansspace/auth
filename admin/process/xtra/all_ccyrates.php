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
      	  
  
    
  $sql = "SELECT * FROM ccyrate";
    
	$result = $conn->query($sql);
    
  $size = $result->num_rows;

  
  if($size <= 0){
  
    print json_encode("empty");
    exit;
    
  }                      
          
  while($fetch = $result->fetch_array()) {
        
        $date = date("d/m/Y", strtotime($fetch['date'])); 
        $rate =  number_format($fetch["rate"], 2, '.', ','); 
                                   
        $output[] = array (           
            $fetch["id"],$fetch["ccypair"],$rate,$date
        );
        
  }
  
  echo json_encode($output);  
  exit;
?>
       