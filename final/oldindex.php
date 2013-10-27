<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
<?php
session_start();
//session_destroy();

 
 
 $signed_request = $_REQUEST['signed_request']; // Get the POST signed_request variable.

  if(isset($signed_request)) // Determine if signed_request is blank.
  {
  $pre = explode('.',$signed_request); // Get the part of the signed_request we need.
  $json = base64_decode($pre['1']); // Base64 Decode signed_request making it JSON.
  $obj = json_decode($json,true); // Split the JSON into arrays.
  $page = $obj['page']; // Get the page array. It has a sub array.

 $profile = $obj['app_data'];
 $_SESSION['profile']= $profile;

 echo "<meta http-equiv=\"refresh\" content=\"0;URL=submit.php\">";
  }
  else
  {
echo "<meta http-equiv=\"refresh\" content=\"0;URL=bounce.php\">";  }
 
	
?>
</head><body></body></html>