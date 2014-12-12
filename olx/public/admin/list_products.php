<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the ads posted by the user
  $products = new Product;
  $result_set = $products->find_by_user_id($_SESSION["user_id"]);
?>
<?php include_layout_template('admin_header.php'); ?>

<div class="page">
<h2>My AD's</h2>

<?php echo output_message($message); ?>
<table class="bordered">
  <tr>
    <th>Product</th>
    <th>Category</th>
    <th>Name of Product</th>
    <th>Price (Rs.)</th>
    <th>Description</th>
    <th>&nbsp;</th>
  </tr>
<?php global $database; ?>
<?php while($product = $database->fetch_array($result_set)) { ?>
  <tr>
    <td><img src="../<?php echo $products->image_path($product["filename"]); ?>" width="100" /></td>
    <td><?php echo $product["category"]; ?></td>
    <td><?php echo $product["name"]; ?></td>
    <td><?php echo $product["price"]; ?></td>
    <td><?php echo $product["description"]; ?></td>
    <td><a href="delete_product.php?id=<?php echo $product["id"]; ?>">Remove</a>
  </tr>
<?php } ?>
</table>
<br />
<a href="new_product.php">Post a new Ad?</a><br><br>
<a href="index.php">Back</a><br><br>
<a href="../index.php">Browse more products</a>
</div>
<?php include_layout_template('admin_footer.php'); ?>
