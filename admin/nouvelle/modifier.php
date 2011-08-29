<?php

include_once "lib.php";

if(isset($_GET['id']) && intval($_GET['id'])) {
	$nouvelle = getUtilisateur($_GET['id']);

	include '../../common/header.php';
	include 'formulaire_modifier.php';
	include "../../common/footer.php";
}
else if(isset($_POST['titre']) && isset($_POST['texte']) && isset($_POST['categorie']) && isset($_POST['id'])) {

	if(!empty($_POST['titre']) && !empty($_POST['texte']) && intval($_POST['categorie']) && intval($_POST['id'])) {
		modifierNouvelle($_POST['id'], $_POST['titre'], $_POST['texte'], $_POST['categorie']);
	}
	else if(intval($_POST['id'])) {
		include '../../common/header.php';
		echo 'Vous devez remplir tous les champs pour ajouter une nouvelle. <a href="modifier.php?id='.intval($_POST['id']).'">Retourner au formulaire</a>.';
		include '../../common/footer.php';
	}
	else {
		die("Une erreur est servenue lors de la transmission de la modification. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.");
	}
	
}
else {
	header("Location: ".url("admin/nouvelle/"));
}

include "../../conf/end.php";

?>
