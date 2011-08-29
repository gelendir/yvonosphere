<?php

include_once("init.php");

$utilisateur = $_POST;
$erreurs = validerUtilisateur( $utilisateur );

if( count( $erreurs ) == 0 ) {
    creerUtilisateur( $utilisateur );
}

?>

<?php if( count( $erreurs ) > 0 ) { ?>

    <h1>Création de l'utilisateur</h1>
    <a href="<?php echo url("admin/utilisateur") ?>">Retour à la liste d'utilisateurs</a>
    <form action="creer.php" method="post" name="creerUtilisateur">
        <?php require("formulaire.php"); ?>
    </form>

<?php } else { ?>

    <p>L'utilisateur a été crée avec succès</p>
    <a href="<?php echo url("admin/utilisateur") ?>">Retourner à la liste d'utilisateurs</a>

<?php } #endif ?>

<?php include_once("end.php") ?>
