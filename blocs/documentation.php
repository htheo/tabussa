<h1>Documentation de l'API Tabussa</h1>
<div class="doc">

    <div class="tips">
        <h2>Récupérer tous les liquides</h2>
        <p>URL : API/drinks<br><br>
        Utiliser la méthode POST avec un token valide (pour l'instant en phase de test pas besoin de token valide mais
        simplement un nombre lambda.<br><br>
        Vous allez recevoir 3 tableaux JSON (alcools, softs et aliments)</p>
    </div>
    <div class="tips">
        <h2>Récupérer un type de liquide</h2>
        <p>URL : API/drinks<br><br>
            Utiliser la méthode POST avec un token valide (pour l'instant en phase de test pas besoin de token valide mais
            simplement un nombre lambda et envoyer en méthode POST key=type et value=(alcool, soft ou aliment).<br><br>
            Vous allez recevoir un tableau JSON de type alcools</p>
    </div>


</div>

<script>
    $('.tips').on('click', function(){
        $(this).children('p').show();
    })
</script>