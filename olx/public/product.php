<?php require_once("../includes/initialize.php"); ?>
<?php
	if(isset($_GET["vehicle"])) { $back = "vehicles.php"; $id = $_GET["vehicle"]; }
	elseif(isset($_GET["enc"])) { $back = "enc.php"; $id = $_GET["enc"]; }
	elseif(isset($_GET["mbntab"])) { $back = "mbntab.php"; $id = $_GET["mbntab"]; }
	elseif(isset($_GET["clothing"])) { $back = "clothing.php"; $id = $_GET["clothing"]; }
	elseif(isset($_GET["booksncd"])) { $back = "booksncd.php"; $id = $_GET["booksncd"]; }
	elseif(isset($_GET["homenfur"])) { $back = "homenfur.php"; $id = $_GET["homenfur"]; }
	elseif(isset($_GET["other"])) { $back = "other.php"; $id = $_GET["other"]; }
	elseif(isset($_GET["id"])) { $back = "index.php"; $id = $_GET["id"]; }
	else { redirect_to("index.php"); }


$product = Product::find_by_id($id);
$pd = new Product;
if(!$product) {
	$session->message("The Photo could not be located");
	redirect_to("index.php");
}
$user = User::find_by_id($product["user_id"]);

?>
<?php include_layout_template('header.php'); ?>

<div class ="page">
	<a href="<?php echo $back; ?>">&laquo; Back</a><br /><br />
	<div id="description">
		By: <b><?php echo $user["first_name"]; ?></b><br />
		Price: Rs. <?php echo $product["price"]; ?><br />
		Contact: <?php echo $user["phone"] ?><br />
		<?php if(!empty($product["pur_year"])) {
			echo "Purchased In: ". $product["pur_year"];
		} ?>
		<div style="margin-left: 20px; ">
			<img src="<?php echo $pd->image_path($product["filename"]); ?>" width="480"/>	
		</div>
		<div class="message">
			<p><?php echo $product["description"]; ?> </p>
		</div>
	</div>
</div>
<?php require_once("layouts/footer.php"); ?>

