<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user) {
    $session->login($found_user);
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { 
  // Form has not been submitted.
  $username = "";
  $password = "";
  $message = "";
}

?>
<?php include_layout_template('admin_header.php'); ?>
<div class="page">
  <div id="form">
		<h2>Login</h2>
		<?php echo output_message($message); ?>

		<form action="login.php" method="post">
		   <p> Username:

		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" /></p>
       <p> Password:
		   
		        <input type="password" name="password" maxlength="30" value="" /></p><br />
		
		        <input type="submit" name="submit" value="Login" />
		</form><br />
    New User? <a href="../register.php">Sign Up</a><br /><br />
    Return to Home: <a href="../index.php">Home</a>
  </div>
</div>
   <?php include_layout_template("admin_footer.php"); ?>