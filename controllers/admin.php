<?php

include 'blocs/header-start.php';
include 'blocs/nav.php';


if (isset($_SESSION['pseudo'])){
	$acces=true;
	



    
} else{
	$tab_alerte["error"]="Vous n'avez pas les droits";
    include 'blocs/404.php';
}
include 'blocs/footer.php';
?>
