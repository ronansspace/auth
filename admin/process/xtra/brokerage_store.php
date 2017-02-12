<?php
session_start();
require_once('../../inc/def.php');

if(tdrLoggedIn()){	
  
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if($conn->connect_error) {
    	 die("Connection failed: " . $conn->connect_error);
    } 
    
    $id_user = $_GET['id_user'];
    
    $cost_type = $_POST['cost_type'];
    $company = $_POST['company'];
    $cost = $_POST['cost'];
    
    $sql = "";
    
    if($id_user == ""){
    
          $sql = "insert into brokerage(cost_type, company, cost)
                  values ('$cost_type', '$company', $cost)";   
                      
    } else {
    
          $sql = "update brokerage set cost_type = '$cost_type', company = '$company', cost = $cost
                  where id = $id_user";    
    }
    
    
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {                                   
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    $conn->close();
    
}  
?>
       