<?php 
	include('../config/constant.php');
	//echo "delete food";
	//whether value is passed or not
	if(isset($_GET['id']) && isset($_GET['image_name'])){
		//process to delete
		//echo "process to delte";
		//get id and image name
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		//remove the image if availbe
		//check whether img is avalible or nor
		if($image_name != "" ){
			$path = "../images/food/".$image_name;
			//remove img file from folder
			$remove = unlink($path);
			//check whether the imag is removed or not
			if($remove == false){
				//failed to remove
				$_SESSION['upload'] = "<div class = 'error'> Failed to remove image </div>";
				header("location:".SITEURL.'admin/mfood.php');
				die();
			}
		}
		
		//delte food from database
		$sql = "DELETE FROM tbl_food WHERE id=$id";
		$res = mysqli_query($conn, $sql);
		//whether the query is exectued or not 
		if($res == true){
			$_SESSION['delete'] = "<div class = 'success'> Food Deleted successfully</div>";
			header("location:".SITEURL.'admin/mfood.php');
		}
		else{
			//redirect to mfood 
			$_SESSION['delete'] = "<div class = 'error'> Failed to delete</div>";
			header("location:".SITEURL.'admin/mfood.php');
		}
		
	}
	else{
		//redirect
		//echo "failed";
		$_SESSION ['unauthorized'] = "<div class = 'error'> Unauthorized access </div>";
		header("location:".SITEURL.'admin/mfood.php');
	}

?>