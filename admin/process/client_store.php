<?php
session_start();
require_once('../../inc/def.php');

if(tdrLoggedIn()){	
  
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if($conn->connect_error) {
    	 die("Connection failed: " . $conn->connect_error);
    } 
    
    $id_client = $_GET['id_client'];
    $client = $_POST['client'];
    $email = $_POST['email'];
       
    
    $sql = "";
    
    if($id_client == ""){
    
          $sql = "insert into clients(name, email)
                  values ('$client', '$email')";   
                      
    } else {
    
          $sql = "update clients set name = '$client', email = '$email'
                  where id = $id_client";    
    }
    
    
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {                                   
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    $conn->close();
    
}  
?>
       