<?php require_once("../includes/initialize.php"); ?>
<?php

if(isset($_POST['submit'])) {
	
	global $database;
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $database->escape_value($_POST["password"]);
	
	// Instantiating a new user
	$user = new User;
	
	$user->first_name = $first_name;
	$user->last_name = $last_name;
	$user->phone = $phone;
	$user->email = $email;
	$user->username = $username;
	$hash = $user->password_encrypt($password);
	$user->password = $hash;

	if($_POST["confirmation"] !== $_POST["password"]) {
		$user->errors[] = "Passwords don't match";
	}

	if($user->save()) {
		$session->message("You are registered successfully.");
		redirect_to("admin/index.php");
	} else {
		$message = join("<br />", $user->errors);
		
	}	
} else {
	$first_name = "";
	$last_name = "";
	$email = "";
	$phone = "";
	$username = "";
	$password = "";
}

?>
<?php include_layout_template('header.php'); ?>
	
	<div class="col-lg-9 col-sm-7">
		<?php echo output_message($message); 	?>
		<h2>New Member</h2>
		<div id="form">
		<form action="register.php" method="post">
			<p class="form-group">First Name:
				<input autofocus class="form-control" type="text" name="first_name" value="<?php echo htmlentities($first_name); ?>" />
			</p>
			<p>Last Name:
				<input autofocus class="form-control" type="text" name="last_name" value="<?php echo htmlentities($last_name); ?>" />
			</p>
			<p>Phone No:
				<input autofocus class="form-control" type="text" name="phone" value="<?php echo htmlentities($phone); ?>" />
			</p>
			<p>Email Id:
				<input autofocus class="form-control" type="text" name="email" value="<?php echo htmlentities($email); ?>" />
			</p>
			<p>Username:
				<input autofocus class="form-control" type="text" name="username" value="<?php echo htmlentities($username); ?>" />
				(Please select any Username of your choice)
			</p>
			<p>Password:
				<input autofocus class="form-control" type="password" name="password" value="<?php echo htmlentities($password); ?>" />
			</p>
			<p>Re-Type password:
				<input autofocus class="form-control" type="password" name="confirmation" value="" />
			</p>
			<p>
			<input type="submit" class="btn btn-info" name="submit" value="Sign Up" /></p>
		</form>
	</div>
		<br />
	 <a href="index.php">Cancel</a>
	</div>

<?php include_layout_template('footer.php'); ?>