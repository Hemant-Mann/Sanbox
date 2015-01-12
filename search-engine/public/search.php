<?php require_once("../includes/initialize.php"); ?>
<?php
    if(isset($_POST['submit'])) {
      $keywords = htmlentities($_POST["keyword"]);
      
      if($keywords == "" && !isset($_SESSION["user_id"])) {
      	redirect_to("index.php");
      } elseif($keywords == "" && isset($_SESSION["user_id"])) {
      	redirect_to("admin/index.php");
      }

      $products = Product::search($keywords);
      if($products == null) {
      	$session->message("Sorry could not find the product");
      	redirect_to("index.php");
      }

    }
?>

<?php include_layout_template('header.php'); ?>
<?php include_layout_template('navigation.php'); ?>

<h2>Your Results</h2>
<?php foreach($products as $product) { ?>
	<div class="col-xs-3">
		<div class="thumbnail">
      <p class="caption">
        Category: <?php echo $product->category; ?><br/>
  		Product: <?php echo $product->name; ?><br />
      </p>
			<a href="product.php?id=<?php echo $product->id; ?>" class="img-responsive">
				<img src="<?php echo $product->image_path(); ?>" width="200" height="200" />
			</a>	
		</div>
  </div>
	<?php } ?>


<?php require_once("layouts/footer.php"); ?>