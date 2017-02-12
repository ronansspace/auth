<?php
	session_start();
	require_once('../inc/def.php');
	if(isset($_SESSION['auth']) && $_SESSION['auth']!=0){
		if(tdrLoggedIn()){
			session_unset();
			session_destroy();
			echo "success";
		}
		else{
			echo "failed";
		}
	}
	else{
		header("Location: ".HOMEPAGE);
	}
?>