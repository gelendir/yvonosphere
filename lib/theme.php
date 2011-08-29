<?php

function getThemesDisponibles( $dirname = "../css/" ) {
	$retour = array();
	$dir = opendir($dirname); 

	while($file = readdir($dir)) {
		if($file != '.' && $file != '..') {
			if(is_dir($dirname.$file)) {
				if(file_exists($dirname.$file."/default.css")) {
					$retour[] = $file;
				}
			}
		}
	}
	
	closedir($dir);
	
	return $retour;
}

function recevoirFormulaireTheme() {
	if(isset($_POST['theme'])) {
		$theme = $_POST['theme'];
		if(in_array($theme, getThemesDisponibles())) {
			mysql_query("UPDATE utilisateurs SET theme = '".mysql_real_escape_string($theme)."' WHERE id = " . intval($_SESSION['id_utilisateur']));
			$_SESSION['theme'] = $theme;
		}
	}
}

?>
