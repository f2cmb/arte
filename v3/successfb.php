<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
 <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript">



function capture() {
	$('.ui-resizable-handle, .ui-resizable-se, .ui-icon, .ui-icon-gripsmall-diagonal-se').css("display","none");
	$('#nwgrip, #negrip, #swgrip, #segrip, #ngrip, #egrip, #sgrip, #wgrip,#segrip').css("display","none");
	$('#element1, #element2').css("border","none");
	$('#overlay').css("display","block"); 
	$('#watermark').css("display","block");

	
		html2canvas($('#uploaded-image'), {
			proxy: "server.js",
		    useCORS: true,
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
    $( ".element1" ).resizable({maxWidth: 550});
	$( ".element2" ).resizable({maxWidth: 550});
    $( ".uploaded-image" ).resizable({
    aspectRatio: true,maxWidth: 650,minWidth: 300,
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
	z-index:9997;
	top:600px;
	left:35%;
	border: 1px dashed #fff;
    overflow: hidden;
	
    
}
#element2{
	position:absolute;
	z-index:9997;
	top:600px;
	left:35%;
	border: 1px dashed #fff;
    overflow: hidden;
	
 
}


.element1{max-width:650px;
	text-align:center;
	margin:auto;
}
.element2{max-width:650px;
	text-align:center;
	margin:auto;}

#element1 :hover{
cursor: -moz-grab;cursor: -webkit-grab
    
}
#element2 :hover{
	cursor: -moz-grab;cursor: -webkit-grab
 
}

#nwgrip, #negrip, #swgrip, #segrip, #ngrip, #egrip, #sgrip, #wgrip {
    width: 10px;
    height: 10px;
    background-color: #ffffff;
    border: 1px solid #000000;
}
#segrip {
    right: -5px;
    bottom: -5px;
}


img.uploaded-image.ui-resizable{
	text-align:center; 
	margin:auto;
	width:100%;
}

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
#loader{
	text-align:center;
	margin:auto;    
	position:relative;
  	top:30%;
	font-family: 'Raleway', Arial, serif; font-weight: 300;
	color:#fff;
} 

#watermark{
	position:relative;
	z-index:9996; 
	display:none;
	bottom: 70px;
	left: 60%;
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
	<div id="overlay"><div id="loader"><img src="graphics/loading.gif"><br />
		Patience, nous créons votre portrait...</div></div>
	<div id="wrapper">
		<div id="top-first">
			<img src="graphics/logo-small.png" alt="coenizr" /><br />
			Refaites-vous le portrait en
			<br />
			<img src="<?php echo $profile_src; ?>" alt="nom" />
		</div>
		<br />
		<span>2. Je redimensionne ma photo, mes cheveux, ma moustache... </span><br />
		<span style="text-transform:none; font-weight: 500;font-size:14px">Pour agrandir ou diminuer la taille des éléments,<br />utilisez la poignée en bas à droite de chaque cadre.</span>
		
		
		
	<br />
		<br />
		<input type="image" src="graphics/create-btn.png" value="Take Screenshot Of Div" onclick="capture();" />
		<form method="POST" enctype="multipart/form-data" action="save-share.php" id="myForm">
		    <input type="hidden" name="img_val" id="img_val" value="" />
		</form>
		<br />	<br />
		
	
		<div id="uploaded-image"><img class="uploaded-image" src="<?php echo $_POST['image_fb'];?>" style="text-align:center;margin:auto">
			<div id="elements-container">
				<div id="element1">
					<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div>
					<div class="ui-resizable-handle ui-resizable-ne" id="negrip"></div>
					<div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div>
					<div class="ui-resizable-handle ui-resizable-se" id="segrip"></div>
					<img class="element1" src="<?php echo $src1; ?>" />
				</div>
				<div id="element2">
					<div class="ui-resizable-handle ui-resizable-nw" id="nwgrip"></div>
				    <div class="ui-resizable-handle ui-resizable-ne" id="negrip"></div>
					<div class="ui-resizable-handle ui-resizable-sw" id="swgrip"></div>
				    <div class="ui-resizable-handle ui-resizable-se" id="segrip"></div>
					<img class="element2" src="<?php echo $src2; ?>" />
				</div>
				<img id="watermark" src="graphics/watermark.png" />
				
			</div>
		</div>
		
		
		
		
			<br /><br />
	
	</div>
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

