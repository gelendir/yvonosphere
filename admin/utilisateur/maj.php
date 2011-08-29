<?php

include_once("init.php");

$utilisateur = $_POST;
$erreurs = validerUtilisateur( $utilisateur, true );

if( count( $erreurs ) == 0 ) {
    majUtilisateur( $utilisateur );
}

?>

<?php if( count( $erreurs ) > 0 ) { ?>

    <h1>Modification d'un utilisateur</h1>
    <a href="<?php echo url("admin/utilisateur") ?>">Retour à la liste d'utilisateurs</a>

    <form action="maj.php" method="post" name="modifierUtilisateur">
        <input type="hidden" name="id" value="<?php echo $utilisateur['id'] ?>" />
        <?php require("formulaire.php") ?>
    </form>

<?php } else { ?>

    <p>L'utilisateur a été mis à jour avec succès</p>
    <a href="<?php echo url("admin/utilisateur") ?>">Retourner à la liste d'utilisateurs</a>

<?php } #endif ?>

<?php include_once("end.php") ?>
