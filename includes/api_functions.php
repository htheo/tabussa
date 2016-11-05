<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 23:03
 */
// fonctions API

function get_drinks(){
    $drinks["alcools"]=array(
        "0" => "Vodka",
        "1" => "Whisky",
        "2" => "Rhum",
        "3" => "Rhum ambré",
        "4" => "Rhum arrangé",
        "5" => "Bière blonde",
        "6" => "Bière brune",
        "7" => "Bière blanche",
        "8" => "Bière noir",
        "9" => "Gin",
        "10" => "Jagger",
        "11" => "Champagne",
        "12" => "Vin rouge",
        "13" => "Vin blanc",
        "14" => "Rosé",
        "15" => "Get 27",
        "16" => "Get 31",
        "17" => "Bourbon",
        "18" => "Pastis",
        "19" => "Cognac",
        "20" => "Tequila",
        "21" => "Absynthe",
        "22" => "Passoa",
        "23" => "Cidre",
        "24" => "Saké",
        "25" => "Martini",
        "26" => "Manzana",
        "27" => "Porto",




    );
    $drinks["softs"]=array(
        "0" => "Lait",
        "1" => "Jus d'orange",
        "2" => "Jus de citron",
        "3" => "Jus de pomme",
        "4" => "Jus d'ananas",
        "5" => "Jus de poire",
        "6" => "Jus de banane",
        "7" => "Jus de carotte",
        "8" => "Jus de tomate",


    );
    $drinks["aliments"]=array(
        "0" => "citron",
        "1" => "chocolat en poudre",
        "2" => "sucre de canne",
    );
    return $drinks;

}