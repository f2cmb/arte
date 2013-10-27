<?php

session_start();

 

switch ($_SESSION['profile']) {
 case 1:
     $bg_src="graphics/bg-barnes.jpg";
     break;
 case 2:
		$bg_src="graphics/bg-chigurh.jpg";
     break;
 case 3:
		$bg_src="graphics/bg-davis.jpg";
     break;
	case 4:
		$bg_src="graphics/bg-fink.jpg";
	    break;
	case 5:
		$bg_src="graphics/bg-gopnik.jpg";
	    break;
	case 6:
		$bg_src="graphics/bg-mcgill.jpg";
	    break;
	case 7:
		$bg_src="graphics/bg-lebowski.jpg";
	    break;
	case 8:
		$bg_src="graphics/bg-gunderson.jpg";
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

<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo.png" alt="coenizr" /><br />
			
		
		</div>
		<br />
		<span>Votre fichier est d'une taille trop importante. Réessayez avec un autre.</span><br />
		<div id="infos-upload">(Vous allez être redirigé vers la page d'upload dans 5 secondes)</div>
		
</div>

 <script type="text/javascript">
 setTimeout(function(){
   window.location = "https://artecoen-preprod03.brainsonic.com/submit.php";
 }, 5000);
 </script>

</body>
</html>


