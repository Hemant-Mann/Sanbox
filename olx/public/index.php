<?php require_once("../includes/initialize.php"); ?>
<?php
 // 1. the current page number ($current_page)
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

  // 2. records per page ($per_page)
  $per_page = 8;

  // 3. total record count ($total_count)
  $total_count = Product::count_all();

  // Find all the photos
  // instead of using this $photos = Photograph::find_all();
  // use pagination instead

  $pagination = new Pagination($page, $per_page, $total_count);

  // Instead of finding all records, just find the recoreds
  // for this page
  $sql  = "SELECT * FROM products ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $products = Product::find_by_sql($sql);
  $pd = new Product;
?>
<?php include_layout_template('header.php'); ?>
<?php include_layout_template('navigation.php'); ?>
<div class="ads">
	<p><h2>All Products:</h2></p>
	<?php echo output_message($message); ?>
	<?php while($product = $database->fetch_array($products)) { ?>
	
		<div style="float: left; margin-left: 20px; ">
			Category: <?php echo $product["category"]; ?><br/>
			Product Name: <?php echo $product["name"]; ?><br />
			<a href="product.php?id=<?php echo $product["id"]; ?>">
				<img src="<?php echo $pd->image_path($product["filename"]); ?>" width="200"/>
			</a>	
		</div>
	<?php } ?>
<div id="pagination" style="clear: both;">
  <?php
    if($pagination->total_pages() > 1) {

      if($pagination->has_previous_page()) {
        echo " <a href=\"index.php?page=";
        echo $pagination->previous_page();
        echo "\">&laquo; Previous</a> ";
      }

      for($i=1; $i<= $pagination->total_pages(); $i++) {
        if($i == $page) {
          echo " <span class=\"selected\">{$i}</span> ";
        } else {
          echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
        }
      }

      if($pagination->has_next_page()) {
        echo " <a href=\"index.php?page=";
        echo $pagination->next_page();
        echo "\">Next &raquo;</a> ";
      }
    }


  ?>
</div>
</div>
<?php require_once("layouts/footer.php"); ?>