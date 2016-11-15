<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 18:32
 */

if(isset($nom_second_url)){
    include('includes/api_functions.php'); // on ajout le fichier php avec les fonctions de co API
    switch ($nom_second_url){
        case "drinks":
            $drinks = get_drinks(); // on récupère toutes les boissons en database
            print(json_encode($drinks));
            break;


        case "cocktail":
            $_POST["drinks"][0]=82;
            $_POST["drinks"][1]=81;
            $_POST["drinks"][2]=85;
            $_POST["drinks"][3]=84;
            $cocktail= set_cocktail(); // on récupère nb_likes du cocktail et nb_visite et on dit que ce cocktail a été fait (vérifier si cet adresse IP l'a déjà fait)

            echo "";
            print(json_encode($cocktail));
            break;
    }
}else{
    $output["error"]=true;
    $output["message"]="La route demandée n'est pas bonne";
    print(json_encode($output));
}