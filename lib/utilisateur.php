<?php

$UTILISATEUR_OBLIGATOIRE = array(
    'username',
    'nom',
    'prenom',
    'password',
    'passwordConfirm',
    'categorie_id',
    'theme',
);

$UTILISATEUR_LONGEUR = array(
    'username'  => 40,
    'password'  => 32,
    'nom'       => 80,
    'prenom'    => 80,
    'theme'     => 40,
);

function getCategories() {

    $sql =<<<EOQ
    SELECT
        id,
        nom
    FROM
        categories
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur requete sql : " . mysql_error() );
    }

    $categories = array();
    while( $row = mysql_fetch_assoc( $query ) ) {
        $categories[] = $row;
    }

    return $categories;

}

function validerUtilisateur( $utilisateur, $maj = false ) {

    global $UTILISATEUR_LONGEUR;
    global $UTILISATEUR_OBLIGATOIRE;

    $longeurs = $UTILISATEUR_LONGEUR;
    $obligatoire = $UTILISATEUR_OBLIGATOIRE;
    $erreurs = array();

    if( $maj ) {

        $pos = array_search( 'password', $obligatoire );
        unset( $obligatoire[ $pos ] );

        $pos = array_search( 'passwordConfirm', $obligatoire );
        unset( $obligatoire[ $pos ] );
    }

    //initialiser les listes d'erreurs pour chaque champ
    foreach( $obligatoire as $champ ) {
        $erreurs[$champ] = array();
    }

    //Validation des champs vides
    foreach( $utilisateur as $champ => $valeur ) {
        if ( in_array( $champ, $obligatoire )
             && trim( $valeur ) == "" )
        {
            $erreurs[$champ][] = "Ce champ est obligatoire";
        }
    }

    //Validation de la longeur des champs
    foreach( $utilisateur as $champ => $valeur ) {
        if ( in_array( $champ, $longeurs )
            && count( $valeur ) > $longeurs[ $champ ] )
        {
            $erreurs[$champ][] = "Le champ ne peut dépasser "
                . $longeurs[ $champ ]
                . " charactères";
        }
    }

    //Confirmation du mot de passe
    if(
        ( !$maj )
        || ( $maj && trim( $utilisateur['password'] ) != "" ) )
    {
        if( $utilisateur['password'] != $utilisateur['passwordConfirm'] ) {
            $erreurs['passwordConfirm'][] = "Les mot de passes ne sont pas pareils";
        }
    }

    //Confirmation de l'unicité du username
    $sql = "SELECT COUNT(*) FROM utilisateurs WHERE username = '"
        . mysql_escape_string( $utilisateur['username'] )
        . "'";

    if( $maj ) {
        $sql .= " AND id != " . mysql_escape_string( $utilisateur['id'] );
    }

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur lors de la validation username : " . mysql_error() );
    }

    $row = mysql_fetch_row( $query );
    if( $row[0] > 0 ) {
        $erreurs['username'][] = "Ce nom d'utilisateur est déja pris";
    }

    //enlever les listes vides
    foreach( $erreurs as $champ => $messages ) {
        if ( count( $messages ) == 0 ) {
            unset( $erreurs[ $champ ] );
        }
    }

    return $erreurs;

}

function transformationParams( $utilisateur ) {

    foreach( $utilisateur as $champ => &$valeur ) {
        $valeur = mysql_escape_string( $valeur );
    }

    if( !isset( $utilisateur['admin'] ) ) {
        $utilisateur['admin'] = '0';
    }

    return $utilisateur;

}

function creerUtilisateur( $utilisateur ) {

    $utilisateur = transformationParams( $utilisateur );

    $utilisateur['password'] = md5( $utilisateur['password'] );

    $sql =<<<EOQ
    INSERT INTO utilisateurs (
        username,
        password,
        nom,
        prenom,
        admin,
        categorie_id,
        theme
    ) VALUES (
        '${utilisateur['username']}',
        '${utilisateur['password']}',
        '${utilisateur['nom']}',
        '${utilisateur['prenom']}',
        ${utilisateur['admin']},
        ${utilisateur['categorie_id']},
        '${utilisateur['theme']}'
    )
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur lors de l'insertion: " . mysql_error() );
    }

    $_SESSION['theme'] = $utilisateur['theme'];

}

function majUtilisateur( $utilisateur ) {

    $utilisateur = transformationParams( $utilisateur );

    //Verification si le mot de passe doit etre mis a jour
    if( trim( $utilisateur['password'] ) != "" ) {

        $sql = " UPDATE utilisateurs SET password = '" .
            md5( $utilisateur['password'] ) .
            "' WHERE id = " .
            $utilisateur['id'];

        $query = mysql_query( $sql );
        if( !$query ) {
            die("erreur mise à jour mot de passe");
        }

    }

    //mise à jour de l'utilisateur
    $sql =<<<EOQ
    UPDATE utilisateurs
    SET
        username = '${utilisateur['username']}',
        nom = '${utilisateur['nom']}',
        prenom = '${utilisateur['prenom']}',
        admin = ${utilisateur['admin']},
        categorie_id = ${utilisateur['categorie_id']},
        theme = '${utilisateur['theme']}'
    WHERE
        id = ${utilisateur['id']}
EOQ;

    $_SESSION['theme'] = $utilisateur['theme'];

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur lors de la mise a jour : " . mysql_error() );
    }

}

function recupererUtilisateur( $idUtilisateur ) {

    $idUtilisateur = mysql_escape_string( $idUtilisateur );

    $sql =<<<EOQ
    SELECT
        *
    FROM
        utilisateurs
    WHERE
        id = ${idUtilisateur}
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur recuperation utilisateur : " . mysql_error() );
    }

    $utilisateur = mysql_fetch_assoc( $query );

    return $utilisateur;

}

function supprimerUtilisateur( $idUtilisateur ) {

    $idUtilisateur = mysql_escape_string( $idUtilisateur );

    $sql =<<<EOQ
    DELETE FROM
        utilisateurs
    WHERE
        id = ${idUtilisateur}
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur supprimer utilisateur : " . mysql_error() );
    }

}

function deconnecterUtilisateur( $idUtilisateur ) {

    $idUtilisateur = mysql_escape_string( $idUtilisateur );

    $sql =<<<EOQ
    UPDATE
        utilisateurs
    SET
        session_id = NULL
    WHERE
        id = ${idUtilisateur}
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur deconnecter utilisateur : " . mysql_error() );
    }

}

?>
