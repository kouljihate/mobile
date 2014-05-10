<?
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
include"functions.php";
connexion();

        $now=date('Y-m-d H:i:s');
		$today=date('Y-m-d');
        $id_radio=$_SESSION['chauffeur_id_radio'];
        $sql0=mysql_query("SELECT * FROM planning WHERE ((id_dr='$id_radio') AND (id_dr!=0) AND(TIMESTAMPDIFF(MINUTE,planning.date_time,'$now') <= 5) AND (statut!=2) AND (statut!=0)) ORDER BY (TIMESTAMPDIFF(MINUTE,planning.date_time,'$now')) ASC")or die(mysql_error());
        while($find=mysql_fetch_array($sql0)){
            $id_planning=$find["id_planning"];
            $planning_details=GetPlanningDetails($id_planning);
			$course_en_cour=1;
			$pointage_details=GetPointageDetails($_SESSION['chauffeur_id_radio']);
			?>
            <div class="alert">
         		<div class="typo-icon">
                    <h3 style="font-weight: bold;font-size:17px;"><? echo $planning_details["heure"]?> : Nouvelle course à faire!</h3>
                    <p style="font-weight: bold;font-size:17px;">Heure: <? echo $planning_details["heure"];?>
                    <br />Départ: <? echo $planning_details["pick_up_location"];?>
                    <br />Client: <? $clients_details=GetClientDetails($planning_details["id_cl"]); echo $clients_details['company'];?>
                    <br />Commentaires: <? echo $planning_details["comments"];?>
                    <br />Déstination: <? echo $planning_details["destination"];?>
                    <br />Type de la course: <? //echo $planning_details[""];?>
                    <? if(($pointage_details==false)||($pointage_details["statut_en_charge"]==1)){?>
                    <br /><a rel="external" class="button button12" href="course-live.php?ac=faussecourse&id_planning=<? echo $id_planning;?>" >Fausse course</a>
                    <? }?></p>
                </div>
   			</div>
            <? }?>    

    <table cellpadding="0" cellspacing="0" class="table3" width="99%">
			    <tr>
				<thead>
				    <th>Heure</th>
				    <th>Départ</th>
				    <th>Commentaires</th>
				    <!--<th>Déstination</th>-->
				</thead>
				<tbody>
                
                <? $f=0;
					$query=mysql_query("SELECT * FROM planning WHERE ((id_dr='$id_radio') AND (TIMESTAMPDIFF(MINUTE,planning.date_time,'$now')  > 5) AND (statut!=2) AND (statut!=0) AND (date='$today')) ORDER BY (TIMESTAMPDIFF(MINUTE,planning.date_time,'$now')) ASC")or die(mysql_error());
					while($exist=mysql_fetch_array($query)){
						$f++;
					$curr_planning=$exist["id_planning"];
					$curr_planning_details=GetPlanningDetails($curr_planning);
					//////////// GET CONNECTED ON THIS SECTEUR
					?>	
				    <tr>
						<td><? echo $curr_planning_details["heure"];?></td>
						<td><? echo $curr_planning_details["pick_up_location"];?>
                        <br /><? $clients_details=GetClientDetails($curr_planning_details["id_cl"]); echo $clients_details['company'];?></td>
						<td><? echo $curr_planning_details["comments"];?><br />&nbsp;<br />&nbsp;<br />
                        	<? $pointage_details=GetPointageDetails($_SESSION['chauffeur_id_radio']);
								if((!isset($course_en_cour))&&($f==1)&&($pointage_details==false)){?>
                            	<a rel="external" class="button button12" href="course-live.php?ac=faussecourse&id_planning=<? echo $id_planning;?>">
                                Fausse course</a>
                            <? }?>
                        </td>
						<!--<td><? echo $curr_planning_details["destination"];?></td>-->
				    </tr>
                    <? }?>
				</tbody>
			    </tr>
			</table>
</div>