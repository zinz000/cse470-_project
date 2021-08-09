<?php
	//whether the user is logged in or not
	//authorization
	if(!isset($_SESSION['user'])){ //if user is session is not set
		//user is not logged in
		$_SESSION['no-login-message']="<div class = 'error text-center'>please login to access admin panel</div>";
		//rediredt to login page
		header('location:'.SITEURL."admin/login.php");
	}
?>