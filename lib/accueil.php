<?php

$CATEGORIE_DEFAULT = 'anonyme';

if (!function_exists('cal_days_in_month'))
{
    function cal_days_in_month($calendar, $month, $year)
    {
        return date('t', mktime(0, 0, 0, $month, 1, $year));
    }
}

if (!defined('CAL_GREGORIAN'))
    define('CAL_GREGORIAN', 1);

define('NB_PAGE', 5);

function getIdCategorieDefault() {

    global $CATEGORIE_DEFAULT;

    $sql = <<<EOQ
    SELECT
        id
    FROM
        categories
    WHERE
        nom = '${CATEGORIE_DEFAULT}'
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur recuperation categorie par default : " . mysql_error() );
    }

    $row = mysql_fetch_assoc( $query );
    return $row['id'];

}


function getActualites( $idCategorie = null, $page = 1, $mois = 0, $annee = 0 ) {

    $idCategorie = intval($idCategorie);
    $page = intval($page);
    --$page;
    $page *= NB_PAGE;
    $mois = intval($mois);
    $annee = intval($annee);
    
    $nouvelles = array();
    
    if( !$idCategorie ) {
        $idCategorie = getIdCategorieDefault();
    }

    $date_actuelle = getdate();
    if(checkdate($mois, 1, $annee) && $annee <= $date_actuelle['year']) {
        $time_debut = mktime(0, 0, 0, $mois, 1, $annee);
        $time_fin = mktime(0, 0, 0, $mois, cal_days_in_month(CAL_GREGORIAN, $mois, $annee), $annee);
        $sql = "
        SELECT
            id,
            nom,
            contenu,
            UNIX_TIMESTAMP(date_parution) AS date_parution
        FROM
            nouvelles
        WHERE
            categorie_id = ${idCategorie} AND
            UNIX_TIMESTAMP(date_parution) >= $time_debut AND
            UNIX_TIMESTAMP(date_parution) <= $time_fin
        ORDER BY
            date_parution DESC
        LIMIT
            ${page}, ".NB_PAGE;
    }
    else {
        $sql = "
        SELECT
            id,
            nom,
            contenu,
            UNIX_TIMESTAMP(date_parution) AS date_parution
        FROM
            nouvelles
        WHERE
            categorie_id = ${idCategorie}
        ORDER BY
            date_parution DESC
        LIMIT
            ${page}, ".NB_PAGE;
    }
    
    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur recuperation actualités : " . mysql_error() );
    }

    while( $row = mysql_fetch_assoc( $query ) ) {
        $nouvelles[] = $row;
    }

    return $nouvelles;

}

function getMaximumPages( $idCategorie = null, $mois = 0, $annee = 0 ) {
    $nouvelles = array();

    if( !$idCategorie ) {
        $idCategorie = getIdCategorieDefault();
    }

    $date_actuelle = getdate();
    if(checkdate($mois, 1, $annee) && $annee <= $date_actuelle['year']) {
        $time_debut = mktime(0, 0, 0, $mois, 1, $annee);
        $time_fin = mktime(0, 0, 0, $mois, cal_days_in_month(CAL_GREGORIAN, $mois, $annee), $annee);
        $sql = "
        SELECT
            CEIL(COUNT(*) / ".NB_PAGE.") AS max_page
        FROM
            nouvelles
        WHERE
            categorie_id = ${idCategorie} AND
            UNIX_TIMESTAMP(date_parution) >= $time_debut AND
            UNIX_TIMESTAMP(date_parution) <= $time_fin
        ORDER BY
            date_parution DESC";
    }
    else {
        $sql = "
        SELECT
            CEIL(COUNT(*) / ".NB_PAGE.") AS max_page
        FROM
            nouvelles
        WHERE
            categorie_id = ${idCategorie}
        ORDER BY
            date_parution DESC";
    }
    $retour = mysql_query($sql);
    $retour = mysql_fetch_array($retour);
    return $retour['max_page'];
}

function getUtilisateurConnecte() {

    $idSession = $_SESSION['id_utilisateur'];

    $sql =<<<EOQ
    SELECT
        *
    FROM
        utilisateurs
    WHERE
        id = ${idSession}
    LIMIT 1
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur recuperation utilisateur session : " . mysql_error() );
    }

    $utilisateur = mysql_fetch_assoc( $query );

    return $utilisateur;
}

function getArchives( $idCategorie = null ) {

    if( !$idCategorie ) {
        $idCategorie = getIdCategorieDefault();
    }

    $annees = array();

    $sql = <<<EOQ
    SELECT DISTINCT
        EXTRACT( MONTH FROM date_parution ) AS mois,
        EXTRACT( YEAR FROM date_parution ) as annee
    FROM
        nouvelles
    WHERE
        categorie_id = ${idCategorie}
    ORDER BY
        annee DESC,
        mois DESC
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur recuperation mois : " . mysql_error() );
    }

    while( $row = mysql_fetch_assoc( $query ) ) {
        if( !array_key_exists( $row['annee'], $annees ) ) {
            $annees[ $row['annee'] ] = array();
        }

        $annees[ $row['annee'] ][] = $row['mois'];
    }

    return $annees;

}


?>
