<?php

include_once "lib.php";

$mois = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");

$nouvelles = getNouvelles();

include "../../common/header.php";

?>

<h1>Liste des nouvelles</h1>

<a href="ajouter.php">Ajouter une nouvelle</a><br/>
<a href="<?php echo url("admin/") ?>">Retourner à la page d'administration</a>
<br />
<br />
<?php
	if(count($nouvelles) == 0) {
		echo "Il n'y a aucune nouvelle présentement.";
	}
	else {
?>
<table id="utilisateurs" class="zebra-striped">
    <thead>
        <tr>
            <th>Titre de la nouvelle</th>
            <th>Date de parution</th>
            <th>Catégorie</th>
			<th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($nouvelles as $nouvelle) { ?>
        <tr>
            <td><?php echo $nouvelle['nom'] ?></td>
            <td><?php 
            	$date = explode(" ", $nouvelle['date_parution']);
            	$date[1] = $mois[intval($date[1]) - 1];
            	echo implode(" ", $date);      
            ?></td>
            <td><?php echo $nouvelle['categorie'] ?></td>
            <td>
                <a href="modifier.php?id=<?php echo htmlspecialchars( $nouvelle['id'] ) ?>">
                    Editer
                </a>
            </td>
            <td>
                <a href="supprimer.php?id=<?php echo htmlspecialchars( $nouvelle['id'] ) ?>">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php } #endfor ?>
   </tbody>
</table>
<?php
		include "../../common/footer.php";
	} #endif

include_once "../../conf/end.php";

?>
