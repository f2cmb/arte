
<?php

session_start();
$_SESSION['profile']= 7; 
//now, let's register our session variables
switch ($_SESSION['profile']) {
 case 1:
     $bg_src="graphics/bg-barnes.jpg";
 	$profile_src="graphics/title-barnes.png";
     break;
 case 2:
		$bg_src="graphics/bg-chigurh.jpg";
 	$profile_src="graphics/title-chigurh.png";
     break;
 case 3:
		$bg_src="graphics/bg-davis.jpg";
 	$profile_src="graphics/title-davis.png";
     break;
	case 4:
		$bg_src="graphics/bg-fink.jpg";
		$profile_src="graphics/title-fink.png";
	    break;
	case 5:
		$bg_src="graphics/bg-gopnik.jpg";
		$profile_src="graphics/title-gopnik.png";
	    break;
	case 6:
		$bg_src="graphics/bg-mcgill.jpg";
		$profile_src="graphics/title-mcgill.png";
	    break;
	case 7:
		$bg_src="graphics/bg-lebowski.jpg";
		$profile_src="graphics/title-lebowski.png";
	    break;
	case 8:
		$bg_src="graphics/bg-gunderson.jpg";
		$profile_src="graphics/title-gunderson.png";
		 break;
	 }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
  <link href="css/general.css" rel="stylesheet">
  <link rel="stylesheet" href="css/csphotoselector.css" />
  

<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo.png" alt="coenizr" /><br />
			
			<br /><br /><br />
			<img src="<?php echo $profile_src; ?>" alt="nom" />
			
		
		</div>
	<br /><br />
	<?php
	$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);
	$unencodedData=base64_decode($filteredData);
	?>
	<img src="<?php echo $_POST['img_val']; ?>" alt="nom" />
		
	
	
</div>


  <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="example.js"></script>
	<script src="csphotoselector.js"></script>
  
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
	FB.init({ appId: '155864171290746', channelUrl : '//artecoen-preprod03.brainsonic.com/channel.html', cookie: true, status: true, xfbml: true, oauth: true });
	
	FB.getLoginStatus(function(response) {
		if (response.authResponse) {
			$("#login-status").html("Logged in");
		} else {
			$("#login-status").html("Not logged in");
		}
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));
</script>


</body>
</html>


