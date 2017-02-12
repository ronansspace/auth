<?php
session_start();
require_once('inc/def.php');  

$mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
			if (mysqli_connect_errno()) {
   				 printf("Connect failed: %s\n", mysqli_connect_error());
    			exit();
			} 
      
      //print "print" . $_SESSION['auth']; 
if(isset($_SESSION['auth'])){

  	
  
	if($_SESSION['auth']==0 && !empty($_POST)){
    
		$traderID = isset($_POST['tdrID'])?htmlspecialchars($mysqli->real_escape_string(trim($_POST['tdrID']))):"";
		$traderPWD = isset($_POST['tdrPWD'])?htmlspecialchars($mysqli->real_escape_string(trim($_POST['tdrPWD']))):"";
		//$token = isset($_POST['token'])?$_POST['token']:"";
		if($traderID!="" && $traderPWD!=""){
			if(strstr($traderID,"--") || strstr($traderID,"#")){
				echo "failed";
			}
			else{
				$q = "SELECT * FROM traders where tdrID='$traderID'";
				$result = $mysqli->query($q);
				if ($result->num_rows ==1) {
					$id = "";
					$pwd = "";
					$uname = "";
  				while($row = $result->fetch_assoc()) {
      				$id = $row['pid'];
  						//$uname = $row['md5ID'];
  						$pwd = $row['tdrPWD'];
              $sadmin = $row['super_admin'];
  				}
					if($pwd == md5($traderPWD)){
            
            $_SESSION['auth']=1;
						$_SESSION['auth_id']=$id;
            $_SESSION['super_admin'] = $sadmin;
            
            setcookie('auth', 1 , time()+(30 * 24 * 60 * 60), '/');
            setcookie('auth_id', $id, time()+(30 * 24 * 60 * 60), '/');
            setcookie('super_admin', $sadmin, time()+(30 * 24 * 60 * 60), '/');
            
						//header("Location: http://www.curvemarkets.com/auth/admin/");
            header("Location: admin/");
            
					}
					else{
						// code for checking login attempts and request password
						//echo "Either TraderID or password not matched.";
            header("Location: index.php?err=y");
					}
				} 
				else {
    				//echo "Either TraderID or password not matched.";
            header("Location: index.php?err=y");
				}
			}
		}
		else
			echo "Either TraderID or password not matched.";
		}
	else{
		header("Location: ".HOMEPAGE);
	}
	$mysqli->close();
}
else{
	//header("Location: ".HOMEPAGE);
  
  header("Location: ../");
}
?>