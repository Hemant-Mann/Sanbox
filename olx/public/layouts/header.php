<!DOCTYPE html>
<html>
  <head>
    <title>OLX</title>
    <link href="stylesheets/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="header">
      <h1>OLX<?php if(isset($_SESSION["user_id"])) { 
      			$logged_user = User::find_by_id($_SESSION["user_id"]);
      			echo ": ".$logged_user["first_name"];
      			unset($logged_user);
      			echo "<b style=\"float: right; font-size: 18px; margin-right: 1em; font-family: MV Boli; font-weight: 0em; \"><a style=\"color: yellow; \" href=\"logout.php\">Logout</a></b>";
      		  } else {
  				    echo "<b style=\"float: right; font-size: 18px; margin-right: 1em; font-weight: 0em;\"><a href=\"register.php\">Register</a> <a href=\"admin/login.php\">Log In</a></b>";
    }  ?></h1>
    </div>
    
