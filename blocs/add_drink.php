<div class="proposition">
    <?php
if(isset($message)){
    echo '<h1>'.$message.'<br>
    Ajoute un autre ingrédient</h1>';
}else{
    echo '<h1>Ajouter un ingrédient</h1>';
}




    echo '<form method="post" action="'.$niveau_url.'API/add_drink">';
    ?>
        <input class="input" type="text" placeholder="Votre boisson/ingrédient" name="name" required>
        <select class="input" name="type">
            <option value="alcool">Alcool</option>
            <option value="soft">Soft</option>
            <option value="aliment">Aliment</option>
        </select>
        <label for="color">Couleur de la boisson </label><input id="color" type="color" name="color" value="#ff0000"><br>
        <input type="submit" value="Envoie moi ça !">
    </form>
</div>