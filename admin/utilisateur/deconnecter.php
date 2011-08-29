<?php

include_once("init.php");

//Validations diverses
if ( !isset( $_GET['idUtilisateur'] ) ) {
    die("aucun id utilisateur");
}

$idUtilisateur = $_GET['idUtilisateur'];

if( !is_numeric( $idUtilisateur ) ) {
    die("id utilisateur n'est pas un chiffre");
}

$utilisateur = recupererUtilisateur( $idUtilisateur );

if( !$utilisateur ) {
    die("utilisateur n'existe pas");
}

deconnecterUtilisateur( $idUtilisateur );

?>

<p>L'utilisateur a été déconnecté</p>
<a href="<?php echo url("admin/utilisateur") ?>">Retourner à la liste d'utilisateurs</a>

<?php include_once("end.php") ?>
