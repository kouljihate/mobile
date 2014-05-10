<?
//error_reporting(E_ALL^E_NOTICE);
$theme ="light";
$color ="199DD4";
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title>Taxi Capital Bruxelles</title> 
	<meta id="extViewportMeta" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
	<!-- For iPhone 4 with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon.png">
	<!-- For first-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="images/icon.png">
	<!-- For nokia devices: -->
	<link rel="shortcut icon" href="images/icon.png">
	
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.24.custom.css" />
	<link rel="stylesheet" href="css/themes/default/RSVmain.min.css" />
	<link rel="stylesheet" href="css/themes/default/jquery.mobile.structure-1.1.1.min.css" />
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/add2home.css">
	
	<link rel="stylesheet/less" href="css/style.php?theme=<?=$theme?>&color=<?=$color?>">

	 <!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script src="js/jquery-ui-1.8.24.custom.min.js"></script>
	
	<script type="text/javascript" src="js/jquery.mobile-1.1.1.min.js"></script>
        <script type="text/javascript" src="js/less-1.3.0.min.js"></script>
        <!--<script type="text/javascript" src="js/jquery-ui-effects.js"></script>-->

	<script src="js/helper.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/iphone-style-checkboxes.js"></script>
	<script src="js/klass.min.js"></script>
	<script src="js/code.photoswipe.jquery-3.0.5.min.js"></script>
	<script src="js/add2home.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        
	<script type="text/javascript" src="js/app.js?v=30"></script>
    <script type="text/javascript">
	//$(document).bind('pageinit')(function() {	
	function initialize_geo()
	{
		if(geo_position_js.init())
		{
			document.getElementById('current').innerHTML="Receiving...";
			geo_position_js.getCurrentPosition(save_position,function(){
				document.getElementById('current').innerHTML="Couldn't get location"},{enableHighAccuracy:true});
		}
		else
		{
			document.getElementById('current').innerHTML="Functionality not available";
		}
	}
	
	function save_position(p)
	{	
		$("#current").load('includes/geo_verif.php?lat='+p.coords.latitude+'&long='+p.coords.longitude);		
		
	}
									
	$(document).ready(function() {
		$("#header-bar-notif").load("includes/header-bar-notification.php");
		   var refreshId = setInterval(function() {
			  $("#header-bar-notif").load('includes/header-bar-notification.php');
		   }, 2000);
		   
		   
		   var refreshId = setInterval(function() {
			  $("#verif_call").load('includes/verif_call.php');
		   },1000);
	   
		var hovering = false;
		var onResponse = null;
		
		$('#live-course').mouseover(function() {
			hovering = true;
		});
		
		$('#live-course').mouseout(function() {
			hovering = false;
			onResponse && onResponse();
		});
		
		function posts() {
		 pfunc = $.ajax({
				 url: 'includes/course_live_list.php',
				 success: function(data) {
								onResponse = function() {
									if(hovering) return;
									$('#live-course').html(data);
									$('#live-course').fadeIn(2000);
									setTimeout(posts, 2000);
									onResponse = null;
								};
								onResponse();
				}
				});
		}
		
		posts();
		/*GEOCALISATION*/
		initialize_geo();
		   var refreshGeo = setInterval(function() {
			  initialize_geo()
		   }, 60000*2);
});

</script>
</head> 

<body>
	<!-- Splash screen -->
  	 <div id="splash"> 
	   <img id="splash-bg" src="images/splash/splash-alternate.png" alt="splash image"/>
	   <img id="splash-title" src="images/splash/main.png" alt="splash title" />
	 </div> 
  <!-- end splash screen -->
	<div id="menu">		
		<ul>
			<li><a href="home.php" rel="external" class="contentLink">Home<span></span></a></li>
            <li><a href="secteur-live.php" rel="external" class="contentLink">Secteurs<span></span></a></li>
			<li class="active"><a href=""  class="contentLink">Mes courses<span></span></a></li>
			<li><a href="" class="contentLink">Mon compte<span></span></a></li>
            <li><a href="home.php?ac=depointage" rel="external" class="contentLink">Se d&eacute;pointer<span></span></a></li>
            <li><a href="home.php?ac=logout" rel="external" class="contentLink">Fin de service<span></span></a></li>
		</ul>
	</div>