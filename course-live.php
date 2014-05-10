<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
//ini_set("session.lifetime",60);
if ((!isset($_SESSION['login'])) ||(!isset($_SESSION['chauffeur_id_radio'])))
	{
		header ('Location: index.php?color=199dd4&amp;theme=light');
		exit();
	}
include("includes/config_bd.php");
include("includes/functions.php");	
//error_reporting(E_ALL^E_NOTICE);
$theme ="light";
$color ="199DD4";
 	include("includes/header-course.php");	
	//echo mysql_num_rows($sql);
	//print_r($driver_details);
	if((isset($_GET['ac']))&&($_GET['ac']=="faussecourse")){
		$id_planning=$_GET['id_planning'];
		$declare_fausse_course=RequestNewFausseCourse($_SESSION['chauffeur_id_radio'],$_SESSION["id_chauffeur"],$id_planning);
		}
	if((isset($_GET['ac']))&&($_GET['ac']=="response_call")){
		$id_call=$_GET['id_call'];
		$response_this_call=ResponseThisCall($id_call);
	}
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
        	
            <div id="verif_call"></div>
            
            <div id="verif_pending_trip"></div>
            
            <h3>Mes courses</h3>
           <div id="live-course"></div>
		<div class="clear" style="min-height:60px;">&nbsp;</div>
            <a class="icon" href="secteur-live.php" rel="external">
                <img src="images/content/icon-secteurs.png" width="68" />
                <span>Secteurs</span>
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