<?php include("partials/menu.php"); ?>
 <div class ="main" >
	<div class = "wrapper">
		<h1>Update Admin</h1>
		<br> <br>
		<?php 
			//get the id of the admin
			$id = $_GET['id'];
			
			//create sql to get detail
			$sql = "SELECT * FROM tbl_admin WHERE id=$id";
			//execute query
			$res = mysqli_query($conn, $sql);
			//whether the query executed or not
			if($res == true){
				//whether the data is avaible or not
				$count = mysqli_num_rows($res);
				//check whether we have admin data or not
				if($count == 1){
					//get the details
					//echo "admin avaliable";
					$row = mysqli_fetch_assoc($res);
					$full_name = $row['full_name'];
					$username = $row['username'];
					
				}
				else{
					//redirect to manage
					header('location:'.SITEURL.'admin/manage.php');
					exit;
				}
			}
		?>
		<form action = "" method= "POST">
			<table class = "tbl-30">
				<tr>
					<td>Full Name: </td>
					<td>
					<input type = "text" name = "full_name" value ="<?php echo $full_name ;?>">
					</td>
				</tr>
				<tr>
					<td>User Name: </td>
					<td>
					<input type = "text" name = "username" value ="<?php echo $username ;?>">
					</td>
				</tr>
				<tr>
					<td colspan ="2">
						<input type = "hidden" name ="id" value = "<?php echo $id ;?>">
						<input type = "submit" name= "submit" value ="Update Admin" class = "btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	<div>
 </div>
 <?php
	//whether submit button clicked or not
if(isset($_POST['submit'])){
	//echo "button clicked";
	//get all values from form to update
	$id = $_POST['id'];
	$full_name = $_POST['full_name'];
	$username = $_POST['username'];
	//create sql query to update admin
	$sql = "UPDATE tbl_admin SET
	full_name = '$full_name',
	username = '$username'
	WHERE id ='$id'
	";
		//execute query
	$res = mysqli_query($conn, $sql);
	//whether the query executed or not
	if($res == true){
		//query executed and admin updated
		$_SESSION['update'] = "<div class = 'success'>Admin Updated Successfully</div>";
		header('location:'.SITEURL.'admin/manage.php');
		exit;
	}
	else{
		//failed
		$_SESSION['update'] = "<div class = 'error'>failed to Updated </div>";
		header('location:'.SITEURL.'admin/manage.php');
		exit;
	}
}
 ?>
<?php include("partials/footer.php ")  ?>