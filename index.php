<?php

require_once('src/controllers/edito.php');
require_once('src/controllers/recette.php');


try {
	if (isset($_GET['action']) && $_GET['action'] !== '') {
		if ($_GET['action'] === 'recette') {
			recette();
		}
		else {
			echo "Erreur 404 : la page que vous recherchez n'existe pas.";
		}
	} else {
		edito();
	} 
} catch (Exception $e) {
	echo 'Erreur : '.$e->getMessage();
}