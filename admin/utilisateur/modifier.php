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

$utilisateur['password'] = "";
$utilisateur['passwordConfirm'] = "";

$erreurs = array();

?>

<h1>Modification d'un utilisateur</h1>
<a href="<?php echo url("admin/utilisateur") ?>">Retour à la liste d'utilisateurs</a>

<form action="maj.php" method="post" name="modifierUtilisateur">
    <input type="hidden" name="id" value="<?php echo $utilisateur['id'] ?>" />
    <?php require("formulaire.php") ?>
</form>

<?php include_once("end.php") ?>
