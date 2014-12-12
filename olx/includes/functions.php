<?php

  function strip_zeros_from_date( $marked_string="" ) {
    // first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    // then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
  }

  function redirect_to( $location = NULL ) {
    if ($location != NULL) {
      header("Location: {$location}");
      exit;
    }
  }

  function output_message($message="") {
    if (!empty($message)) { 
      return "<p class=\"message\">{$message}</p>";
    } else {
      return "";
    }
  }

  function __autoload($class_name) {
  	$class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)) {
      require_once($path);
    } else {
  		die("The file {$class_name}.php could not be found.");
  	}
  }

  function include_layout_template($template = "") {
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
  }

  function datetime_to_text($datetime="") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I: %M %p", $unixdatetime);
  }

  // Error functions

  global $errors;
  $errors = [];  

  function fieldname_as_text($fieldname) {
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
  }

  //*presence
  function has_presence($value) {
    return isset($value) && $value !== "";
  }

  function validate_presences($required_fields) {
    global $errors;
    foreach($required_fields as $field) {
      $value = trim($_POST[$field]);
      if(!has_presence($value)) { 
        $errors[$field] = fieldname_as_text($field) . " can't be blank";
      }
   }
  }

  //max length
  function has_max_length ($value, $max) {
  return strlen($value) <= $max;
  }

  function validate_max_lengths ($fields_with_max_lengths) {
    global $errors;
    foreach($fields_with_max_lengths as $field => $max) {
      $value = trim($_POST[$field]);
      if(!has_max_length($value, $max)) {
        $errors[$field] = fieldname_as_text($field) . " is too long";
      }
    }
  }

  function form_errors ($errors = array()) {
    $output = "";
    if(!empty($errors)) {
      $output .= "<div class = \"error\">";
      $output .= "Please fix the following errors: ";
      $output .= "<ul>";
      foreach ($errors as $key => $error) {
        $output .= "<li>";
        $output .= htmlentities($error);
        $output .= "</li>";
      }

      $output .= "</ul>";
      $output .= "</div>";
    } 
    return $output;
  }

  function password_check($password, $existing_hash) {
    //existing hash contains format and salt or start
    $hash = crypt($password, $existing_hash);
    if($hash == $existing_hash) {
      return true;
    } else {
      return false;
    }
  }

?>