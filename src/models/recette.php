<?php



class Recette {
    public int $id;
    public int $cat_id;
    public int $user_id;
    public string $rec_titre;
    public string $rec_contenu;
    public string $rec_resume;
    public string $rec_image;
    public string $rec_date_crea;
    public string $rec_date_modif;
    public string $rec_auteur;
}

class PostRepository {
    public ?PDO $bdd = null;

    public function dbConnect()
    {
        $db_host = parse_ini_file('all_secret_variables.env')["DB_HOST"];
        $db_name = parse_ini_file('all_secret_variables.env')["DB_NAME"];
        $db_encode = parse_ini_file('all_secret_variables.env')["DB_ENCODE"];
        $db_username = parse_ini_file('all_secret_variables.env')["DB_USERNAME"];
        $db_password = parse_ini_file('all_secret_variables.env')["DB_PASSWORD"];

        if ($this->bdd == null) {
            $this->bdd = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=' . $db_encode, $db_username, $db_password);
        }
    }

    public function getRecettes(): array 
    {
        $this->dbConnect($this);
        $requeteRecette = $this->bdd->query(
            "SELECT REC_ID, REC_IMAGE, REC_TITRE, CAT_INTITULE, REC_RESUME, TAG_INTITULE FROM FORK_RECETTE JOIN FORK_CATEGORIE USING(CAT_ID) JOIN FORK_TAGS USING(TAG_ID) ORDER BY rec_date_crea DESC LIMIT 15;"
        );
        $recettes = [];
        while (($row = $requeteRecette->fetch())) {
            $recette = new Recette();
            $recette->id = $row[''];
            $recette->cat_id = $row[''];
            $recette->user_id = $row[''];
            $recette->rec_titre = $row[''];
            $recette->rec_contenu = $row[''];
            $recette->rec_resume = $row[''];
            $recette->rec_image = $row[''];
            $recette->rec_date_crea = $row[''];
            $recette->rec_date_modif = $row[''];
            $recette->rec_auteur = $row[''];
    
            $recettes[] = $recette;
        }
    
        return $recettes;
    }

    public function getRecette(string $identifier): Post {
        $this->dbConnect($this);
        $statement = $this->bdd->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);
    
        $row = $statement->fetch();
    
        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];
    
        return $post;
    }
}

?>








<?php
    require_once 'includes/connexionBDD.php';

    function recupererToutesLesRecettes($bdd) {
        $requeteRecette = "
            SELECT REC_ID, REC_IMAGE, REC_TITRE, CAT_INTITULE, REC_RESUME, TAG_INTITULE FROM FORK_RECETTE JOIN FORK_CATEGORIE USING(CAT_ID) JOIN FORK_TAGS USING(TAG_ID) ORDER BY rec_date_crea DESC LIMIT 15;
        ";
        $reqServeurRecette = $bdd->prepare($requeteRecette);
        $reqServeurRecette->execute();
        $nom_variableRecette = $reqServeurRecette->fetchAll(); /*changer le nom_variable en fonction de ce que tu veux afficher*/

        foreach($nom_variableRecette as $nom_table_sql_recette) { /*changer les variables nom_table_sql en fonction de la table sql utilisée*/
            $nomPlat = $nom_table_sql_recette["REC_TITRE"];
            $requeteTags = "SELECT TAG_INTITULE FROM FORK_TAGS WHERE TAG_RECETTE = '$nomPlat'";
            $reqServeurTags = $bdd->prepare($requeteTags);
            $reqServeurTags->execute();
            $nom_variableTags = $reqServeurTags->fetchAll();
            echo 
            "<a href='../../../view/php/page/detail_recette.php?idPlat=" . $nom_table_sql_recette['REC_ID'] . "'>" . "<img src='" . $nom_table_sql_recette["REC_IMAGE"] . "' alt='Image recette " . $nom_table_sql_recette["REC_TITRE"] . "' width='500px'/></a>" . "<br>" .
            "<a href='../../../view/php/page/detail_recette.php?idPlat=" . $nom_table_sql_recette['REC_ID'] . "'>" . strtoupper($nom_table_sql_recette["REC_TITRE"]) . "</a>" . "<br>" .
            "Categorie : " . $nom_table_sql_recette["CAT_INTITULE"] . "<br>" .
            "Resumé : " . $nom_table_sql_recette["REC_RESUME"] . "<br>" . 
            "Tags : ";
            foreach($nom_variableTags as $nom_table_sql_tags) {
                echo '#' . $nom_table_sql_tags["TAG_INTITULE"] . ' ';
            }
        }
    }


?>
