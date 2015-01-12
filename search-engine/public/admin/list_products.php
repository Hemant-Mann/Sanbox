<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
// 1. the current page number ($current_page)
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

  // 2. records per page ($per_page)
  $per_page = 8;
  
  $sql  = "SELECT * FROM products ";
  $sql .= "WHERE user_id =".$_SESSION['user_id']." ";
  
  // 3. Find the total count of ads/photos/products
  $ads = Product::find_by_sql($sql);
  $total_count = 0;
  foreach($ads as $ad) {
    $total_count++;
  }

  $pagination = new Pagination($page, $per_page, $total_count);

  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $products = Product::find_by_sql($sql);

?>
<?php include_layout_template('admin_header.php'); ?>
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="list_products.php">My Products</a></li>
        <li><a href="new_product.php">Post An Ad</a></li>
        <li><a href="../index.php">Browse more products</a></li>
      </ul>
    </div> 
  </nav>     
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12">
    <h2>My AD's</h2>

    <?php echo output_message($message); ?>
    <div class="table-responsive">
      <table class="table table-hover">
        <tr>
          <th>Product</th>
          <th>Category</th>
          <th>Name of Product</th>
          <th>Price (Rs.)</th>
          <th>Description</th>
          <th>&nbsp;</th>
        </tr>
      <?php global $database; ?>
      <?php foreach($products as $product) { ?>
        <tr>
          <td><img src="../<?php echo $product->image_path(); ?>" width="120" /></td>
          <td><?php echo $product->category; ?></td>
          <td><?php echo $product->name; ?></td>
          <td><?php echo $product->price; ?></td>
          <td><?php echo $product->description; ?></td>
          <td><a href="delete_product.php?id=<?php echo $product->id; ?>" onclick="return confirm('Are you sure?')">Remove</a>
        </tr>
      <?php } ?>
      </table>
    </div>
    <div id="pagination" style="clear: both;">
     
      <?php
        if($pagination->total_pages() > 1) {

          if($pagination->has_previous_page()) {
            echo " <a href=\"list_products.php?page=";
            echo $pagination->previous_page();
            echo "\">&laquo; Previous</a> ";
          }

          for($i=1; $i<= $pagination->total_pages(); $i++) {
            if($i == $page) {
              echo " <span class=\"selected\">{$i}</span> ";
            } else {
              echo " <a href=\"list_products.php?page={$i}\">{$i}</a> ";
            }
          }

          if($pagination->has_next_page()) {
            echo " <a href=\"list_products.php?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a> ";
          }
        }
      ?>
    </div>

  </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
