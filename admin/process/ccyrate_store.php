<?php
session_start();
require_once('../../inc/def.php');

if(tdrLoggedIn()){	
  
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if($conn->connect_error) {
    	 die("Connection failed: " . $conn->connect_error);
    } 
    
    $id_user = $_GET['id_user'];
    
    $ccypair = strtoupper($_POST['ccy_pair']);
    $rate = $_POST['rate'];
    $datadate = $_POST['datadate'];
    //$date = $_POST['date'];

    $trade_date = date('d/m/Y');
    $timestamp = date('Y-m-d H:i:s');

    $sql = "";
    
    if($id_user == ""){
    
          $sql_a = "SELECT * FROM ccyrate where ccypair = '$ccypair' and trade_date = '$datadate'";
        	$result_a = $conn->query($sql_a);
                  
          $size = $result_a->num_rows;
          
          if($size > 0){           
            print "already";
            exit;         
          }           
    
          $sql = "insert into ccyrate(trade_date, ccypair, rate, date)
                  values ('$datadate', '$ccypair', $rate, '$timestamp')";
                      
    } else {
    
          $sql = "update ccyrate set ccypair = '$ccypair', rate = $rate, date='$timestamp'
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
       