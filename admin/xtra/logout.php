<?php
	session_start();
	//require_once('../inc/def.php');
	//if(isset($_SESSION['auth']) && $_SESSION['auth']!=0){
		//if(tdrLoggedIn()){
			session_unset();
			session_destroy();
      
      unset($_COOKIE['auth']);
      unset($_COOKIE['auth_id']);
      unset($_COOKIE['super_admin']);
      
      setcookie('auth', null, -1, '/');
      setcookie('auth_id', null, -1, '/');
      setcookie('super_admin', null, -1, '/');
      
      
			echo "success";
		//}
		//else{
			//echo "failed";
		//}
	//}else{
 //header("Location: ".HOMEPAGE);
	//}
?>