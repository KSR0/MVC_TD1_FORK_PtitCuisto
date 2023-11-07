<?php

require_once('src/models/liste_recette.php');

function recette() {
	$recetteRepository = new RecetteRepository();
	$recettes = $recetteRepository->getRecettes();
	require('views/liste_recette.php');
}
?>