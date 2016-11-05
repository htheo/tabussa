<?php
if($black==true){
    echo "<nav class='black_nav'>";
}else{
    echo "<nav  class='white_nav'>";
}
?>
    <?php
    if($niveau_url==""){
        $back="home";
    }else {
        $back=$niveau_url;
    }
    if($nom_first_url!="home" && $nom_first_url!=""){
        echo '<a href="'.$back.'"><img src="'.$niveau_url.'image/arrow_back.png" alt="retour"></a>';
    }

        echo '<a href="'.$niveau_url.'documentation"> Doc API</a>';
    ?>
</nav>