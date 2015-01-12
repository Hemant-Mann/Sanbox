<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>

<?php
	// Max file size is 5 MB
	$max_file_size = 5242880;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])) {
		$product = new Product();

		$product->user_id = $_SESSION["user_id"];
		$product->category = $_POST['category'];
		$product->name = $_POST['name'];
		$product->price = $_POST['price'];
		if(isset($_POST['pur_year'])) {
			$product->pur_year = $_POST['pur_year'];
		} else {
			$product->pur_year = 0;
		}

		$product->description = $_POST['description'];

		$product->attach_file($_FILES['file_upload']);
		if($product->save()) {
			// Success
			$session->message("Ad uploaded successfully...");
			redirect_to('list_products.php');
		} else {
			// Failure
			$message = join("<br />", $product->errors);
		}
	} 

	
?>

<?php include_layout_template('admin_header.php'); ?>

      	<li><a href="index.php">Home</a></li>
        <li><a href="list_products.php">My Products</a></li>
        <li class="active"><a href="new_product.php">Post An Ad</a></li>
        <li><a href="../index.php">Browse more products</a></li>
      </ul>
    </div> 
  </nav>     
</div>

<div class="row">
	<div class="col-lg-12 col-sm-12">
		<h2>Post An Ad</h2>
			<?php echo output_message($message); ?>
		<div id = "form">
			<form action="new_product.php" enctype="multipart/form-data" method="POST">
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
				<p>Category:<br /> 
					<input type="radio" name="category" value="Vehicles" /> Vehicles<br />	
					<input type="radio" name="category" value="Electronics and Computer" /> Electronics and Computer<br />
					<input type="radio" name="category" value="Mobiles and Tablet" /> Mobiles and Tablet<br />
					<input type="radio" name="category" value="Clothing and Accessories" /> Clothing and Accessories<br />
					<input type="radio" name="category" value="Books and CDs" /> Books and CDs<br />
					<input type="radio" name="category" value="Home and Furniture" /> Home and Furniture<br />
					<input type="radio" name="category" value="other"> Other
				</p>
				
				<p>Name: <input autofocus class="form-control" type="text" name="name" value="" />	
				<p>Price: <input autofocus class="form-control" type="text" name="price" value="" />	(In Rs.)</p>
				<p>Purchase Year: <input autofocus class="form-control" type="text" name="pur_year" value="" /></p>
				Description: <br />
				<p><textarea autofocus class="form-control" name="description" cols=150 rows=20></textarea>				
				<p>Photo: <input type="file" name="file_upload" /><br />
				Max File size should be less than 5 MB.<br /></p>

				<input class="btn btn-info" type="submit" name="submit" value="Upload" />
			</form>
			<br />
			<p><a href = "list_products.php">Cancel</a><br /></p>
		</div>
	</div>
	</div>
</div>
<?php include_layout_template('admin_footer.php'); ?>	
		