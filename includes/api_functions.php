<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 23:03
 */
// fonctions API

function get_drinks(){
    $drinks=[];
    if(isset($_POST["type"])){ // si il y a un type
        $type=htmlentities($_POST["type"]);
        $drinks=db_select('SELECT * FROM tabussa_drinks WHERE type="'.$type.'"');

    }else{
        $drinks=db_select('SELECT * FROM tabussa_drinks');
    }
    if(!isset($drinks[0])){
        $drinks["error"]=true;
    }
    return $drinks;

}