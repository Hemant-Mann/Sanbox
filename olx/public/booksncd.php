<?php require_once("../includes/initialize.php"); ?>
<?php  
	$sql = "SELECT * FROM products ";
	$sql .= "WHERE category = 'Books and CDs'";
	$products = Product::find_by_sql($sql);
	$pd = new Product;
?>

<?php include_layout_template('header.php'); ?>
<?php include_layout_template('navigation.php'); ?>
<div class="ads">
	<h2>Books/CDs: </h2>
	<?php while($product = $database->fetch_array($products)) { ?>
	<div style="float: left; margin-left: 20px; ">
		Product Name: <b><?php echo $product["name"]; ?><br /></b>
	    <a href="product.php?booksncd=<?php echo $product["id"]; ?>">
		    <img src="<?php echo $pd->image_path($product["filename"]); ?>" width="200" />
		</a>
	</div>
	<?php } ?>
</div>

<?php include_layout_template('footer.php'); ?>