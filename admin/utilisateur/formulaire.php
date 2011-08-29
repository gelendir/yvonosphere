<?php

include_once( ROOT . "lib/theme.php" );

$DOSSIER_CSS = ROOT . "css/";

function listeCategories( $categorie_id = null ) {

    $html = "<select name='categorie_id'>";
    foreach( getCategories() as $categorie ) {

        $html .= "<option ";

        if ( $categorie_id == $categorie['id'] ) {
            $html .= "selected ";
        }

        $html .= " value='" . htmlspecialchars( $categorie['id'] )
            . "'>" . htmlspecialchars( $categorie['nom'] )
            . "</option>";
    }

    $html .= "</select>";

    return $html;
}

function listeThemes( $theme = null ) {

    global $DOSSIER_CSS;

    $html = "<select name='theme'>";
    foreach( getThemesDisponibles( $DOSSIER_CSS ) as $nom_theme ) {
        $html .= "<option ";

        if( $theme == $nom_theme ) {
            $html .= "selected";
        }

        $html .= " value='" . htmlspecialchars( $nom_theme )
            . "'>" . htmlspecialchars( ucfirst( $nom_theme ) )
            . "</option>";

    }

    $html .= "</select>";

    return $html;

}

function messageErreur( $erreurs, $champ ) {

    $html = "";

    if( array_key_exists( $champ, $erreurs ) ) {
        foreach( $erreurs[$champ] as $erreur ) {
            $html .= "<span class='help-inline'>"
                . $erreur
                . "</span>";
        }
    }

    return $html;
}

function divLigne( $champ ) {
    global $erreurs;
    if( array_key_exists( $champ, $erreurs ) ) {
        return "<div class='clearfix error'>";
    } else {
        return "<div class='clearfix'>";
    }
}

?>

<fieldset class="form">

<?php echo divLigne( 'username' ) ?>
    <label for="username">
        <span>Nom d'utilisateur</span>
    </label>

    <div class="input">
        <input type="text" name="username" value="<?php echo $utilisateur['username'] ?>" />
        <?php echo messageErreur( $erreurs, 'username' ) ?>
    </div>
</div>

<?php echo divLigne( 'nom' ) ?>
    <label for="nom">
        <span>Nom</span>
    </label>

    <div class="input">
        <input type="text" name="nom" value="<?php echo $utilisateur['nom'] ?>" />
        <?php echo messageErreur( $erreurs, 'nom' ) ?>
    </div>
</div>

<?php echo divLigne( 'prenom' ) ?>
    <label for="prenom">
        <span>Prenom</span>
    </label>

    <div class="input">
        <input type="text" name="prenom" value="<?php echo $utilisateur['prenom'] ?>" />
        <?php echo messageErreur( $erreurs, 'prenom' ) ?>
    </div>
</div>

<?php echo divLigne( 'password' ) ?>
    <label for="password">
        <span>Mot de passe</span>
    </label>

    <div class="input">
        <input type="password" name="password" value="<?php echo $utilisateur['password'] ?>" />
        <?php echo messageErreur( $erreurs, 'password' ) ?>
    </div>
</div>

<?php echo divLigne( 'passwordConfirm' ) ?>
    <label for="passwordConfirm">
        <span>Mot de passe</span>
    </label>

    <div class="input">
        <input type="password" name="passwordConfirm" value="<?php echo $utilisateur['passwordConfirm'] ?>" />
        <?php echo messageErreur( $erreurs, 'passwordConfirm' ) ?>
    </div>
</div>

<?php echo divLigne( 'categorie_id' ) ?>
    <label for="categorie_id">
        <span>Catégorie</span>
    </label>

    <div class="input">
        <?php echo listeCategories( $utilisateur['categorie_id'] ) ?>
        <?php echo messageErreur( $erreurs, 'categorie_id' ) ?>
    </div>
</div>

<?php echo divLigne( 'admin' ) ?>
    <label for="admin">
        <span>Est-ce un administrateur ?</span>
    </label>

    <div class="input">
        <input type="checkbox" name="admin" value="1" <?php if( $utilisateur['admin'] ) { echo "checked"; } ?> />
        <?php echo messageErreur( $erreurs, 'admin' ) ?>
    </div>
</div>

<?php echo divLigne( 'theme' ) ?>
    <label for="theme">
        <span>Thème du blogue</span>
    </label>

    <div class="input">
        <?php echo listeThemes( $utilisateur['theme'] ) ?>
        <?php echo messageErreur( $erreurs, 'theme' ) ?>
    </div>
</div>

<div class="actions">
    <button class="btn primary" type="submit" >Sauver</div>
</div>

</fieldset>

