<?php include('partials/menu.php'); ?>
<div class = "main-content">
	<div class = "wrapper" >
		<h1> Add Category </h1>
		<br>
		<br>
		<?php 
			if(isset($_SESSION['add'])){
				echo $_SESSION['add'];
				unset($_SESSION['add']);
				
			}
			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
				
			}
		
		?>
		<br>
		<br>
		<form action = "" method = "POST" enctype = "multipart/form-data">
			<table class = "tbl-30">
				<tr>
					<td>Title:</td>
					<td> 
						<input type = "text" name = "title" placeholder = "Title">
					</td>
				</tr>
				<tr>
					<td> Select Image: </td>
					<td>
						<input type ="file" name = "image">
					</td>
				<tr>
				
				<tr>
					<td>Featured: </td>
					<td>
						<input type = "radio" name = "featured" value ="Yes">Yes
						<input type = "radio" name = "featured" value = "No">No
						
					</td>
					
				</tr>
				<tr>
					<td>Active: </td>
					<td>
						<input type = "radio" name = "active" value="Yes">Yes
						<input type = "radio" name  ="active" value ="No"> No
					</td>
					
				</tr>
				<tr>
					<td>
						<input type = "submit" name = "submit"  class = "btn-secondary" value="Add Category">
					</td>
					
				</tr>
			</table>
		</form>
		<?php 
			if(isset($_POST['submit'])){
				//get the value from form
				$title = $_POST['title'];
				//for radio, check clicked or not
				if(isset($_POST['featured'])){
					//get the value
					$featured = $_POST['featured'];
				}
				else{
					$featured = "No"; //default
				}
				if(isset($_POST['active'])){
					$active =$_POST['active'];
				}
				else{
					$active ="No";
				}
				//whether img is selected or not and get img value
				if(isset($_FILES['image']['name'])){
					//upload img
					//src path n des path
					$image_name = $_FILES['image']['name'];
					//renameing
					$ext = end(explode('.',$image_name));
					$image_name = "food_category_".rand(000,999).'.'.$ext;
					$src = $_FILES['image']['tmp_name'];
					$des ="../images/category/".$image_name;
					//upload
					$upload = move_uploaded_file($src, $des);
					//whether the img upload or not
					//if img not upload, we ll stop the process and redirect
					if($upload == false){
						$_SESSION['upload'] = "<div class = 'error> Failed to upload </div>'";
						header("location:".SITEURL.'admin/addcat.php');
						die();
						
					}

				}
				else{
					//deafult
					$image_name = "";
				}
				//sql query to insert
				$sql = "INSERT INTO  tbl_categories SET
				title  = '$title',
				image_name = '$image_name',
				featured = '$featured',
				active = '$active'";
				//execute
				$res = mysqli_query($conn, $sql);
				//whether query working or not
				if($res == true){
					//category added
					$_SESSION['add'] = "<div class = 'success'> Category Added Successfully</div>";
					header("location:".SITEURL.'admin/mcat.php');
					die();
				}
				else{
					//failed
					$_SESSION['add'] = "<div class = 'error'> Failed to add category</div>";
					header("location:".SITEURL.'admin/addcat.php');
					die();
				}
				
			}
		?>
	</div>
</div>

<?php include('partials/footer.php'); ?>





