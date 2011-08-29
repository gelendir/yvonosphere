<?php

include_once("init.php");

?>

<h1>Administration du site</h1>

<h2>Actions</h2>

<ul>
    <li>
        <a href="<?php echo url("admin/utilisateur") ?>">Gestion des utilisateurs</a>
    </li>
    <li>
        <a href="<?php echo url("admin/nouvelle") ?>">Gestion des nouvelles</a>
    </li>
    <li>
        <a href="<?php echo url("") ?>">Retour au site</a><br/>
    </li>
    <li>
        <a href="<?php echo url("accueil/deconnexion.php") ?>">Se déconnecter</a>
    </li>
</ul>

<?php include_once("end.php") ?>
