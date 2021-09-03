<?php include("partials/menu.php"); ?>
<div class="main">
	<div class ="wrapper">
		<h1>Change Password</h1>
		<br><br>
		<?php
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}
		?>
		<form action = "" method= "POST">
			<table class = "tbl-30">
				<tr>
					<td> Old Password: </td>
					<td>
						<input type= "password" name = "old_password" placeholder= "Old Password">
					</td>
				</tr>
				<tr>
					<td> New Password: </td>
					<td>
						<input type= "password" name = "new_password" placeholder= "New Password">
					</td>
				</tr>
				<tr>
					<td>Confirm Password: </td>
					<td>
						<input type= "password" name = "confirm_password" placeholder= "Confirm Password">
					</td>
				</tr>
				<tr>
					<td colspan ="2">
						<input type = "hidden" name = "id" value = "<?php echo $id ; ?>">
						<input type ="submit" name ="submit" value = "Change Password" class = "btn-secondary">
					</td>
				</tr>
			</table>
		</form>
		
	</div>
</div>

<?php
//check whether the submit button is cliked or not
	if(isset($_POST['submit'])){
		//echo "clicked";
		//get data
		$id =$_POST['id'];
		$old_password = md5($_POST['old_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);
		//check user with current id or not
		$sql = "SELECT * FROM tbl_admin WHERE id= $id AND password='$old_password'";
		$res = mysqli_query($conn, $sql); //execute query
		if($res == true){
			//check data avalibale or not
			$count = mysqli_num_rows($res);
			if($count == 1){
				//user exists and password found
				//echo "User found";
				//whether the new password match or not-found
				if($new_password == $confirm_password){
					//echo "update password";
					$sql2 = "UPDATE tbl_admin SET
					password = '$new_password'
					WHERE id =$id
					";
					//execute the query
					$res2 = mysqli_query($conn, $sql2);
					//check whether the query executed or not
					if($res2 == true){
						$_SESSION['change-pass'] ="<div class = 'success'> password has changed successfully </div>";
						header('location:'.SITEURL."admin/manage.php");
						exit;
					}
					else{
						$_SESSION['change-pass'] ="<div class = 'error'> password did not change </div>";
						header('location:'.SITEURL."admin/manage.php");
					}
				}
				else{
					//password is wrong
					$_SESSION['change-pass'] ="<div class = 'error'> password does not match </div>";
					header('location:'.SITEURL."admin/manage.php");
				}				
			}
			else{
				//user is wrong
				$_SESSION['user-not-found'] ="<div class = 'error'> User not found </div>";
				header('location:'.SITEURL."admin/manage.php");
				
			}
		}
		//check the new password or not
		//change password if above all are right
	}
?>
<?php include("partials/footer.php ")  ?>