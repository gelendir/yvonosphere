<?php

include_once "../../conf/init.php";
include_once "../../lib/isConnected.php";
include_once "../../lib/nouvelle.php";
include_once "../../lib/urls.php";

if(!isConnectedAsAdmin()) {
	header("Location: ".url("admin/connexion.php"));
}

?>
