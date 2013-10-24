<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
 <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
 <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript">

function capture() {
	$('.ui-resizable-handle, .ui-resizable-se, .ui-icon, .ui-icon-gripsmall-diagonal-se').css("display","none");
	$('#element1, #element2').css("border","none");
		html2canvas($('#target'), {
        onrendered: function (canvas) {
            //Set hidden field's value to image data (base-64 string)
            $('#img_val').val(canvas.toDataURL("image/png"));
            //Submit the form manually
            document.getElementById("myForm").submit();
        }
    });
}

$(window).on('load',function () {
    $( "#element1" ).draggable();
    $( "#element2" ).draggable();
    $( ".element1" ).resizable({maxWidth: 400});
	$( ".element2" ).resizable({maxWidth: 400});
    $( ".uploaded-image" ).resizable({
    aspectRatio: true,maxWidth: 515,minWidth: 300,
    resize: function(event, ui) {
        $(this).css({
            'top': parseInt(ui.position.top, 10) + ((ui.originalSize.height - ui.size.height)) / 2,
            'left': parseInt(ui.position.left, 10) + ((ui.originalSize.width - ui.size.width)) / 2
        });
    }
});
});

</script>
  <link href="css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet">
  <link href="css/general.css" rel="stylesheet">
  
<style type="text/css">

#element1{
	position:absolute;
	z-index:9999;
	top:600px;
	left:35%;
	border: 1px dashed #11ece9;
    
}
#element2{
	position:absolute;
	z-index:9999;
	top:600px;
	left:35%;
	border: 1px dashed #11ece9;
 
}

#element1 :hover{
cursor: -moz-grab;cursor: -webkit-grab
}
#element2 :hover{
cursor: -moz-grab;cursor: -webkit-grab
}

</style>
<?php

session_start();

$profile = $_SESSION['profile'];

switch ($profile) {
    case 1:
        $bg_src="graphics/bg-barnes.jpg";
        $src1="elements/barnes-butterfly.png";
        $src2="elements/barnes-hair.png";
    	$profile_src="graphics/title-barnes.png";
        break;
    case 2:
		$bg_src="graphics/bg-chigurh.jpg";
        $src1="elements/chigurh-eyebrows.png";
        $src2="elements/chigurh-hair.png";
    	$profile_src="graphics/title-chigurh.png";
        break;
    case 3:
		$bg_src="graphics/bg-davis.jpg";
        $src1="elements/davis-cigarette.png";
        $src2="elements/davis-hair.png";
    	$profile_src="graphics/title-davis.png";
        break;
	case 4:
		$bg_src="graphics/bg-fink.jpg";
	    $src1="elements/fink-glasses.png";
	    $src2="elements/fink-hair.png";
		$profile_src="graphics/title-fink.png";
	    break;
	case 5:
		$bg_src="graphics/bg-gopnik.jpg";
	    $src1="elements/gopnik-kippah.png";
	    $src2="elements/gopnik-hair.png";
		$profile_src="graphics/title-gopnik.png";
	    break;
	case 6:
		$bg_src="graphics/bg-mcgill.jpg";
	    $src1="elements/mcgill-mustach.png";
	    $src2="elements/mcgill-hair.png";
		$profile_src="graphics/title-mcgill.png";
	    break;
	case 7:
		$bg_src="graphics/bg-lebowski.jpg";
	    $src1="elements/lebowski-beard.png";
	    $src2="elements/lebowski-hair.png";
		$profile_src="graphics/title-lebowski.png";
	    break;
	case 8:
		$bg_src="graphics/bg-gunderson.jpg";
	    $src1="elements/gunderson-chapka.png";
		$profile_src="graphics/title-gunderson.png";
		 break;
		
}

?>
</head>
<body style="background:url(<?php echo $bg_src; ?>)">
	<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo-small.png" alt="coenizr" /><br />
			Refaites-vous le portrait en
			<br />
			<img src="<?php echo $profile_src; ?>" alt="nom" />
		</div>
		<br />
		<span>2. Je redimensionne ma photo, mes cheveux, ma moustache... </span>
		<div id="infos-upload">(Redimensionner les éléments à l'aide des poignées)</div>
		
	
		<br /><br /><br />
			<div id="target">
			
				<?php if(isset($_REQUEST['show_image']) and $_REQUEST['show_image']!=''){?>
				<div id="uploaded-image"><img class="uploaded-image" src="image_files/<?php echo $_REQUEST['show_image'];?>" style="float: left; margin-right: 10px;">
				</div>
				<?php }?>
				<div id="elements-container">
					<div id="element1"><img class="element1" src="<?php echo $src1; ?>" /></div>
					<div id="element2"><img class="element2" src="<?php echo $src2; ?>" /></div>
				</div>
			</div>
		
			<br /><br /><br />
		<input type="image" src="graphics/snap_btn.png" value="Take Screenshot Of Div" onclick="capture();" />
		<form method="POST" enctype="multipart/form-data" action="save-share.php" id="myForm">
		    <input type="hidden" name="img_val" id="img_val" value="" />
		</form>
	</div>
</body>
</html>

