<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
<?php




session_start();
//session_destroy();
//----------FACEBOOK CLASS----------//

class facebook {
	
  var $fbLiked;
  var $isFb;
  var $fbData;
 
  //init
  function facebook(){
	
    $this->fbLiked = false;
    $this->isFb = false;
    $this->fbData = false;
	
    if(isset($_REQUEST["signed_request"])){
      $encoded_sig = null;
      $payload = null;
      list($encoded_sig,$payload) = explode(".",$_REQUEST["signed_request"],2);
      $sig = base64_decode(strtr($encoded_sig,"-_","+/"));
      $data = json_decode(base64_decode(strtr($payload,"-_","+/"),true));
      if($data->page->liked){
        $this->fbLiked = true;
      }
      if(isset($data->app_data)){
        $this->fbData = $data->app_data;
      }
      $this->isFb = true;	
    }
	
  }

  //function to return liked status
  function liked(){
    return $this->fbLiked;
  }

  //function to return if on facebook
  function isFacebook(){
    return $this->isFb;
  }

  //function to return query passed in url
  function getData(){
    return $this->fbData;	
  }
	
}
 $FB = new facebook();
 
 $signed_request = $_REQUEST['signed_request']; // Get the POST signed_request variable.

  if(isset($signed_request)) // Determine if signed_request is blank.
  {
// $pre = explode('.',$signed_request); // Get the part of the signed_request we need.
// $json = base64_decode($pre['1']); // Base64 Decode signed_request making it JSON.
// $obj = json_decode($json,true); // Split the JSON into arrays.
// $page = $obj['page']; // Get the page array. It has a sub array.
//echo "The data passed to the app = ".$FB->getData();
 $profile = $FB->getData();
 $_SESSION['profile']= $profile;

 echo "<meta http-equiv=\"refresh\" content=\"0;URL=submit.php\">";
  }
  else
  {
echo "<meta http-equiv=\"refresh\" content=\"0;URL=bounce.php\">";  }
 
	
?>
</head><body></body></html>