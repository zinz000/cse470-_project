<?php include('partials/menu.php'); ?>
<div class = "main-content">
	<div class = "wrapper">
		<h1>Update Order </h1>
		<br>
		<br>
		<?php
			//whether id is et or not
			if(isset($_GET['id'])){
				//get the order details
				$id = $_GET['id'];
				//get all order based on id
				//sql 
				$sql = "SELECT *FROM tbl_order WHERE id = $id";
				$res = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($res);
				if($count == 1){
					//avalibel
					$row = mysqli_fetch_assoc($res);
					$food = $row['food'];
					$price = $row['price'];
					$qty = $row['quantity'];
					$status = $row['status'];
					$customer_name = $row['customer_name'];
					$customer_contact = $row['customer_contact'];
					$customer_email = $row['customer_email'];
					$customer_address = $row['customer_address'];
				}
				else{
					//details is not avalibel
					header("loaction:".SITEURL.'admin/morder.php');
				}
			}
			else{
				//redirect
				header("location:".SITEURL.'admin/morder.php');
			}
		?>
		<form action= "" method = "POST" >
			<table class = "tbl-30">
				<tr>
					<td>Food Name: </td>
					<td><b>
						<?php
							echo $food;
						?>
					</b>
					</td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><b>
						$<?php echo $price;?>
					</b>
					</td>
				</tr>
				<tr>
					<td> Quantity: </td>
					<td>
						<input type = "number" name ="qty" value="<?php echo $qty; ?>">
					</td>
				</tr>
				<tr>
					<td> Status:</td>
					<td>
						<select name = "status">
							<option <?php  if($status =="Ordered"){ echo "selected";}?> value = "Ordered">Ordered </option>
							<option <?php  if($status =="On Delivery"){ echo "selected";}?> value = "On Delivery">On Delivery</option>
							<option <?php  if($status =="Delivered"){ echo "selected";}?> value = "Delivered">Delivered</option>
							<option <?php  if($status =="Cancelled"){ echo "selected";}?> value = "Cancelled">Cancelled</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Customer Name: </td>
					<td>
						<input type = "text" name = "customer_name" value= "<?php echo $customer_name; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Contact: </td>
					<td>
						<input type = "text" name = "customer_contact" value= "<?php echo $customer_contact; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Email: </td>
					<td>
						<input type = "text" name = "customer_email" value= "<?php echo $customer_email; ?>">
					</td>
				</tr>
				<tr>
					<td>Customer Address: </td>
					<td>
						<textarea name = "customer_address" cols = "30" rows = "5" ><?php echo $customer_address; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
						<input type = "hidden" name = "price" value = "<?php echo $price; ?>">
						<input type = "submit" name = "submit" class = "btn-secondary" value = "Update Order" >
					</td>
				</tr>
			</table>
		</form>
		<?php 
			//checked update button is clicked or not
			if(isset($_POST['submit'])){
				//get all values from form
				$id = $_POST['id'];
				$price = $_POST['price'];
				$qty = $_POST['qty'];
				$total = $price * $qty;
				$status = $_POST['status'];
				$customer_name = $_POST['customer_name'];
				$customer_contact  = $_POST['customer_contact'];
				$customer_email = $_POST['customer_email'];
				$customer_address = $_POST['customer_address'];
				//update the valus
				  $sql2 = "UPDATE tbl_order SET 
                    quantity = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

				$res2 = mysqli_query($conn, $sql2);
				//whetehr updated or not
				if($res2 == true){
					//updated
					$_SESSION['update'] = "<div class = 'success'>Updated Successfully</div>";
					header("location:".SITEURL.'admin/morder.php');
				}
				else{
					$_SESSION['update'] = "<div class = 'error'>Failed to Update</div>"; //failed
					header("location:".SITEURL.'admin/morder.php');
				}
				//redirect
				
			}
		?>
	</div>
	
</div>




<?php include('partials/footer.php'); ?>