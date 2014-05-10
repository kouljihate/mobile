<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
include"functions.php";
connexion();
$id_radio=$_SESSION['chauffeur_id_radio'];
$verif_new_call=array("id_appel_taxi"=>"","id_radio"=>"","id_chauffeur"=>"","id_telephoniste"=>"","date_time_request"=>"","response_as_ready"=>"","date_time_response"=>"","delay_call"=>"");
$verif_new_call=VerifCall($id_radio);
if($verif_new_call!=false){
	?>
	<!--<img src="images/calling.gif"><br />-->
    <div class="approved">
        <div class="typo-icon">
        	<img src="images/loading6.gif">
            Nouveau appel ! ...<? echo $verif_new_call["delay_call"];?>
        </div>
    </div>
    <a rel="external" class="button button12" href="course-live.php?ac=response_call&id_call=<? echo $verif_new_call["id_appel_taxi"];?>" style="margin-bottom:8%!important; display:block; padding-top:10px; padding-bottom:17px; font-size:18px; text-align:center;">Je suis Présent !</a>
	<script type="text/javascript">		
			$(document).ready(function() {
	 			$('#call').trigger('play');
			});
	 </script>
     <audio src="images/call.mp3" preload="auto" id="call" autobuffer></audio>
 <? }?>