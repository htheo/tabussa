<div class="proposition">
    <?php
if(isset($message)){
    echo '<h1>'.$message.'<br>
    Ajoute un autre ingrédient</h1>';
}else{
    echo '<h1>Ajouter un ingrédient</h1>';
}




    echo '<form method="post" action="'.$niveau_url.'api/add_drink">';
    ?>

    <?php
    if(isset($name_again)){
        echo '<input id="#input1" class="input" type="text" value="'.$name_again.'" name="name" required>';
    }else{
        echo '<input id="#input1" class="input" type="text" placeholder="Votre boisson/ingrédient" name="name" required>';
    }
    ?>

        <select class="input" name="type" required>
            <option>Type</option>
            <option value="alcool_fort">Alcool_fort (Vodka, Whisky, Rhum...)</option>
            <option value="alcool">Alcool (Bière, vin, champagne...)</option>
            <option value="soft">Soft (sirop, jus, soda...)</option>
            <option value="aliment">Aliment (sucre, sucre de canne, glaçons, citron...)</option>
        </select>
    <select class="input" name="taille" required>
        <option value="1">Remplir le verre (bière, jus, champagne...)</option>
        <option value="0.5">Moyenne quantité (au cas ou)</option>
        <option value="0.2">petite quantité (vodka, whisky, sirop, sucre...)</option>
    </select>
         <?php
    if(isset($color_again)){
        echo '<label for="color">Couleur de la boisson </label><input id="color" type="color" name="color" value="'.$color_again.'"><br>';
    }else{
        echo '<label for="color">Couleur de la boisson </label><input id="color" type="color" name="color" value="#ff0000"><br>';
    }
    ?>
    <input class="btn orange" type="submit" value="Envoie moi ça !">
    </form>
</div>

<script>

</script>