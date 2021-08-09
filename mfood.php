<?php include("partials/menu.php"); ?>
	<div class = "main">
		<div class ="wrapper">
			<h1> Manage Food</h1>
			<br> <br> 
			<!--bottom to add admin -->
			<a href="<?php echo SITEURL; ?>admin/add-food.php" class = "btn-primary">Add Food</a>
			<br> <br> <br>
				
		<?php
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}


				
			?>

				<table class= "tbl-full">
						<tr>
							<th>S.N</th>
							<th>Title</th>
							<th>Price </th>
							<th>Image</th>
							<th>Featured</th>
							<th>Active</th>
							<th>Actions</th>
							<tr>
							<?php
							//create a sql query for food
								$sql ="SELECT * FROM tbl_food"; //to get all categories from database
								//execute query
								$res = mysqli_query($conn, $sql);
								//count rows
								$count = mysqli_num_rows($res);
								//count serial no
								$sn = 1;
								if($count>0){
									//have food
									//get the foods from database and display
									while($row = mysqli_fetch_assoc($res)){
										//get values for each col
										$id=$row['id'];
										$title=$row['title'];
										$price=$row['price'];
										$image_name=$row['image_name'];
										$featured=$row['featured'];
										$active=$row['active'];
											?>
										<tr>
											<td><?php echo $sn++; ?></td>
											<td><?php echo $title; ?></td>
											<td><?php echo $price; ?></td>
											<td>
												<?php 
												//check img is blank or not
												if($image_name == ""){
													echo "<div class = 'error'>Image is not available</div>";
												}
												else{
													//img display
													?>
													<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
													<?php
												}
											    ?>
											</td>
											<td><?php echo $featured; ?></td>
											<td><?php echo $active; ?></td>
											<td>
												<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ;?>" class ="btn-secondary">Update Food</a>												
												<a href="<?php echo SITEURL; ?>admin/del-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ;?>" class ="btn-danger">Delete Food</a>
											</td>
										</tr>
										<?php
									}
								}
								else{
									//no food
									echo "<tr><td colspan='7' class='error'> Food not added yet</td></tr>";
								}
							?>
							
							
					</table>
		</div>
	
	</div>
	
	
<?php include("partials/footer.php ")  ?>