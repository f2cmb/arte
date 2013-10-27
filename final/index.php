<!DOCTYPE html>
<html lang="fr">
<head>
  <title></title>
 <meta charset="utf-8">
  <link href="css/general.css" rel="stylesheet">
  <link rel="stylesheet" href="css/csphotoselector.css" />
  



  
</head>
<body style="background:url(graphics/bg-accueil.jpg)">
	<div id="fb-root"></div>
	

	<div id="wrapper">
		<a href="http://coen.arte.tv/fr/" target="_blank"><img src="graphics/btn-questionnaire.png"  style="padding-top:150px" /></a>	
	</div>

	<div id="credits">Direction artistique : Arnaud Desjardins<br />
Tous droits de reproduction et de diffusion réservés © 2013 ARTE G.E.I.E.<br />
ARTE G.E.I.E. 4, quai du chanoine Winterer CS 20035 F- 67080 Strasbourg Cedex</div>
</div>

<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
window.fbAsyncInit = function() {

 
	FB.init({ appId: '302290699911602', channelUrl : '//artecoen-preprod03.brainsonic.com/channel.html', cookie: true, status: true, xfbml: true, oauth: true });
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


