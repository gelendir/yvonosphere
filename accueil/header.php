<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <title>Yvon-o-sphere</title>
    <script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="/js/accueil.js"></script>
<?php
if( isConnected() ) {
?>
    <link href="<?php echourl( 'css/'.htmlspecialchars($_SESSION['theme']).'/default.css' ) ?>" type="text/css" rel="stylesheet" />
<?php
}
else {
?>
    <link href="<?php echourl( 'css/vert/default.css' ) ?>" type="text/css" rel="stylesheet" />
<?php
} #endif
?>
    <link href="<?php echourl( 'css/custom.css' ) ?>" type="text/css" rel="stylesheet" />
   </head>

<body>

<div class="container">
	<div class="top">
    <a href="<?php echo URL_ROOT ?>"><span>Yvon-O-Sphere</span></a>
        <p class="motto">Un blogue web 3.0 C++ latin-1 avec framework MVC en DOS et injection SQL</p>
	</div>
	
    <div class="header">
    </div>
