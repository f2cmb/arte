<?php
session_start();

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
		$title_fbshare='Llewyn Davis de "Inside Llewyn Davis"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Davis, blabla';
		
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
	 

 	define('UPLOAD_PATH', 'image_files/');

 	  // 接收 POST 進來的 base64 DtatURI String
 	  $img = $_POST['img_val'];

 	  // 轉檔 & 存檔
 	  $img = str_replace('data:image/png;base64,', '', $img);
 	  $img = str_replace(' ', '+', $img);
 	  $data = base64_decode($img);
 	  $file = UPLOAD_PATH . uniqid() . '.png';
 	  $success = file_put_contents($file, $data); 

 	  // output string
 	  //$output = ($success) ? '<img src="'. $file .'" alt="Canvas Image" />' : '<p>Unable to save the file.</p>';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
 <meta property="og:url" content="https://artecoen-preprod03.brainsonic.com/v2/save-share.php" >

 <meta property="og:title" content="Le loser-o-tron des Frères Coen, par ARTE" >
 
 
  <link href="css/general.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/csphotoselector.css" />
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
<div id="fb-root"></div>

<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo-small.png" alt="coenizr" /><br />
		
			<img src="<?php echo $profile_src; ?>" alt="nom" />
			
		
		</div>
	<br />
	
    <img src="graphics/share_btn.png" id="share_button" style="padding-top: 1em;"/>
	<br />
	
	<div id="infos-upload">(Clic-droit "enregistrer sous" pour sauvegarder votre portrait)</div>
	
	<img src="<?php echo $file; ?>" alt="nom"  />

	
</div>


  <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  

<script>

window.fbAsyncInit = function() {
FB.init({
	appId: '302290699911602',
		channelUrl : '//artecoen-preprod03.brainsonic.com/channel.html',
		cookie: true,
		status: true,
		xfbml: true,
		oauth: true
});
};
 
(function() {
var e = document.createElement('script');
e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
e.async = true;
document.getElementById('fb-root').appendChild(e);
}());

$(document).ready(function(){
$('#share_button').live('click', function(e){
e.preventDefault();
FB.ui(
{
method: 'me/photos',
name: 'Je suis <?php echo $title_fbshare; ?> – ARTE',
link: 'http://arte.tv/coen',
picture: 'https://artecoen-preprod03.brainsonic.com/image_files/526b90f69fc57.png',
caption: '<?php echo $caption_fbshare; ?>',
description: 'Loser-o-tron'
});
});
});

</script>

</body>
</html>


