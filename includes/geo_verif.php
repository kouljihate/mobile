<?php
session_start();
include 'config_bd.php';
include'functions.php';
$now=date('Y-m-d H:i:s');
$id_radio=SaveToDB($_SESSION['chauffeur_id_radio']);
$id_chauffeur=SaveToDB($_SESSION["id_chauffeur"]);
$ip 		= SaveToDB($_SERVER['REMOTE_ADDR']);//user ip
$latitude 	= SaveToDB($_GET['lat']);
$longitude 	= SaveToDB($_GET['long']);

//--------------------------------------------------------------------------------
$get_last_geo=mysql_query("SELECT MAX(id) AS lastgeo FROM txtcapital_geo_taxi WHERE id_radio='$id_radio'")or die(mysql_error());
$result = mysql_fetch_assoc($get_last_geo);
$id_last_geo=$result["lastgeo"];
$geo_details=$geo_details=array("id"=>"","id_radio"=>"","id_chauffeur"=>"","ip"=>"","latitude"=>"","longitude"=>"","lastupdate"=>"");
$geo_details=GetGeoDetails($id_last_geo);echo("<br>Lat:".$geo_details['latitude']." / long:".$geo_details['longitude']);
if((round(floatval($geo_details["latitude"]),4)!=round(floatval($latitude),4))&&(round(floatval($geo_details["longitude"]),4)!=round(floatval($longitude),4) )){
	echo 'yes';
	$query=mysql_query("INSERT INTO `txtcapital_geo_taxi` VALUES(default, '$id_radio', '$id_chauffeur', '$ip', '$latitude', '$longitude', '$now')")or die(mysql_error());
}/*

/*$result = $mysqli->query("SELECT * FROM `txtcapital_geo_taxi` LIMIT 200");
$rows 	= array();
while ($row = $result->fetch_array(MYSQLI_ASSOC) ) 
{
	unset($row['ip']);//hide ip for user privacy
    $rows[]=$row;// do what you need.
}
//-------------------------------------------------------------------------------------
*/
//echo json_encode(array('id'=>$id, 'users'=>$rows ));
//echo("<br>Lat:".round($latitude,4)." / long:".round($longitude,5));