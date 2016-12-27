<?php
/**
 * Created by PhpStorm.
 * User: hinfraytheo
 * Date: 05/11/16
 * Time: 18:32
 */
if(isset($nom_second_url)){

    switch ($nom_second_url){
        case "add_drink":
            if(isset($_POST["name"]) && $_POST["name"]!=" " && $_POST["type"]!="" && $_POST["taille"]!=""){
                $name=htmlentities($_POST["name"]);
                $name=strtolower($name);
                $name= ucfirst($name);
                $color=$_POST["color"];
                $type=$_POST["type"];
                $taille=$_POST["taille"];
                $drink=db_select('SELECT * FROM tabussa_drinks WHERE name="'.$name.'"');
                if(isset($drink[0])){

                    $message='Mec ta boisson '.$name.' existe déjà';
                }else{
                    $id_drink=db_insert('tabussa_drinks',array("name"=>$name, "color"=>$color, 'type'=>$type, 'taille'=>$taille));
                    if($id_drink>0){
                        $message='Ta boisson '.$name.' a été ajoutée avec succès';
                    }else{
                        $message='Erreur lors de l\'insertion';
                    }

                }


            }else if(isset($_POST["name"])){
                $name=htmlentities($_POST["name"]);
                $name=strtolower($name);
                $name_again= ucfirst($name);
                $color_again=$_POST["color"];
                $message = "N'oublie pas le type de ta boisson";
            }else{
                $message='oups';
            }
            include('controllers/admin.php');
            break;

        case "drinks":
            $drinks = get_drinks(); // on récupère toutes les boissons en database
            print(json_encode($drinks));
            break;

        case "cocktails":
            $cocktails = get_cocktails(); // on récupère tous les cocktails en database
            print(json_encode($cocktails));
            break;

        case "cocktail":
           //$_POST["drinks"][0]=82;
            //$_POST["drinks"][1]=110;


            $cocktail= set_cocktail(); // on récupère nb_likes du cocktail et nb_visite et on dit que ce cocktail a été fait (vérifier si cet adresse IP l'a déjà fait)


            print(json_encode($cocktail));
            break;
        case "bonus":
            $mycocktail=json_decode(file_get_contents("php://input"));
            if(isset($mycocktail->id)){
                $id_cocktail=$mycocktail->id;
                $cocktail=db_select('SELECT * FROM tabussa_cocktails WHERE id='.$id_cocktail);
                if(isset($cocktail[0])){
                    $likes=$cocktail[0]["bonus"]+1;
                    $id_cocktail = db_update('tabussa_cocktails', array("bonus"=>$likes), array('id'=>$id_cocktail));
                    if(isset($id_cocktail)){
                        $message["bonus"]=$likes;
                        $message["malus"]=$cocktail[0]["malus"];
                    }else{
                        $message["error"]='Erreur le like n\'a pas été envoyé';
                    }
                }else{

                    $message["error"]='Erreur il n\'y a pas de $cocktail à cet id';
                }

            }else{
                $message["requete"]=$mycocktail;
                $message["error"]='L\'envoie de la requête est pas bon, envoyer un id';
            }
            print(json_encode($message));
            break;
        case "malus":
            $mycocktail=json_decode(file_get_contents("php://input"));
            if(isset($mycocktail->id)){
                $id_cocktail=$mycocktail->id;
                $cocktail=db_select('SELECT * FROM tabussa_cocktails WHERE id='.$id_cocktail);
                if(isset($cocktail[0])){
                    $malus=$cocktail[0]["malus"]+1;
                    $id_cocktail = db_update('tabussa_cocktails', array("malus"=>$malus), array('id'=>$id_cocktail));
                    if(isset($id_cocktail)){
                        $message["malus"]=$malus;
                        $message["bonus"]=$cocktail[0]["bonus"];
                    }else{
                        $message["error"]='Erreur le like n\'a pas été envoyé';
                    }
                }else{

                    $message["error"]='Erreur il n\'y a pas de $cocktail à cet id';
                }

            }else{
                $message["requete"]=$mycocktail;
                $message["error"]='L\'envoie de la requête est pas bon, envoyer un id';
            }
            print(json_encode($message));
            break;
        default:
            echo "problème";
            break;


    }
}else{
    $output["error"]=true;
    $output["message"]="La route demandée n'est pas bonne";
    print(json_encode($output));
}