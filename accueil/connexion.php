<?php

include_once "../conf/init.php";
include_once ROOT . "lib/isConnected.php";
include_once ROOT . "lib/urls.php";

if(isConnected()) {
	header( "Location: " . url("") );
}

include_once ROOT . "accueil/header.php";


if(isset($_POST['username']) && isset($_POST['password'])) {
	$result = mysql_query("SELECT id, admin, theme FROM utilisateurs WHERE username = '".mysql_real_escape_string($_POST['username']) ."' AND password = '".md5($_POST['password'])."'");
	
	if(mysql_num_rows($result) == 1) {
		$row = mysql_fetch_array($result);
		$_SESSION['id_utilisateur'] = $row['id'];
		if($row['admin']) {
			$_SESSION['admin'] = true;
			$_SESSION['theme'] = $row['theme'];
		}
		else {
			$_SESSION['admin'] = false;
		}
		mysql_query("UPDATE utilisateurs SET session_id = '".mysql_real_escape_string($_COOKIE['PHPSESSID'])."' WHERE id = " . intval($_SESSION['id_utilisateur']));
		header("Location: " . url("") );
	}
	else {
		include ROOT . "accueil/header.php";
		echo "Le nom d'utilisateur ou le mot de passe n'est pas valide.";
		include ROOT . "accueil/footer.php";
	}	
}
else {
?>

<div class="main">

    <div class="login">

        <h1>Connexion</h1>
        <form method="POST" action="#">
            <label for="username">
                <span>Utilisateur:</span>
                <input type="text" name="username" size="15" />
            </label>

            <br />
            <label for="password">
                <span>Mot de passe:</span>
                <input type="password" name="password" size="15" />
            </label>
            <br />

            <input type="submit" value="Login" /></p>
        </form>

    </div>

</div>

<?php
	include ROOT . "accueil/footer.php";
}

include ROOT . "conf/end.php";

?>
