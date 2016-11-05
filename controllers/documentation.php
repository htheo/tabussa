<?php
include 'blocs/header-start.php';
include 'blocs/nav.php';
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 19:29
 */

if(isset($nom_second_url)){
    echo "<div class='documentation'>";
    switch ($nom_second_url){
        case "general":
            echo" yes";
            break;

    }
    echo "</div>";
}else if($nom_first_url=="documentation"){
    echo "<div class='documentation'>";
    echo "doc";
    echo "</div>";
}else {
    $black=true;
    include 'blocs/404.php';
}
