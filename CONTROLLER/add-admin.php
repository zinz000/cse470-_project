<?php include("partials/menu.php"); ?>
	<div class = "main-content">
		<div class="wrapper">
			<h1>Add Admin</h1>
			<br> <br>
			<?php
				if(isset($_SESSION['add'])){ //checking whether session is set or not
					echo $_SESSION['add']; //displyaing session message
					unset($_SESSION['add']); //removing session message
				}
			?>
			<form action="" method= "POST">
				<table class = "tbl-30">
					<tr>
						<td>Full Name:</td>
						<td><input type = "text" name = "full_name" placeholder = "Enter name"></td>
					</tr>
					<tr>
						<td>UserName:</td>
						<td><input type = "text" name = "username" placeholder = "Your username"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type = "password" name = "password" placeholder = "Enter password"></td>
					</tr>
					<tr>
						<td colspan= "2">
							<input type ="submit" name = "submit" value = "Add Admin" class = "btn-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	
	</div>

<?php include("partials/footer.php ")  ?>


<?php
	//process for value from form save to database
	//check whether the submit button is clicked or not
	if(isset($_POST['submit'])){	
	//button clicked
	//get the data from form
		$full_name= $_POST["full_name"];
		$username= $_POST["username"];
		$password= md5($_POST["password"]); //password encryption with md5
		  //sql query to save the data into database
		$sql =" INSERT INTO tbl_admin SET 
			full_name ='$full_name', 
			username = '$username',
			password = '$password'
		  ";
		//execute and save in database
		
		$res = mysqli_query($conn, $sql) or die(mysqli_error());
		//check whether the data is ineserted or not and display error .

	if($res == true){
	//data inserted
	//create session var to display message
	//echo "inserted";
	$_SESSION['add'] = "Admin Added Successfully";
	//redirect page manage
	header("location:".SITEURL.'admin/manage.php' );
	exit;
}
	else{
	$_SESSION['add'] = "Failed to add admin";
	//redirect page add-admin
	//echo "not inserted";
	header("location:".SITEURL.'admin/add-admin.php' );
	exit;
}
	}
?>