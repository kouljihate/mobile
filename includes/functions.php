<?php
function connexion()
	{
		$c=mysql_connect("mysql7.lwspanel.com","bruss494105","looklook");
		if($c===0){die("connection impossible");}
		$base=mysql_select_db("bruss494105",$c);
	};
$DateFormats["1"] = "yyyy-mm-dd";	
$DateFormats["2"] = "yyyy/mm/dd";
$DateFormats["3"] = "yyyy.mm.dd";
$DateFormats["4"] = "mm-dd-yyyy";
$DateFormats["5"] = "mm/dd/yyyy";
$DateFormats["6"] = "mm.dd.yyyy";
$DateFormats["7"] = "dd-mm-yyyy";
$DateFormats["8"] = "dd/mm/yyyy";
$DateFormats["9"] = "dd.mm.yyyy";
$DateSeparator["1"] = "-";	
$DateSeparator["2"] = "/";
$DateSeparator["3"] = ".";
$DateSeparator["4"] = "-";
$DateSeparator["5"] = "/";
$DateSeparator["6"] = ".";
$DateSeparator["7"] = "-";
$DateSeparator["8"] = "/";
$DateSeparator["9"] = ".";

function SaveToDB($str) {
	return mysql_escape_string(utf8_encode($str));
};

function ReadFromDB($str) {
	return htmlentities(utf8_decode(stripslashes($str)),ENT_COMPAT,'UTF-8');
};
function ReadFromDBWithBR($str) {
	$texte = str_replace("\r", "-",htmlentities(utf8_decode(stripslashes($str)),ENT_COMPAT,'UTF-8'));
	return $texte;
};

function ReadFromDBWithBRR($str) {
	$texte = str_replace("\r", "<br>",htmlentities(utf8_decode(stripslashes($str)),ENT_COMPAT,'UTF-8'));
	return $texte;
};

function ReadFromDBWithBRRR($str) {
	$texte = str_replace("\r\n", "\r",htmlentities(utf8_decode(stripslashes($str)),ENT_COMPAT,'UTF-8'));
	return $texte;
};

function ReadFromDBPDF($str) {
	return html_entity_decode(htmlentities(utf8_decode(stripslashes($str)),ENT_COMPAT,'UTF-8'));
};

/*********************************LOGIN*****************************///////
function GetClassMember($user)
{
	include"config_bd.php";
	$sql=mysql_query("SELECT * FROM admin where pseudot='$user'");
	while($find=mysql_fetch_array($sql)){
	$return=$find['classe'];	
	}
	return $return;
}


function FormatDateToSQL($date){	
	$date=explode("-",$date);
	if(strlen($date[0])<4){
	if(strlen($date[0])==1){$day="0".$date[0];}else{$day=$date[0];}
	if(strlen($date[1])==1){$month="0".$date[1];}else{$month=$date[1];}
	$year=$date[2];
	$date=$year."-".$month."-".$day;
		}
	else{
	$year=$date[0];
	if(strlen($date[2])==1){$day="0".$date[2];}else{$day=$date[2];}
	if(strlen($date[1])==1){$month="0".$date[1];}else{$month=$date[1];}
	$date=$year."-".$month."-".$day;
	}
	return $date;
}


function formatDatesFromDB($mysqDate) {
	return substr($mysqDate,8)."-".substr($mysqDate,5,2)."-".substr($mysqDate,0,4);//0000-00-00
};

function ReadHTMLFromDB($str) {
	return nl2br(utf8_decode(stripslashes($str)));
};

function ClearPrice($price) {
	$remove = array(" ", ",");
	$replace = array("",".");
	return str_replace($remove, $replace, $price);
};

function formatDates($mysqDate) {
	return date("F j, Y, g:i a",strtotime($mysqDate));
};

function nbr_jours($mois,$annee) { 
$timestamp1=mktime(0,0,1,$mois,01,$annee); 
$moisreference=date("F",$timestamp1); 
$timestamp2=$timestamp1+mktime((1+24),0,0,01,01,1970); 
$moisreferenceplusjours=date("F",$timestamp2); 
for($i=1;$moisreference==$moisreferenceplusjours;$i++) { 
$timestamp2+=mktime((1+24),0,0,01,01,1970); 
$moisreferenceplusjours=date("F",$timestamp2); 
} 
return($i); 
}


function Date2MySQL($dt){
	global $DateSeparator, $DateFormats;
	
	$dtArr = array();
	$calDateFormat = 8;
	$dateParts = explode($DateSeparator[$calDateFormat],$dt);
	$templateParts = explode($DateSeparator[$calDateFormat],$DateFormats[$calDateFormat]);
	
	for($i=0;$i<count($templateParts);$i++) if(($templateParts[$i]=="yyyy") or ($templateParts[$i]=="yy")) $dtArr[0] = $dateParts[$i];
	for($i=0;$i<count($templateParts);$i++) if($templateParts[$i]=="mm") $dtArr[1] = $dateParts[$i];
	for($i=0;$i<count($templateParts);$i++) if($templateParts[$i]=="dd") $dtArr[2]= $dateParts[$i];
	return $dtArr[0].'-'.$dtArr[1].'-'.$dtArr[2];
}

function MySQL2Date($dt){
	global $DateSeparator, $DateFormats, $SETTINGS_DB;

	if ($dt<>'') {
	  $datetime = strtotime($dt);
	  $format = $DateFormats[$SETTINGS_DB["date_format"]];
  
	  $patterns[0] = '/dd/';
	  $patterns[1] = '/mm/';
	  $patterns[2] = '/yyyy/';
	  
	  $replace[0] = date("d",$datetime);
	  $replace[1] = date("m",$datetime);
	  $replace[2] = date("Y",$datetime);
	  
	  return preg_replace($patterns, $replace, $format);
	} else {
		return '';
	};
}	
	
	
	
function GetPlanningDetails($id_planning){
	connexion();
	$planning_details=array("id_planning" => "", "date_time" => "", "date" => "", "heure" => "", "id_dr" => "", "pick_up_location" => "", "pax" => "","pax_name" =>"","destination" => "", "id_cl" => "", "comments"=>"", "tel"=>"","vip"=>"","commande"=>"","time_before_alert"=>"","to_invoiced"=>"","statut"=>"","date_insert"=>"","id_user_insert"=>"","date_modif"=>"","id_user_modif"=>"");
	$sql=mysql_query("SELECT * FROM planning WHERE id_planning ='$id_planning'")or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){
			$planning_details["id_planning"]=$exist["id_planning"];
			$planning_details["date_time"]=$exist["date_time"];
			$planning_details["date"]=$exist["date"];
			$planning_details["heure"]=$exist["heure"];
			$planning_details["id_dr"]=$exist["id_dr"];
			$planning_details["pick_up_location"]=ReadFromDB($exist["pick_up_location"]);
			$planning_details["pax"]=$exist["pax"];
			$planning_details["pax_name"]=ReadFromDB($exist["paxname"]);
			$planning_details["destination"]=ReadFromDB($exist["destination"]);
			$planning_details["id_cl"]=$exist["id_cl"];
			$planning_details["comments"]=ReadFromDB($exist["comments"]);
			$planning_details["tel"]=$exist["tel"];
			$planning_details["vip"]=$exist["vip"];
			$planning_details["commande"]=$exist["commande"];
			$planning_details["time_before_alert"]=$exist["time_before_alert"];
			$planning_details["to_invoiced"]=$exist["to_invoiced"];
			$planning_details["statut"]=$exist["statut"];
				$get_planning_user=mysql_query("SELECT * FROM planning_user WHERE id_planning='$id_planning'")or die(mysql_error());
				while($find=mysql_fetch_array($get_planning_user)){
					$planning_details["date_insert"]=$find["date_insert"];
					$planning_details["id_user_insert"]=$find["id_user_insert"];
					$planning_details["date_modif"]=$find["date_modif"];
					$planning_details["id_user_modif"]=$find["id_user_modif"];
					}			
			}			
	}else{$planning_details="null";}
	return $planning_details;
	}


function GetClientDetails($id_cl){
	include"config_bd.php";
	$cl=array("id_cl"=>"" ,"num_cl" => "" ,"company" =>"","zip" =>"","adresse" =>"","city" =>"","country" =>"","phone" =>"","fax" =>"","tva" =>"","statut" =>"","mail" =>"");	
	$connect=mysql_query("SELECT * FROM clients WHERE id='$id_cl'")or die ('Erreur : '.mysql_error() );
	while($find=mysql_fetch_array($connect)){
		$cl["num_cl"]=$find["num"];
		$cl["company"]=$find["company"];
		$cl["zip"]=$find["zip"];
		$cl["adresse"]=$find["adresse"];
		$cl["city"]=$find["city"];
		$cl["country"]=$find["country"];
		$cl["phone"]=$find["phone"];
		$cl["fax"]=$find["fax"];
		$cl["tva"]=$find["tva"];
		$cl["statut"]=$find["statut"];
		$cl["mail"]=$find["mail"];
		} 
		return $cl;
}

function GetRadioDetails($id_radio){
	connexion();
	$radio_details=array("id_radio" => "", "matricule" => "", "contact_proprietaire" => "", "tel_proprietaire" => "", "mail_proprietaire" => "", "adresse_proprietaire" => "", "statut" => "");
	$sql=mysql_query("SELECT * FROM radios WHERE id_radio ='$id_radio'")or die(mysql_error());
			while($exist=mysql_fetch_array($sql)){
			$radio_details["id_radio"]=$exist["id_radio"];			
			$radio_details["matricule"]=$exist["matricule"];
			$radio_details["contact_proprietaire"]=$exist["contact_proprietaire"];
			$radio_details["tel_proprietaire"]=$exist["tel_proprietaire"];
			$radio_details["mail_proprietaire"]=$exist["mail_proprietaire"];
			$radio_details["adresse_proprietaire"]=$exist["adresse_proprietaire"];
			$radio_details["statut"]=$exist["statut"];
			}
	return $radio_details;
	}

	
function GetUserDetailsByCaracter($caracter,$value){
	connexion();
	$user_details=array("id_chauffeur" => "", "id_radio" => "", "name" => "", "tel" => "", "adresse" => "", "email" => "", "password" => "");
	$sql=mysql_query("SELECT * FROM chauffeurs WHERE '$caracter' ='$value'")or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){				
			$user_details["id_chauffeur"]=$exist["id_chauffeur"];
			$user_details["id_radio"]=$exist["id_radio"];			
			$user_details["name"]=$exist["name"];
			$user_details["tel"]=$exist["tel"];
			$user_details["adresse"]=$exist["adresse"];
			$user_details["email"]=$exist["email"];
			$user_details["password"]=$exist["password"];
			}			
	}else{$user_details="null";}
	return $user_details;
	}
	

function GetChauffeurDetailsByLogin($id_radio,$password){
	$chauffeur_details=array("id_chauffeur" => "", "id_radio" => "", "name" => "", "tel" => "", "adresse" => "", "email" => "", "password" => "");
	$sql=mysql_query("SELECT * FROM chauffeurs WHERE id_radio='$id_radio' AND password='$password'")or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){				
			$chauffeur_details["id_chauffeur"]=$exist["id_chauffeur"];
			$chauffeur_details['chauffeur_id_radio']=$exist["id_radio"];
			$chauffeur_details["chauffeur_name"]=$exist["name"];
			$chauffeur_details["chauffeur_tel"]=$exist["tel"];
			$chauffeur_details["chauffeur_adresse"]=$exist["adresse"];
			$chauffeur_details["chauffeur_email"]=$exist["email"];			
			}	
	}
	return $chauffeur_details;
}



function GetChauffeurDetailsById($id_chauffeur){
		$chauffeur_details=array("id_chauffeur" => "", "id_radio" => "", "name" => "", "tel" => "", "adresse" => "", "email" => "", "password" => "");
	$sql=mysql_query("SELECT * FROM chauffeurs WHERE id_chauffeur='$id_chauffeur'")or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){				
			$chauffeur_details["id_chauffeur"]=$exist["id_chauffeur"];
			$chauffeur_details['id_radio']=$exist["id_radio"];
			$chauffeur_details["name"]=$exist["name"];
			$chauffeur_details["tel"]=$exist["tel"];
			$chauffeur_details["adresse"]=$exist["adresse"];
			$chauffeur_details["email"]=$exist["email"];			
			}	
	}
	return $chauffeur_details;
}



function GetChauffeurActiveCurrently($id_radio){
		$query=mysql_query("SELECT MAX(date_time_pointage) AS last_time_pointage FROM txtcapital_pointage WHERE id_radio='$id_radio'")or die(mysql_error());
		$tot=mysql_num_rows($query);
		if($tot > 0){
		$result=mysql_fetch_assoc($query);		
		$last_time_pointage=$result['last_time_pointage'];		
		$req=mysql_query("SELECT * FROM  txtcapital_pointage WHERE id_radio='$id_radio' AND date_time_pointage='$last_time_pointage'")or die(mysql_error());
		while($exist=mysql_fetch_array($req)){
			$id_chauffeur=$exist['id_chauffeur'];
			}
		}else{
			$id_chauffeur=false;
			}
		return $id_chauffeur;
}

function GetSecteurDetailsByID($id_secteur){
	connexion();
	$secteur_details=array("id_secteur" => "", "title" => "", "statut" => "");
	$sql=mysql_query("SELECT * FROM txtcapital_secteur WHERE id_secteur ='$id_secteur'")or die(mysql_error());
	if((mysql_num_rows($sql))>0){
			while($exist=mysql_fetch_array($sql)){
			$secteur_details["id_secteur"]=$exist["id_secteur"];
			$secteur_details["title"]=ReadFromDB($exist["title"]);
			$secteur_details["statut"]=$exist["statut"];
			}			
	}
	return $secteur_details;
	}

function GetAllSecteursActive()
	{
	connexion();
	$all_secteur=array();
	$req_secteur=mysql_query("SELECT * FROM txtcapital_secteur WHERE statut=1")	;
	while($find=mysql_fetch_array($req_secteur)){
		$all_secteur[]=$find["id_secteur"];
		}
	return $all_secteur;
}
function GetSecteursForThisCollection($id_collection_secteur)
	{
	connexion();
	$all_secteur=array();
	$req_secteur=mysql_query("SELECT * FROM txtcapital_secteur_collection_details WHERE id_secteur_collection='$id_collection_secteur'  ORDER BY id_secteur ASC")or die(mysql_error());
	while($find=mysql_fetch_array($req_secteur)){
		$all_secteur[]=$find["id_secteur"];
		}
	return $all_secteur;
}
function GetSecteurOnLive(){
	connexion();
	$all_secteur_now=array();
	$now=date('H:i:s');
	$req=mysql_query("SELECT * FROM  `txtcapital_secteur_collection` 
						WHERE (
						(
						CURTIME() <  `hour_end` 
						AND CURTIME() >  `hour_start` 
						AND  `hour_start` <  `hour_end`
						)
						OR (
						(
						CURTIME() <  `hour_end` 
						AND  `hour_end` <  `hour_start`
						)
						OR (
						CURTIME() >  `hour_start` 
						AND  `hour_start` >  `hour_end`
						)
						)
						)")or die(mysql_error());
	while($run=mysql_fetch_array($req)){
		$id_secteur_collection=$run['id_secteur_collection'];
		}
	$all_secteur_now=GetSecteursForThisCollection($id_secteur_collection);
	return $all_secteur_now;
	}
////////////////////////////////////// Taxi Connected	
function GetTaxiConnected(){
	connexion();
	$all_pointage=array("id_pointage"=>array(),"id_radio"=>array(),"id_chauffeur"=>array(),"date_time_pointage"=>array(),"statut_ready"=>array(),"statut_en_charge"=>array(),"statut_en_veille"=>array(),"id_secteur"=>array(),"geo_latitude"=>array(),"geo_longitude"=>array());
	$now=date('H:i:s');
	$req=mysql_query("SELECT * FROM  `txtcapital_pointage` WHERE (statut_ready=1)")or die(mysql_error());
	while($run=mysql_fetch_array($req)){
		$all_pointage["id_pointage"][]=$run['id_pointage'];
		$all_pointage["id_radio"][]=$run["id_radio"];
		$all_pointage["id_chauffeur"][]=$run["id_chauffeur"];
		$all_pointage["date_time_pointage"][]=$run["date_time_pointage"];
		$all_pointage["statut_ready"][]=$run["statut_ready"];
		$all_pointage["statut_en_charge"][]=$run["statut_en_charge"];
		$all_pointage["statut_en_veille"][]=$run["statut_en_veille"];
		$all_pointage["id_secteur"][]=$run["id_secteur"];
		$all_pointage["geo_latitude"][]=$run["geo_latitude"];
		$all_pointage["geo_longitude"][]=$run["geo_longitude"];
		}	
	return $all_pointage;
}


////////////////////////////////////// Taxi Connected on this secteur		
function GetConnectedOnThisSecteur($id_secteur){
	connexion();
	$all_pointage=array("id_pointage"=>array(),"id_radio"=>array(),"id_chauffeur"=>array(),"date_time_pointage"=>array(),"statut_ready"=>array(),"statut_en_charge"=>array(),"statut_en_veille"=>array(),"id_secteur"=>array(),"geo_latitude"=>array(),"geo_longitude"=>array());
	$now=date('H:i:s');
	$req=mysql_query("SELECT * FROM  `txtcapital_pointage` WHERE (statut_ready=1) AND (id_secteur='$id_secteur') ORDER BY date_time_pointage ASC")or die(mysql_error());
	while($run=mysql_fetch_array($req)){
		$all_pointage["id_pointage"][]=$run['id_pointage'];
		$all_pointage["id_radio"][]=$run["id_radio"];
		$all_pointage["id_chauffeur"][]=$run["id_chauffeur"];
		$all_pointage["date_time_pointage"][]=$run["date_time_pointage"];
		$all_pointage["statut_ready"][]=$run["statut_ready"];
		$all_pointage["statut_en_charge"][]=$run["statut_en_charge"];
		$all_pointage["statut_en_veille"][]=$run["statut_en_veille"];
		$all_pointage["id_secteur"][]=$run["id_secteur"];
		$all_pointage["geo_latitude"][]=$run["geo_latitude"];
		$all_pointage["geo_longitude"][]=$run["geo_longitude"];
		}	
	return $all_pointage;
	}


function GetPointagePosition($id_secteur,$id_radio){
	connexion();
	$all_pointage=array("id_pointage"=>array(),"id_radio"=>array(),"id_chauffeur"=>array(),"date_time_pointage"=>array(),"statut_ready"=>array(),"statut_en_charge"=>array(),"statut_en_veille"=>array(),"id_secteur"=>array(),"geo_latitude"=>array(),"geo_longitude"=>array());
	$now=date('H:i:s');
	$req=mysql_query("SELECT * FROM  `txtcapital_pointage` WHERE (statut_ready=1) AND (id_secteur='$id_secteur') ORDER BY date_time_pointage ASC")or die(mysql_error());
	if(mysql_num_rows($req)>0){
	while($run=mysql_fetch_array($req)){
		$all_pointage["id_pointage"][]=$run['id_pointage'];
		$all_pointage["id_radio"][]=$run["id_radio"];
		$all_pointage["id_chauffeur"][]=$run["id_chauffeur"];
		$all_pointage["date_time_pointage"][]=$run["date_time_pointage"];
		$all_pointage["statut_ready"][]=$run["statut_ready"];
		$all_pointage["statut_en_charge"][]=$run["statut_en_charge"];
		$all_pointage["statut_en_veille"][]=$run["statut_en_veille"];
		$all_pointage["id_secteur"][]=$run["id_secteur"];
		$all_pointage["geo_latitude"][]=$run["geo_latitude"];
		$all_pointage["geo_longitude"][]=$run["geo_longitude"];
		}
	for($k=0;$k<count($all_pointage["id_pointage"]);$k++){
		if($all_pointage['id_radio'][$k]==$id_radio){
			$return=$k+1;
			}
		}
	}
	else{
		$return="O";
		}
	return $return;
}

			
////////////////////////////////////////////////////// FUNCTION for updating statut pointage 1:ready(if ready we need $id_secteur) , 2:busy, 3:disconnected
function update_pointage_driver($id_dr,$id_chauffeur,$statut_topoint,$id_secteur){
	connexion();
	$now=date('Y-m-d H:i:s');
	if(($statut_topoint==1)&&($id_dr!=0)){		
		/////////////////////////////// CASE NEW APPOINTMENT
		$ready=1;
		$desactivatd=0;
		$pointage_details=GetPointageDetails($id_dr);
		if($pointage_details!=false){
			$backup_this=mysql_query('INSERT INTO `txtcapital_pointage_history` VALUES(default,"'.$id_dr.'","'.$pointage_details['id_chauffeur'].'","'.$pointage_details['date_time_pointage'].'","'.$pointage_details['statut_ready'].'","'.$pointage_details['statut_en_charge'].'","'.$pointage_details['statut_en_veille'].'","'.$pointage_details['id_secteur'].'","'.$pointage_details['geo_latitude'].'","'.$pointage_details['geo_longitude'].'")') or die(mysql_error());
			////////// DELETE ALL OLD OPPOINTMENT
			$delete_all_appointment=mysql_query("DELETE FROM `txtcapital_pointage` WHERE (id_radio='$id_dr')")or die (mysql_error());
			}
			
			$point_this=mysql_query('INSERT INTO `txtcapital_pointage` VALUES(default,"'.$id_dr.'","'.$id_chauffeur.'","'.$now.'","'.$ready.'","'.$desactivatd.'","'.$desactivatd.'","'.$id_secteur.'","'.$desactivatd.'","'.$desactivatd.'")') or die(mysql_error());
		}
	else if(($statut_topoint==2)&&($id_dr!=0)){
		$pointage_details=GetPointageDetails($id_dr);
		$backup_this=mysql_query('INSERT INTO `txtcapital_pointage_history` VALUES(default,"'.$id_dr.'","'.$pointage_details['id_chauffeur'].'","'.$pointage_details['date_time_pointage'].'","'.$pointage_details['statut_ready'].'","'.$pointage_details['statut_en_charge'].'","'.$pointage_details['statut_en_veille'].'","'.$pointage_details['id_secteur'].'","'.$pointage_details['geo_latitude'].'","'.$pointage_details['geo_longitude'].'")') or die(mysql_error());
		$update_this=mysql_query("UPDATE `txtcapital_pointage` 
								  SET statut_ready=0,
								  statut_en_charge=1,
								  date_time_pointage='$now'
								  WHERE(id_radio='$id_dr')")or die(mysql_error());
		}
	else if(($statut_topoint==3)&&($id_dr!=0)){//////////////////// IF DEPOINTAGE
		$pointage_details=GetPointageDetails($id_dr);
		$backup_this=mysql_query('INSERT INTO `txtcapital_pointage_history` VALUES(default,"'.$id_dr.'","'.$pointage_details['id_chauffeur'].'","'.$pointage_details['date_time_pointage'].'","'.$pointage_details['statut_ready'].'","'.$pointage_details['statut_en_charge'].'","'.$pointage_details['statut_en_veille'].'","'.$pointage_details['id_secteur'].'","'.$pointage_details['geo_latitude'].'","'.$pointage_details['geo_longitude'].'")') or die(mysql_error());
		$delete_all_appointment=mysql_query("DELETE FROM `txtcapital_pointage` WHERE (id_radio='$id_dr')")or die (mysql_error());
		}
	else{}
}



function GetPointageDetails($id_radio){
	connexion();
	$pointage_details=array("id_pointage"=>"","id_radio"=>"","id_chauffeur"=>"","date_time_pointage"=>"","statut_ready"=>"","statut_en_charge"=>"","statut_en_veille"=>"","id_secteur"=>"","geo_latitude"=>"","geo_longitude"=>"");
	$query1=mysql_query("SELECT * FROM `txtcapital_pointage` WHERE (id_radio='$id_radio')") or die(mysql_error());
	if(mysql_num_rows($query1)>0){
		while($yes=mysql_fetch_array($query1)){
		$pointage_details['id_pointage']=$yes['id_pointage'];
		$pointage_details['id_radio']=$yes['id_radio'];
		$pointage_details['id_chauffeur']=$yes['id_chauffeur'];
		$pointage_details['date_time_pointage']=$yes['date_time_pointage'];
		$pointage_details['statut_ready']=$yes['statut_ready'];
		$pointage_details['statut_en_charge']=$yes['statut_en_charge'];
		$pointage_details['statut_en_charge']=$yes['statut_en_charge'];
		$pointage_details['statut_en_veille']=$yes['statut_en_veille'];
		$pointage_details['id_secteur']=$yes['id_secteur'];
		$pointage_details['geo_latitude']=$yes['geo_latitude'];
		$pointage_details['geo_longitude']=$yes['geo_longitude'];
		}
	return $pointage_details;
	}
	else{
		return false;
		}
}	

function penalite_details($id_penalite){
	connexion();
   $penalite_details=array("id_penalite"=>"","id_radio"=>"","date_time_penalite_start"=>"","date_time_penalite_end"=>"","id_pointage_history"=>"","minutes_interval"=>"","motif"=>"");
	$sql=mysql_query("SELECT * FROM txtcapital_pointage_penalite WHERE id_penalite='$id_penalite'")or die(mysql_error());
 	while($exist=mysql_fetch_array($sql)){
		$penalite_details['id_penalite']=$exist['id_penalite'];
		$penalite_details['id_radio']=$exist['id_radio'];
		$penalite_details['date_time_penalite_start']=$exist['date_time_penalite_start'];
		$penalite_details['date_time_penalite_end']=$exist['date_time_penalite_end'];
		$penalite_details['id_pointage_history']=$exist['id_pointage_history'];
		$penalite_details['minutes_interval']=$exist['minutes_interval'];
		$penalite_details['motif']=ReadFromDB($exist['motif']);				
		}
	return $penalite_details;
	}


function VerifPenalite($id_radio){	
	connexion();
	$now=date('Y-m-d H:i:s');
	$sql=mysql_query("SELECT * FROM txtcapital_pointage_penalite WHERE ((id_radio='$id_radio') AND (date_time_penalite_end > '$now'))")or die(mysql_error());
	while($exist=mysql_fetch_array($sql)){
		return $exist['id_penalite'];
		}
		if(mysql_num_rows($sql)==0){
			return false;
			}
	}
function RequestNewFausseCourse($id_radio,$id_chauffeur,$id_planning){
	connexion();
	$now=date('Y-m-d H:i:s');
	$sql=mysql_query("INSERT INTO txtcapital_fausse_course VALUES(default,'$id_radio','$id_chauffeur','$id_planning','$now',0)")or die(mysql_error());
	return true;
	}

function VerifCall($id_radio){
	connexion();
	$now=date('Y-m-d H:i:s');
	$return=array("id_appel_taxi"=>"","id_radio"=>"","id_chauffeur"=>"","id_telephoniste"=>"","date_time_request"=>"","response_as_ready"=>"","date_time_response"=>"","delay_call"=>"");	
		$query=mysql_query("SELECT * FROM txtcapital_appel_taxi WHERE ((id_radio='$id_radio') AND (TIMESTAMPDIFF(SECOND,date_time_request,'$now')<=10) AND (response_as_ready=0))")or die(mysql_error());
		/*$query=mysql_query("SELECT * FROM txtcapital_appel_taxi WHERE ((id_radio='$id_radio')AND(
		(ABS(UNIX_TIMESTAMP(txtcapital_appel_taxi.date_time_request) - UNIX_TIMESTAMP('$now'))<= 10) AND (response_as_ready=0))")or die(mysql_error());*/
		$tot=mysql_num_rows($query);
		if($tot==0){
			return false;
			}
		else{
		while($result=mysql_fetch_array($query)){		
			$return["id_appel_taxi"]=$result['id_appel_taxi'];
			$return["id_radio"]=$result['id_radio'];
			$return["id_chauffeur"]=$result['id_chauffeur'];
			$return["id_telephoniste"]=$result['id_telephoniste'];
			$return["date_time_request"]=$result['date_time_request'];
			$return["response_as_ready"]=$result['response_as_ready'];			
			$return["date_time_response"]=$result['date_time_response'];
			$return["delay_call"]=strtotime($now) - strtotime($return["date_time_request"]);
		}
		return $return;
		}
	}
function ResponseThisCall($id_call){
	connexion();
	$now=date('Y-m-d H:i:s');
	$response=mysql_query("UPDATE `txtcapital_appel_taxi` 
								  SET response_as_ready=1,
								  date_time_response='$now'
								  WHERE(id_appel_taxi='$id_call')")or die(mysql_error());
	return true;
	}
/********************************************GEOLOCALISATION**************************************************/

function GetGeoDetails($id_geo){
	connexion();
	$geo_details=array("id"=>"","id_radio"=>"","id_chauffeur"=>"","ip"=>"","latitude"=>"","longitude"=>"","lastupdate"=>"");
	$sql=mysql_query("SELECT * FROM `txtcapital_geo_taxi` WHERE id='$id_geo'")or die(mysql_error());
	while($result=mysql_fetch_array($sql)){		
			$return["id"]=ReadFromDB($result['id']);
			$return["id_radio"]=ReadFromDB($result['id_radio']);
			$return["id_chauffeur"]=ReadFromDB($result['id_chauffeur']);
			$return["ip"]=ReadFromDB($result['ip']);
			$return["latitude"]=ReadFromDB($result['latitude']);
			$return["longitude"]=ReadFromDB($result['longitude']);			
			$return["lastupdate"]=ReadFromDB($result['lastupdate']);
		}
		return $return;
	}
	
function GetGeoOfRadio($id_radio){
	connexion();
		$get_last_geo=mysql_query("SELECT MAX(id) AS lastgeo FROM txtcapital_geo_taxi WHERE id_radio='$id_radio'")or die(mysql_error());
		$result = mysql_fetch_assoc($get_last_geo);
		$id_last_geo=$result["lastgeo"];
	return $id_last_geo;
	}
	
	
function GetBlockPointageStatut(){
	connexion();
	$request=mysql_query("SELECT * FROM txtcapital_pointage_block") or die(mysql_error());
	while($exist=mysql_fetch_array($request)){
		$return=$exist["statut_block"];
		}
		return $return;
	}				
?>