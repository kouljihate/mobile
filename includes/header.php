<?
error_reporting(E_ALL^E_NOTICE);
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
</head> 

<body>
	<!-- Splash screen -->
  	 <div id="splash"> 
	   <img id="splash-bg" src="images/splash/splash-alternate.png" alt="splash image"/>
	   <img id="splash-title" src="images/splash/main.png" alt="splash title" />
	 </div> 
  <!-- end splash screen -->
	<div id="menu">
		<form action="search.php"><h3><input id="search" type="text" placeholder="Search" /> </h3></form>
		<ul>
			<li class="active"><a href="./" data-transition="pop" class="contentLink">Home<span></span></a></li>
			<li><a href="company-profile.php" data-transition="pop" class="contentLink">Company Profile<span></span></a></li>
			<li><a href="products-services.php"data-transition="pop" class="contentLink">Products &amp; Services<span></span></a></li>
			<li><a href="portfolio.php" data-transition="pop" class="contentLink">Portfolio<span></span></a></li>
			<li><a href="news-events.php" data-transition="pop" class="contentLink">News &amp; Events<span></span></a></li>
			<li><a href="gallery.php" data-transition="pop" class="contentLink">Gallery<span></span></a></li>
			<li><a href="typography.php" data-transition="pop" class="contentLink">Typography<span></span></a></li>
			<li><a href="blog.php" data-transition="pop" class="contentLink">Wordpress Blog<span></span></a></li>
			<li><a href="twitter.php" data-transition="slide" class="contentLink">Twitter Feeds<span></span></a></li>
			<li><a href="video-channel.php" data-transition="pop" class="contentLink">Video Channel<span></span></a></li>
			<li><a href="contact-us.php" data-transition="flip" class="contentLink">Contact Us<span></span></a></li>
			<li><a href="about.php" data-transition="slide" class="contentLink">About<span></span></a></li>
            <li><a href="404.php" data-transition="slide" class="contentLink">404<span></span></a></li>
		</ul>
	</div>