<?php

include_once("../conf/init.php");

include_once( ROOT . "lib/isConnected.php" );
include_once( ROOT . "lib/urls.php" );

if( !isConnectedAsAdmin() ) {
    header("Location: ".url("admin/connexion.php"));
}

include_once( ROOT . "common/header.php" );

?>
