<?
//error_reporting(E_ALL^E_NOTICE);
	$theme = $_GET['theme'] ?  $_GET['theme'] : "light";
	$color = $_GET['color'] ?  $_GET['color'] : "199DD4";
 	include("includes/header-login.php")
?>
<div data-dom-cache="false" data-role="page" class="pages" id="home" data-theme="a">
	<div data-role="header">
            <div class="left">
                <a href="#" class="showMenu menu-button"><img src="images/menu-button.png" width="40" /></a>
            </div>
            <h1>
              <p>Taxi Capital</p></h1>
	</div>
        <div class="header-shadow"></div>
        <!-- /header -->
    
	<div data-role="content" data-theme="a" class="minus-shadow" id="callAjaxPage">
            <div class="cherry-slider ipad-width-optimize" style="height: 210px;" data-role="content">
    <!-- call ajax page -->
            <form id="callAjaxForm">
                <div data-role="fieldcontain">
                    <label for="firstName">First Name</label>
                    <input type="text" name="login" id="login" value=""  />
 
                    <label for="lastName">Last Name</label>
                    <input type="text" name="pass" id="pass" value=""  />
                    <h3 id="notification"></h3>
                    <h3 id="notification_error"></h3>
                    <button data-theme="b" id="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
  	  </div>
   <? include("includes/footer-content.php"); ?>
</div><!-- /page -->
<? include("includes/footer.php") ?>