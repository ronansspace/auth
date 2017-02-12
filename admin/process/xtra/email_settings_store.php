<?php
session_start();
require_once('../../inc/def.php');

if(tdrLoggedIn()){	
  
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if($conn->connect_error) {
    	 die("Connection failed: " . $conn->connect_error);
    } 
    
        
        $rbs_email = $_POST['rbs_email'];
        $rbs_subject = $_POST['rbs_subject'];
        $rbs_body = $_POST['rbs_body'];
        $client_subject = $_POST['client_subject'];
        $client_body = $_POST['client_body'];
        $email_from = $_POST['email_from'];
        $email_footer = $_POST['email_footer'];
        $email_disclaimer = $_POST['email_disclaimer'];
        $email_cc = $_POST['email_cc'];
    
        
    
    $sql = "update email_settings set rbs_email = '$rbs_email' , rbs_subject = '$rbs_subject', rbs_body = '$rbs_body',
                  rbs_body = '$rbs_body', client_subject = '$client_subject', client_body = '$client_body', email_from = '$email_from', 
                  email_footer = '$email_footer',  email_disclaimer = '$email_disclaimer', email_cc = '$email_cc'";
                      
    
    
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {                                   
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    $conn->close();
    
}  
?>
       