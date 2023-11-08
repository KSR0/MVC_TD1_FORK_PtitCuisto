<?php

require_once('src/controllers/edito.php');
require_once('src/controllers/liste_recette.php');
require_once('src/controllers/details_recette.php');
require_once('src/controllers/connexion_compte.php');
require_once('src/controllers/creation_compte.php');


try {
	if (isset($_GET['action']) && $_GET['action'] !== '') {
		if ($_GET['action'] === 'liste_recette') {
			recettes();
		}
		else if ($_GET['action'] === 'details_recette') {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				recette($_GET['id']);
			}
		}
		else if ($_GET['action'] === 'connexion_compte') {
			connexion_compte();
		}
		else if ($_GET['action'] === 'creation_compte') {
			creation_compte();
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