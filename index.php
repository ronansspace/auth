<?php
session_start();

if( (isset($_SESSION['auth']) && $_SESSION['auth']==1) || isset($_COOKIE['auth_id'])) {

      header("Location: admin/");

}else{
    
    $_SESSION['auth'] = 0;
    
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">   

<head>   
<title>Curve Markets</title>
<link rel="icon" type="image/png" href="admin/images/favicon.png" />   
  
<link rel="stylesheet" type="text/css" href="css/maxstyle.css" />
<META http-equiv="Pragma" content="no-cache" />
<!--<marquee direction="right" behavior="scroll" scrollamount="5" style="position:absolute; border:3px solid; right:300px; left:440px; top:70px"><font color="#000000" size="3" ><img src="images/FlyingParrot.gif" height="auto" width="auto"></font></marquee>-->
<!--<img src="images/Parrot_animated_.gif" height="100px" width="100px" style="position:absolute; margin-left:650px; margin-top:-55px">-->

</head>  

<body>  
                     

<div id="parent">

<div id="wrapper">

        <div id="content">        
        <div id="header" bgcolor="lightgrey">
        <center>
            <img src="img/CurveMarketlogo.jpeg" width=250px height=70px> 
            <br>
          <!--style="border-radius: 10px;"-->
          <?php
          if(isset($_GET['err'])){
          ?> 
                <center style="margin-top:8px;margin-bottom:5px;">
                    <font  size="2" color="#ff0000">Either TraderID or password not matched.</font>
                </center>
          <?php
          }
          ?>
        
          <font size=5>Login</font>
        </center>
        
        </div>
        
        <div id="main">
        <form id="tradername" name="tradername" method="post" action="auth.php" autocomplete="on">
         
                <label id="trader" for="trader">Trader Name</label>
                <!--<select id="trader" name="trader">  
                  
                </select>-->
                <input type="text" id="trader" name="tdrID" value="" />
                <br>
                <label id="pass" for="password">Password</label>
                <input id="password" name="tdrPWD" type="password" value="">
                <center>
                <input id="login" name="login" type="submit" value="Enter">
                </center>
         </form>    
         
         
        </div>
        </div>
</div>   
</body> 


</html> 
