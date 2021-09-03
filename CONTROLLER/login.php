<?php
	include('../config/constant.php');
?>
<html>
	<head>
		<title>Login-Food Project</title>
		<link rel ="stylesheet" href="../css/admin.css">
	</head>
	<body>
		<div class= "login">
			<h1 class = "text-center"> Login</h1><br><br>
			<?php
				if(isset($_SESSION['login'])){
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}
				if(isset($_SESSION['no-login-message'])){
					echo $_SESSION['no-login-message'];
					unset($_SESSION['no-login-message']);
				}
			?>
			<br><br>
			<!--login start-->
			<form action="" method = "POST" class="text-center">
				Username:<br>
				<input type = "text" name="username" placeholder="Enter Username"><br><br>
				Passowrd:<br>
				<input type ="password" name ="password" placeholder="Enter Password"><br><br>
				<input type ="submit" name ="submit" value="Login" class="btn-primary">
			</form>
			<!--login end-->
			<p class = "text-center"> Created By <a href= "#" > Zinia Nawrin Sukhi</a></p>
		</div>
	</body>


</html>
<?php
//check whether the submit button is clicked or not
	if(isset($_POST['submit'])){
		//get data from login
//$username = $_POST['username'];
		//$password = md5($_POST['password']);
		$username =mysqli_real_escape_string($conn, $_POST['username']);
		$raw_password = md5($_POST['password']);
		$password = mysqli_real_escape_string($conn, $raw_password);
		//whether the username and password exist or not
		$sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password = '$password'";
		//execute query
		$res = mysqli_query($conn, $sql);
		//count rows to check user esit or not
		$count= mysqli_num_rows($res);
		if($count == 1){
			//user avaliable
			$_SESSION['login'] = "<div class = 'success'>Login Successful</div>";
			$_SESSION['user'] = $username; //whether the user is logged in or out
			//redirect to home page
			header("location:".SITEURL.'admin/adin.php');
			exit;
		}
		else{
			//user not avaliable
			$_SESSION['login'] = "<div class = 'error text-center'>Username and password did not match</div>";
			//redirect to home page
			header("location:".SITEURL.'admin/login.php');
			exit;
		}
		
	}

?>