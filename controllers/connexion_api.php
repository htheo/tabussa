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
            $_POST["drinks"][1]=110;
            $cocktail= set_cocktail(); // on récupère nb_likes du cocktail et nb_visite et on dit que ce cocktail a été fait (vérifier si cet adresse IP l'a déjà fait)


            print(json_encode($cocktail));
            break;
        case "bonus":
            if(isset($_POST["id"])){
                $id_cocktail=$_POST["id"];
                $cocktail=db_select('SELECT * FROM tabussa_cocktails WHERE id='.$id_cocktail);
                if(isset($cocktail[0])){
                    $likes=$cocktail[0]["bonus"]+1;
                    $id_cocktail = db_update('tabussa_cocktails', array("bonus"=>$likes), array('id'=>$id_cocktail));
                    if(isset($id_cocktail)){
                        $message["bonus"]=$likes;
                    }else{
                        $message["error"]='Erreur le like n\'a pas été envoyé';
                    }
                }else{

                    $message["error"]='Erreur il n\'y a pas de $cocktail à cet id';
                }
                print(json_encode($message));
            }
            break;
        case "malus":
            if(isset($_POST["id"])){
                $id_cocktail=$_POST["id"];
                $cocktail=db_select('SELECT * FROM tabussa_cocktails WHERE id='.$id_cocktail);
                if(isset($cocktail[0])){
                    $malus=$cocktail[0]["malus"]+1;
                    $id_cocktail = db_update('tabussa_cocktails', array("malus"=>$malus), array('id'=>$id_cocktail));
                    if(isset($id_cocktail)){
                        $message["malus"]=$malus;
                    }else{
                        $message["error"]='Erreur le like n\'a pas été envoyé';
                    }
                }else{

                    $message["error"]='Erreur il n\'y a pas de $cocktail à cet id';
                }
                print(json_encode($message));
            }
            break;

        case "add_drink":
            if(isset($_POST["name"])){
                $name=htmlentities($_POST["name"]);
                $color=$_POST["color"];
                $type=$_POST["type"];
                $drink=db_select('SELECT * FROM tabussa_drinks WHERE name="'.$name.'"');
                if(isset($drink[0])){
                    $message='Mec ta boisson '.$_POST["name"].' existe déjà';
                }else{
                    db_insert('tabussa_drinks',array("name"=>$name, "color"=>$color, 'type'=>$type));
                    $message='Ta boisson'.$_POST["name"].' a été ajouté avec succès';
                }
                include('controllers/admin.php');

            }
            break;
    }
}else{
    $output["error"]=true;
    $output["message"]="La route demandée n'est pas bonne";
    print(json_encode($output));
}