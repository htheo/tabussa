<?php
session_start();
$tab_alerte = array();  // tableau pour afficher les alertes (souvent erreur)
include 'includes/baseconnect.php';
include 'includes/config.php';
include 'includes/functions.php';

$black=true;

$url_barre = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  //on récupère toutes les données

$tab_url_barre = explode('/', $url_barre);    // on les sépare dans un tableau avec les "/"
$i = 0;
$nom_domaine = false;   //pour trouver le nom de domaine
$niveau_url = "";
$niveau_url2 = "";
foreach ($tab_url_barre as $key => $value) {  // boucle pour prendre toutes les infos
    if ($nom_domaine == true) {                     // à partir de la on a les infos utile de la racine
        switch ($i) {
            case 0:
                $enlever_get = explode('?', $value);
                $nom_first_url = $enlever_get[0];   //première valeur -> surement un projet

                break;
            case 1:
                $enlever_get = explode('?', $value);
                $nom_second_url = $enlever_get[0];     //deuxième -> nom de la page
                $niveau_url = "../";
                break;
            case 2:
                $enlever_get = explode('?', $value);
                $donnees_url = $enlever_get[0];  // troisième valeur
                $niveau_url = "../../";
                $niveau_url2 = "../";
                $nom_third_url = $donnees_url;
                break;
            default:
                //on peut en mettre autant qu'on veut
                # code...
                break;
        }
        $i++;
    } else if ($value == 'tabussa') {
        $nom_domaine = true;
    }
}
if (isset($_SESSION['pseudo']) && isset($_SESSION['id'])) {   // a remplir pour la connexion sur le site au cas ou

} else {  //sinon niveau visiteur
    $level = 4;
}


$_POST["token"] = true; //c'est pour le local pour pouvoir faire les tests sans token
if (isset($_POST["token"]) && isset($nom_first_url) && $nom_first_url == "API") { // on donnera des token pour se co
    $template = "connexion_api.php";

} else if ($nom_first_url != ""){   // si il y a un fichier
    switch ($nom_first_url){
        case 'home':
            $template="home.php";
            break;
        case 'documentation':
            $template="documentation.php";
            break;
        case 'admin':
            $template="admin.php";
            break;
        default:
            $template="home.php";
            break;
    }


}else if($nom_first_url == ""){
    $template = 'home.php';

}else{
    $tab_alerte["error"] = "Page introuvable";

    $template = '404.php';

}


if($template=="404.php"){

    include 'blocs/header-start.php';
    include 'blocs/nav.php';
    include 'blocs/404.php';

}else{
    include 'controllers/' . $template;

}

?>



