<?php
session_start();

switch ($_SESSION['profile']) {
 case 1:
    	$bg_src="graphics/bg-barnes.jpg";
 		$profile_src="graphics/title-barnes.png";
 		$title_fbshare='Norville Barnes de "Le Grand Saut"';
 		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Norville, un jeune diplômé naïf doublé d\'un inventeur de génie';
     break;
 case 2:
		$bg_src="graphics/bg-chigurh.jpg";
 	   	$profile_src="graphics/title-chigurh.png";
 		$title_fbshare='Anton Chigurh de "No Country For Old Men"';
 		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Anton, un tueur psychopathe bien coiffé';
     break;
 case 3:
		$bg_src="graphics/bg-davis.jpg";
 		$profile_src="graphics/title-davis.png";
		$title_fbshare='Llewyn Davis de "Inside Llewyn Davis"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Davis, un chanteur de folk loser';
		
     break;
	case 4:
		$bg_src="graphics/bg-fink.jpg";
		$profile_src="graphics/title-fink.png";
		$title_fbshare='Barton Fink de "Barton Fink"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Barton, un scénariste à la dérive à Hollywood';
	    break;
	case 5:
		$bg_src="graphics/bg-gopnik.jpg";
		$profile_src="graphics/title-gopnik.png";
		$title_fbshare='Lawrence Larry Gopnik de "A Serious Man"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Lawrence Larry, un prof de physique en pleine crise existentielle';
	    break;
	case 6:
		$bg_src="graphics/bg-mcgill.jpg";
		$profile_src="graphics/title-mcgill.png";
		$title_fbshare='Jeffrey "The Dude" Lebowski de "The Big Lebowski"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Ulysses Everett, un chômeur fan de bowling et de white russian
';
	    break;
	case 7:
		$bg_src="graphics/bg-lebowski.jpg";
		$profile_src="graphics/title-lebowski.png";
		$title_fbshare='Ulysses Everett Mc Gill de "Barton Fink"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Ulysses Everett, un prisonnier évadé obsédé par ses cheveux';
	    break;
	case 8:
		$bg_src="graphics/bg-gunderson.jpg";
		$profile_src="graphics/title-gunderson.png";
		$title_fbshare='Marge Maggy Gunderson de "Fargo"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Marge Maggy, une chef de la police gaillarde et enceinte jusqu\'aux yeux';
		 break;
	 }
	 

 	define('UPLOAD_PATH', 'image_files/');

 	  $img = $_POST['img_val'];

 	  $img = str_replace('data:image/png;base64,', '', $img);
 	  $img = str_replace(' ', '+', $img);
 	  $data = base64_decode($img);
 	  $file = UPLOAD_PATH . uniqid() . '.png';
 	  $success = file_put_contents($file, $data); 


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
<meta property="og:image" content="https://artecoen-preprod03.brainsonic.com/<?php echo $file; ?>" />

<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo-small.png" alt="coenizr" /><br />
		
			<img src="<?php echo $profile_src; ?>" alt="nom" />
			
		
		</div>
		<br />
		<span>3. Je partage mon portrait de loser ! </span>
		
	<br />
	
    <img src="graphics/share_btn.png" id="share_button" style="padding-top: 1em;"/>
	<br />
	
	<div id="infos-upload">(Clic-droit "enregistrer sous" pour sauvegarder votre portrait)</div>
	
	<img src="<?php echo $file; ?>" alt="nom"  />

	
</div>


 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
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
method: 'feed',
name: 'Je suis <?php echo $title_fbshare; ?> – ARTE',
link: 'http://arte.tv/coen',
picture: 'https://artecoen-preprod03.brainsonic.com/<?php echo $file; ?>',
caption: '<?php echo $caption_fbshare; ?>',
description: 'Loser-o-tron'
});
});
});

</script>

</body>
</html>


