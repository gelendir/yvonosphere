<?php

include_once("init.php");

$utilisateur = array(
    'username'          => '',
    'nom'               => '',
    'prenom'            => '',
    'password'          => '',
    'passwordConfirm'   => '',
    'admin'             => false,
    'theme'             => '',
    'categorie_id'      => 0,
);

$erreurs = array();

?>

<h1>Création d'un nouvel utilisateur</h1>
<a href="<?php echo url("admin/utilisateur") ?>">Retour à la liste d'utilisateurs</a>

<form action="creer.php" method="post" name="creerUtilisateur">
    <?php require("formulaire.php"); ?>
</form>

<?php include_once("end.php") ?>
