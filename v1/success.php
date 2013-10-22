<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
 <meta charset="utf-8">
 <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
 <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript">

function capture() {
	$('.ui-resizable-handle, .ui-resizable-se, .ui-icon, .ui-icon-gripsmall-diagonal-se').css("display","none")
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
    $( ".element1" ).resizable();
	$( ".element2" ).resizable();
    $( ".uploaded-image" ).resizable({ aspectRatio: true });
});

</script>
  <link href="css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<style type="text/css">

#snap{
	background-color:#a2a2a2;
	width:150px;
	height:50px;
	color:#000;
	position:absolute;
	top:0px;
	right:0px;
}
#element1{
	position:absolute;
	z-index:9999;
}
#element2{
	position:absolute;
	z-index:9999;
}


</style>
<?php

//$profile = $_POST['profile'];
echo $_POST['profile'];
switch ($profile) {
    case 2:
        $src1="images/yoda.png";
        $src2="images/darkvador.png";
        break;
    case 3:
    	$src1="images/grievous.png";
    	$src2="images/chewie.png";
        break;
}

?>
</head>
<body>
<div>
	Sélectionner la zone de la photo à utiliser :
<div id="target"> 
<div id="element1"><img class="element1" src="<?php echo $src1; ?>" /></div>
<div id="element2"><img class="element2" src="<?php echo $src2; ?>" /></div><br /><br />
<?php if(isset($_REQUEST['show_image']) and $_REQUEST['show_image']!=''){?>
<div id="uploaded-image"><img class="uploaded-image" src="image_files/<?php echo $_REQUEST['show_image'];?>" style="float: left; margin-right: 10px;"></div>
<?php }?>
</div>
</div>

	
<input type="submit" value="Take Screenshot Of Div" onclick="capture();" />
<form method="POST" enctype="multipart/form-data" action="save-share.php" id="myForm">
    <input type="hidden" name="img_val" id="img_val" value="" />
</form>

</body>
</html>

