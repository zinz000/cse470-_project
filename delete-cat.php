<?php 
	include('../config/constant.php');
	if(isset($_GET['id']) AND isset($_GET['image_name'])){
			//get the value
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
	
	//remove img if availbe
		if($image_name!= ""){
			$path = "../images/category/".$image_name;
			//remove it
			$remove = unlink($path);
			//failed to remove and stop the process
			if($remove == false){
				//set session message and redirect
				$_SESSION['remove'] = "<div class = 'error'> Failed to Remove </div>";
				header("location:".SITEURL.'admin/mcat.php');
				die();
			}
		}
	
		$sql = "DELETE FROM tbl_categories WHERE id = $id"; //sql to delete from database
		//execute
		$res = mysqli_query($conn, $sql);
		//check whether data is delete or not
		if($res == true){
			//set success
			$_SESSION['delete']="<div class = 'success'> Category deleted successfully</div>";
			header("location:".SITEURL.'admin/mcat.php');
			
		}
		else{
			//set failed
			$_SESSION['delete']="<div class = 'error'> Failed to delete</div>";
			header("location:".SITEURL.'admin/mcat.php');
			
		}
	}
	//delete
	//redirect
	else{
		//redirect
		header("locatin:".SITEURL.'admin/mcat.php');
	}

?>