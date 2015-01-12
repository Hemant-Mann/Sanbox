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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>OLX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../stylesheets/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../javascript/respond.js"></script>  
  </head>
  <body>
    <div class="container">
     <!--header-->
      <div class="row">
        <nav class="navbar navbar-default navbar-fixed-top">
          <h1>OLX<?php if(isset($_SESSION["user_id"])) { 
                $logged_user = User::find_by_id($_SESSION["user_id"]);
                echo ": ".$logged_user->first_name;
                unset($logged_user);
                echo "<b style=\"float: right; font-size: 18px; margin-right: 1em; font-weight: 0em;\"><a href=\"logout.php\">Logout</a></b>";
                } else {
                  echo "<b style=\"float: right; font-size: 18px; margin-right: 1em; font-weight: 0em;\"><a href=\"../register.php\">Register</a> <a href=\"admin/login.php\">Log In</a></b>";
                }  ?>
          </h1>
        </nav>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-4">
          <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="collapse navbar-collapse" id="collapse">        
              <h3>Navigation</h3>
              <ul class="nav nav-pills nav-stacked">
                <?php if(isset($_SESSION["user_id"])) { 
                  echo "<li><a href=\"admin/index.php\">Home</a></li><br />";
                } else {
                  echo "<li><a href=\"../index.php\">Home</a></li><br />";
                } ?>
                <li><a href="../vehicles.php">Vehicles</a></li><br />
                <li><a href="../enc.php">Electronics and Computer</a></li><br />
                <li><a href="../mbntab.php">Mobiles and Tablet</a></li><br />
                <li><a href="../clothing.php">Clothing and Accessories</a></li><br />
                <li><a href="../booksncd.php">Books and CDs</a></li><br />
                <li><a href="../homenfur.php">Home and Furniture</a></li><br />
                <li><a href="../other.php">Other</a></li><br />
              </ul>
            </div> 
          </nav>     
        </div>
       
        <div class="col-lg-9 col-sm-7">
          <div id="form">
        		<h2>Login</h2><br />
        		<?php echo output_message($message); ?>

        		<form action="login.php" method="post">
        		   
               <p class="form-group">
        		        <input autofocus class="form-control" type="text" name="username" maxlength="30" placeholder="Username" value="<?php echo htmlentities($username); ?>" /></p>
               <p class="form-group">
        		        <input autofocus class="form-control" type="password" name="password" maxlength="30" placeholder="Password" value="" /></p><br />
        		
        		   <p><input class="btn btn-info" type="submit" name="submit" value="Login" /></p>
        		</form><br />
            New User? <a href="../register.php">Sign Up</a><br /><br />
            <a href="../index.php">Home</a>
          </div>
        </div>
      </div>

   <?php include_layout_template("admin_footer.php"); ?>