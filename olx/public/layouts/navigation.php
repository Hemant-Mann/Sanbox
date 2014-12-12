<div class="navigation">
	<h3>Navigation</h2>
	<ul>
		<li><a href="vehicles.php">Vehicles</a></li><br />
		<li><a href="enc.php">Electronics and Computer</a></li><br />
		<li><a href="mbntab.php">Mobiles and Tablet</a></li><br />
		<li><a href="clothing.php">Clothing and Accessories</a></li><br />
		<li><a href="booksncd.php">Books and CDs</a></li><br />
		<li><a href="homenfur.php">Home and Furniture</a></li><br />
		<li><a href="other.php">Other</a></li><br />
		<?php if(isset($_SESSION["user_id"])) { 
			echo "<li><a href=\"admin/index.php\">Home</a></li>";
		} else {
			echo "<li><a href=\"index.php\">Home</a></li>";
		} ?>
	</ul>
</div>