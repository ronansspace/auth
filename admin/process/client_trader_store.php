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
    $email_bcc = $_POST['email_cc'];
    $trader_id = $_POST['trader_id'];
    $broker = $_POST['broker'];
    $clientName = "";

    $sql2 = "select * from clients where id = '$client'";
    $result2 = $conn->query($sql2);
    $fetch2 = $result2->fetch_array();

    if($fetch2['name'] <> ""){
        $client_name = $fetch2['name'];
    }


    $sql = "";
    
    if($id_client == ""){
    
          $sql = "insert into client_trader(name, email, email_cc, client_id, broker, email_bcc, ClientName)
                  values ('$client', '$email', '$email_cc', $trader_id, '$broker', '$email_bcc', '$client_name')";
                      
    } else {
    
          $sql = "update client_trader set broker = '$broker', name = '$client', email = '$email', email_cc = '$email_cc', email_bcc = '$email_bcc', client_id = $trader_id, ClientName = '$client_name'
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
       