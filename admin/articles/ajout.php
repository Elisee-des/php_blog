<?php

if (!empty($_POST)) {
    //s'il n'est pas vide
    if (
        isset($_POST["titre"], $_POST["contenu"]) &&
        !empty($_POST["titre"]) && !empty($_POST["contenu"])
    ) 
    {
        //le formulaire est complet
        //on va chercher les donner tout en les protegeant des failles xss
        //-strip_tags, -htmlentity, -htmlspecialchar

        //on retire les balise du titre
        // $balise_permis = ["<,>"];

        $titre = strip_tags($_POST["titre"]);

        //on neutralise les balises html
        $contenu = htmlspecialchars($_POST["contenu"]);

        //on se connect a la base de donnee
        require_once "../../includes/connection.php";

        //On enregistre les donnee du formulaire dans a base de donnees
        $sql = "INSERT INTO `articles`(`title`, `content`) VALUES (:title, :content)";

        $requete = $db->prepare($sql);

        $requete->bindValue(":title", $titre, PDO::PARAM_STR);
        $requete->bindValue(":content", $contenu, PDO::PARAM_STR);

        //on execute la requete
        $requete->execute();
        if (!$requete->execute()) {
            die("Une erreur est survenue lors de l'insertion");
        }else{
            $id = $db->lastInsertId();

            die("Un article a ete ajouter sous le le numero $id");
        }
    }
    else {
        //le formulaire est incomplet
        die("Veuillez remplire tout les champs");
    }
}

$titre = "Ajout d'article";

require_once "../../includes/hearder.php";
require_once "../../includes/navbar.php";

?>

<h2>Ajouter un article</h2>

<div class="card-body">
    <div class="container">
        <form method="POST">
            <fieldset>
                <div>
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id="titre">
                </div>
                <div>
                    <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="contenu" cols="20" rows="6"></textarea>
                </div><br>
                <button type="submit" class="btn-primary">Creer l'article</button>
            </fieldset>
        </form>
    </div>
</div>

<?php


include "../../includes/footer.php";

?>