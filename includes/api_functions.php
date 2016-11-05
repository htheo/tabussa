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
        "0" => "vodka",
        "1" => "whisky",
        "2" => "rhum",
    );
    $drinks["softs"]=array(
        "0" => "lait",
        "1" => "jus d'orange",
        "2" => "coca",
    );
    $drinks["aliments"]=array(
        "0" => "citron",
        "1" => "chocolat en poudre",
        "2" => "sucre de canne",
    );
    return $drinks;

}