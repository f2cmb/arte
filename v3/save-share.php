<?php
session_start();

switch ($_SESSION['profile']) {
 case 1:
    	$bg_src="graphics/bg-barnes.jpg";
 		$profile_src="graphics/title-barnes.png";
 		$title_fbshare='Norville Barnes de "Le Grand Saut"';
 		$caption_fbshare="Grâce au Lose-o-maton des frères Coen je suis Norville Barnes, un jeune diplômé naïf doublé d\'un inventeur de génie";
     break;
 case 2:
		$bg_src="graphics/bg-chigurh.jpg";
 	   	$profile_src="graphics/title-chigurh.png";
 		$title_fbshare='Anton Chigurh de "No Country For Old Men"';
 		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Anton Chigurh, un tueur psychopathe bien coiffé';
     break;
 case 3:
		$bg_src="graphics/bg-davis.jpg";
 		$profile_src="graphics/title-davis.png";
		$title_fbshare='Llewyn Davis de "Inside Llewyn Davis"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Llewyn Davis, un chanteur de folk loser';
		
     break;
	case 4:
		$bg_src="graphics/bg-fink.jpg";
		$profile_src="graphics/title-fink.png";
		$title_fbshare='Barton Fink de "Barton Fink"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Barton Fink, un scénariste à la dérive à Hollywood';
	    break;
	case 5:
		$bg_src="graphics/bg-gopnik.jpg";
		$profile_src="graphics/title-gopnik.png";
		$title_fbshare='Lawrence Larry Gopnik de "A Serious Man"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Lawrence Larry Gopnik, un prof de physique en pleine crise existentielle';
	    break;
	case 6:
		$bg_src="graphics/bg-mcgill.jpg";
		$profile_src="graphics/title-mcgill.png";
		$title_fbshare='Ulysses Everett Mc Gill de "O Brothers"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Ulysses Everett, un prisonnier évadé obsédé par ses cheveux';
	    break;
	case 7:
		$bg_src="graphics/bg-lebowski.jpg";
		$profile_src="graphics/title-lebowski.png";
		$title_fbshare='The Dude" Lebowski de "The Big Lebowski"';
		$caption_fbshare='Grâce au Lose-o-maton des frères Coen je suis Jeffrey "The Dude" Lebowski, un chômeur fan de bowling et de white russian';
	    break;
	case 8:
		$bg_src="graphics/bg-gunderson.jpg";
		$profile_src="graphics/title-gunderson.png";
		$title_fbshare='Marge Maggy Gunderson de "Fargo"';
		$caption_fbshare="Grâce au Lose-o-maton des frères Coen je suis Marge Maggy Gunderson, une chef de la police gaillarde et enceinte jusqu\'aux yeux";
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
 <meta property="og:url" content="https://artecoen.storage14.brainsonic.com/save-share.php" >

 <meta property="og:title" content="Le loser-o-tron des Frères Coen, par ARTE" >
 
 
  <link href="css/general.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/csphotoselector.css" />
  
  <style>
  #overlay{
  	width:100%;
  	height:100%;
  	position:absolute;
  	z-index:9999;   
  	text-align:center;
  	margin:auto;  
  	display:none;  
  	background-color:#000; 
  	opacity:0.8;
  }
  #text-success{
  	text-align:center;
  	margin:auto;    
  	position:relative;
  	top:30%;
  	font-family: 'Raleway', Arial, serif; font-weight: 300;
  	color:#fff;
  } 
  </style>
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
	<div id="overlay"><div id="text-success">
		Votre portait a bien été posté !<br />
		Retrouvez dans quelques secondes sur votre mur Facebook !</div></div>
<div id="fb-root"></div>
<meta property="og:image" content="https://artecoen.storage14.brainsonic.com/<?php echo $file; ?>" />

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
	
	
	<img src="<?php echo $file; ?>" alt="nom"  />

	
</div>

  <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  

<script>
window.fbAsyncInit = function() {
FB.init({
        appId: '302290699911602',
                channelUrl : '//artecoen.storage14.brainsonic.com/channel.html',
                cookie: true,
                status: true,
                xfbml: true,
                oauth: true
});
};

(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}());
</script>

    
<script type="text/javascript">
$(document).ready(function(){
$('#share_button').click(function(e){
e.preventDefault();
$('#overlay').css("display","block"); 

// Facebook login
FB.login(function(response) {
    if (response.authResponse) {
        // login success, then post a photo
        FB.api('/me/photos',
               'post',
               {
                   message: '<?php echo $caption_fbshare; ?>. Découvre quel loser tu es sur www.arte.tv/coen',
                   url: 'https://artecoen.storage14.brainsonic.com/<?php echo $file; ?>'
               },
               function(response) {
                 console.log(response);
                 if (!response || response.error) {
                     alert('erreur');
                 } else {
				 	
                     
                 }
               }
        );
    }
}, {scope: 'publish_stream'});

});
});





</script>
<div id="credits"><br /><br />Direction artistique : Arnaud Desjardins<br />
Tous droits de reproduction et de diffusion réservés © 2013 ARTE G.E.I.E.<br />
ARTE G.E.I.E. 4, quai du chanoine Winterer CS 20035 F- 67080 Strasbourg Cedex</div>
</body>
</html>


