<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
//ini_set("session.lifetime",60);
if (!isset($_SESSION['login'])) 
	{
		header ('Location: index.php?color=199dd4&amp;theme=light'); 
		exit();
	}
include("includes/config_bd.php");
include("includes/functions.php");	
//error_reporting(E_ALL^E_NOTICE);
$theme ="light";
$color ="199DD4";
 	include("includes/header-secteur.php");
	//echo mysql_num_rows($sql);
	//print_r($driver_details);
?>
<div data-dom-cache="false" data-role="page" class="pages" id="course-live" data-theme="a">
	<div data-role="header">
            <div class="left">
                <a href="#" class="showMenu menu-button"><img src="images/menu-button.png" width="40" /></a>
            </div>
            <h1 class="left welcome-padding-left ui-title" role="heading" aria-level="1">
                <p class="no-margin">Taxi Capital</p>
                <p class="no-margin">
                Bienvenue <? echo $_SESSION["chauffeur_name"];?></p>                
            </h1>
            <div id="header-bar-notif"> </div>
	</div>
        <div class="header-shadow"></div>
        <!-- /header -->
<div data-role="content" data-theme="a" class="minus-shadow" style="width:100%!important;">
            <div class="cherry-slider ipad-width-optimize" style="height:110px;">
                 <ul class="gallery photoswipe column-split one-column">
                    <li><img src="images/content/logo.png" alt="Taxi Capital"></li>
                </ul>          
            </div>
	    <div class="white-content-box2">
            <h3>Secteurs</h3>
           <div id="live-secteur"></div>
		<div class="clear" style="min-height:60px;">&nbsp;</div>             
            </a>
            <a class="icon" href="course-live.php" rel="external">
                <img src="images/content/icon-courses.png" width="68"/>
                <span>Mes courses</span>
            </a>
            <a class="icon" href="#">
                <img src="images/content/icon-profil.png" width="68"/>
                <span>Mon compte</span>
            </a>
            <a rel="external" class="icon" href="home.php?ac=logout">
                <img src="images/content/icon-logout.png" width="68"/>
                <span>Fin de service</span>
            </a>
            <!-- GEOCALISATION -->
            <div id="current" style="display:none;"></div>
            <!-- /GEOCALISATION -->
        </div>
</div>
<!-- /content -->        
        <? include("includes/footer-content.php"); ?>
</div><!-- /page -->
<? include("includes/footer.php") ?>