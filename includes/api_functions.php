<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 23:03
 */
// fonctions API



// GETTERS
function get_drinks(){ //on récupère toutes le boissons par type ou non
    $tab_drinks=[];
    if(isset($_POST["type"])){ // si il y a un type
        $type=htmlentities($_POST["type"]);
        $tab_drinks=db_select('SELECT * FROM tabussa_drinks WHERE type="'.$type.'"');

    }else{
        $tab_drinks=db_select('SELECT * FROM tabussa_drinks WHERE type!="none"'); // none égal à supprimé
    }
    if(!isset($tab_drinks[0])){
        $tab_drinks["error"]="Il n'y a pas de boissons";
    }
    return $tab_drinks;

}

function get_cocktails(){ //on récupère tous les cocktails
    $cocktails=db_select('SELECT * FROM tabussa_cocktails'); // none égal à supprimé
    if(!isset($cocktails[0])){
        $cocktails["error"]="Il n'y a pas de cocktails";
    }
    return $cocktails;
}


function cocktail_existant($add_cocktail_drinks, $where, $j){ //cocktail existant ou non

    for($j;$j<=10;$j++){
        if($j==1){ //si c'est le premier ce n'est pas un "et" la condition
            $where=$where." id_drink".$j."=0";

        }else{
            $where=$where." && id_drink".$j."=0";
        }
    }
    $cocktail_cree=db_select('SELECT * FROM tabussa_cocktails '.$where);
    if(isset($cocktail_cree[0])){  //cocktail existant on récupère son id
        $id_cocktail=$cocktail_cree[0];
    }else{
        $add_cocktail_drinks["visits"]=0;
        $id_cocktail=db_insert('tabussa_cocktails', $add_cocktail_drinks);
    }
    return $id_cocktail;
}


function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}


// SETTERS
function set_cocktail(){



    $mycocktail = json_decode(file_get_contents("php://input"));
    if(isset($mycocktail->drinks[0])){
        $drinks=$mycocktail->drinks;
        asort($drinks);
        $where="WHERE "; //condition pour le select
        $i=1;
        $add_cocktail_drinks="";
        foreach($drinks as $drink){
            if($i==1){ //si c'est le premier ce n'est pas un "et" la condition
                $where=$where." ".$drink." IN(id_drink1, id_drink2, id_drink3, id_drink4, id_drink5, id_drink6, id_drink7, id_drink8, id_drink9, id_drink10)";

            }else{
                $where=$where." && ".$drink." IN(id_drink1, id_drink2, id_drink3, id_drink4, id_drink5, id_drink6, id_drink7, id_drink8, id_drink9, id_drink10)";

                }
                $add_cocktail_drinks["id_drink".$i]=$drink;
                $i++;
            }
            $cocktail_suggestions=db_select('SELECT * FROM tabussa_cocktails '.$where.'ORDER BY visits');
            $drink_suggestions=array();

            if(isset($cocktail_suggestions[0])){
                foreach ($cocktail_suggestions as $cocktail_suggestion){


                    for($k=1;$k<=10;$k++){  //on regarde les 10 ingrédients du cocktail
                        if($cocktail_suggestion["id_drink".$k]>0){

                            if (in_array($cocktail_suggestion["id_drink".$k], $drink_suggestions) || in_array($cocktail_suggestion["id_drink".$k] , $drinks)) //si l'ingredient n'est pas dans
                            {

                            }
                            else
                            {

                                $drink_suggestions[]=$cocktail_suggestion["id_drink".$k];
                                $name_cocktail=db_select('SELECT name FROM tabussa_drinks WHERE id='.$cocktail_suggestion["id_drink".$k]);
                                $name_cocktail = $name_cocktail[0]["name"];
                                $cocktail["suggestions"][$cocktail_suggestion["id_drink".$k]]["name"]=$name_cocktail;

                            }
                        }

                    }
                }
            }


            $tab_cocktail = cocktail_existant($add_cocktail_drinks, $where,$i);
            if($tab_cocktail>0){   //si il y a un cocktail existant
                //print_r($tab_cocktail);
                $cocktail["visits"]=$tab_cocktail["visits"];
                $cocktail["id"]=$tab_cocktail["id"];
                $cocktail["bonus"]=$tab_cocktail["bonus"];
                $cocktail["malus"]=$tab_cocktail["malus"];
                $visits=$tab_cocktail["visits"];
                $visits++;
                db_update("tabussa_cocktails", array("visits"=>$visits), array("id"=>$tab_cocktail["id"]));
            }else{
                $cocktail["visits"]=1;
                $cocktail["bonus"]=0;
                $cocktail["malus"]=0;
            }
        }else{
            $cocktail["error"]="Ce n'est pas un tableau";
        }

    return $cocktail;
}


// UPDATE

