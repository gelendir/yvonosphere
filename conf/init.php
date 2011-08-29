<?php

    include "conf.php";
	
	mysql_connect($info_database['server'], $info_database['user'], $info_database['password']);
	mysql_select_db($info_database['database']);
	
    session_start();
    setlocale(LC_ALL, 'French');

    define( "ROOT", $_SERVER['DOCUMENT_ROOT'] . "/" );
?>

