<?php
// fonction requetes sql

	//INSERT
function db_insert($table, $tab_valeurs, $debug=false){
	global $bdd;
	$tab_champs=array_keys($tab_valeurs);
	$tab_data=array_values($tab_valeurs);
	
	$sql = 'INSERT INTO '.$table.' ('.implode(', ', $tab_champs).') VALUES (:'.implode(', :', $tab_champs).')';
	$req = $bdd->prepare($sql);
	if ($req->execute($tab_valeurs)){
		$last_id = $bdd->lastInsertId();
		}
	else $last_id=-1;
	
	if ($debug) echo '<pre><code>'.$sql.'</code></pre>';
	
	return $last_id;
	}

	//UPDATE	
function db_update($table, $tab_valeurs, $tab_where, $debug=false){
	global $bdd;
	
	$sql = 'UPDATE '.$table.' SET ';
	
	$delim='';
	foreach ($tab_valeurs as $col=>$val){	
			$sql.=$delim.' '.$col.' = :'.$col;
			$delim=',';
			}
	
	if (!empty($tab_where)){
		$delim=' WHERE';
		foreach ($tab_where as $col=>$val){
			$sql.=$delim.' '.$col.' = :'.$col.' ';
			$delim='AND';
		}
	}
	else{
		echo 'Requete sans clause where impossible';
		}
		
	if ($debug) echo '<pre><code>'.$sql.'</code></pre>';
	
	$req = $bdd->prepare($sql);
	$tab_merged=array_merge($tab_valeurs, $tab_where);
	if ($req->execute($tab_merged)){
		$affected_rows = $req->rowCount();
		}
	else $affected_rows=-1;
	return $affected_rows;
	
	}
	
	//DELETE
function db_delete($table, $tab_where, $debug=false){
	global $bdd;
	
	$sql = 'DELETE FROM '.$table;
	
	if (!empty($tab_where)){
		$delim=' WHERE';
		foreach ($tab_where as $col=>$val){
		$sql.=$delim.' '.$col.' = :'.$col.' ';
		$delim='AND';
		}
		
	}
	else{
		echo 'Requete sans clause where impossible';
		}
		
	if ($debug) echo '<pre><code>'.$sql.'</code></pre>';
	
	$req = $bdd->prepare($sql);
	if ($req->execute($tab_where)){
		$affected_rows = $req->rowCount();
		}
	else $affected_rows=-1;
	return $affected_rows;
	
	}

	//SELECT
function db_select($sql, $tab_valeurs='', $debug=false, $optnum=''){
	global $bdd;
	if (empty($tab_valeurs)){
		$req = $bdd->query($sql);
		}
	else{
		//$req = $bdd->prepare('SELECT titre, auteur FROM actualites WHERE visible = ?  AND date <= ? ORDER BY date');
		$req = $bdd->prepare($sql);
		$req->execute($tab_valeurs);
		}
	if ($debug) echo '<pre><code>'.$sql.'</code></pre>';
	if ($optnum=='num') $donnees = $req->fetchAll(PDO::FETCH_NUM);//tableau associatif
	else $donnees = $req->fetchAll(PDO::FETCH_ASSOC);//tableau iteratif
	$req->closeCursor(); 
	
	return $donnees;
	}


function erreur($err='')
{
    $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
    exit('<p>'.$mess);
}

//se deconnecter
if(isset($_GET['logout'])&&$_GET['logout']==true){
	session_destroy();
	header('Location: home.php');
}



?>
