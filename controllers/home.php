<?php

include 'blocs/header-start.php';



//panel = vue

switch($nom_first_url){
    case 'home':
        $black=false;
        include 'blocs/nav.php';
        include 'blocs/default.php';
        break;
    case '':
        $black=false;
        include 'blocs/nav.php';
        include 'blocs/default.php';
        break;
    case 'add-drink':
        include 'blocs/nav.php';
        include 'blocs/add_drink.php';
        break;
    default:
        include 'blocs/nav.php';
        $tab_alerte["error"] = "Page introuvable";
        include 'blocs/404.php';
        break;

}



include 'blocs/footer.php';

?>
