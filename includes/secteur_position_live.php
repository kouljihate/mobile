<?
include"functions.php";
connexion();
session_start();
?>
<div class="notices">
    <div class="typo-icon">
    Vous êtes pointés dans le secteur <span style="font-weight:bold; color:#900;"><? $secteur_details=GetSecteurDetailsByID($_SESSION["id_secteur_in_point"]); echo $secteur_details["title"]?></span>, position <span style="font-weight:bold; color:#900;"><?php echo GetPointagePosition($_SESSION["id_secteur_in_point"],$_SESSION['chauffeur_id_radio']);?></span>
    </div>
</div>