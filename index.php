<?php

require_once('src/controllers/edito.php');
require_once('src/controllers/liste_recette.php');
require_once('src/controllers/connexion_compte.php');

try {
	if (isset($_GET['action']) && $_GET['action'] !== '') {
		if ($_GET['action'] === 'liste_recette') {
			recette();
		}
		else if ($_GET['action'] === 'recette_unique') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				echo "page de d'une recette";
			}
		}
		else if ($_GET['action'] === 'connexion_compte') {
			connexion_compte();
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