<?php

include_once "lib.php";

if(isset($_GET['id']) && intval($_GET['id'])) {
	supprimerNouvelle($_GET['id']);
}
else {
	header("Location: ".url("/admin/nouvelle/"));
}

include "../../conf/end.php";

?>
