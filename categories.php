<?php  include('partials-front/menu-front.php');?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
			<?php 
				//display all the categories that are active
				//sql
				$sql = "SELECT * FROM tbl_categories WHERE active = 'Yes'";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				//chcek category avalible or not
				if($count >0){
					while($row = mysqli_fetch_assoc($res)){
						$id = $row['id'];
						$title = $row['title'];
						$image_name = $row['image_name'];
						?>
						<a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
						<div class="box-3 float-container">
							<?php
								if($image_name == ""){
									//img not avaliable
									echo "<div class = 'error'> Image is not avalibale</div>";
								}
								else{
									//img avalible
									?>
									<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curve">

									<?php
								}
							?>
							

							<h3 class="float-text text-white"><?php echo $title; ?></h3>
						</div>
						</a>

						<?php
					}
				}
				else{
					echo "<div class = 'error'> Category is not avalibale</div>";
				}
			?>

          
           
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
<?php  include('partials-front/footer-front.php');?>


</body>
</html>
             
