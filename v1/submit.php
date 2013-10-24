<?php ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"?>
<?php

session_start();
$_SESSION['profile']= 7; 
//now, let's register our session variables

// upload the file
if ((isset($_POST["submitted_form"])) && ($_POST["submitted_form"] == "image_upload_form")) {
	
	// file needs to be jpg,gif,bmp,x-png and 4 MB max
	if (($_FILES["image_upload_box"]["type"] == "image/jpeg" || $_FILES["image_upload_box"]["type"] == "image/pjpeg" || $_FILES["image_upload_box"]["type"] == "image/gif" || $_FILES["image_upload_box"]["type"] == "image/png") && ($_FILES["image_upload_box"]["size"] < 8388608))
	{
		
  
		// some settings
		$max_upload_width = 3000;
		$max_upload_height = 2000;
		  
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
		header("Location: erreur.html");
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
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
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
			<span style="width:250px">Depuis mon ordinateur </span>
			<div id="infos-upload">(Fichiers image seulement, 2Mo Max.,formats : jpeg, gif ou png)</div>
			<br />
			<div id="classic-select">
				<form action="submit.php" method="POST" enctype="multipart/form-data" name="image_upload_form" id="image_upload_form" style="padding-top: 4.7em;">
					<input name="image_upload_box" type="file" id="image_upload_box" size="40" />
					<input type="image" name="submit" src="graphics/classic-upload.png" value="Upload image" />     
					<input name="submitted_form" type="hidden" id="submitted_form" value="image_upload_form" />
				</form>
			</div>
		</div>
			
		<div class="upload-mode-container">
			<span style="width:250px">Parmi mes albums photos Facebook </span>
				<br /><br />
			<div id="fb-select">
				
				<img src="graphics/fb-upload.png" style="padding-top: 5.8em;" />
			</div>
		</div>
	</div>
</div>



</body>
</html>


