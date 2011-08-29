<?php

include_once("init.php");

//Validation diverses
if( !isset( $_REQUEST['idUtilisateur'] ) ) {
    die("aucun id utilisateur");
}

$idUtilisateur = $_REQUEST['idUtilisateur'];

if( !is_numeric( $idUtilisateur ) ) {
    die("id utilisateur n'est pas un chiffre");
}

$utilisateur = recupererUtilisateur( $idUtilisateur );
$supprimer = false;

if( !$utilisateur ) {
    die("utilisateur n'existe pas");
}

//Confirmation de la supprimation
if( isset( $_POST['confirmer'] ) ) {

    if(  $_POST['confirmer'] == 'Oui' ) {

        supprimerUtilisateur( $idUtilisateur );
        $supprimer = true;

    } else {

        header("Location: " . url("admin/utilisateur"));

    }

}

?>

<?php if( $supprimer ) { ?>

    <p>L'utilisateur a été supprimé avec succès</p>
    <a href="<?php echo url("admin/utilisateur") ?>">Retourner à la liste d'utilisateurs</a>

<?php } else { ?>

    <form action="supprimer.php" method="post" name="supprimerUtilisateur">
        <p>ATTENTION : êtes vous sûr de vouloir supprimer l'utilisateur
        <?php echo $utilisateur['username'] ?> ?</p>
        <input type="hidden" name="idUtilisateur" value="<?php echo $idUtilisateur ?>" />
        <input type="submit" name="confirmer" value="Oui" />
        <input type="submit" name="confirmer" value="Non" />
    </form>

<?php } #endif ?>

<?php include_once("end.php") ?>
