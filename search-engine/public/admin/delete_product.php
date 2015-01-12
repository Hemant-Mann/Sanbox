<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	//must have an ID
	if(empty($_GET['id'])) {
		$session->message("No product ID was provided.");
		redirect_to('index.php');
	}

	$product = Product::find_by_id($_GET['id']);
	if($product && $product->destroy()) {
		$session->message("The AD for ". $product->name. " was removed.");
		redirect_to('list_products.php');
	} else {
		$session->message("The ad could not be removed.");
		redirect_to('list_products.php');
	}
?>

<?php if(isset($database)) { $database->close_connections(); } ?>