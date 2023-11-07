<?php ob_start();?>


<!-- ↓----------------------------------------------------↓ Code de la page ↓----------------------------------------------------↓ -->

<h1 class="text-center text-charte_bleu_fonce font-permanent_marker text-5xl mb-5">Détails de la recette</h1>
<p class="text-3xl text-center text-charte_bleu_clair">Page affichant les détails de la recette sélectionnée.</p>

<div id="recette">
    <?php
        echo "<img src='" . $recette->rec_image . "' alt='Image recette " . $recette->rec_titre . "' width='500px'/></a>" . "<br>" .
        "<a href='index.php?action=recette_unique&id=" . $recette->rec_id . "'>" . strtoupper($recette->rec_titre) . "</a><br>" .
        "Categorie : " . $recette->cat_intitule . "<br>" .
        "Resumé : " . $recette->rec_resume . "<br>" . 
        "Tags : " . $recette->tags_intitule;
    ?>
</div>

<?php $content = ob_get_clean();
require_once('template.php'); ?>