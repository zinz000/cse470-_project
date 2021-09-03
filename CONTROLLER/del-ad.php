<?php
	//include constant.php here
	include('../config/constant.php');
	//get the id of admin to be deleted
	//create sql query to delete admin
	//redirect to manage admin page
	$id= $_GET['id'];
	$sql = "DELETE FROM tbl_admin WHERE id = $id";
	//execute the query
	$res = mysqli_query($conn, $sql);
	//check whether the query exectued or not
	if($res == true){
		//execute 
		//echo "Admin deleted";
		//create session to display message
		$_SESSION['delete'] = "<div class ='success'>Admin deleted successfully </div>";
		//redirect to manage.php
		header("location:".SITEURL.'admin/manage.php');
		exit;
	}
	else{
	//failed	
		//echo "failed to delete";
		$_SESSION['delete'] = "<div class = 'error'>Failed to delete. Please Try Again</div>";
		header("location:".SITEURL.'admin/manage.php');
		exit;
	}
?>