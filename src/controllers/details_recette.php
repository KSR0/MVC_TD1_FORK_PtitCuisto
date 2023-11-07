<?php

require_once('src/models/liste_recette.php');

function recette(string $identifier) {
	$recetteRepository = new RecetteRepository();
	$recette = $recetteRepository->getRecette($identifier);
	require('views/details_recette.php');
}
?>