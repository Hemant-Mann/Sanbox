<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>OLX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="stylesheets/bootstrap.min.css" rel="stylesheet">
    <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
    <script src="javascript/respond.js"></script>
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
      				    echo "<b style=\"float: right; font-size: 18px; margin-right: 1em; font-weight: 0em;\"><a href=\"register.php\">Register</a> <a href=\"admin/login.php\">Log In</a></b>";
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
                  echo "<li><a href=\"index.php\">Home</a></li><br />";
                } ?>
                <li><a href="vehicles.php">Vehicles</a></li><br />
                <li><a href="enc.php">Electronics and Computer</a></li><br />
                <li><a href="mbntab.php">Mobiles and Tablet</a></li><br />
                <li><a href="clothing.php">Clothing and Accessories</a></li><br />
                <li><a href="booksncd.php">Books and CDs</a></li><br />
                <li><a href="homenfur.php">Home and Furniture</a></li><br />
                <li><a href="other.php">Other</a></li><br />
              </ul>
            </div> 
          </nav>     
        </div>
       
