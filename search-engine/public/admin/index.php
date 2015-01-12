<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }

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

include_layout_template('admin_header.php'); ?>
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="list_products.php">My Products</a></li>
        <li><a href="new_product.php">Post An Ad</a></li>
        <li><a href="../index.php">Browse more products</a></li>
      </ul>
    </div> 
  </nav>     
</div>

<div class="row">
  <div class="col-lg-12 col-sm-12">
    <?php echo output_message($message); ?>
    <h3>Find a product:</h3>

    <form name="search" action="../search.php" method="post">
      <input autofocus class="form-control" type="text" name="keyword" placeholder="Name of the product" > <br /><input type="submit" name="submit" onClick="validator()" class="btn btn-success" value="Search" />
    </form>
    <script type="text/javascript">
      function validator() {
        var keyword = document.search.keyword.value;
        if(keyword=="") {
          alert("Please fill in the name of the product!");
        }
      };
    </script>
    <br />

    <?php foreach($products as $product) { ?>
    <div class="col-xs-4">
      <div class="thumbnail">
        <p class="caption">
          Category: <?php echo $product->category; ?><br/>
          Product Name: <?php echo $product->name; ?><br />
        </p>
        <a href="../product.php?id=<?php echo $product->id; ?>" class="img-responsive">
          <img src="../<?php echo $product->image_path(); ?>" width="200" height="200" />
        </a>  
      </div>
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
</div>
<?php include_layout_template('admin_footer.php'); ?>	