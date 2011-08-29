<?php

#include_once "../conf/init.php";

function isConnected() {
	if(isset($_SESSION['id_utilisateur'])) {
		$result = mysql_query("SELECT session_id FROM utilisateurs WHERE id = " . intval($_SESSION['id_utilisateur']) . " AND session_id IS NOT NULL");
		
		if(mysql_num_rows($result) == 1) {
			$row = mysql_fetch_array($result);
			
			if($_COOKIE['PHPSESSID'] == $row['session_id']) {
				return true;
			}
			else {
				mysql_query("UPDATE utilisateurs SET session_id = NULL WHERE id = " . intval($_SESSION['id_utilisateur']));
				return false;
			}
		}
		else {
			unset($_SESSION['id_utilisateur']);
			return false;
		}
	
		
	}
	else {
		return false;
	}
}

function isConnectedAsAdmin() {
	return isset($_SESSION['admin']) && $_SESSION['admin'] && isConnected();
}

?>
