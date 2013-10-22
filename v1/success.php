<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript">


$(document).ready(function () {
jQuery( '#snap' ).click(function() {
	html2canvas($('#container'), {
	  onrendered: function(canvas) {
	    document.body.appendChild(canvas);
	  }
	});
});
});  


$(document).ready(function () {
    $( "#yoda" ).draggable();
    $( "#darkvador" ).draggable();
    $( ".yoda" ).resizable();
	$( ".darkvador" ).resizable();
    $( ".tatooine" ).resizable();
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
#yoda{
	position:absolute;
	z-index:9999;
}
#darkvador{
	position:absolute;
	z-index:9999;
}


</style>
</head>
<body>
<div>
	Sélectionner la zone de la photo à utiliser : 
<div id="yoda"><img class="yoda" src="images/yoda.png" /></div>
<div id="darkvador"><img class="darkvador" src="images/darkvador.png" /></div><br /><br />
<?php if(isset($_REQUEST['show_image']) and $_REQUEST['show_image']!=''){?>
<div id="tatooine"><img class="tatooine" src="image_files/<?php echo $_REQUEST['show_image'];?>" style="float: left; margin-right: 10px;"></div>
<?php }?>
</div>

<div id="snap">screen that !</div>

</body>
</html>

