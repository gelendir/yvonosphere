<?php

include_once("init.php");

function getUtilisateurs() {

    $utilisateurs = array();

    $sql = <<<EOQ
        SELECT
            id,
            username,
            ( session_id IS NOT NULL ) AS connect
        FROM
            utilisateurs
EOQ;

    $query = mysql_query( $sql );
    if( !$query ) {
        die("erreur requete sql: " . mysql_error() );
    }

    while( $row = mysql_fetch_assoc( $query ) ) {
        $utilisateurs[] = $row;
    }

    return $utilisateurs;

}

?>

<h1>Liste des utilisateurs</h1>

<a href="ajouter.php">Ajouter un utilisateur</a><br />
<a href="<?php echourl("admin" ) ?>">Retour à la page d'administration</a>

<br />
<br />

<table id="utilisateurs" class="zebra-striped">
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th colspan="3">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach( getUtilisateurs() as $utilisateur ) { ?>
        <tr>
            <td><?php echo $utilisateur['username'] ?></td>
            <td>
                <a href="<?php echo "modifier.php?idUtilisateur=" . htmlspecialchars( $utilisateur['id'] ) ?>">
                    Editer
                </a>
            </td>
            <td>
                <a href="<?php echo "supprimer.php?idUtilisateur=" . htmlspecialchars( $utilisateur['id'] ) ?>">
                    Supprimer
                </a>
            </td>
            <?php if( $utilisateur['connect'] ) { ?>
                <td>
                    <a href="<?php echo "deconnecter.php?idUtilisateur=" . htmlspecialchars( $utilisateur['id'] ) ?>">
                        Deconnecter l'utilisateur
                    </a>
                </td>
            <?php } else { ?>
                <td></td>
            <?php } #endif ?>
        </tr>
    <?php } #endfor ?>
    </tbody>
</table>

<?php include_once("end.php") ?>
