<?php
	//echo "update";
	include("partials/menu.php");
?>
<div class ="main-content">
	<div class ="wrapper">
		<h1>Update Category</h1>
		<br><br>
		<?php
			//whether the id is set or not
			if(isset($_GET['id'])){
				//get id
				//echo "getting cat";
				$id =$_GET['id'];
				//create query to get data
				$sql ="SELECT * FROM tbl_categories WHERE  id=$id";
				//execute the query
				$res = mysqli_query($conn,$sql);
				//count the rows to know valid or not
				$count=mysqli_num_rows($res);
				if($count ==1){
					$row = mysqli_fetch_assoc($res);
					$title =$row['title'];
					$current_image =$row['image_name'];
					$featured =$row['featured'];
					$active =$row['active'];
				}
				else{
					//redirect
					$_SESSION['no-category-found']= "<div class ='error'>Category failed to save</div>";
					header('location'.SITEURL.'admin/mcat.php');
				}
			}
			else{
				header('location:'.SITEURL.'admin/mcat.php');
				
			}
		?>
		<form action ="" method="POST" enctype ="multipart/form-data">
			<table class= "tbl-30">
				<tr>
					<td> Title: </td>
					<td>
						<input type = "text" name = "title" value= "<?php echo $title ;?>">
					</td>
				</tr>
				<tr>
					<td> Current Image: </td>
					<td>
						<?php
							if($current_image!= ''){
								//display img
								?>
								<img src="<?php echo SITEURL;?>images/category/<?php echo $current_image ?>" width ="100px">
								<?php
							}
							else{
								//display msg
								echo"<div class ='error'> Image is not added</div>";
							}
						?>
						
					</td>
				</tr>
				<tr>
					<td> New Image : </td>
					<td>
						<input type = "file" name = "image">
					</td>
				</tr>
				<tr>
				<td>Featured: </td>
				<td>
					<input <?php if($featured =="Yes"){echo 'checked';}?> type = "radio" name = "featured" value= "Yes">Yes
					<input <?php if($featured =="No"){echo 'checked';}?> type = "radio" name = "featured" value= "No">No
				</td>
			</tr>
			<tr>
				<td>Active: </td>
				<td>
					<input <?php if($active =="Yes"){echo 'checked';}?> type = "radio" name = "active" value= "Yes">Yes
					<input <?php if($active =="No"){echo 'checked';} ?> type = "radio" name = "active" value= "No">No
				</td>
			</tr>
			<tr>
				<td>
					<input type ="hidden" name ="current_image" value="<?php echo $current_image;?>">
					<input type ="hidden" name ="id" value="<?php echo $id;?>">
					<input type = "submit" name = "submit" value= "Update Category" class ="btn-secondary">
					
				</td>
			</tr>
			</table>
		</form>
		<?php
			if(isset($_POST['submit'])){
				//echo "clicked";
				//get all values from our form
				$id =$_POST['id'];
				$title = $_POST['title'];
				$current_image =$_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];
				//updating new img
				//check whether the img is selected or not
				if(isset($_FILES['image']['name'])){
					//get img details
					$image_name = $_FILES['image']['name'];
					if($image_name!= ''){
						//img avaliable
						//upload new img
						$ext = end(explode('.',$image_name));
						$image_name ="food_category_".rand(000, 999).'.'.$ext;//food_category_834.jpg
						$source_path = $_FILES['image']['tmp_name'];
						$destination_path = "../images/category/".$image_name;
						//finally upload image
						$upload = move_uploaded_file($source_path,$destination_path);
						//check whether the img upload or not
						//if image is not uploaded , we will stop the process and redirect to error message
						if($upload == false){
							$_SESSION['upload'] = "<div class='error'>Failed to upload an image</div> ";
							header("location:".SITEURL.'admin/mcat.php');
							die();
						}
						//remove prev  img avaliable
						if($current_image!= ''){
							$remove_path = '../images/category/'.$current_image;
							$remove = unlink($remove_path);
							//check img is removed or not
							if($remove == false){
								$_SESSION['failed_remove']="<div class = 'error'> Failed to remove current image </div>";
								header("location:".SITEURL.'admin/mcat.php');
								die();
							}
						}
					
					}
					else
					{
						$image_name = $current_image;
					}
				}
				else{
					$image_name = $current_image;
				}
				//update databazse
				$sql2 ="UPDATE tbl_categories SET
				title = '$title',
				image_name = '$image_name',
				featured = '$featured',
				active = '$active'
				WHERE  id ='$id' " ;
				//execute 
				$res2 = mysqli_query($conn, $sql2);
				//reditect
				//whether executed or not
				if($res2 == true){
					//updated
					$_SESSION['update']="<div class = 'success'> Updated Successfully </div>";
					header("location:".SITEURL.'admin/mcat.php');
					
				}
				
				else{
					//failed
					$_SESSION['update']="<div class = 'error'> Failed to Update </div>";
					header("location:".SITEURL.'admin/mcat.php');
					

				}
			}
		?>
	</div>

</div>



<?php
	//echo "update";
	include("partials/footer.php");
?>