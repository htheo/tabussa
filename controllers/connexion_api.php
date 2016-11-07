<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 18:32
 */

if(isset($nom_second_url)){
    include('includes/api_functions.php');
    switch ($nom_second_url){
        case "drinks":
            $drinks = get_drinks();

            print(json_encode($drinks));

            break;
    }
}else{
    $output["error"]=true;
    $output["message"]="La route demandée n'est pas bonne";
    print(json_encode($output));
}