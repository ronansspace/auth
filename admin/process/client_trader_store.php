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
    $email_cc = $_POST['email_cc'];
    $trader_id = $_POST['trader_id'];
    $broker = $_POST['broker'];

    $sql = "";
    
    if($id_client == ""){
    
          $sql = "insert into client_trader(name, email, email_cc, client_id, broker)
                  values ('$client', '$email', '$email_cc', $trader_id, '$broker')";
                      
    } else {
    
          $sql = "update client_trader set broker = '$broker', name = '$client', email = '$email', email_cc = '$email_cc', client_id = $trader_id
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
       