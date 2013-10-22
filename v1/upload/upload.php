<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style>
	
	body{
		background:url(http://www.sophrologieparis7.fr/themes/bartik/images/bg-traits.jpg);
		background-size:cover;
		margin:auto;
		text-align:center;
		font-family:helvetica,arial,sans-serif;
	}
	
	</style>
	
</head>
<?php
// Simple PHP Upload Script:  http://coursesweb.net/php-mysql/



$uploadpath = 'upload/';      // directory to store the uploaded files
$max_size = 2000;          // maximum file size, in KiloBytes
$alwidth = 900;            // maximum allowed width, in pixels
$alheight = 800;           // maximum allowed height, in pixels
$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png', 'pdf');        // allowed extensions





if($_POST['izfile']==1){
if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
  $uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       // gets the file name
  $sepext = explode('.', strtolower($_FILES['fileup']['name']));
  $type = end($sepext);       // gets extension
  list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     // gets image width and height
  $err = '';         // to store the errors

  // Checks if the file has allowed type, size, width and height (for images)
  if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
  if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
  if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
 
  // If no errors, upload the image, else, output the errors
  if($err == '') {
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) { 
      echo 'Fichier : <b>'. basename( $_FILES['fileup']['name']). '</b> uploadé avec succès :';
      echo '<br/>Fichier : <b>'. $_FILES['fileup']['type'] .'</b>';
      echo '<br />Taille : <b>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'</b> KB';
      echo '<br/><br/>Adresse du fichier : <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
	  
	    $con = mysql_connect("localhost","vds86-uploadsoph","ZCID0Ud0");
	    if (!$con)
	    {
	      die('Could not connect: ' . mysql_error());
	    }
	    mysql_select_db("vds86-uploadsoph", $con);

		$titre = addslashes($_POST['titre']);
		$jour = addslashes($_POST['jour']);
		$string = $_FILES["fileup"]["name"];

	    $query = "
	    INSERT INTO `vds86-uploadsoph`.`fichiers` (`titre`, `date`, `string`) VALUES ('$titre','$jour','$string');";

	    mysql_query($query);


	    mysql_close($con);
	  
	
	  
    }
	
	
	
	
	
	
    else echo '<b>Unable to upload the file.</b>';
  }
  else echo $err;
}}elseif($_POST['izfile']==0){
    $con = mysql_connect("localhost","vds86-uploadsoph","ZCID0Ud0");
    if (!$con)
    {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("vds86-uploadsoph", $con);

	$titre = addslashes($_POST['titre']);
	$jour = addslashes($_POST['jour']);

    $query = "
    INSERT INTO `vds86-uploadsoph`.`fichiers` (`titre`, `date`, `string`) VALUES ('$titre','$jour',NULL);";

    mysql_query($query);
	if(mysql_errno()){
	   echo "Informations correctement envoyées";
	}

    

    mysql_close($con);
}
?>
<body>
<div style="margin: 1em auto; text-align:center;">
	
	<h2>Ajout ateliers</h2>
	
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"> 
	 Titre de l'atelier :<br />
	 <input type="text" size="200" name="titre" /><br /><br />
	 Date de l'atelier :<br />
	 
	 <input type="text" size="200" name="jour" /><br /><br />
	 Fichier :<br />
	 avec <INPUT type=radio name="izfile" value="1" checked>sans <INPUT type=radio name="izfile" value="0"><br /><br />
	 
  Fichier à enregistrer : <input type="file" name="fileup" /><br/><br />
  <input type="submit" name='submit' value="Envoyer" /> 
 </form>
</div>
</body>
<html>