<?php
session_start();
require_once('../../inc/def.php');

if(tdrLoggedIn()){	
  
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    
    if($conn->connect_error) {
    	 die("Connection failed: " . $conn->connect_error);
    } 
    
    $id_user = $_GET['id_user'];
    $trader = $_POST['trader'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $super_admin = $_POST['super_admin'];
    
    
    if($password == ""){
        $update_pass = "";
    }else{
        $pwd = MD5($password);
        
        $update_pass = " , tdrpwd = '$pwd' "; 
    }
    
    
    $sql = "";
    
    if($id_user == ""){
    
          $sql = "insert into traders(tdrid, tdrpwd, tdremail, super_admin)
                  values ('$trader', '$pwd', '$email','$super_admin')";   
                      
    } else {
    
          $sql = "update traders set tdrid = '$trader' $update_pass , tdremail = '$email', super_admin = '$super_admin'
                  where pid = $id_user";    
    }
    
    
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {                                   
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
    $conn->close();
    
}  
?>
       