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
<div class="page">
	<h2>Post An Ad</h2>
		<?php echo output_message($message); ?>
	<div id = "form">
	<form action="new_product.php" enctype="multipart/form-data" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
		<p>Category: 
			<input type="radio" name="category" value="Vehicles" /> Vehicles	
			<input type="radio" name="category" value="Electronics and Computer" /> Electronics and Computer
			<input type="radio" name="category" value="Mobiles and Tablet" /> Mobiles and Tablet
			<input type="radio" name="category" value="Clothing and Accessories" /> Clothing and Accessories
			<input type="radio" name="category" value="Books and CDs" /> Books and CDs
			<input type="radio" name="category" value="Home and Furniture" /> Home and Furniture
			<input type="radio" name="category" value="other">Other
		</p>
		
		<p>Name: <input type="text" name="name" value="" />	
		<p>Price: <input type="text" name="price" value="" />	(In Rs.)</p>
		<p>Purchase Year: <input type="text" name="pur_year" value="" /></p>
		Description: <br /><p><textarea name="description" cols=150 rows=20></textarea>				
		<p>Photo: <input type="file" name="file_upload" /><br />
		Max File size should be less than 5 MB.<br /></p>

		<input type="submit" name="submit" value="Upload" />
	</form>
<a href = "list_products.php">Cancel</a>
<a href="index.php">Home</a>
</div>
<?php include_layout_template('admin_footer.php'); ?>	
		