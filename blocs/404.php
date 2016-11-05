<?php



echo '<div class="error">';
echo '<h1>Oups !</h1>';
if(isset($tab_alerte['error'])){
	echo '<h2>'.$tab_alerte['error'].'</h2>';
}else{
	echo '<h2>	Une erreure non identifiée vient de se produire</h2>';
}
echo '</div>';


?>


<?php
include 'blocs/footer.php';
?>