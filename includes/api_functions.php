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
    $drinks=[];
    if(isset($_POST["type"])){ // si il y a un type
        $type=htmlentities($_POST["type"]);
        $drinks=db_select('SELECT * FROM tabussa_drinks WHERE type="'.$type.'"');

    }else{
        $drinks=db_select('SELECT * FROM tabussa_drinks WHERE type!="none"'); // none égal à supprimé
    }
    if(!isset($drinks[0])){
        $drinks["error"]="Il n'y a pas de boissons";
    }
    return $drinks;

}


function cocktail_existant($add_cocktail_drinks, $where, $i){ //cocktail existant ou non

    for($i;$i<=10;$i++){
        if($i==1){ //si c'est le premier ce n'est pas un "et" la condition
            $where=$where." id_drink".$i."=0";

        }else{
            $where=$where." && id_drink".$i."=0";
        }
    }
    $cocktail_cree=db_select('SELECT * FROM tabussa_cocktails '.$where);
    if(isset($cocktail_cree[0])){  //cocktail existant on récupère son id
        $id_cocktail=$cocktail_cree[0];
    }else{
        $add_cocktail_drinks["visits"]=1;
        $id_cocktail=db_insert('tabussa_cocktails', $add_cocktail_drinks);
    }
    return $id_cocktail;
}

// SETTERS
function set_cocktail(){
    if(isset($_POST["drinks"][0])){
        $drinks=$_POST["drinks"];
        asort($drinks);
        $where="WHERE "; //condition pour le select
        $i=1;
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

                            $drink_suggestions[]=$cocktail_suggestion["id_drink".$k];;
                            $cocktail["suggestions"][]=$cocktail_suggestion["id_drink".$k];
                        }
                    }

                }
            }
        }


        $id_cocktail = cocktail_existant($add_cocktail_drinks, $where,$i);
        if(isset($id_cocktail["id"])){   //si il y a un cocktail existant
            $cocktail["visits"]=$id_cocktail["visits"];
            $cocktail["bonus"]=$id_cocktail["bonus"];
            $cocktail["malus"]=$id_cocktail["malus"];
            $visits=$id_cocktail["visits"];
            $visits++;
            db_update("tabussa_cocktails", array("visits"=>$visits), array("id"=>$id_cocktail["id"]));
        }else{
            $cocktail["visits"]=1;
            $cocktail["bonus"]=0;
            $cocktail["malus"]=0;
        }




    }else{
        $cocktail["error"]="Il n'y a pas de boissons envoyées en méthode POST";
    }
    return $cocktail;
}


// UPDATE

