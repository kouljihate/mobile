<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
//ini_set("session.lifetime",60);
if (isset($_SESSION['login'])) 
	{
		header ('Location: home.php?color=199DD4&theme=light'); 
		exit();
	}
//error_reporting(E_ALL^E_NOTICE);
	$theme = $_GET['theme'] ?  $_GET['theme'] : "light";
	$color = $_GET['color'] ?  $_GET['color'] : "199DD4";
 	include("includes/header-login.php")
?>
<div data-dom-cache="false" data-role="page" class="pages" id="loginpage" data-theme="a">
	<div data-role="header">
    <div class="header-shadow"></div>
            <h1>
             <ul class="gallery photoswipe column-split one-column">
            	<li><img src="images/content/logo.png" alt="Taxi Capital"></li>
        	</ul>
            </h1>  
	</div>
        
    <div style="height:20px;"></div>    
        
        <!-- /header -->
	<div data-role="content" data-theme="a" class="minus-shadow" id="callAjaxPage">
    <div class="cherry-slider ipad-width-optimize" style="height:250px;" data-role="content"> 
    <!-- call ajax page -->    
            <form id="callAjaxForm" method="POST" action="index.php" data-ajax="false">
                <div data-role="fieldcontain">
                    <div class="form-element">
                    <label for="login">Radio N&deg;</label>
                    <input type="text" name="login" id="login" value=""/>
                    </div>
                    <div class="form-element">
                    <label for="pass">Mot de passe</label>
                    <input type="password" name="pass" id="pass" value=""/>
                    </div> 
                    <div style="height:10px;">&nbsp;</div>                   
					<input data-theme="b" type="submit" id="submit" class="button button2" value="Se connecter" />
                </div>
            </form>
            <h3 id="notification"></h3>
            <h3 id="notification_error"></h3>
        </div>
  	  </div>
   <? include("includes/footer-content.php"); ?>
</div><!-- /page -->
<? include("includes/footer.php") ?>