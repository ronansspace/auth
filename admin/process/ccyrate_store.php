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
    //$date = $_POST['date'];
    
    $date = str_replace("/", "-", $_POST['ccy_date']);
    $date = date('Y-m-d', strtotime($date));
    
    $sql = "";
    
    if($id_user == ""){
    
          $sql_a = "SELECT * FROM ccyrate where ccypair = '$ccypair'";
        	$result_a = $conn->query($sql_a);
                  
          $size = $result_a->num_rows;
          
          if($size > 0){           
            print "already";
            exit;         
          }           
    
          $sql = "insert into ccyrate(ccypair, rate, date)
                  values ('$ccypair', $rate, '$date')";   
                      
    } else {
    
          $sql = "update ccyrate set ccypair = '$ccypair', rate = $rate, date = '$date'
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
       