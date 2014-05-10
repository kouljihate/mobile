<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
//ini_set("session.lifetime",60);
include("includes/config_bd.php");
include("includes/functions.php");
/////////////////////////////////////// CHANGE POINTAGE
if(isset($_GET['ac'])){
	if($_GET['ac']=='change_secteur'){
		$id_secteur_to_point=$_GET['id_secteur'];
		$point_this=update_pointage_driver($_SESSION['chauffeur_id_radio'],$_SESSION["id_chauffeur"],1,$id_secteur_to_point);
	}	
	if($_GET['ac']=="depointage"){
		update_pointage_driver($_SESSION['chauffeur_id_radio'],$_SESSION["id_chauffeur"],3,0);
		}
	if($_GET['ac']=="logout"){
		update_pointage_driver($_SESSION['chauffeur_id_radio'],$_SESSION["id_chauffeur"],3,0);
		unset($_SESSION['login']);
		session_unset();
		session_destroy();		
		}
}	

if (!isset($_SESSION['login'])) 
	{
		header ('Location: index.php?color=199DD4&theme=light'); 
		exit();
	}

//error_reporting(E_ALL^E_NOTICE);
	$theme = $_GET['theme'] ?  $_GET['theme'] : "light";
	$color = $_GET['color'] ?  $_GET['color'] : "199DD4";
 	include("includes/header-page.php");
	//$driver_details=GetUserDetailsByCaracter("email",$_SESSION['login']);		
	$value=$_SESSION['login'];
	$id_radio=$_SESSION['login'];
	$sql=mysql_query('SELECT * FROM chauffeurs WHERE id_radio="'.$_SESSION['login'].'" AND password="'.$_SESSION['password'].'"')or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){				
			$_SESSION["id_chauffeur"]=$exist["id_chauffeur"];
			$_SESSION['chauffeur_id_radio']=$exist["id_radio"];
			$_SESSION["chauffeur_name"]=$exist["name"];
			$_SESSION["chauffeur_tel"]=$exist["tel"];
			$_SESSION["chauffeur_adresse"]=$exist["adresse"];
			$_SESSION["chauffeur_email"]=$exist["email"];			
			}	
	}

	
	$pointage_details=GetPointageDetails($_SESSION['chauffeur_id_radio']);
	if($pointage_details==false){
		$id_secteur_in_point=0;
		$classse_notif="notif-secteur-unranked";
		}
	else{
		$id_secteur_in_point=$pointage_details['id_secteur'];
		$classse_notif="notif-secteur-ranked";
		}
	$_SESSION["id_secteur_in_point"]=$id_secteur_in_point;
	//echo mysql_num_rows($sql);
	//print_r($driver_details);
?>
<div data-dom-cache="false" data-role="page" class="pages" id="home" data-theme="a">
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
            <div class="cherry-slider ipad-width-optimize" style="height:160px;">
                 <ul class="gallery photoswipe column-split one-column">
                    <li><img src="images/content/logo.png" alt="Taxi Capital"></li>
                </ul>          
            </div>            
	    <div class="white-content-box ">
            <h2 style="margin-top: 0;">Home</h2>
            <?php /*if($pointage_details!=false){?>
            	<div id="position_in_secteur"></div>
            <?php }*/?>
            
            <ul class="column-split two-column" style="margin-left:15%;">
            <li>
            <a class="icon" href="secteur-live.php" rel="external">
                <img src="images/content/icon-secteurs.png" width="68" />
                <span>Secteurs</span>
            </a>
            </li>
            <li>
            <a rel="external" class="icon" href="course-live.php">
                <img src="images/content/icon-courses.png" width="68"/>
                <span>Mes courses</span>
            </a>
            </li>
            <li>
            <a class="icon" href="#">
                <img src="images/content/icon-profil.png" width="68"/>
                <span>Mon compte</span>
            </a>
            </li>
            <li>
            <a rel="external" class="icon" href="home.php?ac=logout">
                <img src="images/content/icon-logout.png" width="68"/>
                <span>Fin de service</span>
            </a>
            </li>
            <!-- GEOCALISATION -->
            <li><div id="current" style="display:none;"></div></li>
            <!-- /GEOCALISATION -->
           </ul>
        </div>
	</div>
<!-- /content -->        
        <? include("includes/footer-content.php"); ?>
</div><!-- /page -->
<? include("includes/footer.php") ?>