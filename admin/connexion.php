<?php

include_once "../conf/init.php";
include_once "../lib/isConnected.php";

if(isConnectedAsAdmin()) {
	header("Location: /admin/");
}

if(isset($_POST['username']) && isset($_POST['password'])) {
	$result = mysql_query("SELECT id, theme FROM utilisateurs WHERE username = '".mysql_real_escape_string($_POST['username']) ."' AND password = '".md5($_POST['password'])."' AND admin = TRUE");
	
	if(mysql_num_rows($result) == 1) {
		$row = mysql_fetch_array($result);
		$_SESSION['id_utilisateur'] = $row['id'];
		$_SESSION['theme'] = $row['theme'];
		$_SESSION['admin'] = true;
		mysql_query("UPDATE utilisateurs SET session_id = '".mysql_real_escape_string($_COOKIE['PHPSESSID'])."' WHERE id = " . intval($_SESSION['id_utilisateur']));
		header("Location: /admin/");
	}
	else {
		include "../common/header.php";
		echo "Le nom d'utilisateur ou le mot de passe n'est pas valide.";
		include "../common/footer.php";
	}	
}
else {
	include "../common/header.php";
?>
<h1>Connexion à l'administration</h1>
<form method="POST" action="#">
    <fieldset class="form">
    
        <div class='clearfix'>
	        <label for="username"><span>Utilisateur:</span></label>
		    <div class="input"><input type="text" name="username" size="15" /></div>
	    </div>
	    
	    <div class='clearfix'>
	        <label for="password"><span>Mot de passe:</span></label>
       		<div class='input'><input type="password" name="password" size="15" /></div>
       	</div>

        <div class="actions">
	        <input class="btn primary" type="submit" value="Login" />
	    </div>
	</fieldset>
</form>

<?php
	include "../common/footer.php";
}

include "../conf/end.php";

?><div class="input">
