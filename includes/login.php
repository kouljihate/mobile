<?php
ini_set('session.gc_maxlifetime', 15*60*60);
session_start();
//ini_set("session.lifetime",60);
// on teste si le visiteur a soumis le formulaire de connexion  
include"config_bd.php";
if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) { 
$login=mysql_escape_string($_POST['login']);
$pass=md5(mysql_escape_string($_POST['pass']));
// on teste si une entrée de la base contient ce couple login / pass 
$sql = 'SELECT count(*) FROM chauffeurs WHERE id_radio="'.mysql_escape_string($_POST['login']).'" AND password="'.md5(mysql_escape_string($_POST['pass'])).'"';
		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
		$data = mysql_fetch_array($req); 
 		mysql_free_result($req); 
 		mysql_close(); 
// si on obtient une réponse, alors l'utilisateur est un membre 
if ($data[0] == 1) { 
 		$_SESSION['login'] = mysql_escape_string($_POST['login']);
 		$_SESSION['password']=md5(mysql_escape_string($_POST['pass']));
 echo ("Bienvenue ".$_SESSION['login']);
      }
// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe 
   	else if ($data[0] == 0) 
	  	{ 
        echo 'E-mail ou mot de passe invalide!'; 
		} 
      // sinon, alors la, il y a un gros problème :) 
	else 
	  	{ 
        echo 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion !'; 
      	}
}
else 
	{ 
      echo 'Veuillez introduire votre email et votre mot de passe!';  
}
?>