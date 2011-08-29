<?php

include_once __DIR__."/../conf/init.php";

function supprimerNouvelle($id) {
	$query = mysql_query("DELETE FROM nouvelles WHERE id=".intval($id));
	if( !$query ) {
		die("Une erreur est survenue lors de la suppression de la nouvelle. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.");
	}
	else {
		include __DIR__.'/../common/header.php';
		echo "La suppression s'est effetué avec succès. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.";
		include __DIR__.'/../common/header.php';
	}
}

function getCategories() {
    $categories = array();

    $sql = <<<EOQ
        SELECT
            id,
            nom
        FROM
            categories
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur requete sql: " . mysql_error() );
    }

    while( $row = mysql_fetch_assoc( $query ) ) {
        $categories[] = $row;
    }

    return $categories;
}


function getUtilisateur($id) {
		$sql = <<<EOQ
		SELECT
			id,
			nom,
			contenu,
			categorie_id
		FROM
			nouvelles
		WHERE
			id = 
EOQ;
	$sql .= intval($id);

	$query = mysql_query($sql);
	if(!$query  || mysql_num_rows($query) != 1) {
		die("La nouvelle sélectionnée n'existe pas. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.");
	}
	$nouvelle = mysql_fetch_assoc( $query );
	return $nouvelle;
}

function modifierNouvelle($id, $titre, $texte, $categorie) {
	$query = mysql_query("UPDATE nouvelles SET nom = '".mysql_real_escape_string($titre)."', contenu = '".mysql_real_escape_string($texte)."', categorie_id = ".intval($categorie)." WHERE id = " . intval($id));
	if( !$query ) {
		die("Une erreur est survenue lors de la modification de la nouvelle. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.");
	}
	else {
		include  __DIR__.'/../common/header.php';
		echo "La modification de la nouvelle a été effectué avec succès. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.";
		include  __DIR__.'/../common/footer.php';
	}
}

function getNouvelles() {

    $nouvelles = array();

    $sql = <<<EOQ
        SELECT
            nouvelles.id				AS id,
            nouvelles.nom				AS nom,
            categories.nom 				AS categorie,
            DATE_FORMAT(date_parution, '%e %c %Y %T')	AS date_parution
        FROM
            nouvelles
            	JOIN categories
            		ON nouvelles.categorie_id = categories.id
	ORDER BY
		date_parution DESC
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur requete sql: " . mysql_error() );
    }

    while( $row = mysql_fetch_assoc( $query ) ) {
        $nouvelles[] = $row;
    }

    return $nouvelles;

}

function ajouterNews($titre, $texte, $categorie) {
	$query = mysql_query("INSERT INTO nouvelles(nom, contenu, categorie_id) VALUES('".mysql_real_escape_string($titre)."', '".mysql_real_escape_string($texte)."', ".intval($categorie).")");
	if(!$query) {
		die("Une erreur est survenue lors de l'ajout de la nouvelle.");
	}
	else {
		include  __DIR__.'/../common/header.php';
		echo "L'ajout de la nouvelle a été effectué avec succès. <a href=\"".url("admin/nouvelle/")."\">Retourner à la liste des nouvelles</a>.";
		include  __DIR__.'/../common/footer.php';
	}
}
?>
