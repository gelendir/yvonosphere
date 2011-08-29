<?php

include_once "../conf/init.php";
include_once ROOT . "lib/isConnected.php";

if(isConnected()) {
	mysql_query("UPDATE utilisateurs SET session_id = NULL WHERE id = " . intval($_SESSION['id_utilisateur']));
	session_destroy();
}

include ROOT . "conf/end.php";

header("Location: /");

?>
