<?php ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"?>
<?php

session_start();
//now, let's register our session variables
$_SESSION['profile']= 6;

// upload the file
if ((isset($_POST["submitted_form"])) && ($_POST["submitted_form"] == "image_upload_form")) {
	
	// file needs to be jpg,gif,bmp,x-png and 4 MB max
	if (($_FILES["image_upload_box"]["type"] == "image/jpeg" || $_FILES["image_upload_box"]["type"] == "image/pjpeg" || $_FILES["image_upload_box"]["type"] == "image/gif" || $_FILES["image_upload_box"]["type"] == "image/png") && ($_FILES["image_upload_box"]["size"] < 2097152))
	{
		
  
		// some settings
		$max_upload_width = 650;
		$max_upload_height = 900;
		  
		// if user chosed properly then scale down the image according to user preferances
		if(isset($_REQUEST['max_width_box']) and $_REQUEST['max_width_box']!='' and $_REQUEST['max_width_box']<=$max_upload_width){
			$max_upload_width = $_REQUEST['max_width_box'];
		}    
		if(isset($_REQUEST['max_height_box']) and $_REQUEST['max_height_box']!='' and $_REQUEST['max_height_box']<=$max_upload_height){
			$max_upload_height = $_REQUEST['max_height_box'];
		}	

		
		// if uploaded image was JPG/JPEG
		if($_FILES["image_upload_box"]["type"] == "image/jpeg" || $_FILES["image_upload_box"]["type"] == "image/pjpeg"){	
			$image_source = imagecreatefromjpeg($_FILES["image_upload_box"]["tmp_name"]);
		}		
		// if uploaded image was GIF
		if($_FILES["image_upload_box"]["type"] == "image/gif"){	
			$image_source = imagecreatefromgif($_FILES["image_upload_box"]["tmp_name"]);
		}	
		// BMP doesn't seem to be supported so remove it form above image type test (reject bmps)	
		// if uploaded image was BMP
		if($_FILES["image_upload_box"]["type"] == "image/bmp"){	
			$image_source = imagecreatefromwbmp($_FILES["image_upload_box"]["tmp_name"]);
		}			
		// if uploaded image was PNG
		if($_FILES["image_upload_box"]["type"] == "image/png"){
			$image_source = imagecreatefrompng($_FILES["image_upload_box"]["tmp_name"]);
		}
		

		$remote_file = "image_files/".$_FILES["image_upload_box"]["name"];
		imagejpeg($image_source,$remote_file,100);
		chmod($remote_file,0644);
	
	

		// get width and height of original image
		list($image_width, $image_height) = getimagesize($remote_file);
	
		if($image_width>$max_upload_width || $image_height >$max_upload_height){
			$proportions = $image_width/$image_height;
			
			if($image_width>$image_height){
				$new_width = $max_upload_width;
				$new_height = round($max_upload_width/$proportions);
			}		
			else{
				$new_height = $max_upload_height;
				$new_width = round($max_upload_height*$proportions);
			}		
			
			
			$new_image = imagecreatetruecolor($new_width , $new_height);
			$image_source = imagecreatefromjpeg($remote_file);
			
			imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
			imagejpeg($new_image,$remote_file,100);
			
			imagedestroy($new_image);
		}
		
		imagedestroy($image_source);
		
		
				header("Location: success.php?upload_message=image uploaded&upload_message_type=success&show_image=".$_FILES["image_upload_box"]["name"]);
		exit;
	}
	else{
		header("Location: erreur.php");
		exit;
	}
}
 

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
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
	<div id="fb-root"></div>

<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo.png" alt="coenizr" /><br />
			Refaites-vous le portrait en
			<br /><br /><br />
			<img src="<?php echo $profile_src; ?>" alt="nom" />
			
		
		</div>
		<br />
		<span>1. Je choisis ma photo </span>
			<br />
		<img src="graphics/arrows.png" alt="mode de sélection" />
		<br />
	<div id="mode-container">
		<div class="upload-mode-container">
			<span style="width:250px">une image depuis mon ordinateur </span>
			<div id="infos-upload">(Fichiers image seulement, 2Mo max., jpeg, gif ou png)</div>
			<br />
			<div id="classic-select">
				<form action="submit6.php" method="POST" enctype="multipart/form-data" name="image_upload_form" id="image_upload_form" style="padding-top: 5em;">
					<input name="image_upload_box" type="file" id="image_upload_box" size="20" />
					<input type="image" name="submit" src="graphics/classic-upload.png" value="Upload image" style="padding-top: 15px;"/>     					<input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 

					<input name="submitted_form" type="hidden" id="submitted_form" value="image_upload_form" />
				</form>
			</div>
		</div>
	</div>		
		<div class="upload-mode-container">
			<span style="width:250px">Parmi mes albums photos Facebook </span>
			<div id="infos-upload">(Je me logge, je choisis et j'envoie)</div>
			
				<br />
			<div id="fb-select">
   			 <img src="graphics/login_btn.png" id="btnLogin" style="padding-top: 3.5em;"/>
				
				<a href="#" class="photoSelect">
				<img src="graphics/fb-upload.png" style="padding-top: 10px; border:0" />
				</a>
				<form action="successfb.php" method="POST" enctype="multipart/form-data" name="form_fb" id="form_fb"  style="padding-top: 10px;">
					<input type="image" src="graphics/send_btn.png" name="submit" value="Envoi" />     
					<input name="image_fb" type="hidden" id="image_fb" value="" />
				</form>
			</div>
			
			
		</div>
	</div>
<br />

</div>



<!-- Markup for Carson Shold's Photo Selector -->
<div id="CSPhotoSelector">
	<div class="CSPhotoSelector_dialog">
		<a href="#" id="CSPhotoSelector_buttonClose">x</a>
		<div class="CSPhotoSelector_form">
			<div class="CSPhotoSelector_header">
				<p>Sélectionnez depuis vos photos</p>
			</div>

			<div class="CSPhotoSelector_content CSAlbumSelector_wrapper">
				<p>Parcourez vos albums pour choisir votre photo</p>
				<div class="CSPhotoSelector_searchContainer CSPhotoSelector_clearfix">
					<div class="CSPhotoSelector_selectedCountContainer">Choisir un album</div>
				</div>
				<div class="CSPhotoSelector_photosContainer CSAlbum_container"></div>
			</div>

			<div class="CSPhotoSelector_content CSPhotoSelector_wrapper">
				<p>Choisir une nouvelle photo</p>
				<div class="CSPhotoSelector_searchContainer CSPhotoSelector_clearfix">
					<div class="CSPhotoSelector_selectedCountContainer"><span class="CSPhotoSelector_selectedPhotoCount">0</span> / <span class="CSPhotoSelector_selectedPhotoCountMax">0</span> photos sélectionnées</div>
					<a href="#" id="CSPhotoSelector_backToAlbums">Retour aux albums</a>
				</div>
				<div class="CSPhotoSelector_photosContainer CSPhoto_container"></div>
			</div>

			<div id="CSPhotoSelector_loader"></div>


			<div class="CSPhotoSelector_footer CSPhotoSelector_clearfix">
				<a href="#" id="CSPhotoSelector_pagePrev" class="CSPhotoSelector_disabled">Précédent</a>
				<a href="#" id="CSPhotoSelector_pageNext">Prochain</a>
				<div class="CSPhotoSelector_pageNumberContainer">
					Page <span id="CSPhotoSelector_pageNumber">1</span> / <span id="CSPhotoSelector_pageNumberTotal">1</span>
				</div>
				<a href="#" id="CSPhotoSelector_buttonOK">OK</a>
				<a href="#" id="CSPhotoSelector_buttonCancel">Annuler</a>
			</div>
		</div>
	</div>
	
</div>
	

  <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="fbselect.js"></script>
	<script src="csphotoselector.js"></script>
  

<script>
window.fbAsyncInit = function() {
	FB.init({ appId: '302290699911602', channelUrl : '//artecoen.storage14.brainsonic.com/channel.html', cookie: true, status: true, xfbml: true, oauth: true });
	FB.Canvas.setAutoGrow();
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


