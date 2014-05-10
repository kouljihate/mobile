<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
include"functions.php";
connexion();
$now=date('Y-m-d H:i:s');//echo $now;		
$statut_block_pointage=GetBlockPointageStatut();
$pointage_details=GetPointageDetails($_SESSION['chauffeur_id_radio']);
if($pointage_details!=false){	 
	$date_time_pointage=$pointage_details["date_time_pointage"];
	
	//echo $date_time_pointage;
	#TU AJOUTES LE NOMBRE DE SECONDE DESIRE (ici 1h30 = 5400 secondes)
	$start_pointage_possible=date("Y-m-d H:i:s", strtotime($date_time_pointage.' +5 Minutes'));
	//echo '<br>'.$start_pointage_possible;
}
		
		
		$exist_penalite=VerifPenalite($_SESSION['chauffeur_id_radio']);
		if(($exist_penalite!=false)&&($pointage_details==false)){
			$penalite_details=penalite_details($exist_penalite);?>
<div class="alert">
    <div class="typo-icon">
    	<span style="color:#C00;font-weight:bold;">Vous avez eu une pénalité de <?php echo $penalite_details['minutes_interval'];?> minute(s)</span>
    </div>
</div>
<?php	
	}
	else if(($pointage_details["statut_en_charge"]==1)&&($now < $start_pointage_possible)){
		?>
		<div class="alert">
            <div class="typo-icon">
                <span style="color:#C00;font-weight:bold;">Vous pouvez vous repointer à partir de <br /><?php echo substr($start_pointage_possible,11);?> !</span>
            </div>
        </div>
		
		<? }
	else if($statut_block_pointage==1){
		?>
		<div class="alert">
            <div class="typo-icon">
                <span style="color:#C00;font-weight:bold;">Le pointage a était bloqué de la part de l'administration !</span>
            </div>
        </div>
		
		<? }
	else{?>
<ul class="column-split two-column">
	<li style="width:61%;">
        <p>
            <ul class="nav-list">
            <?php
                $get_secteur_on_live=array();
                $get_secteur_on_live=GetSecteurOnLive();	
                for($k=0;$k<count($get_secteur_on_live);$k++){
                    $secteur_details=GetSecteurDetailsByID($get_secteur_on_live[$k]);
                    //////////// GET CONNECTED ON THIS SECTEUR
                    $connected_on_this_secteur=array("id_pointage"=>array(),"id_radio"=>array(),"id_chauffeur"=>array(),"date_time_pointage"=>array(),"statut_ready"=>array(),"statut_en_charge"=>array(),"statut_en_veille"=>array(),"id_secteur"=>array(),"geo_latitude"=>array(),"geo_longitude"=>array());
                    $connected_on_this_secteur=GetConnectedOnThisSecteur($get_secteur_on_live[$k]);
                    ?>			
                	<li style="width:100%;display:block;"><a><? echo $secteur_details["title"]?>
                    	<span class="ui-li-count"><? echo count($connected_on_this_secteur["id_pointage"]);?></span>
                    </a></li>
                <? }?>
            </ul>
        </p>
	</li>
	<li style="width:32%; margin:5% 3%;">
        <p>
            <?php for($k=0;$k<count($get_secteur_on_live);$k++){
                    $secteur_details=GetSecteurDetailsByID($get_secteur_on_live[$k]);
                    //////////// GET CONNECTED ON THIS SECTEUR
                    $connected_on_this_secteur=array("id_pointage"=>array(),"id_radio"=>array(),"id_chauffeur"=>array(),"date_time_pointage"=>array(),"statut_ready"=>array(),"statut_en_charge"=>array(),"statut_en_veille"=>array(),"id_secteur"=>array(),"geo_latitude"=>array(),"geo_longitude"=>array());
                    $connected_on_this_secteur=GetConnectedOnThisSecteur($get_secteur_on_live[$k]);
                    ?>
           <a href="home.php?ac=change_secteur&id_secteur=<?php echo $get_secteur_on_live[$k];?>" style="margin-bottom:8%!important; display:block; padding-top:10px; padding-bottom:17px; font-size:18px;" class="button button2" rel="external">Se pointer</a>
           <? }?>			
        </p>
    </li>
</ul>
<? }?>