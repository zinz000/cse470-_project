<?php include("partials/menu.php"); ?>
	<div class = "main">
		<div class ="wrapper">
			<h1> Manage Category</h1>
			<br>
			<br>
			<?php
				if(isset($_SESSION['add'])){
					echo $_SESSION['add'];
					unset($_SESSION['add']);
					
				}
			?>
			<br>
			<br>
			<!--bottom to add admin -->
			<a href="../admin/addcat.php" class = "btn-primary">Add Category</a>
			<br> <br> <br>
				<table class= "tbl-full">
						<tr>
							<th>S.N</th>
							<th>Title</th>
							<th>Image </th>
							<th>Freature</th>
							<th>Active</th>
							<th>Actions</th>
						</tr>
						<?php
							//sql for database
							$sql ="SELECT * FROM tbl_categories";
							//execute
							$res = mysqli_query($conn, $sql);
							$count= mysqli_num_rows($res);
							$sn=1;
							if($count>0){
								//data in databse
								//get data from database
								while($row = mysqli_fetch_assoc($res)){
									$id = $row['id'];
									$title =$row['title'];
									$image_name = $row['image_name'];
									$featured = $row['featured'];
									$active = $row['active'];
									?>
										<tr>
												<td><?php echo $sn++ ;?> </td>
												<td><?php echo $title; ?></td>
												<td>
													<?php 
														//whether img name is avalible or not
														if($image_name !=""){
															//display img
															?>
															<img src = "<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt ="" width = "100px">
															<?php
														}
														else{
															echo "<div class = 'error>Image is not added</div>'";
														}
													?>
												</td>
												<td><?php echo $featured; ?></td>
												<td><?php echo $active; ?></td>
												
												<td>
													<a href = "#" class = "btn-secondary">Upadte Category</a>
													<a href = "#" class = "btn-danger"> Delete Category</a>
												</td>
										</tr>
									<?php
								}
							}
							else{
								//no data in database
								?>
								<tr>
									<td colspan = "6">
										<div class = "error"> No Category</div>
									</td>
								</tr>
								<?php
							}
						?>

					</table>
		</div>
	</div>
	
	
<?php include("partials/footer.php ")  ?>