<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
include"functions.php";
connexion();
	$pointage_details=GetPointageDetails($_SESSION['chauffeur_id_radio']);
	if($pointage_details==false){
		$exist_penalite=VerifPenalite($_SESSION['chauffeur_id_radio']);
		if($exist_penalite!=false){
			$penalite_details=penalite_details($exist_penalite);
			$position_in_secteur='P';
			$classse_notif="notif-secteur-unranked";
			$secteur_title='<span style="color:#C00;font-weight:bold;">Pénalité de '.$penalite_details['minutes_interval'].' minute(s)</span>';
			}
		if($exist_penalite==false){
			$position_in_secteur='&nbsp;&nbsp;!';
			$classse_notif="notif-secteur-unranked";
			$secteur_title='<span style="color:#C00;font-weight:bold;">Attention, vous n\'êtes pas pointés!</span>';
			}
		}
	else{
		$position_in_secteur=GetPointagePosition($pointage_details['id_secteur'],$_SESSION['chauffeur_id_radio']);
		$id_secteur_in_point=$pointage_details['id_secteur'];
		$secteur_details=GetSecteurDetailsByID($id_secteur_in_point);
		$secteur_title=$secteur_details["title"];
		$classse_notif="notif-secteur-ranked";
		}
?>
<div class="left <? echo $classse_notif;?> ui-link"><? echo $position_in_secteur;?></div>
<div style="margin-left:13%"><h3><? echo $secteur_title;?></h3></div>
<div class="bg-radio"><? echo $_SESSION['chauffeur_id_radio'];?></div>